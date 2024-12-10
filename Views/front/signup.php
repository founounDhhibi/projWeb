<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Inclure Composer autoload si vous utilisez Composer
include_once '../../Model/Utilisateur.php';
include_once '../../Controller/UtilisateurC.php';

session_start();
if (isset($_SESSION["username"])) {
    if ($_SESSION["role_user"] == "ADMIN_ROLE") {
        header("location:../back/utilisateurs.php");
    } else if ($_SESSION["role_user"] == "USER_ROLE") {
        header("location:index.php");
    }
}

$utilisateurC = new UtilisateurC();

if (
    isset($_POST["nom_user"]) &&
    isset($_POST["prenom_user"]) &&
    isset($_POST["email_user"]) &&
    isset($_POST["tel_user"]) &&
    isset($_POST["adresse_user"]) &&
    isset($_POST["username"]) &&
    isset($_POST["password_user"])
) {
    if (
        !empty($_POST["nom_user"]) &&
        !empty($_POST["prenom_user"]) &&
        !empty($_POST["email_user"]) &&
        !empty($_POST["tel_user"]) &&
        !empty($_POST["adresse_user"]) &&
        !empty($_POST["username"]) &&
        !empty($_POST["password_user"])
    ) {
        $nom_user = $_POST['nom_user'];
        $prenom_user = $_POST['prenom_user'];
        $email_user = $_POST['email_user'];
        $tel_user = $_POST['tel_user'];
        $adresse_user = $_POST['adresse_user'];
        $username = $_POST['username'];
        $password_user = md5($_POST['password_user']);
        $role_user = 'USER_ROLE';

        $utilisateur = new Utilisateur(
            $nom_user,
            $prenom_user,
            $email_user,
            $tel_user,
            $adresse_user,
            $username,
            $password_user,
            $role_user
        );

        $utilisateurC->ajouter_Utilisateur($utilisateur);

        // Envoyer un e-mail de confirmation
        $mail = new PHPMailer(true);
        try {
            // Paramètres du serveur
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Utilisez votre serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'iheb.zaidi.med@gmail.com'; // Votre email SMTP
            $mail->Password = 'zdmq jvrz jmku eynj'; // Votre mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // STARTTLS pour le port 587
            $mail->Port = 587;
            

            // Destinataires
            $mail->setFrom('iheb.zaidi.med@gmail.com', 'Iheb');
            $mail->addAddress($email_user, $prenom_user . ' ' . $nom_user);

            // Contenu de l'e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Bienvenue sur notre site!';
            $mail->Body = "
                <h1>Bienvenue, $prenom_user $nom_user!</h1>
                <p>Merci de vous être inscrit sur notre site. Nous sommes ravis de vous accueillir.</p>
                <p>Voici vos informations de connexion :</p>
                <ul>
                    <li>Nom d'utilisateur : $username</li>
                    <li>E-mail : $email_user</li>
                </ul>
                <p>Nous espérons que vous apprécierez votre expérience chez nous.</p>
                <p>Cordialement,<br>L'équipe</p>
            ";
            $mail->AltBody = 'Merci de vous être inscrit sur notre site. Nous sommes ravis de vous accueillir.';

            $mail->send();
        } catch (Exception $e) {
            echo "L'e-mail n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }

        header('Location: index.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/responsive-style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style-light.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,800%7CPlayfair+Display:400,700" rel="stylesheet">
    <title>Contact</title>
</head>
<body>
<header>
    <div id="mySidenav" class="sidenav">
        <div class="freedelivery">
            <img src="1.png" alt="Free Delivery on all orders over $100" width="60" height="48">
            <h3>FREE DELIVERY</h3>
            <p class="bolder">On All Orders Over $100</p>
        </div>
        <a href="#" class="closebtn">&times;</a>
        <ul id="pagesmenu">
            <li class="boldest">Main Navigation</li>
            <li><a href="index.php">Homepage 1</a></li>
            <li><a href="index2.html">Homepage 2</a></li>
            <li><a href="index3.html">Homepage 3</a></li>
            <li><a href="browse1.html">Portfolio Grid 1</a></li>
            <li><a href="browse2.html">Portfolio Grid 2</a></li>
            <li><a href="browse3.html">Portfolio Grid 3</a></li>
            <li><a href="product-page.html">Product Page</a></li>
            <li><a href="cart.html">Cart</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
        <ul>
            <li><a href="browse1.html"><img src="http://placehold.it/20x20" alt="New" width="20" height="20">New</a></li>
            <li><a href="browse2.html"><img src="http://placehold.it/20x20" alt="Living" width="20" height="20">Living</a></li>
            <li><a href="browse3.html"><img src="http://placehold.it/20x20" alt="Bedroom" width="20" height="20">Bedroom</a></li>
            <li><a href="browse1.html"><img src="http://placehold.it/20x20" alt="Dining" width="20" height="20">Dining</a></li>
            <li><a href="browse2.html"><img src="http://placehold.it/20x20" alt="Storage" width="20" height="20">Storage</a></li>
            <li><a href="browse3.html"><img src="http://placehold.it/20x20" alt="Study" width="20" height="20">Study</a></li>
            <li><a href="browse1.html"><img src="http://placehold.it/20x20" alt="Mattresses" width="20" height="20">Mattresses</a></li>
            <li><a href="browse2.html"><img src="http://placehold.it/20x20" alt="Kitchens" width="20" height="20">Kitchens</a></li>
            <li><a href="browse3.html"><img src="http://placehold.it/20x20" alt="Wardrobes" width="20" height="20">Wardrobes</a></li>
            <li><a href="browse1.html"><img src="http://placehold.it/20x20" alt="Interiors" width="20" height="20">Interiors</a></li>
            <li><a href="browse2.html"><img src="http://placehold.it/20x20" alt="Decor" width="20" height="20">Decor</a></li>
        </ul>
        <div id="menu-social">
            <ul>
                <li><a href="#"><img src="http://placehold.it/28x28" alt="Facebook link" width="28" height="28"></a></li>
                <li><a href="#"><img src="http://placehold.it/28x28" alt="LinkedIn link" width="28" height="28"></a></li>
                <li><a href="#"><img src="http://placehold.it/28x28" alt="Pinterest link" width="28" height="28"></a></li>
                <li><a href="#"><img src="http://placehold.it/28x28" alt="Googleplus link" width="28" height="28"></a></li>
                <li><a href="#"><img src="http://placehold.it/28x28" alt="Twitter link" width="28" height="28"></a></li>
            </ul>
        </div>
    </div>
    <div id="overlay"></div>
    <section class="container-fluid">
        <div class="row" id="topbar">
            <div class="col-sm-5">
                <ul id="topleft">
                    <li><a href="#" id="usa">USA <img src="http://placehold.it/7x5" alt="Arrow" width="7" height="5"></a></li>
                    <li>&nbsp;|&nbsp;</li>
                    <li><a href="#" id="english">English <img src="http://placehold.it/7x5" alt="Arrow" width="7" height="5"></a></li>
                </ul>
            </div>
            <ul id="topright">
                <li>Order Direct on: 0123-456-789</li>
                <li>&nbsp;|&nbsp;</li>
                <li id="searchlink" class="searchlink withpopup"><a href="#" class="search"><img src="imag.png" alt="Search" width="14" height="14"></a>
                    <div class="popup" id="searchform">
                        <form id="search">
                            <input type="text" class="s" id="s" placeholder="Search...">
                            <button type="submit" class="sbtn"><i class="fa fa-search"></i>Search</button>
                        </form>
                    </div>
                </li>
                <li>&nbsp;|&nbsp;</li>
                <li id="userlink" class="userlogin withpopup"><a href="#"><img src="image.png" alt="User" width="14" height="14"></a>
                    <div class="popup" id="usermenu">
                        <ul>
                            <li><a href="#">Sign in</a></li>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">Wishlists</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row pagehead">
            <div class="col-sm-2 col-xs-2">
                <div id="nav-toggle">
                    <a href="#"><img src="http://placehold.it/28x26" alt="Navigation toggler" width="28" height="26"></a><span>Menu</span>
                </div>
            </div>
            <div class="col-sm-8 col-xs-8" id="logo">
                <a href="index.php"><img src="http://placehold.it/252x47" alt="Shof Store Logo"></a>
            </div>
            <div class="col-sm-1 col-sm-offset-1 col-xs-2">
                <div id="cart">
                    <div id="cartitems">
                        <span>&nbsp;3</span>
                    </div>
                    <a href="#"><img src="2.png" alt="Cart" width="30" height="30">Cart</a>
                </div>
                <div id="cartpopup">
                    <h3>YOUR SHOPPING CART</h3><span class="bolder">3 ITEMS</span>
                    <div class="cartitem">
                        <img src="logo.png" width="100" height="100" alt="Cart Item 1"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Lounge Chair</a></p>
                        <p class="bolder">$1,199.00</p>
                    </div>
                    <div class="cartitem">
                        <img src="logo.png" width="100" height="100" alt="Cart Item 1"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Mono Chair</a></p>
                        <p class="bolder">$299.00</p>
                    </div>
                    <div class="cartitem">
                        <img src="logo.png" width="100" height="100" alt="Cart Item 1"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Lounge Chair</a></p>
                        <p class="bolder">$899.00</p>
                    </div>
                    <p class="boldest">TOTAL IN YOUR CART &nbsp;<span class="bolder">&nbsp; $2397</span></p>
                    <a class="boldest" href="">VIEW CART</a><a class="boldest" href="">CHECKOUT</a>
                </div>
            </div>
        </div>
    </section>
    <section class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 ">
                    <div id="head-container">
                        <h1>sign up</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>


<section class="container">
    <div class="row">
        <div class="col-sm-5 contactbox">
            <h3>creer votre compte</h3>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-5 contactbox">
            <p>established fact that a reader will be distracted by the readable content of a page when looking at its layout. more-or-less normalless normalless normal distribu- tion of letters, as opposed.</p>
            <img src="http://placehold.it/20x20" alt="Location" width="20" height="20"><span>24 eaque ipsa. quae inventore, India.</span><br>
            <br>
            <img src="http://placehold.it/20x20" alt="E-mail" width="20" height="20"><span>hello@yourdomain.com</span><br>
            <br>
            <img src="http://placehold.it/20x20" alt="Telephone" width="20" height="20"><span>(91) 0000 00000</span><br>
        </div>
        <div class="col-sm-7 contactbox">
            <form id="contact-form" method="POST">
                <div class="row">
                    <div class="col-sm-6 name-input">
                        <label>nom</label><br>
                        <input type="text" name="nom_user" placeholder="Your Name" required>
                    </div>
                    <div class="col-sm-6 email-input">
                        <label>prenom</label><br>
                        <input type="text" name="prenom_user"  required>
                    </div>
                </div>
                <div class="row">
                    <div class="message-input col-sm-12">
                        <label>username</label><br>
                        <input type="text" name="username"  required>
                    </div>
                </div>
                <div class="row">
                    <div class="message-input col-sm-12">
                        <label>email</label><br>
                        <input type="email" name="email_user"  required>
                    </div>
                </div>
                <div class="row">
                    <div class="message-input col-sm-12">
                        <label>tel</label><br>
                        <input type="tel" name="tel_user"  required>
                    </div>
                </div>
                <div class="row">
                    <div class="message-input col-sm-12">
                        <label>adresse</label><br>
                        <input type="text" name="adresse_user"  required>
                    </div>
                </div>
                <div class="row">
                    <div class="message-input col-sm-12">
                        <label>password</label><br>
                        <input type="password" name="password_user"  required>
                    </div>
                </div>
                <input type="submit" id="submitform" name="Submit" value="SEND MESSAGE">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 googlemap">
            <div id="map">
                <script>
                    function myMap() {
                        var mapCanvas = document.getElementById("map");
                        var myLatLng = {lat: 50 , lng: 20};
                        var mapOptions = {
                            center: myLatLng,
                            zoom: 4
                        }
                        var map = new google.maps.Map(mapCanvas, mapOptions);
                        var marker = new google.maps.Marker({
                            position: myLatLng,
                            map: map,
                            title: 'Enter title here'});
                    }
                </script>
            </div>
        </div>
    </div>
</section>



<footer>
    <div class="jumbotron hidden-xs">
        <div class="container">
            <div class="row" id="logos">
                <div class="col-sm-12">
                    <ul>
                        <li><a href="#"><img src="http://placehold.it/126x107" alt="Footer-logo"></a></li>
                        <li><a href="#"><img src="http://placehold.it/126x107" alt="Footer-logo"></a></li>
                        <li><a href="#"><img src="http://placehold.it/126x107" alt="Footer-logo"></a></li>
                        <li><a href="#"><img src="http://placehold.it/126x107" alt="Footer-logo"></a></li>
                        <li><a href="#"><img src="http://placehold.it/126x107" alt="Footer-logo"></a></li>
                        <li><a href="#"><img src="http://placehold.it/126x107" alt="Footer-logo"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2>Get <span>70% Off</span> On Home Furnishing</h2>
                <p>Shof store for new living room furniture dining furniture and bedroom furniture</p>
            </div>
            <div class="col-sm-3 col-sm-offset-1">
                <a href="#">GET MORE OFFERS</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <h3>ABOUT US</h3>
                <p>"At vero eos et accusarnus et iusto odio dignissimos ducimus qui blanditiis"</p>
                <p>Praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate</p>
            </div>
            <div class="col-sm-4">
                <h3>CONNECT WITH US</h3>
                <p>Perspiciatis unde omnis iste natus error riam, eaque ipsa quae ab illo inventore	veritatis vitae dicta sunt explicabo.</p>
                <p><img src="http://placehold.it/20x20" alt="Location" width="20" height="20"> 24 eaque ipsa. quae inventore, India.</p>
                <p><img src="http://placehold.it/20x20" alt="E-mail" width="20" height="20"> hello@yourdomain.com</p>
                <p><img src="http://placehold.it/20x20" alt="Telephone" width="20" height="20">	(91) 0000 00000</p>
            </div>
            <div class="col-sm-4">
                <h3>NEWSLETTER</h3>
                <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain count of the system.</p>
                <form id="subscribe-form" action="action.php" method="POST">
                    <input type="text" name="e-mail" placeholder="Enter Email Address...">
                    <input type="submit" name="Submit" value="">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <p>&copy;2016 Shof Store. All Rights Reserved</p>
            </div>
            <div class="col-sm-3 col-sm-offset-5">
                <ul>
                    <li><a href="#"><img src="http://placehold.it/19x19" alt="Facebook link" width="19" height="19"></a></li>
                    <li><a href="#"><img src="http://placehold.it/19x19" alt="LinkedIn link" width="19" height="19"></a></li>
                    <li><a href="#"><img src="http://placehold.it/19x19" alt="Pinterest link" width="19" height="19"></a></li>
                    <li><a href="#"><img src="http://placehold.it/19x19" alt="Googleplus link" width="19" height="19"></a></li>
                    <li><a href="#"><img src="http://placehold.it/19x19" alt="Twitter link" width="19" height="19"></a></li>
                    <li><a href="#"><img src="http://placehold.it/19x19" alt="Instagram link" width="19" height="19"></a></li>
                </ul>
            </div>
        </div>
    </section>
</footer>
<script type="text/javascript" src="assets/js/nav-toggler.js"></script>
<script type="text/javascript" src="assets/js/topsearch.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?callback=myMap"></script>
</body>
</html>