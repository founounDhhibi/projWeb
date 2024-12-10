<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
include '../../config.php';

$conn = getConnexion();
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 4;

$warning_msg = [];
$success_msg = [];

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_prod = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
} else {
    header('location:product-list.php');
    exit;
}

if (isset($_POST['submit'])) {
    $titre = isset($_POST['title']) ? filter_var($_POST['title'], FILTER_SANITIZE_STRING) : '';
    $description = isset($_POST['description']) ? filter_var($_POST['description'], FILTER_SANITIZE_STRING) : '';
    $rating = isset($_POST['rating']) ? filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT) : 0;

    if (!empty($titre) && !empty($description) && $rating > 0) {
        $verify_review = $conn->prepare("SELECT * FROM `ratings` WHERE product_id = ? AND user_id = ?");
        $verify_review->execute([$id_prod, $user_id]);

        if ($verify_review->rowCount() > 0) {
            $warning_msg[] = 'Votre avis a déjà été ajouté !';
        } else {
            // Insertion de l'avis dans la base de données
            $add_review = $conn->prepare("INSERT INTO `ratings` (product_id, user_id, rating, created_at, titre, description) VALUES (?, ?, ?, NOW(), ?, ?)");
            $add_review->execute([$id_prod, $user_id, $rating, $titre, $description]);
            $success_msg[] = 'Avis ajouté avec succès !';

            // Envoi d'email à l'admin
            try {
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'violonistafounoun@gmail.com'; // Remplacez par votre email
                $mail->Password = 'cxbu lopp ldip fbnq'; // Remplacez par votre mot de passe
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('violonistafounoun@gmail.com', 'maison artisanat Denden');
                $mail->addAddress('admin@example.com'); // Email de l'administrateur

                $mail->isHTML(true);
                $mail->Subject = 'Nouvelle évaluation soumise';
                $mail->Body = "
                <html>
                    <head>
                        <style>
                            body {
                                font-family: Arial, sans-serif;
                                color: #333;
                            }
                            .email-header {
                                text-align: center;
                                background-color: #f1f1f1;
                                padding: 20px;
                            }
                            .email-header img {
                                width: 150px;
                            }
                            .email-content {
                                padding: 20px;
                                background-color: #fff;
                                border-radius: 8px;
                                border: 1px solid #ddd;
                            }
                            .email-content h3 {
                                color: #0056b3;
                            }
                            .footer {
                                text-align: center;
                                font-size: 12px;
                                color: #777;
                                margin-top: 20px;
                            }
                            .footer a {
                                color: #0056b3;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='email-header'>
                            <img src='cid:logo' alt='Maison Artisanat Denden'>
                            <h2>Maison Artisanat Denden</h2>
                        </div>
                        <div class='email-content'>
                            <h3>Nouvelle évaluation reçue pour le produit ID: $id_prod</h3>
                            <p><strong>Titre:</strong> $titre</p>
                            <p><strong>Description:</strong> $description</p>
                            <p><strong>Note:</strong> $rating/5</p>
                            <p><strong>Utilisateur ID:</strong> $user_id</p>
                            <p><strong>Date de soumission:</strong> " . date("Y-m-d H:i:s") . "</p>
                        </div>
                        <div class='footer'>
                            <p>Merci d'avoir choisi la Maison Artisanat Denden</p>
                            <p>Vous recevez ce message car vous êtes inscrit à notre service. <a href='#'>Se désinscrire</a></p>
                        </div>
                    </body>
                </html>
                ";

                // Ajouter le logo de la Maison Artisanat Denden dans l'email
                $mail->addEmbeddedImage('img/logo.png', 'logo'); // Assurez-vous de remplacer le chemin par le chemin réel du logo

                $mail->send();
            } catch (Exception $e) {
                echo "Échec de l'envoi de l'email. Erreur: {$mail->ErrorInfo}";
            }
        }
    } else {
        $warning_msg[] = 'Veuillez remplir tous les champs requis correctement !';
    }
}

// Affichage des messages de notification
if (!empty($warning_msg)) {
    foreach ($warning_msg as $msg) {
        echo "<div class='alert alert-warning'>$msg</div>";
    }
}

if (!empty($success_msg)) {
    foreach ($success_msg as $msg) {
        echo "<div class='alert alert-success'>$msg</div>";
    }
}
?>




<!-- Partie HTML pour afficher les messages -->
<?php if (!empty($warning_msg)) : ?>
    <div class="alert alert-warning">
        <?php foreach ($warning_msg as $msg) : ?>
            <p><?= $msg; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($success_msg)) : ?>
    <div class="alert alert-success">
        <?php foreach ($success_msg as $msg) : ?>
            <p><?= $msg; ?></p>
        <?php endforeach; ?>
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
        <h2>Review the product</h2>
        <div class="row">
            <div class="col-md-6">
                <label>Title of the rate</label>
                <input class="form-control" type="text" placeholder="Add title to your review" name="title"> <!-- Correction ici -->
            </div>
            <div class="col-md-12">
                <label for="rating-description">Description</label>
                <textarea class="form-control" id="rating-description" rows="4" placeholder="Describe your experience with the product" name="description"></textarea> <!-- Correction ici -->
            </div>
            <div class="col-md-6">
                <label>Rate Note</label>
                <select class="custom-select" name="rating"> <!-- Correction ici -->
                    <option selected>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit Review</button> <!-- Ajout de l'attribut name="submit" -->
</form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
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
