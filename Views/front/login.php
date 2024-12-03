<?php
session_start() ;
if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE")
        header("location:../back/utilisateurs.php") ;
    else if ($_SESSION["role_user"] == "USER_ROLE")
        header("location:index.php") ;
}
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'gestion_utilisateur') ;
$username = "" ;
if (isset($_POST['username']))
{
    $username = $_POST["username"] ;
    $password = md5($_POST["password_user"]) ;

    $req = "select * from utilisateurs where username='$username' and password_user='$password'" ;
    $result = $con->query($req) ;

    if ($result->num_rows>0)
    {
        $_SESSION['username'] = $username ;
        while ($row = $result->fetch_assoc())
        {
            $_SESSION['nom_prenom_user'] = $row['nom_user'] ." " .$row['prenom_user'];
            $_SESSION['email_user'] = $row['email_user'];
            $_SESSION['tel_user'] = $row['tel_user'];
            $_SESSION['id_user'] = $row['id_user'] ;
            $_SESSION['username'] = $row['username'] ;
            $_SESSION['role_user'] = $row['role_user'];
        }
        if ($_SESSION["role_user"] == "ADMIN_ROLE")
            header("location:../back/utilisateurs.php") ;
        else if (($_SESSION["role_user"] == "USER_ROLE") )
            header("location:index.php") ;
        die ;

    } else {
        ?>
        <script>
            alert('invalid credentials');
        </script>
        <?php
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
    <title>login</title>
</head>
<body>
<header>
    <div id="mySidenav" class="sidenav">
        <div class="freedelivery">
            <img src="http://placehold.it/60x48" alt="Free Delivery on all orders over $100" width="60" height="48">
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
                <li id="searchlink" class="searchlink withpopup"><a href="#" class="search"><img src="http://placehold.it/14x14" alt="Search" width="14" height="14"></a>
                    <div class="popup" id="searchform">
                        <form id="search">
                            <input type="text" class="s" id="s" placeholder="Search...">
                            <button type="submit" class="sbtn"><i class="fa fa-search"></i>Search</button>
                        </form>
                    </div>
                </li>
                <li>&nbsp;|&nbsp;</li>
                <li id="userlink" class="userlogin withpopup"><a href="#"><img src="http://placehold.it/14x14" alt="User" width="14" height="14"></a>
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
                    <a href="#"><img src="http://placehold.it/30x30" alt="Cart" width="30" height="30">Cart</a>
                </div>
                <div id="cartpopup">
                    <h3>YOUR SHOPPING CART</h3><span class="bolder">3 ITEMS</span>
                    <div class="cartitem">
                        <img src="http://placehold.it/100x100" width="100" height="100" alt="Cart Item 1"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Lounge Chair</a></p>
                        <p class="bolder">$1,199.00</p>
                    </div>
                    <div class="cartitem">
                        <img src="http://placehold.it/100x100" width="100" height="100" alt="Cart Item 1"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Mono Chair</a></p>
                        <p class="bolder">$299.00</p>
                    </div>
                    <div class="cartitem">
                        <img src="http://placehold.it/100x100" width="100" height="100" alt="Cart Item 1"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Lounge Chair</a></p>
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
                        <h1>login</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
</header>


<section class="container">
    <div class="row">
        <div class="col-sm-5 contactbox">
            <h3>CONNECT WITH US</h3>
        </div>
        <div class="col-sm-7 contactbox">
            <h3>SEND US MESSAGE</h3>
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
                        <label>username</label><br>
                        <input type="text" name="username" placeholder="username" required>
                    </div>
                    <div class="col-sm-6 email-input">
                        <label>password</label><br>
                        <input type="password" name="password_user"  required>
                    </div>
                </div>

                <input type="submit" id="submitform" name="Submit" value="log in">
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