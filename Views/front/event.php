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

require_once "../../Controller/events.php";

// creer un id user pour tester , à changer !!!!!!!!!
$user_id = $_SESSION["id_user"];
$eventController = new EventController();
if(isset($_POST['search'])) {
    $events = $eventController->showDispoEventsSearch($user_id, $_POST['search']);
} else
    $events = $eventController->showDispoEvents($user_id);
?>
<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?>

<!-- Category News Start-->
<br>
<br>
<!-- Events List Start -->
<div class="product-view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Cultural and Social Events -->
                <h2>Cultural and Social Events</h2>
                <div class="row">
                    <?php foreach ($events as $event): ?>
                        <?php if ($event['type'] == "Cultural and Social Events"): ?>
                            <div class="col-md-4">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>">
                                            <?php echo htmlspecialchars($event['nom_event']); ?>
                                        </a>
                                    </div>
                                    <div class="product-images">
                                        <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>">
                                            <img src="../../images/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" class="product-img">
                                        </a>
                                        <div class="product-action">
                                            <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><?php echo htmlspecialchars($event['date_event']); ?></h3>
                                        <a class="btn" href="eventDetails.php?id_event=<?= $event['id_event']; ?>"><i class="fa fa-info-circle"></i> Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Promotional and Marketing Events -->
                <h2>Promotional and Marketing Events</h2>
                <div class="row">
                    <?php foreach ($events as $event): ?>
                        <?php if ($event['type'] == "Promotional and Marketing Events"): ?>
                            <div class="col-md-4">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>">
                                            <?php echo htmlspecialchars($event['nom_event']); ?>
                                        </a>
                                    </div>
                                    <div class="product-images">
                                        <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>">
                                            <img src="../../images/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" class="product-img">
                                        </a>
                                        <div class="product-action">
                                            <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><?php echo htmlspecialchars($event['date_event']); ?></h3>
                                        <a class="btn" href="eventDetails.php?id_event=<?= $event['id_event']; ?>"><i class="fa fa-info-circle"></i> Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <!-- Training and Workshop Events -->
                <h2>Training and Workshop Events</h2>
                <div class="row">
                    <?php foreach ($events as $event): ?>
                        <?php if ($event['type'] == "Training and Workshop Events"): ?>
                            <div class="col-md-4">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>">
                                            <?php echo htmlspecialchars($event['nom_event']); ?>
                                        </a>
                                    </div>
                                    <div class="product-images">
                                        <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>">
                                            <img src="../../images/<?php echo htmlspecialchars($event['image']); ?>" alt="Event Image" class="product-img">
                                        </a>
                                        <div class="product-action">
                                            <a href="eventDetails.php?id_event=<?= $event['id_event']; ?>"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><?php echo htmlspecialchars($event['date_event']); ?></h3>
                                        <a class="btn" href="eventDetails.php?id_event=<?= $event['id_event']; ?>"><i class="fa fa-info-circle"></i> Details</a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Events List End -->



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
