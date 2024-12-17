<?php
session_start();

if (isset($_SESSION["username"])) {
    if ($_SESSION["role_user"] == "ADMIN_ROLE")
        header("location:../back/utilisateurs.php");
    else if ($_SESSION["role_user"] == "USER_ROLE")
        header("location:index.php");
    exit;
}

try {
    // Connexion à la base de données via PDO
    $pdo = new PDO("mysql:host=localhost;dbname=projweb", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $username = "";

    if (isset($_POST['username'])) {
        $username = $_POST["username"];
        $password = md5($_POST["password_user"]); // Attention : md5 est obsolète et non sécurisé !

        // Requête préparée pour éviter les injections SQL
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE username = :username AND password_user = :password");
        $stmt->execute(['username' => $username, 'password' => $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Création des variables de session
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nom_prenom_user'] = $user['nom_user'] . " " . $user['prenom_user'];
            $_SESSION['email_user'] = $user['email_user'];
            $_SESSION['tel_user'] = $user['tel_user'];
            $_SESSION['role_user'] = $user['role_user'];

            // Redirection en fonction du rôle utilisateur
            if ($_SESSION["role_user"] == "ADMIN_ROLE") {

                header("location:../back/utilisateurs.php");
            } else if ($_SESSION["role_user"] == "USER_ROLE") {
                header("location:../front/home.php");
            }
            exit;
        } else {
            // Affichage d'une alerte en cas d'erreur
            echo "<script>alert('Invalid credentials');</script>";
        }
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Pages / Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <link href="../back/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../back/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../back/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../back/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../back/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../back/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../back/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="../back/assets/css/style.css" rel="stylesheet">

  <style>
    /* Ajoutez ici votre CSS pour l'effet flou */
    body {
        background-image: url('back.jpg'); /* Mettez ici le chemin de votre image */
        background-size: cover;
        background-position: center;
        backdrop-filter: blur(10px); /* Applique le flou à l'arrière-plan */
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    

    /* Applique un flou à tout sauf le logo */
    .container {
        position: relative;
        z-index: 1; /* Permet de superposer le contenu sur l'arrière-plan flou */
    }

    .section {
        background: rgba(255, 255, 255, 0.8); /* Un fond semi-transparent pour mieux faire ressortir le contenu */
        border-radius: 10px;
        padding: 40px;
    }

    
  </style>
</head>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex flex-column align-items-center py-4">
               
                <img src="logo.png" alt="Logo" style="width: 250px; height: 68px;">


                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">maison d'artisanat DENDEN</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" novalidate>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password_user" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have an account? <a href="pages-register.html">Create an account</a></p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
