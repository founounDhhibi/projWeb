<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}

include '../../controller/produitC.php';

// Vérifie si id_prod est défini et non vide
if (isset($_POST["id_produit"]) && !empty($_POST["id_produit"])) {
    $produitC = new ProduitC();
    
    // Supprime le produit en utilisant son ID
    $produitC->deleteProduit($_POST["id_produit"]);
    
    // Redirige vers la liste des produits après suppression
    header('Location: afficher_produit.php');
    exit();
} else {
    // Affiche une erreur si aucun ID n'est fourni
    echo "Erreur : aucun ID fourni pour la suppression.";
}
