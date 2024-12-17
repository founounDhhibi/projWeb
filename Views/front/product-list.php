<?php
session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE" )
        header("location:../back/utilisateurs.php") ;
    
} else {
    header("location:../front/login.php") ;
}

if (isset($_SESSION['email_user'])) {
    $email_user = $_SESSION['email_user']; // L'email de l'utilisateur connecté
} else {
    $email_user = "support@email.com"; // Email par défaut si l'utilisateur n'est pas connecté
}
if (isset($_SESSION['tel_user'])) {
    $tel_user = $_SESSION['tel_user']; // Numéro de téléphone de l'utilisateur connecté
} else {
    $tel_user = "+012-345-6789"; // Valeur par défaut si l'utilisateur n'est pas connecté
}

// Connexion à la base de données
include '../../config.php';
$conn = config::getConnexion();

// Récupérer toutes les catégories depuis la base de données
$sql = "SELECT id_categorie, nom_categorie FROM categorie";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Stocker le résultat des catégories
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifier les filtres appliqués
$category_id = isset($_GET['category']) ? $_GET['category'] : null;
$search_query = isset($_GET['search']) ? $_GET['search'] : null;
$price_range = isset($_GET['price_range']) ? (int)$_GET['price_range'] : 0; // Récupérer la plage de prix

// Vérification si le price_range est égal à 0 (afficher tous les produits)
if ($price_range == 0) {
    $price_min = null;
    $price_max = null;
} else {
    $price_min = $price_range;
    $price_max = $price_range + 20; // Définir une plage de 20€ (ajuster si nécessaire)
}

$status_filter = isset($_GET['status']) ? $_GET['status'] : null;

// Pagination
$limit = 6; // Nombre de produits par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle, défaut à 1
$offset = ($page - 1) * $limit; // Décalage pour la requête SQL

// Préparer la requête pour récupérer les produits avec pagination
$sql_produit = "SELECT p.nom_produit, p.prix_produit, p.images_produit, p.id_produit 
             FROM produits p
             LEFT JOIN categorie c ON p.categorie_produit = c.id_categorie 
             WHERE 1=1"; // Toujours vrai pour faciliter l'ajout de conditions dynamiques

// Ajouter une condition pour filtrer par catégorie si une catégorie est sélectionnée
if ($category_id) {
    $sql_produit .= " AND p.categorie_produit = :category_id";
}

// Ajouter une condition pour la recherche par nom
if ($search_query) {
    $sql_produit .= " AND p.nom_produit LIKE :search_query";
}

// Ajouter des conditions pour la gamme de prix
if ($price_min !== null) {
    $sql_produit .= " AND p.prix_produit >= :price_min";
}
if ($price_max !== null) {
    $sql_produit .= " AND p.prix_produit <= :price_max";
}

// Ajouter une condition pour la disponibilité des produits
if ($status_filter) {
    $sql_produit .= " AND p.status_produit = :status_filter";
}

// Ajouter la pagination à la requête SQL
$sql_produit .= " LIMIT :limit OFFSET :offset";

$stmt_produit = $conn->prepare($sql_produit);

// Liaison des paramètres si nécessaire
if ($category_id) {
    $stmt_produit->bindParam(':category_id', $category_id, PDO::PARAM_INT);
}
if ($search_query) {
    $search_param = '%' . $search_query . '%';
    $stmt_produit->bindParam(':search_query', $search_param, PDO::PARAM_STR);
}
if ($price_min !== null) {
    $stmt_produit->bindParam(':price_min', $price_min, PDO::PARAM_STR);
}
if ($price_max !== null) {
    $stmt_produit->bindParam(':price_max', $price_max, PDO::PARAM_STR);
}
if ($status_filter) {
    $stmt_produit->bindParam(':status_filter', $status_filter, PDO::PARAM_STR);
}

// Lier les paramètres de pagination
$stmt_produit->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt_produit->bindParam(':offset', $offset, PDO::PARAM_INT);

$stmt_produit->execute();

// Stocker le résultat des produits
$products = $stmt_produit->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre total de produits pour la pagination
$sql_count = "SELECT COUNT(*) FROM produits p WHERE 1=1";
if ($category_id) {
    $sql_count .= " AND p.categorie_produit = :category_id";
}
if ($search_query) {
    $sql_count .= " AND p.nom_produit LIKE :search_query";
}
if ($price_min !== null) {
    $sql_count .= " AND p.prix_produit >= :price_min";
}
if ($price_max !== null) {
    $sql_count .= " AND p.prix_produit <= :price_max";
}
if ($status_filter) {
    $sql_count .= " AND p.status_produit = :status_filter";
}

$stmt_count = $conn->prepare($sql_count);

// Liaison des paramètres pour le comptage
if ($category_id) {
    $stmt_count->bindParam(':category_id', $category_id, PDO::PARAM_INT);
}
if ($search_query) {
    $stmt_count->bindParam(':search_query', $search_param, PDO::PARAM_STR);
}

if ($price_min !== null) {
    $stmt_count->bindParam(':price_min', $price_min, PDO::PARAM_STR);
}
if ($price_max !== null) {
    $stmt_count->bindParam(':price_max', $price_max, PDO::PARAM_STR);
}
if ($status_filter) {
    $stmt_count->bindParam(':status_filter', $status_filter, PDO::PARAM_STR);
}

$stmt_count->execute();

// Récupérer le nombre total de produits
$total_produitucts = $stmt_count->fetchColumn();
$total_pages = ceil($total_produitucts / $limit); // Nombre total de pages
?>




<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?>    
  <!-- Product List Start -->
  <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        

                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $row): ?>
                                <!-- Debugging: Check if 'id_produit' exists in each row -->
                                <?php if (isset($row['id_produit']) && !empty($row['id_produit'])): ?>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#"><?php echo htmlspecialchars($row['nom_produit']); ?></a>
                                                <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-images">
                                                <a href="product-detail.php?id=<?= $row['id_produit']; ?>">
                                                <img src="<?php echo '../back/' . htmlspecialchars($row['images_produit']); ?>" alt="Product images" class="product-img">

                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="product-detail.php?id=<?= $row['id_produit']; ?>"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3>TND<?php echo number_format($row['prix_produit'], 2); ?></h3>
                                                <a class="btn" href="ajouterCommandeProduit.php?id_prod=<?php echo $row['id_produit']; ?>"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                                            </div>
                                        </div>
                                       
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No products found.</p>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="col-lg-4">

                    <!-- Sidebar content (if needed) -->
<!-- Sidebar Start -->
<div class="sidebar">
    <div class="sidebar-title">
        <h4>Categories</h4>
    </div>
    <ul class="sidebar-categories">
        <!-- Lien pour tous les produits -->
        <li><a href="product-list.php" >All Products</a></li>

        <?php
        // Vérifiez si des catégories ont été récupérées
        if (!empty($categories)) {
            // Parcourez chaque catégorie et créez un lien pour chaque
            foreach ($categories as $category) {
                // Créez un lien dynamique qui pointe vers une page filtrée par catégorie
                echo '<li><a href="product-list.php?category=' . htmlspecialchars($category['id_categorie']) . '" id="brand">' . htmlspecialchars($category['nom_categorie']) . '</a></li>';
            }
        } else {
            // Si aucune catégorie n'est disponible, afficher un message
            echo '<li><a href="#">No categories available</a></li>';
        }
        ?>
    </ul>
</div>
<!-- Sidebar End -->

    
<div class="sidebar">
    <!-- Price Range Section -->
    <div class="sidebar-title">
        <h4>Price Range</h4>
    </div>
    <div class="sidebar-price-range">
        <input type="range" class="custom-range" min="0" max="500" step="10" id="price-range" name="price_range" 
               value="<?= isset($price_range) ? $price_range : 0; ?>" oninput="updatePriceRange()">
        <div class="price-range-value">
            <span>€<span id="price-min">0</span></span> - <span>€<span id="price-max">500</span></span>
        </div>
        <!-- Price range confirm button -->
        <button type="button" id="price-range-btn" class="btn btn-primary mt-2" onclick="applyPriceRange()">Apply Range</button>
    </div>
</div>


<!-- Filters Section -->
<div class="sidebar">
<div class="sidebar-title">
    <h4>avaibility</h4>
</div>
    <div class="sidebar-filter">
        <form method="GET" action="product-list.php">
            <label>
                <input type="radio" name="status" value="available" <?= $status_filter == 'available' ? 'checked' : ''; ?> onclick="this.form.submit();"> Available
            </label>
            <label>
                <input type="radio" name="status" value="not available" <?= $status_filter == 'not available' ? 'checked' : ''; ?> onclick="this.form.submit();"> Not Available
            </label>
        </form>
    </div>
</div>





                    
                </div>
            </div>
        </div>
    </div>
    <!-- Product List End -->
     <!-- Pagination Start -->
<div class="pagination">
    <nav>
        <ul class="pagination justify-content-center">
            <li class="page-item <?= ($page == 1) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= $page - 1; ?>">Previous</a>
            </li>
            <?php 
            // Affiche les numéros de page
            for ($i = 1; $i <= $total_pages; $i++) :
                // Vérifie si la page courante est celle-ci
                $active = ($page == $i) ? 'active' : ''; 
            ?>
                <li class="page-item <?= $active; ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= ($page == $total_pages) ? 'disabled' : ''; ?>">
                <a class="page-link" href="?page=<?= $page + 1; ?>">Next</a>
            </li>
        </ul>
    </nav>
</div>
<!-- Pagination End -->


   

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/slick/slick.min.js"></script>

    <!-- Template JavaScript -->
    <script>
    // Function to update price range values dynamically
    function updatePriceRange() {
        const range = document.getElementById('price-range');
        const min = document.getElementById('price-min');
        const max = document.getElementById('price-max');
        min.textContent = range.value;
        max.textContent = range.max;
    }

    // Function to apply the selected price range and redirect to the filtered product list
    function applyPriceRange() {
        var priceRange = document.getElementById('price-range').value;
        
        // Redirect the user to a filtered product list based on the selected price range
        window.location.href = "product-list.php?price_range=" + priceRange; // Adjust URL as necessary
    }

    // Call the function on page load
    window.onload = updatePriceRange;
</script>

</body>
</html>