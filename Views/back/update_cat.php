<?php
include '../../controller/CategorieC.php';  // Inclure le contrôleur de catégorie

$categorieC = new CategorieC();
$conn = config::getConnexion();

$id_categorie = null;
$categorie = null;
$error = "";
$id_categorie = $_POST['id_categorie'];  // Récupérer l'ID de la catégorie à mettre à jour

// Vérifier si l'ID est un entier valide
if (filter_var($id_categorie, FILTER_VALIDATE_INT) === false) {
    echo "<script>alert('L\'ID doit être un entier valide.');</script>";
    // Rediriger après l'alerte pour éviter de continuer avec un ID invalide
    header('Location: update_cat.php');  // Remplacez par l'URL correcte de la page de mise à jour
    exit(); // Arrêter l'exécution du script après la redirection
} else {
    // Requête pour vérifier si l'ID existe dans la base de données
    $query = "SELECT COUNT(*) FROM categorie WHERE id_categorie = :id_categorie";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            echo "<script>alert('L\'ID n\'existe pas dans la base de données.');</script>";
            // Rediriger après l'alerte pour empêcher la modification avec un ID erroné
            header('Location: afficher_cat.php');  // Assurez-vous que ce fichier existe à la racine du serveur
            exit();
        } 
    } catch (PDOException $e) {
        echo "Erreur lors de la vérification : " . htmlspecialchars($e->getMessage());
    }
}

// Vérification de la méthode POST et si les données sont envoyées pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_categorie'])) {
        $id_categorie = $_POST['id_categorie'];
        // Vérifiez si l'ID existe dans la base de données
        $categorie = $categorieC->getCategorieById($id_categorie, $conn);
        if (!$categorie) {
            $error = "ID de la catégorie non trouvé.";
        }
    }
}

// Si le formulaire est soumis avec de nouvelles données pour la mise à jour
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom_categorie'])) {
    // Validation des champs
    $nom_categorie = $_POST['nom_categorie'];
    
    // Instanciation de l'objet Categorie
    $categorie = new Categorie(
        $id_categorie,
    $_POST['nom_categorie'],
    $_POST['description_categorie']
    );

    // Mise à jour de la catégorie dans la base de données
    $categorieC->updateCategorie($id_categorie, $categorie);

    // Redirection après la mise à jour
    header('Location: afficher_cat.php');
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
   <?php if (!empty($id_categorie)) : ?>
    <!-- Si l'ID est défini et non vide -->
    <h1>Update categorie with Id = <?php echo $id_categorie; ?></h1>
<?php else : ?>
    <!-- Si l'ID est inconnu -->
    <h1>Update category</h1>
    <form method="POST" action="">
        <label for="id_produit">Enter the category ID:</label>
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

 
    <form id="CategoryForm" action="update_cat.php" method="POST">
    <input type="hidden" name="id_categorie" value="<?= htmlspecialchars($categorie['id_categorie']) ?>">

    <!-- Nom de la catégorie -->
    <div class="row mb-3">
        <label for="categoryName" class="col-sm-2 col-form-label">Nom de la catégorie</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="categoryName" name="nom_categorie" 
                   value="<?= htmlspecialchars($categorie['nom_categorie']) ?>" required>
        </div>
    </div>

    <!-- Description  -->
    <div class="row mb-3">
        <label for="categoryDescription" class="col-sm-2 col-form-label">Description </label>
        <div class="col-sm-10">
            <textarea class="form-control" id="categoryDescription" name="description_categorie"><?= htmlspecialchars($categorie['description_categorie'] ?? '') ?></textarea>
        </div>
    </div>

    <!-- Bouton de soumission -->
    <div class="row mb-3">
        <div class="col-sm-10 offset-sm-2">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
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
