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
include 'dash.php';
include '../../controller/categorieC.php'; // Remplacer le chemin par le bon contrôleur de catégories
$categorieC = new CategorieC(); // Créer une instance du contrôleur des catégories

// Vérification de la page actuelle
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Page actuelle
$limit = 5; // Nombre d'éléments par page
$start = ($page - 1) * $limit; // Calcul de l'élément de départ pour la pagination

// Appel de la méthode de récupération des catégories avec pagination
$list = $categorieC->listeCategoriesPaginated($start, $limit);

// Appel de la méthode qui récupère le nombre total de catégories
$totalItems = $categorieC->countCategories();

$totalPages = ceil($totalItems / $limit);
?>



<!DOCTYPE html>
<html lang="en">

<?php include 'dash.php'; ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>category Table</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">list</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<!--formulaiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiirrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrre-->
<section class="section">
    <div class="row">
        <div class="col-lg-6">
           

            <!-- Default Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Update</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list as $categorie) {
                    ?> 
                        <tr>
                            <td><?= htmlspecialchars($categorie['id_categorie']); ?></td>
                            <td><?= htmlspecialchars($categorie['nom_categorie']); ?></td>
                            <td><?= htmlspecialchars($categorie['description_categorie']); ?></td>
                            <td>
                                <form method="POST" action="update_cat.php">
                                    <input type="submit" name="update" class="btn btn-primary" value="Update">
                                    <input type="hidden" value="<?= htmlspecialchars($categorie['id_categorie']); ?>" name="id_categorie">
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="delete_cat.php">
                                    <input type="hidden" value="<?= htmlspecialchars($categorie['id_categorie']); ?>" name="id_categorie">
                                    <input type="submit" class="btn btn-danger" name="delete" value="Delete" onclick="return confirm('Do you really want to delete?')">

                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

             

            


        </div>
      </div>
    </section>
    <nav>
    <ul class="pagination">
        <!-- Lien vers la page précédente, s'il y en a une -->
        <?php if ($page > 1): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>
        <?php endif; ?>

        <!-- Affichage des numéros de pages -->
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <!-- Lien vers la page suivante, s'il y en a une -->
        <?php if ($page < $totalPages): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>


  </main><!-- End #main -->
 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <!--
  <script type="text/javascript">
    $(document).ready(function(){
      $('table').dataTable()
    });
    </script>
                  -->

</body>

</html>