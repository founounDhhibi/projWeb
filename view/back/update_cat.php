<?php
include '../../controller/CategorieC.php';  // Inclure le contrôleur de catégorie

$categorieC = new CategorieC();
$conn = getConnexion();

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
        } else {
            // L'ID existe, vous pouvez procéder aux actions nécessaires
            echo "<script>alert('L\'ID existe. Vous pouvez continuer.');</script>";
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

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>update products and category</title>
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
            <a href="ajouter_produit.php" class="active">
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
   
<main id="main" class="main">

<div class="pagetitle">
   <?php if (!empty($id_categorie)) : ?>
    <!-- Si l'ID est défini et non vide -->
    <h1>Update categorie with Id = <?php echo $id_categorie; ?></h1>
<?php else : ?>
    <!-- Si l'ID est inconnu -->
    <h1>Update category</h1>
    <form method="POST" action="">
        <label for="id_prod">Enter the category ID:</label>
        <input type="text" id="id_prod" name="id_prod" >
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
  
  
  <script src="js/ajouterCat.js"></script>

</body>

</html>
