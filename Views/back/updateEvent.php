<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once "../../Controller/events.php";

if(isset($_GET["id_event"])) {
    $id_event = $_GET["id_event"];
    $eventController = new EventController();
    $event = $eventController->getEvent($id_event);
} else
    header("location: event.php");

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'dash.php'; ?>



<main id="main" class="main">

    <!-- End Page Title -->
    <!--formulaiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiirrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrrre-->
    <section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Modifier un événement</div>
                </div>
                <form action="add_event.php" method="post" id="eventEditForm" enctype="multipart/form-data">
                    <input type="text" value="<?php echo $event['id_event']; ?>" name="event_id" hidden>

                    <!-- Nom -->
                    <div class="row mb-3">
                        <label for="event_nom" class="col-sm-2 col-form-label">Nom de l'événement</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="event_nom" name="event_nom" placeholder="Nom de l'événement" value="<?php echo $event['nom_event']; ?>">
                        </div>
                        <div id="event_nomError"></div>
                    </div>

                    <!-- Nombre de places -->
                    <div class="row mb-3">
                        <label for="event_nbr_place" class="col-sm-2 col-form-label">Nombres de places</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="event_nbr_place" name="event_nbr_place" placeholder="Nombre de places" value="<?php echo $event['nbr_place']; ?>">
                        </div>
                        <div id="event_nbr_placeError"></div>
                    </div>

                    <!-- Type -->
                    <div class="row mb-3">
                        <label for="event_type" class="col-sm-2 col-form-label">Type</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="event_type" name="event_type">
                                <option <?php if($event['type'] == "Training and Workshop Events") echo 'selected'; ?> value="Training and Workshop Events">Training and Workshop Events</option>
                                <option <?php if($event['type'] == "Promotional and Marketing Events") echo 'selected'; ?> value="Promotional and Marketing Events">Promotional and Marketing Events</option>
                                <option <?php if($event['type'] == "Cultural and Social Events") echo 'selected'; ?> value="Cultural and Social Events">Cultural and Social Events</option>
                            </select>
                        </div>
                        <div id="event_typeError"></div>
                    </div>

                    <!-- Image -->
                    <div class="row mb-3">
                        <label for="event_image" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="event_image" name="event_image" />
                            <?php if (!empty($event['image'])) : ?>
                                <img src="<?= htmlspecialchars($event['image']); ?>" alt="Image de l'événement" class="img-thumbnail mt-2" style="max-width: 150px;">
                            <?php endif; ?>
                        </div>
                        <div id="event_imageError"></div>
                    </div>

                    <input type="text" value="<?php echo $event['image']; ?>" name="old_img" hidden>

                    <!-- Description -->
                    <div class="row mb-3">
                        <label for="event_desc" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="event_desc" name="event_desc" rows="5"><?php echo $event['description_event']; ?></textarea>
                        </div>
                        <div id="event_descError"></div>
                    </div>

                    <!-- Date -->
                    <div class="row mb-3">
                        <label for="event_date" class="col-sm-2 col-form-label">Date</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" id="event_date" name="event_date" value="<?php echo $event['date_event']; ?>">
                        </div>
                        <div id="event_dateError"></div>
                    </div>

                    <!-- Actions -->
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                            <a class="btn btn-danger" href="event.php">Annuler</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

    </div>
    </div>
    </section>

</main><!-- End #main -->


<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script src="eventJS/cntrl_saisie.js"></script>
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