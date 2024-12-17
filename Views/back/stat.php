<?php
require_once '../../controller/produitC.php';

$controller = new ProduitC();
$data = $controller->getTop5RatedProducts();
$produits = [];
$moyennesRatings = [];

foreach ($data as $row) {
    $produits[] = $row['nom_produit'];
    $moyennesRatings[] = round($row['avg_rating'], 2); // Arrondi à 2 décimales
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'dash.php'; ?>
<style>
body {
    background-color: #f8f9fa; /* Couleur de fond légère */
}

.card {
    border-radius: 10px;
    overflow: hidden;
}

.card-header {
    font-size: 1.25rem;
    font-weight: bold;
}

canvas {
    margin-top: 20px;
}
</style>
<main id="main" class="main">
<div class="pagetitle">
      <h1>top rate product </h1>
      
    </div>
    <canvas id="chart" width="400" height="200"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($produits) ?>, // Noms des produits
                datasets: [{
                    label: 'Note Moyenne',
                    data: <?= json_encode($moyennesRatings) ?>, // Notes moyennes
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    barPercentage: 0.1,
                    categoryPercentage: 0.5,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}`;

                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Produits'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Note Moyenne'
                        },
                        beginAtZero: true,
                        max: 5 // Car la note est entre 1 et 5
                    }
                }
            }
        });
    </script>
</main>
</html>