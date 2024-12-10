<?php
include '../../config.php';
$conn = getConnexion();
session_start();
$warning_msg = [];
$success_msg = [];
// Get product ID from URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to get product details based on product ID using prepared statements
    $sql = "SELECT * FROM produits WHERE id_prod = :id_prod";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_prod', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC); // Correct way to fetch a single row

    if ($product) {
        // Query to get related products
        $related_sql = "SELECT * FROM produits WHERE categorie_prod = :categorie_prod LIMIT 4";
        $related_stmt = $conn->prepare($related_sql);
        $related_stmt->bindParam(':categorie_prod', $product['categorie_prod'], PDO::PARAM_STR);
        $related_stmt->execute();
        $relatedResult = $related_stmt->fetchAll(PDO::FETCH_ASSOC); // Correct way to fetch multiple rows

        // Query to get reviews for the current product (assuming a 'ratings' or 'reviews' table)
        $reviews_sql = "
            SELECT r.*, u.nom_user 
            FROM ratings r
            JOIN user u ON r.user_id = u.id_user  -- Correct column for the user
            WHERE r.product_id = :product_id
        ";
        $reviews_stmt = $conn->prepare($reviews_sql);
        $reviews_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $reviews_stmt->execute();
        $reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all reviews for the product
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID is missing.";
    exit();
}
?>
<?php
// Récupérer le message depuis l'URL
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : null;
?>

<!-- Affichage des messages -->
<?php if ($message === 'success') : ?>
    <div class="alert alert-success">
        <p>Le commentaire a été supprimé avec succès.</p>
    </div>
<?php elseif ($message === 'error') : ?>
    <div class="alert alert-danger">
        <p>Une erreur s'est produite lors de la suppression du commentaire.</p>
    </div>
<?php endif; ?>
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
                            <a href="product-list.php" class="nav-item nav-link">Products</a>
                            
                            <a href="cart.html" class="nav-item nav-link">Cart</a>
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
                    <li class="breadcrumb-item active">Product Detail</li>
                </ul>
            </div>
        </div>
        <!-- Breadcrumb End -->
        
 <!-- Product Detail Start lehnéééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééé -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                            <img src="<?php echo '../back/' . htmlspecialchars($product['image_prod']); ?>" alt="<?= $product['nom_prod'] ?>">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                            <div class="title"><h2><?= $product['nom_prod'] ?></h2></div>

<div class="rating">
    <?php 
        // Calcul de la moyenne des notes
        $averageRating = 0;
        $totalReviews = count($reviews);
        
        if ($totalReviews > 0) {
            $sumRatings = 0;
            foreach ($reviews as $review) {
                $sumRatings += $review['rating']; // Ajout de chaque note à la somme
            }
            $averageRating = $sumRatings / $totalReviews; // Calcul de la moyenne
        }
        
        // Affichage des étoiles
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $averageRating) {
                // Afficher une étoile pleine si l'indice est inférieur ou égal à la moyenne
                echo '<i class="fa fa-star"></i>';
            } else {
                // Afficher une étoile vide si l'indice est supérieur à la moyenne
                echo '<i class="fa fa-star-o"></i>';
            }
        }
    ?>
</div>

                                <div class="price">
                                    <h4>Price:</h4>
                                    <p>$<?= $product['prix_prod'] ?></p>
                                </div>
                                <div class="description">
                                    <p><?= $product['description_prod'] ?></p>
                                </div>
                                <!-- Ajout du bouton "Go to Reviews" -->
                                <div class="product-reviews">
                                    <a class="btn btn-primary" href="add_rating.php?id=<?= $product['id_prod'] ?>"><i class="fa fa-comments"></i> add Review</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product">
    <div class="box-container">
        <h1>Related Products</h1>
    </div>
    <div class="row align-items-center product-slider product-slider-3">
        <?php foreach ($relatedResult as $related) { ?>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="product-detail.php?id=<?= $related['id_prod'] ?>"><?= $related['nom_prod'] ?></a>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.php?id=<?= $related['id_prod'] ?>">
                        <img src="<?php echo '../back/' . htmlspecialchars($product['image_prod']); ?>" alt="<?= $product['nom_prod'] ?>">
                        </a>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span><?= $related['prix_prod'] ?></h3>
                        <a class="btn" href="cart.php?add=<?= $related['id_prod'] ?>"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>
    <div class="section-header">
   <h1>Customer Reviews</h1>
</div>

<?php if (count($reviews) > 0) { ?>
   <div class="review-container">
      <?php foreach ($reviews as $review) { ?>
         <div class="review-box">
            <div class="review-header">
               <img src="./img/man.png" alt="User Avatar" class="review-avatar">
               <div>
                  <div class="review-author"><?= htmlspecialchars($review['nom_user']) ?></div>
                  <div class="review-date"><?= date('Y-m-d', strtotime($review['created_at'])) ?></div>
               </div>
               <div class="review-rating">
                  <i class="fa fa-star review-star"></i>
                  <span><?= $review['rating'] ?></span>
               </div>
            </div>
            
            <div class="review-content">
               <h3 class="review-title"><?= htmlspecialchars($review['titre']) ?></h3>
               <p class="review-comment"><?= htmlspecialchars($review['description']) ?></p>
            </div>

            <!-- Actions : Affichage conditionnel -->
            <div class="review-actions">
             
                  <!-- Bouton Edit : envoyer id_rate -->
                  <form method="POST" action="update_rating.php">
    <!-- ID du commentaire (id_rate) à supprimer -->
    <input type="hidden" name="id_rate" value="<?= htmlspecialchars($review['id_rate']); ?>">
    <!-- ID du produit à transmettre -->
    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id_prod']); ?>">
    <input type="submit" class="btn edit-btn" name="Edit" value="Edit Review" >
</form>

          

              
                  <!-- Bouton Delete : réservé aux admins -->
                  <div class="review-actions">
    <!-- Formulaire pour supprimer une évaluation -->
    <form method="POST" action="delete_rating.php">
    <!-- ID du commentaire (id_rate) à supprimer -->
    <input type="hidden" name="id_rate" value="<?= htmlspecialchars($review['id_rate']); ?>">
    <!-- ID du produit à transmettre -->
    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id_prod']); ?>">
    <input type="submit" class="btn delete-btn" name="delete" value="Delete" onclick="return confirm('Do you really want to delete this rating?')">
</form>

</div>


              
            </div>
         </div>
      <?php } ?>
   </div>
<?php } else { ?>
   <p>No reviews yet. Be the first to review this product!</p>
<?php } ?>



<!-- Product Detail End -->
        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- Brand End -->
        
        <!-- Footer Start -->
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Get in Touch</h2>
                            <div class="contact-info">
                                <p><i class="fa fa-map-marker"></i>123 E Store, Los Angeles, USA</p>
                                <p><i class="fa fa-envelope"></i>email@example.com</p>
                                <p><i class="fa fa-phone"></i>+123-456-7890</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Follow Us</h2>
                            <div class="contact-info">
                                <div class="social">
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                    <a href=""><i class="fab fa-facebook-f"></i></a>
                                    <a href=""><i class="fab fa-linkedin-in"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Company Info</h2>
                            <ul>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Terms & Condition</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="footer-widget">
                            <h2>Purchase Info</h2>
                            <ul>
                                <li><a href="#">Pyament Policy</a></li>
                                <li><a href="#">Shipping Policy</a></li>
                                <li><a href="#">Return Policy</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row payment align-items-center">
                    <div class="col-md-6">
                        <div class="payment-method">
                            <h2>We Accept:</h2>
                            <img src="img/payment-method.png" alt="Payment Method" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="payment-security">
                            <h2>Secured By:</h2>
                            <img src="img/godaddy.svg" alt="Payment Security" />
                            <img src="img/norton.svg" alt="Payment Security" />
                            <img src="img/ssl.svg" alt="Payment Security" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->
        
        <!-- Footer Bottom Start -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 copyright">
                        <p>Copyright &copy; <a href="#">Your Site Name</a>. All Rights Reserved</p>
                    </div>

                    <div class="col-md-6 template-by">
						<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->					
                        <p>Designed By <a href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Bottom End -->      
        
        <!-- Back to Top -->
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>