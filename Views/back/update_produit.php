<?php
include '../../controller/ProduitC.php';

$produitC = new ProduitC();
$conn = config::getConnexion();

$id_produit = null;
$produit = null;
$error = "";
$id_produit = $_POST['id_produit'];

// Vérifier si l'ID est un entier
if (filter_var($id_produit, FILTER_VALIDATE_INT) === false) {
    echo "<script>alert('L\'ID doit être un entier valide.');</script>";
    // Rediriger après l'alerte pour éviter de continuer avec un ID invalide
    header('update_produit.php');  // Remplacez par l'URL correcte de la page
    exit(); // Arrêter l'exécution du script après la redirection
} else {
    // Requête pour vérifier si l'ID existe dans la base de données
    $query = "SELECT COUNT(*) FROM produits WHERE id_produit = :id_produit";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            echo "<script>alert('L\'ID n\'existe pas dans la base de données.');</script>";
            // Rediriger après l'alerte pour empêcher la modification avec un ID erroné
            header('Location: /update_produit.php');  // Assurez-vous que ce fichier existe à la racine du serveur
            exit();
            exit();
        } 
    } catch (PDOException $e) {
        echo "Erreur lors de la vérification : " . htmlspecialchars($e->getMessage());
    }
}



// Vérifiez si l'ID a été transmis via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_produit']) || isset($_POST['id_produit'])) {
        $id_produit = $_POST['id_produit'] ?? $_POST['id_produit'];
        // Vérifiez si l'ID existe dans la base de données
        $produit = $produitC->getProduitById($id_produit, $conn);
        if (!$produit) {
            $error = "Product ID not found.";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_produit'])) {
// Validation des champs
$status_produit = isset($_POST['status_produit']) ? $_POST['status_produit'] : 'available'; // Valeur par défaut : "available"
$images_produit = !empty($_FILES['images_produit']['name']) ? $_FILES['images_produit']['name'] : $produitExistant['images_produit'] ?? '';

// Instanciation de l'objet Produits
$produit = new Produits(
    $id_produit,
    $_POST['nom_produit'],
    $_POST['description_produit'],
    (float) $_POST['prix_produit'],
    (int) $_POST['stock_produit'],
    $_POST['date_produit'],
    $_POST['categorie_produit'],
    $status_produit,
    $images_produit
);

  $produitC->updateProduit($id_produit, $produit);

  // Redirection après mise à jour
  header('Location: afficher_produit.php');
  exit;
}


?>




<!DOCTYPE html>
<html lang="en">

<?php include 'dash.php'; ?>
  <main id="main" class="main">

<div class="pagetitle">
   
<main id="main" class="main">

<div class="pagetitle">
   <?php if (!empty($id_produit)) : ?>
    <!-- Si l'ID est défini et non vide -->
    <h1>Update product with Id = <?php echo $id_produit; ?></h1>
<?php else : ?>
    <!-- Si l'ID est inconnu -->
    <h1>Update Product</h1>
    <form method="POST" action="">
        <label for="id_produit">Enter the Product ID:</label>
        <input type="text" id="id_produit" name="id_produit" >
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
<?php endif; ?>
</div>

</main>

      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

 
    <!--formulaiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiirrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrre-->
    <form id="ProductForm" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id_produit" value="<?= htmlspecialchars($produit['id_produit'] ?? '') ?>">

    <!-- Nom du produit -->
    <div class="row mb-3">
        <label for="productName" class="col-sm-2 col-form-label">Nom du produit</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="productName" name="nom_produit" 
                   value="<?= htmlspecialchars($produit['nom_produit'] ?? '') ?>">
        </div>
        <div id="productNameError"></div>
    </div>

    <!-- Description -->
    <div class="row mb-3">
        <label for="productDescription" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" id="productDescription" name="description_produit"><?= htmlspecialchars($produit['description_produit'] ?? '') ?></textarea>
        </div>
        <div id="productDescriptionError"></div>
    </div>

    <!-- Prix -->
    <div class="row mb-3">
        <label for="productPrice" class="col-sm-2 col-form-label">Prix</label>
        <div class="col-sm-10">
            <input type="number" step="0.01" class="form-control" id="productPrice" name="prix_produit" 
                   value="<?= htmlspecialchars($produit['prix_produit'] ?? '') ?>">
        </div>
        <div id="productPriceError"></div>
    </div>

    <!-- Stock -->
    <div class="row mb-3">
        <label for="productStock" class="col-sm-2 col-form-label">Stock</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="productStock" name="stock_produit" 
                   value="<?= htmlspecialchars($produit['stock_produit'] ?? '') ?>">
        </div>
        <div id="productStockError"></div>
    </div>

    <!-- Date -->
    <div class="row mb-3">
        <label for="productDate" class="col-sm-2 col-form-label">Date</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" id="productDate" name="date_produit" 
                   value="<?= htmlspecialchars($produit['date_produit'] ?? '') ?>">
        </div>
        <div id="productDateError"></div>
    </div>

    <!-- Status -->
    <fieldset class="row mb-3">
        <legend class="col-form-label col-sm-2 pt-0">Status</legend>
        <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status_produit" id="available" value="available" 
                       <?= (isset($produit['status_produit']) && $produit['status_produit'] === 'available') ? 'checked' : '' ?>>
                <label class="form-check-label" for="available">Available</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status_produit" id="notAvailable" value="not available" 
                       <?= (isset($produit['status_produit']) && $produit['status_produit'] === 'not available') ? 'checked' : '' ?>>
                <label class="form-check-label" for="notAvailable">Not Available</label>
            </div>
        </div>
    </fieldset>

    <!-- Category -->
    <div class="row mb-3">
        <label for="productCategory" class="col-sm-2 col-form-label">Category</label>
        <div class="col-sm-10">
            <?php
            include_once('../../config.php');
            $conn = config::getConnexion();
            $query = "SELECT id_categorie, nom_categorie FROM categorie";
            try {
                $stmt = $conn->prepare($query);
                $stmt->execute();
                $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (!empty($categories)) {
                    echo '<select id="productCategory" class="form-control" name="categorie_produit">';
                    foreach ($categories as $row) {
                        $selected = (isset($produit['categorie_produit']) && $produit['categorie_produit'] == $row['id_categorie']) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($row['id_categorie']) . '" ' . $selected . '>' . htmlspecialchars($row['nom_categorie']) . '</option>';
                    }
                    echo '</select>';
                } else {
                    echo '<select id="productCategory" class="form-control" name="categorie_produit">';
                    echo '<option value="">Aucune catégorie disponible</option>';
                    echo '</select>';
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la récupération des catégories : " . htmlspecialchars($e->getMessage());
            }
            ?>
        </div>
    </div>

    <!-- Image -->
    <div class="row mb-3">
        <label for="productImage" class="col-sm-2 col-form-label">Image</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" id="productImage" name="image_produit">
            <?php if (!empty($produit['images_produit'])) : ?>
                <img src="<?= htmlspecialchars($produit['images_produit']) ?>" alt="Image du produit" class="img-thumbnail mt-2" style="max-width: 150px;">
            <?php endif; ?>
        </div>
    </div>

    <!-- Bouton de soumission -->
    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </div>
    </div>
</form>


  
  


        

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  

  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  
  <script src="js/updateProduit.js"></script>

</body>

</html>
