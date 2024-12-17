<?php

$search_query = isset($_GET['search']) ? $_GET['search'] : null;
if ($search_query) {
    $sql_produit .= " AND p.nom_produit LIKE :search_query";
}
?>


<head>
    <meta charset="utf-8">
    <title>maison d'artisanat DENDEN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="eCommerce HTML Template Free Download" name="keywords">
    <meta content="eCommerce HTML Template Free Download" name="description">

    <!-- Favicon -->
    <link href="logo.png" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap" rel="stylesheet">

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="lib/slick/slick.css" rel="stylesheet">
    <link href="lib/slick/slick-theme.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    
    <link href="css/styleeee.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
/* Conteneur général pour un fond flou */
/* Conteneur de l'image de fond floue */
/* Conteneur pour l'image de fond floue */
.background {
    position: fixed; /* Couvre toute la page */
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('back.jpg') no-repeat center center fixed; /* Chemin de ton image */
    background-size: cover; /* Couvre toute la zone */
    filter: blur(10px); /* Applique uniquement un flou à l'image */
    z-index: -1; /* Place en arrière-plan */
}

/* Conteneur principal pour le contenu */
.main-content {
    position: relative;
    z-index: 1; /* Place le contenu au-dessus de l'image */
    padding: 20px;
    text-align: center;
    color: #333;
    background-color: rgba(255, 255, 255, 0.8); /* Optionnel : améliore la lisibilité */
    border-radius: 10px;
}



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
    width: 100%;  /* Makes imagess responsive and adjusts to the container's width */
    height: 200px; /* Fixed height for all imagess */
    object-fit: cover; /* Ensures the images covers the area without distortion */
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

        .review-container {
   display: flex;
   flex-direction: column;
   gap: 20px;
   margin-top: 20px;
}

.review-box {
   border: 1px solid #e0e0e0;
   border-radius: 8px;
   padding: 15px;
   background-color: #fff;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.review-header {
   display: flex;
   align-items: center;
   gap: 15px;
   margin-bottom: 10px;
}

.review-avatar {
   width: 50px;
   height: 50px;
   border-radius: 50%;
   object-fit: cover;
}

.review-author {
   font-weight: bold;
   font-size: 16px;
}

.review-date {
   font-size: 14px;
   color: #888;
}

.review-rating {
   margin-left: auto;
   display: flex;
   align-items: center;
   gap: 5px;
}

.review-star {
   color: #f39c12;
   font-size: 16px;
}

.review-title {
   font-size: 18px;
   margin-bottom: 5px;
}

.review-comment {
   font-size: 14px;
   color: #555;
}

.review-actions {
   margin-top: 10px;
   display: flex;
   gap: 10px;
}

.btn {
   padding: 8px 12px;
   border: none;
   border-radius: 5px;
   cursor: pointer;
}

.edit-btn {
   background-color: #f1c40f;
   color: #fff;
}

.delete-btn {
   background-color: #e74c3c;
   color: #fff;
}

</style>

</head>

<body>
<!-- Top bar Start -->
 <div class="background"></div>
<div class="top-bar">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <i class="fa fa-envelope"></i>
                <?php echo $email_user; // Affiche l'email de l'utilisateur si nécessaire ?>
            </div>
            <div class="col-sm-6">
                <i class="fa fa-phone-alt"></i>
                <?php echo $tel_user; // Affiche le numéro de téléphone de l'utilisateur connecté ?>
            </div>
        </div>
    </div>
</div>



<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="home.php" class="nav-item nav-link">Home</a>
                    <a href="product-list.php" class="nav-item nav-link">Products</a>
                    
                    <a href="cart.php" class="nav-item nav-link">Cart</a>
                    
                    <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        <a href="event.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Events</a>
                        <div class="dropdown-menu">
                            <a href="event.php" class="dropdown-item">events list</a>
                            <a href="mesParticipations.php?id_user=<?php echo $user_id; ?>" class="dropdown-item">my participations</a>
                            
                        </div>
                    </div>
                </div>
                </div>
                <div class="navbar-nav ml-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username'] ?></a>
                        <div class="dropdown-menu">
                            <a href="logout.php" class="dropdown-item">Logout</a>
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
