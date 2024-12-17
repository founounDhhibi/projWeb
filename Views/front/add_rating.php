<?php
session_start();

if (isset($_SESSION["username"])) {
    if ($_SESSION["role_user"] == "ADMIN_ROLE")
        header("location:../back/utilisateurs.php");
} else {
    header("location:../front/login.php");
}

if (isset($_SESSION['email_user'])) {
    $email_user = $_SESSION['email_user']; // L'email de l'utilisateur connecté
} else {
    $email_user = "support@email.com"; // Email par défaut si l'utilisateur n'est pas connecté
}
if (isset($_SESSION['tel_user'])) {
    $tel_user = $_SESSION['tel_user']; // Numéro de téléphone de l'utilisateur connecté
} else {
    $tel_user = "+012-345-6789"; // Valeur par défaut si l'utilisateur n'est pas connecté
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
include '../../config.php';

$conn = config::getConnexion();

$user_id = $_SESSION["id_user"];

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
                $mail->addEmbeddedImage('logo.png', 'logo'); // Assurez-vous de remplacer le chemin par le chemin réel du logo

                $mail->send();
            } catch (Exception $e) {
                echo "Échec de l'envoi de l'email. Erreur: {$mail->ErrorInfo}";
            }
        }
    } else {
        $warning_msg[] = 'Veuillez remplir tous les champs requis correctement !';
    }
}

// Affichage des messages de notification dans la partie HTML
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

<?php include "dash.php"?>
<div class="background"></div>
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

        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
