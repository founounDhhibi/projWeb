<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE" )
        header("location:../back/utilisateurs.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once "../../Controller/commande_Controller.php";

if(isset($_POST["id_commande"])){
    $idCommande = $_POST["id_commande"];
    $commandeController = new CommandController();
    $commandeController->deleteCommande($idCommande);
    header("Location: product-list.php");
} else
    header("Location: cart.php");