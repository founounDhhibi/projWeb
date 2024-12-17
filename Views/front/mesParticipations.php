<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE" )
        header("location:../back/utilisateurs.php") ;
} else {
    header("location:../front/login.php") ;
}
if (isset($_SESSION['email_user'])) {
    $email_user = $_SESSION['email_user']; // L'email de l'utilisateur connecté
} else {
    $email_user = "support@email.com"; // Email par défaut si l'utilisateur n'est pas connecté
}
if (isset($_SESSION['tel_user'])) {
    $tel_user = $_SESSION['tel_user']; // Numéro de téléphone de l'utilisateur connecté
} else {
    $tel_user = "+012-345-6789"; // Valeur par défaut si l'utilisateur n'est pas connecté
}
$current_user_id = $_SESSION['id_user']; // Récupère l'ID de l'utilisateur connecté

require_once "../../Controller/ParticipationController.php";

$participations = null;
if(isset($_GET["id_user"])) {
    $participationController = new ParticipationController();
    $participations = $participationController->getEventController()->joinParticipationUser($_GET["id_user"]);
} else
    header("Location: event.php");
// creer un id user pour tester , à changer !!!!!!!!!
$user_id = $_SESSION["id_user"];
?>
<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?>
<!-- Breadcrumb Start -->
<div class="breadcrumb-wrap">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Participations</a></li>
            <li class="breadcrumb-item"><a href="#">Détails</a></li>
        </ul>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Single Participation Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <!-- Partie principale : Détails de la participation -->
            <div class="col-lg-8">
                <?php foreach ($participations as $participation) { ?>
                    <div class="product-detail-top">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="product-slider-single normal-slider">
                                    <img src="../../images/<?php echo $participation['image']; ?>" alt="<?= $participation['nom_event'] ?>">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="product-content">
                                    <div class="title">
                                        <h2><?= $participation['nom_event'] ?></h2>
                                    </div>
                                    <div class="description">
                                        <p><?= $participation['description_event'] ?></p>
                                    </div>
                                    <div class="event-actions">
                                        <a href="deleteParticipation.php?id_event=<?php echo $participation['id_event']; ?>&id_user=<?php echo $user_id; ?>" class="btn btn-danger">Annuler</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- Single Participation End -->



<!-- Back to Top -->
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/slick/slick.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>
</html>
