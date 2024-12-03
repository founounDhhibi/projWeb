<?php
include '../../controller/produitC.php';

// Vérifie si id_prod est défini et non vide
if (isset($_POST["id_prod"]) && !empty($_POST["id_prod"])) {
    $produitC = new ProduitC();
    
    // Supprime le produit en utilisant son ID
    $produitC->deleteProduit($_POST["id_prod"]);
    
    // Redirige vers la liste des produits après suppression
    header('Location: afficher_produit.php');
    exit();
} else {
    // Affiche une erreur si aucun ID n'est fourni
    echo "Erreur : aucun ID fourni pour la suppression.";
}
