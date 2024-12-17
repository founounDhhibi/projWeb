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

include '../../controller/produitC.php';
$travelOfferC = new ProduitC();
$list = $travelOfferC->listeProduits();
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 5; // Number of items per page
$start = ($page - 1) * $limit;

$travelOfferC = new ProduitC();
$list = $travelOfferC->listeProduitsPaginated($start, $limit);
$totalItems = $travelOfferC->countProduits();
$totalPages = ceil($totalItems / $limit);

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'dash.php'; ?>
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>product Table</h1>
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
                    <th scope="col"> image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Number of pieces</th>
                    <th scope="col">Description</th>
                    <th scope="col"> status</th>
                    <th scope="col"> category</th>
                    <th scope="col"> price</th>
                    <th scope="col"> Date</th>
                    
                    <th scope="col"> update</th>
                    <th scope="col"> delete</th>
                  </tr>
                </thead>
                <tbody>  
                <?php
foreach ($list as $produit) {
    ?> 
    <tr>
        <td><?= $produit['id_produit']; ?></td>
        <td>
            <img src="<?= $produit['images_produit']; ?>" alt="Image du produit" width="100" height="100">
        </td>
        <td><?= $produit['nom_produit']; ?></td>
        <td><?= $produit['stock_produit']; ?></td>
        <td><?= $produit['description_produit']; ?></td>
        <td><?= $produit['status_produit']; ?></td>
        <td><?= $produit['categorie_produit']; ?></td>
        <td><?= $produit['prix_produit']; ?></td>
        <td><?= $produit['date_produit']; ?></td>
       
        <td >
            <form method="POST" action="update_Produit.php">
                <input type="submit" name="update" class="btn btn-primary" value="update">
                <input type="hidden" value="<?= $produit['id_produit']; ?>" name="id_produit">
            </form>
        </td>
        <td>
    <form method="POST" action="delete_produit.php">
        <input type="hidden" value="<?php echo $produit['id_produit']; ?>" name="id_produit">
        <input type="submit" class="btn btn-danger" name="delete" value="delete" onclick="return confirm('do you really want to delete this element ?')">

    </form>
</td>
    </tr>
    <?php
}
?>



        </div>
      </div>
    </section>
    <nav>
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page - 1 ?>">Previous</a></li>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <li class="page-item"><a class="page-link" href="?page=<?= $page + 1 ?>">Next</a></li>
        <?php endif; ?>
    </ul>
</nav>
  
  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
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
</body>
</html>