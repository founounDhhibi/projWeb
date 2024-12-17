<?php
require_once "../../Controller/commandeProduitsController.php";
require_once "../../Controller/ProduitController.php";
require_once "../../Controller/commande_Controller.php";
$user = 1;
if(isset($_GET["id_produit"]) && isset($_GET["id_commande"]) && isset($_GET["action"]) && isset($_GET['quantity'])) {
    $id_prod = $_GET['id_produit'];
    $id_commande = $_GET['id_commande'];
    $action = $_GET["action"];
    $commandeController = new CommandController();
    $produitController = new ProduitController();
    $cpController = new CommandeProduitsController();

    $produit = $produitController->getProduit($id_prod);
    $commande = $commandeController->getLastCommande($user);

    if ($action == "decrease") {
        $quantity = $_GET['quantity'] - 1;
        if ($quantity == 0) {
            $cpController->deleteProduitCommande($id_commande, $id_prod);
            $commandes = $commandeController->joinProduitCommandeByStatus($user);
            if($commandes != null){
                $updated_price = $commande['montant_commande'] - $produit['prix_produit'];
                $commandeController->updatePrice($id_commande, $updated_price);
                header('Location: cart.php');
            } else {
                $commandeController->deleteCommande($id_commande);
                header('Location: product-list.php');
            }
            header("Location:cart.php");
        } else {
            $updated_price = $commande['montant_commande'] - $produit['prix_produit'];
            $commandeController->updatePrice($id_commande, $updated_price);
            $cpController->updateQuantity($id_commande,$id_prod, $quantity);
            header('Location: cart.php');
        }
    } else if ($action == "increase") {
        $quantity = $_GET['quantity'] + 1;
        $updated_price = $commande['montant_commande'] + $produit['prix_produit'];
        $commandeController->updatePrice($id_commande, $updated_price);
        $cpController->updateQuantity($id_commande, $id_prod,$quantity);
        header('Location: cart.php');
    } else
        header("Location:cart.php?action=".$action);
} else
    header("Location:cart.php");
