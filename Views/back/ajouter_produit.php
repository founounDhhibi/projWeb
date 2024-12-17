<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}
$username=$_SESSION["username"];


include '../../controller/ProduitC.php';
$error = "";
$produit = null;
// Crée une instance du contrôleur
$produitController = new ProduitC();

if (
    isset($_POST["nom_produit"]) && $_POST["description_produit"] && $_POST["prix_produit"] && $_POST["stock_produit"] && $_POST["categorie_produit"]
) {
    if (
        !empty($_POST["nom_produit"]) && !empty($_POST["description_produit"]) && !empty($_POST["prix_produit"]) && !empty($_POST["stock_produit"]) && !empty($_POST["categorie_produit"])
    ) {
        // Si l'image est téléchargée, traitons-la
        $image_produit = null;
        if (isset($_FILES['image_produit'])) {
          // Vérifier s'il y a une erreur d'upload
          if ($_FILES['image_produit']['error'] !== UPLOAD_ERR_OK) {
              // Afficher le code d'erreur de l'upload
              echo "Error uploading file: " . $_FILES['image_produit']['error'];
              exit;
          }
          
          // Si aucune erreur, traiter l'image
          $image_produit = 'images' . basename($_FILES['image_produit']['name']);
          move_uploaded_file($_FILES['image_produit']['tmp_name'], $image_produit);
          echo "File uploaded successfully.";
      }
      

        // Si le champ status_produit est vide, on lui attribue la valeur "Disponible"
        $status_produit = isset($_POST['status_produit']) ? $_POST['status_produit'] : "Disponible"; // Par défaut "Disponible"

        
        $date_produit = date("Y-m-d"); 

        
        $produit = new Produits(
            0, 
            $_POST['nom_produit'],
            $_POST['description_produit'],
            $_POST['prix_produit'],
            $_POST['stock_produit'],
            $date_produit,
            $_POST['categorie_produit'],
            $status_produit,
            $image_produit
        );

        
        $produitController->addProduit($produit);

        // Redirige vers la liste des produits après ajout
        header('Location: afficher_produit.php');
        exit; // Assurez-vous de quitter le script après la redirection
    } else {
        $error = "Informations manquantes";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<?php include 'dash.php'; ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>add product</h1>
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
      <!-- Product Name -->
      <div class="row mb-3">
          <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="productName" name="nom_produit" >
          </div>
          <div id="productNameError"></div>
      </div>

      <!-- Number of Pieces -->
      <div class="row mb-3">
          <label for="productPieces" class="col-sm-2 col-form-label">Number of Pieces</label>
          <div class="col-sm-10">
              <input type="number" class="form-control" id="productStock" name="stock_produit" >
          </div>
          <div id="productStockError"></div>
      </div>

      <!-- Date -->
      <div class="row mb-3">
          <label for="productDate" class="col-sm-2 col-form-label">Date</label>
          <div class="col-sm-10">
              <input type="date" class="form-control" id="productDate" name="date_produit" >
          </div>
          <div id="productDateError"></div>
      </div>

      <!-- Description -->
      <div class="row mb-3">
          <label for="productDescription" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
              <textarea class="form-control" style="height: 100px" id="productDescription" name="description_produit" ></textarea>
          </div>
          <div id="productDescriptionError"></div>
      </div>

  <!-- Status -->
  <fieldset class="row mb-3">
      <legend class="col-form-label col-sm-2 pt-0">Status</legend>
      <div class="col-sm-10">
          <div class="form-check">
              <input class="form-check-input" type="radio" name="status_produit" id="available" value="available" checked>
              <label class="form-check-label" for="available">Available</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="radio" name="status_produit" id="notAvailable" value="not available">
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
                echo '<select id="productCategory" name="categorie_produit" class="form-select">';
                foreach ($categories as $row) {
                    echo '<option value="' . htmlspecialchars($row['id_categorie']) . '">' . htmlspecialchars($row['nom_categorie']) . '</option>';
                }
                echo '</select>';
            } else {
                echo '<select id="productCategory" name="categorie_produit" class="form-select">';
                echo '<option value="">Aucune catégorie disponible</option>';
                echo '</select>';
            }
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des catégories : " . htmlspecialchars($e->getMessage());
        }
        ?>
    </div>
</div>


      <!-- Price -->
      <div class="input-group mb-3">
          <span class="input-group-text">Price</span>
          <input type="text" class="form-control" id="productPrice" name="prix_produit" aria-label="Amount (to the nearest dollar)" >
          <span class="input-group-text">.00</span>
          <div id="productPriceError"></div>
      </div>

      <!-- Product Image -->
      <div class="input-group mb-3">
          <span class="input-group-text">Image</span>
          <input type="file" class="form-control" id="productImage" name="image_produit" accept="image">
      </div>

      <!-- Submit Button -->
      
       <!-- Submit Button -->
       <div class="row mb-3">
          <div class="col-sm-10 offset-sm-2">
              <button type="submit" class="btn btn-primary" action=""  >Submit</button>
          </div>
      </div>

  
  </form>


        
           
          </div>

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
  
  
  <script src="js/ajouterProduit.js"></script>

</body>

</html>
