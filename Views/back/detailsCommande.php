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

require_once "../../Controller/commande_Controller.php";
require_once "../../Controller/ProduitController.php";


$commandeController = new CommandController();
$produitController = new ProduitController();
$user = 1;
if(isset($_GET["id_commande"])){
    $commandes = $commandeController->joinProduitCommande($_GET["id_commande"]);
} else
    header("Location: commandes.php");
$paiment = $commandeController->joinPaiement($_GET["id_commande"]);
?>
<!DOCTYPE html>
<html lang="en">



<main id="main" class="main">

    
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">


                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Liste de produits</h5>

                                <table class="table table-borderless datatable">
                                    <thead>
                                    <tr>
                                        <th >#ID Produit</th>
                                        <th >Image</th>
                                        <th >Nom</th>
                                        <th >Quantité</th>
                                        <th >Prix</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($commandes as $cmd) {
                                        $prod = $produitController->getProduit($cmd['id_produit']);
                                        ?>
                                        <tr>
                                            <th scope="row"><a href="#">#<?php echo $prod['id_produit']; ?></a></th>
                                            <td><img src="<?php echo $prod['images_produit']; ?>" style="max-height: 84px; max-width: 84px;"></td>
                                            <td><a href="#" class="text-primary"><?php echo $prod['nom_produit']; ?></a></td>
                                            <td><?php echo $cmd['quantite_commande_produit']; ?></td>
                                            <td><?php echo $prod['prix_produit']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Paiement</h5>
                                <?php
                                if($paiment != null) {
                                ?>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#ID Paiement</th>
                                        <th scope="col">Montant</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Mode</th>
                                        <th scope="col">Statut</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row"><a href="#">#<?php echo $paiment['id_paiement']; ?></a></th>
                                            <td><a href="#" class="text-primary"><?php echo $paiment['montant_paiement']; ?> TND</a></td>
                                            <td><?php echo $paiment['date_paiement']; ?></td>
                                            <td><?php echo $paiment['mode_paiement']; ?></td>
                                            <td><?php echo $paiment['statut_paiement']; ?></td>
                                            <?php
                                            if($paiment['statut_paiement'] == "En attente") {
                                            ?>
                                                <td><a href="accepterPaiement.php?id_paiement=<?php echo $paiment['id_paiement']; ?>&id_commande=<?php echo $_GET["id_commande"]; ?>" style="color: green;">Accepter</a></td>
                                                <td><a href="supprimerCommande.php?id_commande=<?php echo $_GET["id_commande"]; ?>" style="color: red;">Refuser</a></td>
                                            <?php } ?>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php } else {?>
                                <h4>Encore non payé</h4>
                                <?php } ?>
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

</body>

</html>