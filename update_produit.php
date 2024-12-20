<?php

include '../../controller/ProduitC.php';
/*if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = [
    'status' => 'success',
    'message' => 'Data received successfully!',
  
  ];
  header('Content-Type: application/json');
  echo json_encode($data);
  exit;
  die();
}*/

$error = "";

$produit = null;
// Crée une instance du contrôleur
$produitController = new ProduitC();

if (
    isset($_POST["nom_prod"]) && $_POST["description_prod"] && $_POST["prix_prod"] && $_POST["stock_prod"] && $_POST["categorie_prod"]
) {
    if (
        !empty($_POST["nom_prod"]) && !empty($_POST["description_prod"]) && !empty($_POST["prix_prod"]) && !empty($_POST["stock_prod"]) && !empty($_POST["categorie_prod"])
    ) {
        // Si l'image est téléchargée, traitons-la
        $image_prod = null;
        if (isset($_FILES['image_prod'])) {
          // Vérifier s'il y a une erreur d'upload
          if ($_FILES['image_prod']['error'] !== UPLOAD_ERR_OK) {
              // Afficher le code d'erreur de l'upload
              echo "Error uploading file: " . $_FILES['image_prod']['error'];
              exit;
          }
          
          // Si aucune erreur, traiter l'image
          $image_prod = 'images' . basename($_FILES['image_prod']['name']);
          move_uploaded_file($_FILES['image_prod']['tmp_name'], $image_prod);
          echo "File uploaded successfully.";
      }
      

        // Si le champ status_prod est vide, on lui attribue la valeur "Disponible"
        $status_prod = isset($_POST['status_prod']) ? $_POST['status_prod'] : "Disponible"; // Par défaut "Disponible"

        // Vous pouvez obtenir la date du produit, par exemple, la date actuelle
        $date_prod = date("Y-m-d"); // Format YYYY-MM-DD

        // Crée un nouvel objet Produit
        $produit = new Produits(
            0, // L'ID sera auto-incrémenté par la base de données
            $_POST['nom_prod'],
            $_POST['description_prod'],
            $_POST['prix_prod'],
            $_POST['stock_prod'],
            $date_prod,
            $_POST['categorie_prod'],
            $status_prod,
            $image_prod
        );

        // Appel de la méthode pour ajouter le produit dans la base de données
        $produitController->updateproduit($id_prod,$produit);

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

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>update products</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Artisanat-Denden</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>



            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>admin de l'artisanat de denden</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>add product/category </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="ajouter_produit.html" class="active">
              <i class="bi bi-circle"></i><span>add product/category</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>update  </span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
          <li>
            <a href="update_produit.php" class="active">
              <i class="bi bi-circle"></i><span>update product</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>products/categories list</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="afficher_produit.php">
              <i class="bi bi-circle"></i><span>products table</span>
            </a>
          </li>
  
        </ul>
      </li><!-- End Tables Nav -->
    </ul>
   

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>update productwith Id = <?php echo $_POST['id_prod'] ?? 'No ID Provided'; ?></h1>
 
    </div><!-- End Page Title -->
    <?php
    if (isset($_POST['id_prod'])) {
        $produit = $produitC->showproduit($_POST['id_prod']);
       
    ?>

    <!--formulaiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiirrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrre-->
    <form id="productForm" action="" method="POST" enctype="multipart/form-data">
      <!-- Product Name -->
      <div class="row mb-3">
          <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
          <div class="col-sm-10">
              <input type="text" class="form-control" id="productName" name="productName" >
          </div>
      </div>

      <!-- Number of Pieces -->
      <div class="row mb-3">
          <label for="productPieces" class="col-sm-2 col-form-label">Number of Pieces</label>
          <div class="col-sm-10">
              <input type="number" class="form-control" id="productPieces" name="productPieces" >
          </div>
      </div>

      <!-- Date -->
      <div class="row mb-3">
          <label for="productDate" class="col-sm-2 col-form-label">Date</label>
          <div class="col-sm-10">
              <input type="date" class="form-control" id="productDate" name="productDate" >
          </div>
      </div>

      <!-- Description -->
      <div class="row mb-3">
          <label for="productDescription" class="col-sm-2 col-form-label">Description</label>
          <div class="col-sm-10">
              <textarea class="form-control" style="height: 100px" id="productDescription" name="productDescription" ></textarea>
          </div>
      </div>

  <!-- Status -->
  <fieldset class="row mb-3">
      <legend class="col-form-label col-sm-2 pt-0">Status</legend>
      <div class="col-sm-10">
          <div class="form-check">
              <input class="form-check-input" type="radio" name="productStatus" id="available" value="available" checked>
              <label class="form-check-label" for="available">Available</label>
          </div>
          <div class="form-check">
              <input class="form-check-input" type="radio" name="productStatus" id="notAvailable" value="not available">
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
              $conn = getConnexion();
              $query = "SELECT id_categorie, nom_categorie FROM categorie";
              try {
                  $stmt = $conn->prepare($query);
                  $stmt->execute();
                  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  if (!empty($categories)) {
                      echo '<select id="productCategory" name="productCategory" required>';
                      foreach ($categories as $row) {
                          echo '<option value="' . htmlspecialchars($row['id_categorie']) . '">' . htmlspecialchars($row['nom_categorie']) . '</option>';
                      }
                      echo '</select>';
                  } else {
                      echo '<select id="productCategory" name="productCategory" required>';
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
          <input type="text" class="form-control" id="productPrice" name="productPrice" aria-label="Amount (to the nearest dollar)" required>
          <span class="input-group-text">.00</span>
      </div>

      <!-- Product Image -->
      <div class="input-group mb-3">
          <span class="input-group-text">Image</span>
          <input type="file" class="form-control" id="productImage" name="productImage" accept="image">
      </div>

      <!-- Submit Button -->
      
       <!-- Submit Button -->
       <div class="row mb-3">
          <div class="col-sm-10 offset-sm-2">
              <button type="submit" class="btn btn-primary" action="">Submit</button>
          </div>
      </div>

  
  </form>


 
             
  

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

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
  
  


</body>

</html>
