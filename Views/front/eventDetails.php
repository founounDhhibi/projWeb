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

require_once "../../Controller/events.php";

if(isset($_GET["id_event"])) {
    $eventController = new EventController();
    $event = $eventController->getEvent($_GET["id_event"]);
} else
    header("Location: event.php");
// creer un id user pour tester , à changer !!!!!!!!!
$user_id = $_SESSION["id_user"];
?>
<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?>
    
<!-- Single Event Start -->
<div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <!-- Partie principale : Détails de l'événement -->
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="../../images/<?php echo $event['image']; ?>" alt="<?= $event['nom_event'] ?>">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title">
                                    <h2><?= $event['nom_event'] ?></h2>
                                </div>
                                <div class="description">
                                    <p><?= $event['description_event'] ?></p>
                                </div>
                                <div class="event-details">
                                    <p><strong>NBR Places:</strong> <?= $event['nbr_place'] ?></p>
                                    <p><strong>Date:</strong> <?= $event['date_event'] ?></p>
                                    <p><strong>Type:</strong> <?= $event['type'] ?></p>
                                </div>
                                <div class="event-actions">
                                    <a href="participerEvent.php?id_event=<?php echo $event['id_event']; ?>&id_user=<?php echo $user_id; ?>" class="btn btn-primary">Participer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Single Event End -->




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
