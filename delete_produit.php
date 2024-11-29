<?php
include '../../controller/produitC.php';

if (isset($_POST["id"])) {
    $produitC = new ProduitC();
    $produitC->deleteProduit($_POST["id"]);
    header('Location: offerList.php'); // Redirection après suppression
    exit();
} else {
    echo "Erreur : aucun ID fourni pour la suppression.";
}
