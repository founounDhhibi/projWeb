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
$isPaginated = true;
$events = []; // Initialisation par défaut pour éviter l'erreur de variable non définie

// Pagination
$per_page_record = 3;  // Nombre d'entrées par page.
$page = isset($_GET["page"]) ? $_GET["page"] : 1;

if (isset($_POST["search"])) {
    $events = $eventController->searchEvent($_POST["search"]);
    $isPaginated = false;
} else if (isset($_POST["filter_type"]) && $_POST["filter_type"] != "All") {
    $type = $_POST["filter_type"];
    $isPaginated = false;
    $events = $eventController->filterEvent($type);
} else {
    $start_from = ($page - 1) * $per_page_record;

    // Requêtes pour la pagination
    $sqlSearch = "SELECT * FROM event LIMIT $start_from, $per_page_record";
    $events = $eventController->paginationLIMIT($sqlSearch); // Récupération des événements

    // Compteur total des événements (pour la pagination)
    $sql = "SELECT COUNT(*) FROM event";
    $total_records = $eventController->paginationCOUNTER($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'dash.php'; ?>
<body>

<main id="main" class="main">

<div class="pagetitle">
    <h1>Event Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">List</li>
            <li class="breadcrumb-item active">Events</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <h5 class="card-title">Liste des événements</h5>

            <!-- Formulaire de filtre -->
            <form method="post" id="filterForm" class="mb-3">
                <div class="form-group">
                    <label for="event_type">Filtrer par Type</label>
                    <select
                            onchange="filtrer()"
                            class="form-select"
                            id="event_type"
                            name="filter_type"
                    >
                        <option value="All" <?= (isset($_POST["filter_type"]) && $_POST["filter_type"] == "All") ? "selected" : "" ?>>All</option>
                        <option value="Promotional and Marketing Events" <?= (isset($_POST["filter_type"]) && $_POST["filter_type"] == "Promotional and Marketing Events") ? "selected" : "" ?>>Promotional and Marketing Events</option>
                        <option value="Training and Workshop Events" <?= (isset($_POST["filter_type"]) && $_POST["filter_type"] == "Training and Workshop Events") ? "selected" : "" ?>>Training and Workshop Events</option>
                        <option value="Cultural and Social Events" <?= (isset($_POST["filter_type"]) && $_POST["filter_type"] == "Cultural and Social Events") ? "selected" : "" ?>>Cultural and Social Events</option>
                    </select>
                </div>
            </form>

            <script>
                function filtrer() {
                    document.getElementById('filterForm').submit();
                }
            </script>

            <!-- Tableau des événements -->
            <table class="table table-bordered" >

                <thead class="table table-bordered">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date</th>
                    <th scope="col">Number of Places</th>
                    <th scope="col">Type</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($events)): ?>
                    <tr>
                        <td colspan="8" class="text-center">Aucun événement trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td><?= htmlspecialchars($event['id_event']); ?></td>
                            <td>
                                <img src="../../images/<?= htmlspecialchars($event['image']); ?>" alt="Event Image"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                            </td>
                            <td><?= htmlspecialchars($event['nom_event']); ?></td>
                            <td><?= htmlspecialchars($event['description_event']); ?></td>
                            <td><?= htmlspecialchars($event['date_event']); ?></td>
                            <td><?= htmlspecialchars($event['nbr_place']); ?></td>
                            <td><?= htmlspecialchars($event['type']); ?></td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="qrcode.php?id_event=<?= htmlspecialchars($event['id_event']); ?>" class="btn btn-info btn-sm">QR Code</a>
                                    <a href="updateEvent.php?id_event=<?= htmlspecialchars($event['id_event']); ?>" class="btn btn-primary">Update</a>
                                    <a href="deleteEvent.php?id_event=<?= htmlspecialchars($event['id_event']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                                    <a href="participants.php?id_event=<?= htmlspecialchars($event['id_event']); ?>" class="btn btn-info btn-sm">Participants</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($isPaginated): ?>
                <div class="pagination justify-content-center mt-3">
                    <?php
                    $total_pages = ceil($total_records / $per_page_record);

                    if ($page >= 2) {
                        echo "<a href='event.php?page=" . ($page - 1) . "' class='btn btn-secondary btn-sm me-1'>Prev</a>";
                    }

                    for ($i = 1; $i <= $total_pages; $i++) {
                        $activeClass = $i == $page ? "btn-primary" : "btn-light";
                        echo "<a href='event.php?page=$i' class='btn $activeClass btn-sm me-1'>$i</a>";
                    }

                    if ($page < $total_pages) {
                        echo "<a href='event.php?page=" . ($page + 1) . "' class='btn btn-secondary btn-sm'>Next</a>";
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- JS et assets -->
<script src="eventJS/cntrl_saisie.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
