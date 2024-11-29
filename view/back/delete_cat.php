<?php
include '../../controller/CategorieC.php';  // Inclure le contrôleur de catégorie

// Vérifie si id_categorie est défini et non vide
if (isset($_POST["id_categorie"]) && !empty($_POST["id_categorie"])) {
    $categorieC = new CategorieC();  // Créer une instance du contrôleur de catégorie
    
    // Supprime la catégorie en utilisant son ID
    $categorieC->deleteCategorie($_POST["id_categorie"]);
    
    // Redirige vers la liste des catégories après suppression
    header('Location: afficher_cat.php');
    exit();
} else {
    // Affiche une erreur si aucun ID n'est fourni
    echo "Erreur : aucun ID fourni pour la suppression de la catégorie.";
}
?>
