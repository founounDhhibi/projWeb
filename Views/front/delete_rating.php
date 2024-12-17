<?php
include '../../config.php';
$conn = config::getConnexion();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rate']) && isset($_POST['product_id'])) {
    $id_rate = intval($_POST['id_rate']);
    $product_id = intval($_POST['product_id']); // Récupérer l'ID du produit

    // Requête pour supprimer l'évaluation
    $sql = "DELETE FROM ratings WHERE id_rate = :id_rate";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_rate', $id_rate, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Rediriger avec un message de succès
        header("Location: product-detail.php?id=$product_id&message=success");
        exit();
    } else {
        // En cas d'échec
        header("Location: product-detail.php?id=$product_id&message=error");
        exit();
    }
} else {
    echo "Invalid request.";
}
?>
<!-- Partie HTML pour afficher les messages -->
<?php if (!empty($warning_msg)) : ?>
    <div class="alert alert-warning">
        <?php foreach ($warning_msg as $msg) : ?>
            <p><?= $msg; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if (!empty($success_msg)) : ?>
    <div class="alert alert-success">
        <?php foreach ($success_msg as $msg) : ?>
            <p><?= $msg; ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>