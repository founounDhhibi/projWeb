<?php
include '../../config.php';
$conn = getConnexion();

// Fetch products
$sql = "SELECT nom_prod, prix_prod, image_prod, id_prod FROM produits";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Store the result
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

.sidebar-search input {
    width: 100%;
    padding: 8px;
}

.sidebar-search button {
    width: 100%;
    margin-top: 10px;
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
                        <a href="product-list.html" class="nav-item nav-link active">Products</a>
                        <a href="product-detail.html" class="nav-item nav-link">Product Detail</a>
                        <a href="cart.html" class="nav-item nav-link">Cart</a>
                        <a href="checkout.html" class="nav-item nav-link">Checkout</a>
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
                        <input type="text" placeholder="Search">
                        <button><i class="fa fa-search"></i></button>
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
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="product-search">
                                            <input type="email" placeholder="Search">
                                            <button><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-short">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle" data-toggle="dropdown">Product sort by</div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Newest</a>
                                                    <a href="#" class="dropdown-item">Popular</a>
                                                    <a href="#" class="dropdown-item">Most sale</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-price-range">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle" data-toggle="dropdown">Product price range</div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">$0 to $50</a>
                                                    <a href="#" class="dropdown-item">$51 to $100</a>
                                                    <a href="#" class="dropdown-item">$101 to $150</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                    <img src="<?php echo '../back/' . htmlspecialchars($row['image_prod']); ?>" alt="Product Image">
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
        <li><a href="#">All Products</a></li>
        <li><a href="#">Electronics</a></li>
        <li><a href="#">Clothing</a></li>
        <li><a href="#">Home Appliances</a></li>
        <li><a href="#">Furniture</a></li>
        <li><a href="#">Books</a></li>
        <li><a href="#">Sports</a></li>
    </ul>
    
    <div class="sidebar-title">
        <h4>Price Range</h4>
    </div>
    <div class="sidebar-price-range">
        <input type="range" class="custom-range" min="0" max="500" step="10" id="price-range">
        <div class="price-range-value">
            <span>€0</span> - <span>€500</span>
        </div>
    </div>

    <div class="sidebar-title">
        <h4>Filters</h4>
    </div>
    <div class="sidebar-filter">
        <label>
            <input type="checkbox"> In Stock Only
        </label>
        <label>
            <input type="checkbox"> On Sale
        </label>
    </div>

    <div class="sidebar-title">
        <h4>Search</h4>
    </div>
    <div class="sidebar-search">
        <input type="text" placeholder="Search products..." class="form-control">
        <button class="btn btn-primary mt-2">Search</button>
    </div>
</div>
<!-- Sidebar End -->

                    
                </div>
            </div>
        </div>
    </div>
    <!-- Product List End -->

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
    <script src="js/main.js"></script>
</body>
</html>