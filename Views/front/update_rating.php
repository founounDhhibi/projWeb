<?php
session_start();

if (isset($_SESSION["username"])) {
    if ($_SESSION["role_user"] == "ADMIN_ROLE") {
        header("location:../back/utilisateurs.php");
    }
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

include '../../controller/ratingC.php'; 
$reviewC = new RatingC(); 
$conn = config::getConnexion();
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

    // Récupérer l'ID du produit associé à cette évaluation
    $product_id = $_POST['product_id']; // L'ID du produit transmis depuis le formulaire

    // Mise à jour de l'évaluation dans la base de données
    $result = $reviewC->updateRating($id_rate, $rating, $description, $titre, $conn);

    if ($result) {
        echo "<script>
        alert('Évaluation mise à jour avec succès.');
        setTimeout(function() {
            window.location.href = 'product-detail.php?id=" . $product_id . "';
        },200); // Délai de 3 secondes (3000 millisecondes) avant la redirection
    </script>";

        exit();
    } else {
        echo "<script>alert('Une erreur est survenue lors de la mise à jour.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?>
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

        
        
        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/slick/slick.min.js"></script>
        
        <!-- Template Javascript -->
        <script src="js/main.js"></script>
    </body>
</html>
