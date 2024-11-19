<?PHP
include_once "../../Controller/UtilisateurC.php";


$utilisateurC = new UtilisateurC();


if (isset($_GET["id"])){
    $utilisateurC->supprimer_Utilisateur($_GET["id"]);
    header('Location: utilisateurs.php');
}

?>