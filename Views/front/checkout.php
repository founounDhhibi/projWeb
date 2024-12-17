<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE" )
        header("location:../back/utilisateurs.php") ;
} else {
    header("location:../front/login.php") ;
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


require_once "../../Controller/commande_Controller.php";

$user = $_SESSION['id_user'];
$commandeController = new CommandController();
$cmd = $commandeController->getLastCommande($user);
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
                            <div class="Adresse de facturation">
                                <h2>Facturation</h2>
                                <form action="payerCommande.php" method="post">
                                    <input type="number" name="montant" value="<?php echo $cmd['montant_commande']; ?>" hidden>
                                    <input type="number" name="id_commande" value="<?php echo $cmd['id_commande']; ?>" hidden>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Méthode de paiement</label>
                                            <select name="methode_paiement" class="custom-select">
                                                <option selected>Par carte</option>
                                                <option>Espèce</option>
                                                <option>Chéque</option>
                                            </select>
                                            <input class="form-control" type="text" name="code_coupon" placeholder="Enter your code coupon">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <button class="btn btn-primary" type="submit">Payer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="checkout-inner">
                            <div class="checkout-summary">
                                <h1>Total</h1>
                                <h2>Montant à payer<span><?php echo $cmd['montant_commande']; ?>dt</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Checkout End -->
        
        
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
