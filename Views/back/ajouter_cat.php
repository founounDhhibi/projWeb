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

include '../../controller/categorieC.php'; // Inclure le contrôleur des catégories
$error = "";
$categorie = null;

// Créer une instance du contrôleur des catégories
$categorieController = new CategorieC();

// Vérifier si les champs nécessaires sont présents dans le formulaire
if (isset($_POST["nom_categorie"]) && isset($_POST["description_categorie"])) {
    // Vérifier que les champs ne sont pas vides
    if (!empty($_POST["nom_categorie"]) && !empty($_POST["description_categorie"])) {

        // Créer une instance de Categorie avec les données du formulaire
        $categorie = new Categorie(
            0, // L'ID peut être 0 pour indiquer qu'il s'agit d'une nouvelle catégorie
            $_POST['nom_categorie'],
            $_POST['description_categorie']
        );

        // Ajouter la catégorie à la base de données
        $categorieController->addCategorie($categorie);

        // Redirige vers la liste des catégories après ajout
        header('Location: afficher_cat.php');
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
      <h1>add category</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<!-- Formulaire pour ajouter une catégorie -->
<form id="CategoryForm" action="" method="POST">

    <!-- Category Name -->
    <div class="row mb-3">
        <label for="categoryName" class="col-sm-2 col-form-label">Category Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="categoryName" name="nom_categorie" >
        </div>
        <div id="categoryNameError"></div>
        <small id="categoryError" class="form-text text-danger"></small>
    </div>

    <!-- Description -->
    <div class="row mb-3">
        <label for="categoryDescription" class="col-sm-2 col-form-label">Description</label>
        <div class="col-sm-10">
            <textarea class="form-control" style="height: 100px" id="categoryDescription" name="description_categorie" ></textarea>
        </div>
        <div id="categoryDescriptionError"></div>
        <small id="categoryError" class="form-text text-danger"></small>
    </div>

    <!-- Submit Button -->
    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>

</form>

<div class="col-lg-6">



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


<script src="js/ajouterCat.js"></script>

</body>

</html>
