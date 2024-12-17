<?PHP
include_once "../../controller/UtilisateurC.php";


$utilisateurC = new UtilisateurC();


if (isset($_GET["id_user"])){
    $utilisateurC->supprimer_Utilisateur($_GET["id_user"]);
    header('Location: utilisateurs.php');
}

?>