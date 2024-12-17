<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once "../../Controller/commande_Controller.php";

$commandeController = new CommandController();

if (isset($_GET["id_commande"])) {
    $commandeController->deleteCommande($_GET["id_commande"]);
    header("Location:commandes.php");
} else
    header("Location:commandes.php");