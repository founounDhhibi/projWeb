<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE" )
        header("location:../back/utilisateurs.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once "../../Controller/commandeProduitsController.php";
require_once "../../Controller/ProduitController.php";
require_once "../../Controller/commande_Controller.php";

$user = 1;
if(isset($_GET["id_prod"]) && isset($_GET["id_commande"])){
    $id_prod = $_GET['id_prod'];
    $id_commande = $_GET['id_commande'];
    $commandeController = new CommandController();
    $produitController = new ProduitController();
    $cpController = new CommandeProduitsController();
    $produit = $produitController->getProduit($id_prod);
    $commande = $commandeController->getLastCommande($user);
    $cp = $cpController->getProduitCommande($id_commande, $id_prod);
    $cpController->deleteProduitCommande($id_commande, $id_prod);
    $commandes = $commandeController->joinProduitCommandeByStatus($user);
    if($commandes != null){
        $updated_price = $commande['montant_commande'] - ($produit['prix_produit'] * $cp['quantite_commande_produit']);
        $commandeController->updatePrice($id_commande, $updated_price);
        header('Location: cart.php');
    } else {
        $commandeController->deleteCommande($id_commande);
        header('Location: produits.php');
    }

} else
    header("Location: cart.php");