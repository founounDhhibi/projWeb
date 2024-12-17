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

require_once "../../Controller/events.php";

$eventController = new EventController();

if( // ajouter
    !isset($_POST["event_id"]) && isset($_POST["event_nom"]) && isset($_POST["event_date"])
    && isset($_POST["event_desc"]) && isset($_FILES["event_image"])
    && isset($_POST["event_nbr_place"])  && isset($_POST["event_type"])
) {
    $imageName = $_FILES["event_image"]["name"];
    $event = new Event(
        $_POST["event_nom"],
        $_POST["event_date"],
        $_POST["event_desc"],
        $_POST["event_nbr_place"],
        $imageName,
        $_POST["event_type"]
    );
    $eventController->addEvent($event);
   
} else if( // modifier
    isset($_POST["event_id"]) && isset($_POST["event_nom"]) && isset($_POST["event_date"])
    && isset($_POST["event_desc"]) && isset($_FILES["event_image"])
    && isset($_POST["event_nbr_place"])  && isset($_POST["event_type"]) && isset($_POST["old_img"])
) {
    $imageName = $_POST["old_img"];
    $event = new Event(
        $_POST["event_nom"],
        $_POST["event_date"],
        $_POST["event_desc"],
        $_POST["event_nbr_place"],
        $imageName,
        $_POST["event_type"]
    );
    if(!empty($_FILES["event_image"]["name"]))
        $event->setImage($_FILES["event_image"]["name"]);
    $event->setIdEvent($_POST["event_id"]);
    $eventController->editEvent($event);
   
} 
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <body>
    <!-- Insérer l'iframe ici -->
    

    <main id="main" class="main">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Ajouter un événement</div>
        </div>
        <form action="add_event.php" method="post" id="eventForm" enctype="multipart/form-data">
            <!-- Nom -->
            <div class="row mb-3">
                <label for="event_nom" class="col-sm-2 col-form-label">Nom</label>
                <div class="col-sm-10">
                    <input
                        type="text"
                        class="form-control"
                        id="event_nom"
                        name="event_nom"
                        placeholder="Nom de l'événement"
                    />
                    <span id="nomError" style="color: red; font-weight: 700;"></span>
                </div>
            </div>

            <!-- NBR Place -->
            <div class="row mb-3">
                <label for="event_nbr_place" class="col-sm-2 col-form-label">NBR Place</label>
                <div class="col-sm-10">
                    <input
                        type="number"
                        class="form-control"
                        id="event_nbr_place"
                        name="event_nbr_place"
                        placeholder="Nombre de places"
                    />
                    <span id="nbrpError" style="color: red; font-weight: 700;"></span>
                </div>
            </div>

            <!-- Type -->
            <div class="row mb-3">
                <label for="event_type" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <select class="form-select" id="event_type" name="event_type">
                        <option value="Promotional and Marketing Events">Promotional and Marketing Events</option>
                        <option value="Training and Workshop Events">Training and Workshop Events</option>
                        <option value="Cultural and Social Events">Cultural and Social Events</option>
                    </select>
                </div>
            </div>

            <!-- Image -->
            <div class="row mb-3">
                <label for="event_image" class="col-sm-2 col-form-label">Image</label>
                <div class="col-sm-10">
                    <input
                        type="file"
                        class="form-control"
                        id="event_image"
                        name="event_image"
                    />
                    <span id="imageError" style="color: red; font-weight: 700;"></span>
                </div>
            </div>

            <!-- Description -->
            <div class="row mb-3">
                <label for="event_desc" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea
                        class="form-control"
                        id="event_desc"
                        name="event_desc"
                        rows="5"
                    ></textarea>
                    <span id="descriptionError" style="color: red; font-weight: 700;"></span>
                </div>
            </div>

            <!-- Date -->
            <div class="row mb-3">
                <label for="event_date" class="col-sm-2 col-form-label">Date</label>
                <div class="col-sm-10">
                    <input
                        class="form-control"
                        type="date"
                        id="event_date"
                        name="event_date"
                    />
                    <span id="dateError" style="color: red; font-weight: 700;"></span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button class="btn btn-primary" type="submit">submit</button>
                </div>
            </div>
        </form>
    </div>
</main>



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