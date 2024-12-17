<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}
$username=$_SESSION["username"];
include 'dash.php';

include_once '../../model/Utilisateur.php';
include_once '../../controller/UtilisateurC.php';


$utilisateurC = new UtilisateurC();

if (
    isset($_POST["nom_user"]) &&
    isset($_POST["prenom_user"]) &&
    isset($_POST["email_user"]) &&
    isset($_POST["tel_user"]) &&
    isset($_POST["adresse_user"]) &&
    isset($_POST["username"]) &&
    isset($_POST["password_user"]) &&
    isset($_POST["role_user"])
) {

    if (
        !empty($_POST["nom_user"]) &&
        !empty($_POST["prenom_user"]) &&
        !empty($_POST["email_user"]) &&
        !empty($_POST["tel_user"]) &&
        !empty($_POST["adresse_user"]) &&
        !empty($_POST["username"]) &&
        !empty($_POST["password_user"]) &&
        !empty($_POST["role_user"])
    ){
        $nom_user = $_POST['nom_user'] ;
        $prenom_user = $_POST['prenom_user'] ;
        $email_user = $_POST['email_user'] ;
        $tel_user = $_POST['tel_user'] ;
        $adresse_user = $_POST['adresse_user'] ;
        $username = $_POST['username'] ;
        $password_user = md5($_POST['password_user']) ;
        $role_user = $_POST['role_user'] ;

        $utilisateur = new Utilisateur($nom_user,
            $prenom_user,
            $email_user,
            $tel_user,
            $adresse_user,
            $username,
            $password_user,
            $role_user
        );

        $utilisateurC->ajouter_Utilisateur($utilisateur);
        header('Location: utilisateurs.php');
    }




}

?>

<!-- Affichage des erreurs -->
<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error): ?>
            <li style="color: red;"><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

?>
<!DOCTYPE html>
<html lang="en">

  <main id="main" class="main">
    <div class="pagetitle">
        <h1>Ajouter Utilisateur</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Utilisateurs</li>
                <li class="breadcrumb-item active">Ajouter</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Formulaire pour ajouter un utilisateur -->
    <form id="UserForm" action="" method="POST">
        <!-- Nom -->
        <div class="row mb-3">
            <label for="nom_user" class="col-sm-2 col-form-label">Nom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nom_user" name="nom_user" 
                       required minlength="2" pattern="[A-Za-z]+" 
                       title="Le nom doit contenir uniquement des lettres et au moins 2 caractères.">
            </div>
        </div>

        <!-- Prénom -->
        <div class="row mb-3">
            <label for="prenom_user" class="col-sm-2 col-form-label">Prénom</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="prenom_user" name="prenom_user" 
                       required minlength="2" pattern="[A-Za-z]+" 
                       title="Le prénom doit contenir uniquement des lettres et au moins 2 caractères.">
            </div>
        </div>

        <!-- Email -->
        <div class="row mb-3">
            <label for="email_user" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email_user" name="email_user" 
                       required title="Veuillez entrer un email valide.">
            </div>
        </div>

        <!-- Téléphone -->
        <div class="row mb-3">
            <label for="tel_user" class="col-sm-2 col-form-label">Téléphone</label>
            <div class="col-sm-10">
                <input type="tel" class="form-control" id="tel_user" name="tel_user" 
                       required pattern="[0-9]{8,15}" 
                       title="Le téléphone doit contenir entre 8 et 15 chiffres.">
            </div>
        </div>

        <!-- Adresse -->
        <div class="row mb-3">
            <label for="adresse_user" class="col-sm-2 col-form-label">Adresse</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="adresse_user" name="adresse_user" 
                       required minlength="5" 
                       title="L'adresse doit contenir au moins 5 caractères.">
            </div>
        </div>

        <!-- Nom d'utilisateur -->
        <div class="row mb-3">
            <label for="username" class="col-sm-2 col-form-label">Nom d'utilisateur</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" name="username" 
                       required minlength="3" 
                       title="Le nom d'utilisateur doit contenir au moins 3 caractères.">
            </div>
        </div>

        <!-- Mot de passe -->
        <div class="row mb-3">
            <label for="password_user" class="col-sm-2 col-form-label">Mot de passe</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_user" name="password_user" 
                       required minlength="6" 
                       title="Le mot de passe doit contenir au moins 6 caractères.">
            </div>
        </div>

        <!-- Rôle -->
        <div class="row mb-3">
            <label for="role_user" class="col-sm-2 col-form-label">Rôle</label>
            <div class="col-sm-10">
                <select class="form-control" name="role_user" id="role_user" required>
                    <option value="USER_ROLE">Utilisateur</option>
                    <option value="ADMIN_ROLE">Administrateur</option>
                </select>
            </div>
        </div>

        <!-- Bouton Submit -->
        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </div>
    </form>
</main>





<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->

<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/echarts/echarts.min.js"></script>
<script src="assets/vendor/quill/quill.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/tinymce/tinymce.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>


<script src="js/ajouterUtilisateur.js"></script>


</body>

</html>