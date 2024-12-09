<?php
require_once "../../Controller/commande_Controller.php";

if(isset($_POST["id_commande"])){
    $idCommande = $_POST["id_commande"];
    $commandeController = new CommandController();
    $commandeController->deleteCommande($idCommande);
    header("Location: produits.php");
} else
    header("Location: cart.php");