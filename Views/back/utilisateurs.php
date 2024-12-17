<?php

session_start() ;

if (isset($_SESSION["username"])) 
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}

include_once '../../Controller/UtilisateurC.php';
$utilisateurC = new UtilisateurC();
$list = $utilisateurC->afficher_Utilisateur();

?>

<!DOCTYPE html>
<html lang="en">



<?php include 'dash.php'; ?>  
<main id="main" class="main">

    <div class="pagetitle">
      <h1>General Tables</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">list</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<!--formulaiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiirrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrre-->
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="card-title">Utilisateurs</h5>

            <!-- Users Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Nom d'utilisateur</th>
                        <th scope="col">Rôle</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Si une recherche est effectuée
                    if (isset($_POST['query']) && !empty($_POST['query'])) {
                        $searchQuery = htmlspecialchars($_POST['query']);
                        $list = $utilisateurC->chercherUtilisateur($searchQuery);
                    } else {
                        $list = $utilisateurC->afficher_Utilisateur(); // Tous les utilisateurs
                    }

                    if (!empty($list)) {
                        foreach ($list as $utilisateur) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($utilisateur['id_user']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['nom_user']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['prenom_user']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['email_user']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['tel_user']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['adresse_user']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['username']); ?></td>
                                <td><?= htmlspecialchars($utilisateur['role_user']); ?></td>
                                <td>
                                    <form method="GET" action="modifierUtilisateur.php">
                                        <input type="hidden" value="<?= htmlspecialchars($utilisateur['id_user']); ?>" name="id_user">
                                        <input type="submit" name="update" class="btn btn-primary" value="Modifier">
                                    </form>
                                </td>
                                <td>
                                    <form method="GET" action="supprimerUtilisateur.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        <input type="hidden" value="<?= htmlspecialchars($utilisateur['id_user']); ?>" name="id_user">
                                        <input type="submit" class="btn btn-danger" name="delete" value="Supprimer">
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="10">Aucun utilisateur trouvé.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>


             

            


        </div>
      </div>
    </section>

  </main><!-- End #main -->

  

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>