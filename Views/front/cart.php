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
require_once "../../Controller/ProduitController.php";

$user = $_SESSION['id_user'];
$commandeController = new CommandController();
$produitController = new ProduitController();
$commandes = $commandeController->joinProduitCommandeByStatus($user);
$cmd = $commandeController->getLastCommande($user);
$increase = "increase";
$decrease = "decrease";
$search_query = isset($_GET['search']) ? $_GET['search'] : null;
if ($search_query) {
    $sql_produit .= " AND p.nom_produit LIKE :search_query";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?> 
<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Quantite</th>
                                <th>Total</th>
                                <th>Remove</th>
                            </tr>
                            </thead>
                            <tbody class="align-middle">
                            <?php
                            foreach ($commandes as $cm) {
                                $prod = $produitController->getProduit($cm['id_produit']);
                                $uniqueId = $cm['id_commande'] . '_' . $prod['id_produit']; // Identifiant unique
                                ?>
                                <tr>
                                    <td>
                                        <div class="img">
                                            <a href="#"><img src="../back/<?php echo $prod['images_produit']; ?>"
                                                             alt="Image"></a>
                                            <p><?php echo $prod['nom_produit']; ?></p>
                                        </div>
                                    </td>
                                    <td><?php echo $prod['prix_produit']; ?>dt</td>
                                    <td>
                                        <script>
                                            function increaseClick<?php echo $uniqueId; ?>() {
                                                window.location.href = "updateCart.php?id_commande=<?php echo $cm['id_commande']; ?>&id_produit=<?php echo $prod['id_produit']; ?>&action=increase&quantity=<?php echo $cm['quantite_commande_produit']; ?>";
                                            }

                                            function decreaseClick<?php echo $uniqueId; ?>() {
                                                window.location.href = "updateCart.php?id_commande=<?php echo $cm['id_commande']; ?>&id_produit=<?php echo $prod['id_produit']; ?>&action=decrease&quantity=<?php echo $cm['quantite_commande_produit']; ?>";
                                            }
                                        </script>

                                        <div class="qty">
                                            <button onclick="decreaseClick<?php echo $uniqueId; ?>()" class="btn-minus">
                                                <i class="fa fa-minus"></i></button>
                                            <input type="text" value="<?php echo $cm['quantite_commande_produit']; ?>">
                                            <button onclick="increaseClick<?php echo $uniqueId; ?>()" class="btn-plus">
                                                <i class="fa fa-plus"></i></button>
                                        </div>
                                    </td>
                                    <td><?php echo $prod['prix_produit']; ?>dt</td>
                                    <td>
                                        <a href="deleteCommandeProduit.php?id_prod=<?php echo $prod['id_produit']; ?>&id_commande=<?php echo $cm['id_commande']; ?>"><i
                                                    class="fa fa-trash"></i></a></td>
                                </tr>
                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($cmd != null) { ?>
                            <form action="deleteCommande.php" method="post">
                                <div class="coupon">
                                    <input type="number" name="id_commande" value="<?php echo $cmd['id_commande']; ?>" hidden="">
                                    <button>Supprimer</button>
                                </div>
                            </form>
                            <?php } ?>
                        </div>
                        <div class="col-md-12">
                            <div class="cart-summary">
                                <div class="cart-content">
                                    <h1>Cart Summary</h1>
                                    <?php if ($cmd != null) { ?>
                                        <p>Total<span><?php echo $cmd['montant_commande']; ?>dt</span></p>
                                    <?php } else { ?>
                                        <p>Panier vide !</p>
                                    <?php } ?>
                                </div>
                                <?php if ($cmd != null) { ?>
                                        <script>
                                            function checkOut(){
                                                window.location.href = "checkout.php";
                                            }
                                        </script>
                                <div class="cart-btn">
                                    <button onclick="checkOut()">Payer</button>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->





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
