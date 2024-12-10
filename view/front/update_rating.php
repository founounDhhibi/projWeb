<?php 
include '../../controller/ratingC.php'; 
$reviewC = new RatingC(); 
$conn = getConnexion();
$error = "";

// Vérification si l'ID est passé via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rate'])) { 
    $id_rate = intval($_POST['id_rate']); 
    if (!filter_var($id_rate, FILTER_VALIDATE_INT)) { 
        echo "<script>alert('L\'ID doit être un entier valide.');</script>"; 
        header('Location: update_rating.php'); 
        exit(); 
    } else { 
        $review = $reviewC->getRatingById($id_rate, $conn); 
        if (!$review) { 
            echo "<script>alert('L\'ID n\'existe pas dans la base de données.');</script>"; 
            exit(); 
        }
    }
}

// Vérification de la soumission du formulaire pour l'update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rating'])) {
    $id_rate = $_POST['id_rate'];
    $rating = $_POST['rating'];
    $description = $_POST['description'];
    $titre = $_POST['titre'];

    // Mise à jour de l'évaluation dans la base de données
    $result = $reviewC->updateRating($id_rate, $rating, $description, $titre, $conn);

    if ($result) {
        echo "<script>alert('Évaluation mise à jour avec succès.');</script>";
        header('Location: product-list.php'); // Redirection après la mise à jour
        exit();
    } else {
        echo "<script>alert('Une erreur est survenue lors de la mise à jour.');</script>";
    }
}

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
    </head>

    <body>
        <!-- Top bar Start -->
        <div class="top-bar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <i class="fa fa-envelope"></i>
                        support@email.com
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

        <!-- Checkout Start -->
        <div class="checkout">
            <div class="container-fluid"> 
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-inner">
                        <form action="#" method="post"> <!-- Formulaire pour soumettre les avis -->
                        <div class="billing-address">
                        <div class="container">
        <h2>Update Review</h2>

        <form action="update_rating.php" method="POST">
            <input type="hidden" name="id_rate" value="<?php echo $review['id_rate']; ?>"> <!-- id_rate au lieu de id_rating -->
            <input type="hidden" name="product_id" value="<?php echo $review['product_id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $review['user_id']; ?>">

            <div class="form-group">
                <label for="titre">Review Title</label> <!-- titre au lieu de title -->
                <input type="text" class="form-control" name="titre" value="<?php echo $review['titre']; ?>" required> <!-- titre -->
            </div>

            <div class="form-group">
                <label for="rating">Rate Note</label>
                <select class="custom-select" name="rating" required>
                    <option value="1" <?php echo ($review['rating'] == 1) ? 'selected' : ''; ?>>1</option>
                    <option value="2" <?php echo ($review['rating'] == 2) ? 'selected' : ''; ?>>2</option>
                    <option value="3" <?php echo ($review['rating'] == 3) ? 'selected' : ''; ?>>3</option>
                    <option value="4" <?php echo ($review['rating'] == 4) ? 'selected' : ''; ?>>4</option>
                    <option value="5" <?php echo ($review['rating'] == 5) ? 'selected' : ''; ?>>5</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Review Description</label>
                <textarea class="form-control" name="description" required><?php echo $review['description']; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update Review</button>
            <!-- Bouton de soumission -->
    
        </form>
    </div>
    
</form>

        <!-- Checkout End -->

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
                    <!-- Other Footer Content -->
                </div>
            </div>
        </div>
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
