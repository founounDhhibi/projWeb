<?php
require_once '../../Controller/paiement_Controller.php';
require_once '../../Controller/commande_Controller.php';
require_once '../../Controller/CodeCouponController.php';

if(isset($_POST['id_commande']) && isset($_POST['montant']) && isset($_POST['methode_paiement'])){
    $pController = new PaiementController();
    if(isset($_POST['code_coupon'])){
        $code_coupon  = $_POST['code_coupon'];
        $ccController = new CodeCouponController();
        $code = $ccController->getOneCodeCoupon($code_coupon);
        if($code){
            if(!$code['is_used']){
                $montant = ($_POST['montant'] / 100 ) * ( 100 - $code['remise']);
                $pController->addPaiement($_POST['id_commande'], $montant, $_POST['methode_paiement'], "En attente", $code['remise']);
                $commandeController = new CommandController();
                $commandeController->updateStatus($_POST['id_commande'], "En attente");
                $ccController->deleteOneCodeCoupon($code['id_code']);
                header("Location: produits.php");
            }
                echo "
                    <script>
                        alert('Code non valide !');
                        window.location.href='cart.php';
                    </script>
                ";
        } else
            echo "
                    <script>
                        alert('Code non valide !');
                        window.location.href='cart.php';
                    </script>
                ";
    } else {
        $pController->addPaiement($_POST['id_commande'], $_POST['montant'], $_POST['methode_paiement'], "En attente", 0);
        $commandeController = new CommandController();
        $commandeController->updateStatus($_POST['id_commande'], "En attente");
        header("Location: produits.php");
    }
} else
    header("Location: cart.php");