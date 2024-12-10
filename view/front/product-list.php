<?php
// Connexion à la base de données
include '../../config.php';
$conn = getConnexion();

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
$sql_prod = "SELECT p.nom_prod, p.prix_prod, p.image_prod, p.id_prod 
             FROM produits p
             LEFT JOIN categorie c ON p.categorie_prod = c.id_categorie 
             WHERE 1=1"; // Toujours vrai pour faciliter l'ajout de conditions dynamiques

// Ajouter une condition pour filtrer par catégorie si une catégorie est sélectionnée
if ($category_id) {
    $sql_prod .= " AND p.categorie_prod = :category_id";
}

// Ajouter une condition pour la recherche par nom
if ($search_query) {
    $sql_prod .= " AND p.nom_prod LIKE :search_query";
}

// Ajouter des conditions pour la gamme de prix
if ($price_min !== null) {
    $sql_prod .= " AND p.prix_prod >= :price_min";
}
if ($price_max !== null) {
    $sql_prod .= " AND p.prix_prod <= :price_max";
}

// Ajouter une condition pour la disponibilité des produits
if ($status_filter) {
    $sql_prod .= " AND p.status_prod = :status_filter";
}

// Ajouter la pagination à la requête SQL
$sql_prod .= " LIMIT :limit OFFSET :offset";

$stmt_prod = $conn->prepare($sql_prod);

// Liaison des paramètres si nécessaire
if ($category_id) {
    $stmt_prod->bindParam(':category_id', $category_id, PDO::PARAM_INT);
}
if ($search_query) {
    $search_param = '%' . $search_query . '%';
    $stmt_prod->bindParam(':search_query', $search_param, PDO::PARAM_STR);
}
if ($price_min !== null) {
    $stmt_prod->bindParam(':price_min', $price_min, PDO::PARAM_STR);
}
if ($price_max !== null) {
    $stmt_prod->bindParam(':price_max', $price_max, PDO::PARAM_STR);
}
if ($status_filter) {
    $stmt_prod->bindParam(':status_filter', $status_filter, PDO::PARAM_STR);
}

// Lier les paramètres de pagination
$stmt_prod->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt_prod->bindParam(':offset', $offset, PDO::PARAM_INT);

$stmt_prod->execute();

// Stocker le résultat des produits
$products = $stmt_prod->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre total de produits pour la pagination
$sql_count = "SELECT COUNT(*) FROM produits p WHERE 1=1";
if ($category_id) {
    $sql_count .= " AND p.categorie_prod = :category_id";
}
if ($search_query) {
    $sql_count .= " AND p.nom_prod LIKE :search_query";
}
if ($price_min !== null) {
    $sql_count .= " AND p.prix_prod >= :price_min";
}
if ($price_max !== null) {
    $sql_count .= " AND p.prix_prod <= :price_max";
}
if ($status_filter) {
    $sql_count .= " AND p.status_prod = :status_filter";
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
$total_products = $stmt_count->fetchColumn();
$total_pages = ceil($total_products / $limit); // Nombre total de pages
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>E Store - eCommerce HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="eCommerce HTML Template Free Download" name="keywords">
    <meta content="eCommerce HTML Template Free Download" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">


    <style>
        /* Sidebar styles */
/* Pagination Container */
.pagination {
    margin: 20px 0;
}

/* Pagination Items */
.pagination .page-item {
    display: inline-block;
    margin: 0 5px;
}

/* Pagination Links */
.pagination .page-link {
    display: block;
    padding: 8px 16px;
    font-size: 16px;
    color: #007bff;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none;
    transition: background-color 0.3s, color 0.3s;
}

/* Hover Effect for Page Links */
.pagination .page-link:hover {
    background-color: #ffc859;
    color: #fff;
}

/* Active Page */
.pagination .page-item.active .page-link {
    background-color:#ffc859;
    color: #fff;
    border-color: #007bff;
}

/* Disabled State */
.pagination .page-item.disabled .page-link {
    color: #ffc859;
    background-color: #fff;
    border-color: #ccc;
    pointer-events: none;
}

/* Pagination Navigation (Previous and Next) */
.pagination .page-item .page-link {
    font-weight: bold;
}

/* Pagination Justify Center */
.pagination.justify-content-center {
    display: flex;
    justify-content: center;
}


.product-img {
    width: 100%;  /* Makes images responsive and adjusts to the container's width */
    height: 200px; /* Fixed height for all images */
    object-fit: cover; /* Ensures the image covers the area without distortion */
}

.sidebar {
    background-color: #f8f9fa;
    padding: 20px;
    border-radius: 8px;
}

.sidebar-title h4 {
    font-size: 18px;
    margin-bottom: 15px;
    font-weight: bold;
}

.sidebar-categories {
    list-style-type: none;
    padding: 0;
}

.sidebar-categories li {
    margin-bottom: 10px;
}

.sidebar-categories a {
    text-decoration: none;
    color: #333;
    font-size: 16px;
    display: block;
    padding: 8px 0;
}

.sidebar-categories a:hover {
    color: #007bff;
}

.sidebar-price-range input[type="range"] {
    width: 100%;
}

.price-range-value {
    text-align: center;
    margin-top: 10px;
}

.sidebar-filter label {
    display: block;
    margin-bottom: 10px;
    font-size: 14px;
}


.sidebar-search button {
    width: 100%;
    margin-top: 10px;
}





.search button {
    position: absolute;
    right: 0;
    top: 10%;
    transform: translateY(-30%); /* Pour centrer verticalement */
    border-radius: 0 0.25rem 0.25rem 0; /* Coin arrondi du bouton */
    padding: 10px;
    background-color: #007bff; /* Couleur du bouton */
    color: white;
    border: none;
    cursor: pointer;
}

.search button:hover {
    background-color: #0056b3;
}


    </style>
</head>

<body>
    <!-- Top bar Start -->
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <i class="fa fa-envelope"></i>
                    heritech@gmail.com
                </div>
                <div class="col-sm-6">
                    <i class="fa fa-phone-alt"></i>
                    +012-345-6789
                </div>
            </div>
        </div>
    </div>
    <!-- Top bar End -->
    
    <!-- Nav Bar Start -->
    <div class="nav">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                <a href="#" class="navbar-brand">MENU</a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                            <a href="index.html" class="nav-item nav-link">Home</a>
                            <a href="product-list.php" class="nav-item nav-link">Products</a>
                    
                            <a href="cart.html" class="nav-item nav-link">Cart</a>
                            <a href="my-account.html" class="nav-item nav-link">My Account</a>
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">More Pages</a>
                                <div class="dropdown-menu">
                                    <a href="wishlist.html" class="dropdown-item">Wishlist</a>
                                    <a href="login.html" class="dropdown-item">Login & Register</a>
                                    <a href="contact.html" class="dropdown-item">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    <div class="navbar-nav ml-auto">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">User Account</a>
                            <div class="dropdown-menu">
                                <a href="#" class="dropdown-item">Login</a>
                                <a href="#" class="dropdown-item">Register</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Nav Bar End -->      
    
    <!-- Bottom Bar Start -->
    <div class="bottom-bar">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-3">
                    <div class="logo">
                        <a href="index.html">
                            <img src="img/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
    <div class="search">
        <!-- Formulaire de recherche -->
        <form method="GET" action="product-list.php">
            <input type="text" name="search" placeholder="Search products..." class="form-control" value="<?= htmlspecialchars($search_query); ?>">
            <button type="submit" class="btn btn-primary mt-2">
                <i class="fa fa-search"></i> 
            </button>
        </form>
    </div>
</div>

                <div class="col-md-3">
                    <div class="user">
                        <a href="wishlist.html" class="btn wishlist">
                            <i class="fa fa-heart"></i>
                            <span>(0)</span>
                        </a>
                        <a href="cart.html" class="btn cart">
                            <i class="fa fa-shopping-cart"></i>
                            <span>(0)</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bottom Bar End -->  
    
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
                <li class="breadcrumb-item active">Product List</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumb End -->
    
    <!-- Product List Start -->
    <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        

                        <?php if (count($products) > 0): ?>
                            <?php foreach ($products as $row): ?>
                                <!-- Debugging: Check if 'id_prod' exists in each row -->
                                <?php if (isset($row['id_prod']) && !empty($row['id_prod'])): ?>
                                    <div class="col-md-4">
                                        <div class="product-item">
                                            <div class="product-title">
                                                <a href="#"><?php echo htmlspecialchars($row['nom_prod']); ?></a>
                                                <div class="ratting">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                            <div class="product-image">
                                                <a href="product-detail.php?id=<?= $row['id_prod']; ?>">
                                                <img src="<?php echo '../back/' . htmlspecialchars($row['image_prod']); ?>" alt="Product Image" class="product-img">

                                                </a>
                                                <div class="product-action">
                                                    <a href="#"><i class="fa fa-cart-plus"></i></a>
                                                    <a href="#"><i class="fa fa-heart"></i></a>
                                                    <a href="product-detail.php?id=<?= $row['id_prod']; ?>"><i class="fa fa-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="product-price">
                                                <h3>€<?php echo number_format($row['prix_prod'], 2); ?></h3>
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


    <!-- Footer Start -->
    <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-logo">
                        <a href="#">
                            <img src="img/logo.png" alt="Logo">
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-info">
                        <p>&copy; 2024 Your Company. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

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