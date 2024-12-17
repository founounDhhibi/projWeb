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

require_once "../../Controller/commande_Controller.php";
require_once "../../Controller/CodeCouponController.php";

$user = 1;
$commandeController = new CommandController();
$ccController = new CodeCouponController();

if (isset($_GET["tri"])) {
    if ($_GET["tri"] == "asc")
        $commandes = $commandeController->triMontantAsc();
    else if ($_GET["tri"] == "desc")
        $commandes = $commandeController->triMontantDesc();
} else if (isset($_POST['search'])) {
    $commandes = $commandeController->searchForCommande($_POST['search']);
} else
    $commandes = $commandeController->listCommandes();
if (isset($_POST['remise'])) {
    $ccController->createCodeCoupon($_POST['remise']);
    header("Location: ".$_SERVER['PHP_SELF']);
}
if (isset($_GET["id_cc"])) {
    $ccController->deleteOneCodeCoupon($_GET["id_cc"]);
    header("Location: ".$_SERVER['PHP_SELF']);
}

$code_coupons = $ccController->showAllNotUsed();
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'dash.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">


                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Tri</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="commandes.php">Aucun</a></li>
                                    <li><a class="dropdown-item" href="commandes.php?tri=asc">Montant Croissant</a></li>
                                    <li><a class="dropdown-item" href="commandes.php?tri=desc">Montant Décroissant</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Liste de commandes</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#ID COMMANDE</th>
                                        <th scope="col">#ID User</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Statut</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($commandes as $cmd) {
                                        ?>
                                        <tr>
                                            <th scope="row"><a href="#">#<?php echo $cmd['id_commande']; ?></a></th>
                                            <td><?php echo $cmd['id_user']; ?></td>
                                            <td><a href="#"
                                                   class="text-primary"><?php echo $cmd['date_commande']; ?></a></td>
                                            <td><?php echo $cmd['montant_commande']; ?> TND</td>
                                            <td><?php echo $cmd['statut_commande']; ?></td>
                                            <?php if ($cmd['statut_commande'] != "Payer") { ?>
                                                <td>
                                                    <a href="supprimerCommande.php?id_commande=<?php echo $cmd['id_commande']; ?>"
                                                       style="color: red;">Delete</a></td>
                                                <?php
                                            }
                                            ?>
                                            <td>
                                                <a href="detailsCommande.php?id_commande=<?php echo $cmd['id_commande']; ?>">Details</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Liste de code coupon</h5>
                                <form action="commandes.php" method="post">
                                    <div style="display: flex; flex-direction: row; gap: 1rem;">
                                        <input class="form-control" style="max-width: 70% !important;" type="number" id="remise" name="remise" placeholder="Enter discount">
                                        <button type="submit" class="btn btn-primary">Add Code</button>
                                    </div>
                                </form>
                                <br>
                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">#Code</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Remise (%)</th>
                                        <th scope="col">etat</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($code_coupons as $cc) {
                                        ?>
                                        <tr>
                                            <th scope="row"><a href="#">#<?php echo $cc['id_code']; ?></a></th>
                                            <td><?php echo $cc['code']; ?></td>
                                            <td><a href="#"
                                                   class="text-primary"><?php echo $cc['date_code']; ?></a></td>
                                            <td><?php echo $cc['remise']; ?> %</td>
                                            <td><?php echo $cmd['statut_commande']; ?></td>
                                            <td>
                                                <a href="commandes.php?id_cc=<?php echo $cc['id_code']; ?>"
                                                   style="color: red;">Delete</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div><!-- End Recent Sales -->


                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">
                <!-- Budget Report -->
                <div class="card">
                    <div class="filter">
                        <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>

                            <li><a class="dropdown-item" href="#">Today</a></li>
                            <li><a class="dropdown-item" href="#">This Month</a></li>
                            <li><a class="dropdown-item" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title">Budget Report <span>| This Month</span></h5>

                        <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                                    legend: {
                                        data: ['Allocated Budget', 'Actual Spending']
                                    },
                                    radar: {
                                        // shape: 'circle',
                                        indicator: [{
                                            name: 'Sales',
                                            max: 6500
                                        },
                                            {
                                                name: 'Administration',
                                                max: 16000
                                            },
                                            {
                                                name: 'Information Technology',
                                                max: 30000
                                            },
                                            {
                                                name: 'Customer Support',
                                                max: 38000
                                            },
                                            {
                                                name: 'Development',
                                                max: 52000
                                            },
                                            {
                                                name: 'Marketing',
                                                max: 25000
                                            }
                                        ]
                                    },
                                    series: [{
                                        name: 'Budget vs spending',
                                        type: 'radar',
                                        data: [{
                                            value: [4200, 3000, 20000, 35000, 50000, 18000],
                                            name: 'Allocated Budget'
                                        },
                                            {
                                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                                name: 'Actual Spending'
                                            }
                                        ]
                                    }]
                                });
                            });
                        </script>

                    </div>
                </div><!-- End Budget Report -->

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->



<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

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

</body>

</html>