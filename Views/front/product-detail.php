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


include '../../config.php';
$conn = config::getConnexion();

$warning_msg = [];
$success_msg = [];
$search_query = isset($_GET['search']) ? $_GET['search'] : null;
if ($search_query) {
    $sql_produit .= " AND p.nom_produit LIKE :search_query";
}
// Get product ID from URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Query to get product details based on product ID using prepared statements
    $sql = "SELECT * FROM produits WHERE id_produit = :id_produit";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_produit', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC); // Correct way to fetch a single row

    if ($product) {
        // Query to get related products
        $related_sql = "SELECT * FROM produits WHERE categorie_produit = :categorie_produit LIMIT 4";
        $related_stmt = $conn->prepare($related_sql);
        $related_stmt->bindParam(':categorie_produit', $product['categorie_produit'], PDO::PARAM_STR);
        $related_stmt->execute();
        $relatedResult = $related_stmt->fetchAll(PDO::FETCH_ASSOC); // Correct way to fetch multiple rows

        // Query to get reviews for the current product (assuming a 'ratings' or 'reviews' table)
        $reviews_sql = "
            SELECT r.*, u.nom_user 
            FROM ratings r
            JOIN utilisateurs u ON r.user_id = u.id_user  -- Correct column for the user
            WHERE r.product_id = :product_id
        ";
        $reviews_stmt = $conn->prepare($reviews_sql);
        $reviews_stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $reviews_stmt->execute();
        $reviews = $reviews_stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all reviews for the product
    } else {
        echo "Product not found.";
        exit();
    }
} else {
    echo "Product ID is missing.";
    exit();
}
?>
<?php
// Récupérer le message depuis l'URL
$message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : null;
?>

<!-- Affichage des messages -->
<?php if ($message === 'success') : ?>
    <div class="alert alert-success">
        <p>Le commentaire a été supprimé avec succès.</p>
    </div>
<?php elseif ($message === 'error') : ?>
    <div class="alert alert-danger">
        <p>Une erreur s'est produite lors de la suppression du commentaire.</p>
    </div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<?php include "dash.php"?>    
 <!-- Product Detail Start lehnéééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééééé -->
 <div class="product-detail">
    <div class="container-fluid">
        <div class="row">
            <!-- Partie principale : Détails du produit -->
            <div class="col-lg-8">
                <div class="product-detail-top">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="product-slider-single normal-slider">
                                <img src="<?php echo '../back/' . htmlspecialchars($product['images_produit']); ?>" alt="<?= $product['nom_produit'] ?>">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="product-content">
                                <div class="title"><h2><?= $product['nom_produit'] ?></h2></div>
                                <div class="rating">
                                    <h7>Average Rating:</h7><br>
                                    <?php
                                    $averageRating = 0;
                                    $totalReviews = count($reviews);
                                    if ($totalReviews > 0) {
                                        $sumRatings = 0;
                                        foreach ($reviews as $review) {
                                            $sumRatings += $review['rating'];
                                        }
                                        $averageRating = $sumRatings / $totalReviews;
                                    }
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo ($i <= $averageRating) ? '<i class="fa fa-star"></i>' : '<i class="fa fa-star-o"></i>';
                                    }
                                    ?>
                                </div>
                                <div class="price">
                                    <h4>Price:</h4>
                                    <p>$<?= $product['prix_produit'] ?></p>
                                </div>
                                <div class="description">
                                    <p><?= $product['description_produit'] ?></p>
                                </div>
                                <div class="product-reviews">
                                    <a class="btn btn-primary" href="add_rating.php?id=<?= $product['id_produit'] ?>"><i class="fa fa-comments"></i> Add Review</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partie droite : Customer Reviews -->
            <div class="col-lg-4">
    <div class="reviews-section">
        <div class="section-header">
            <h1>Customer Reviews</h1>
        </div>
        <?php if (count($reviews) > 0) { ?>
            <div class="review-container">
                <?php foreach ($reviews as $review) { ?>
                    <div class="review-box">
                        <div class="review-header">
                            <img src="./img/man.png" alt="User Avatar" class="review-avatar">
                            <div>
                                <div class="review-author"><?= htmlspecialchars($review['nom_user']) ?></div>
                                <div class="review-date"><?= date('Y-m-d', strtotime($review['created_at'])) ?></div>
                            </div>
                            <div class="review-rating">
                                <i class="fa fa-star review-star"></i> <span><?= $review['rating'] ?></span>
                            </div>
                        </div>
                        <div class="review-content">
                            <h3 class="review-title"><?= htmlspecialchars($review['titre']) ?></h3>
                            <p class="review-comment"><?= htmlspecialchars($review['description']) ?></p>
                        </div>

                        <!-- Vérification si l'ID de l'utilisateur correspond à l'ID de l'utilisateur actuel -->
                        <?php if ($review['user_id'] == $current_user_id) { ?>
                            <div class="review-actions">
                                <form method="POST" action="update_rating.php">
                                    <input type="hidden" name="id_rate" value="<?= htmlspecialchars($review['id_rate']); ?>">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id_produit']); ?>">
                                    <input type="submit" class="btn edit-btn" name="Edit" value="Edit Review">
                                </form>
                                <form method="POST" action="delete_rating.php">
                                    <input type="hidden" name="id_rate" value="<?= htmlspecialchars($review['id_rate']); ?>">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['id_produit']); ?>">
                                    <input type="submit" class="btn delete-btn" name="delete" value="Delete" onclick="return confirm('Do you really want to delete this rating?')">
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No reviews available for this product.</p>
        <?php } ?>
    </div>
</div>

        </div>
    </div>
</div>

<div class="box-container">
        <h1 style="text-align: center;">Related Products</h1>
    </div>
    <div class="row align-items-center product-slider product-slider-3">
        <?php foreach ($relatedResult as $related) { ?>
            <div class="col-lg-3">
                <div class="product-item">
                    <div class="product-title">
                        <a href="product-detail.php?id=<?= $related['id_produit'] ?>"><?= $related['nom_produit'] ?></a>
                    </div>
                    <div class="product-image">
                        <a href="product-detail.php?id=<?= $related['id_produit'] ?>">
                        <img src="<?php echo '../back/' . htmlspecialchars($product['images_produit']); ?>" alt="<?= $product['nom_produit'] ?>">
                        </a>
                    </div>
                    <div class="product-price">
                        <h3><span>$</span><?= $related['prix_produit'] ?></h3>
                        <a class="btn" href="cart.php?add=<?= $related['id_produit'] ?>"><i class="fa fa-shopping-cart"></i>Buy Now</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>

<!-- Product Detail End -->
        <!-- Brand Start -->
        <div class="brand">
            <div class="container-fluid">
                <div class="brand-slider">
                    <div class="brand-item"><img src="img/brand-1.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-2.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-3.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-4.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-5.png" alt=""></div>
                    <div class="brand-item"><img src="img/brand-6.png" alt=""></div>
                </div>
            </div>
        </div>
        <!-- Brand End -->
        
         
        
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