<?php
session_start();
if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE")
        header("location:../back/utilisateurs.php") ;

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
	<script type="text/javascript" src="assets/js/responsiveslides.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,800%7CPlayfair+Display:400,700" rel="stylesheet">
	<title>Homepage 1</title>
</head>
	<body id="index1">
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
			  		<li><a href="index.html">Homepage 1</a></li>
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
					<div class="col-sm-7">
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
                                        <?php
                                        session_start();
                                            if (isset($_SESSION['username'])) {

                                                echo ' <li><a href="">'. $_SESSION['nom_prenom_user'].'</a></li>';
                                        echo '<li><a href="logout.php">Sign out</a></li>';


                                            }  else {

                                        echo ' <li><a href="login.php">Sign in</a></li>';
                                        echo ' <li><a href="signup.php">Sign up</a></li>';
                                        echo ' <li><a href="logout.php">Sign out</a></li>';


                                        }
                                        ?>
		      						</ul>
      							</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="row pagehead">
					<div class="col-sm-2 col-xs-2">
						<div id="nav-toggle">
							<a href="#"><img src="http://placehold.it/28x26" alt="Navigation toggler" width="28" height="26"></a><span>Menu</span>
						</div>
					</div>
					<div class="col-sm-8 col-xs-8" id="logo">
						<a href="index.html"><img src="http://placehold.it/252x47" alt="Shof Store Logo"></a>
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
								<img src="http://placehold.it/100x100" width="100" height="100" alt="Cart Item 2"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Mono Chair</a></p>	
								<p class="bolder">$299.00</p>
							</div>
							<div class="cartitem">
								<img src="http://placehold.it/100x100" width="100" height="100" alt="Cart Item 3"><p class="boldest"><a href="#">&times;&nbsp;</a><a href="#">Cleon Lounge Chair</a></p>	
								<p class="bolder">$899.00</p>
							</div>
							<p class="boldest">TOTAL IN YOUR CART &nbsp;<span class="bolder">&nbsp; $2397</span></p>
							<a class="boldest" href="">VIEW CART</a><a class="boldest" href="">CHECKOUT</a>
						</div>
					</div>
				</div>
			</section>
			<section class="jumbotron withslider">
				<ul class="rslides">
	 				<li><img src="http://placehold.it/1663x693" alt=""></li>
	  				<li>
	  					<img src="http://placehold.it/1663x693" alt="">
	  					<div class="slider-overlay slider-overlay-2">
	  						<h2><span>201</span><span>6 5</span>Designer Sofas</h2>
	  						<p>The highest quality standards and provide sumptuous comfort and luxury.</p>
	  					</div>
	  				</li>
	  				<li>
	  					<img src="http://placehold.it/1663x693" alt="">
	  					<div class="slider-overlay slider-overlay-3">
	  						<ul class="sliderlinks">
	  							<li><a href="#" class="linethrough">New Design</a></li>
	  							<li><a href="#" class="linethrough">HomeTown</a></li>
	  							<li><a href="#" class="linethrough">Furniture</a></li>
	  						</ul>
	  					</div>
	  				</li>
				</ul>
			</section>
		</header>
		<section class="container homeview">
			<div class="row atleft">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12 hidden-xs">
							<div class="vertical"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2 class="num">01.</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2>Your living room furniture</h2>
						</div>
					</div>
					<div class="row thetext">
						<div class="col-sm-4 hr-line hidden-xs"></div>
						<div class="col-sm-8">
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis  vitae dicta sunt explicabo. remque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis  vitae dicta sunt explicabo.remque laudantium.</p>
						</div>
					</div>
					<div class="row readmore">
						<div class="col-sm-8 col-sm-offset-4">
							<a href="#" class="boldest">READ MORE</a>
						</div>
					</div>
				</div>
				<div class="col-sm-6 imageright">
					<div class="bg-simple-right"></div>
					<div class="bg-effect-right"></div>
					<img src="http://placehold.it/606x376" alt="Homepage Sofa">
				</div>
			</div>
			<div class="row atright">
				<div class="col-sm-6 imageleft">
					<div class="bg-simple-left"></div>
					<div class="bg-effect-left"></div>
					<img src="http://placehold.it/587x358" alt="Homepage Table">
				</div>
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-12 hidden-xs">
							<div class="vertical"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2 class="num">02.</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h2>We also offer solid wood furniture</h2>
						</div>
					</div>
					<div class="row thetext">
						<div class="col-sm-8">
							<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis  vitae dicta sunt explicabo.remque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis  vitae dicta sunt explica
							remque laudantium.</p>
						</div>
						<div class="col-sm-4 hr-line hidden-xs"></div>
					</div>
					<div class="row readmore">
						<div class="col-sm-8">
							<a href="#" class="boldest">READ MORE</a>
						</div>
					</div>
				</div>
			</div>
		</section>

<!--MAIN BODY-->
		<section class="container-fluid related">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<h2>Modern Furniture</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<p>Lorem Ipsum is simply dummy text of the printing and type dard dummy text ever since the 1500s.</p>
				</div>
			</div>
		</section>
		<div class="container">
			<div id="categories" class="row icon-list icons">
				<div class="col-sm-2">
					<p class="iconcaption bolder">Office-chair</p>
					<a href="#categories" id="filter-office" class="filter linethrough"><img src="http://placehold.it/58x58" width="58" height="58" alt="Category"></a>
				</div>
				<div class="col-sm-2">
					<p class="iconcaption bolder">Living</p>
					<a href="#categories" id="filter-living" class="filter linethrough"><img src="http://placehold.it/58x58" width="58" height="58" alt="Category"></a>
				</div>
				<div class="col-sm-2">
					<p class="iconcaption bolder">Storage</p>
					<a href="#categories" id="filter-storage" class="filter linethrough"><img src="http://placehold.it/58x58" width="58" height="58" alt="Category"></a>
				</div>
				<div class="col-sm-2">
					<p class="iconcaption bolder">Mattresses</p>
					<a href="#categories" id="filter-mattresses" class="filter linethrough"><img src="http://placehold.it/58x58" width="58" height="58" alt="Category"></a>
				</div>
				<div class="col-sm-2">
					<p class="iconcaption bolder">Interiors</p>
					<a href="#categories" id="filter-interiors" class="filter linethrough"><img src="http://placehold.it/58x58" width="58" height="58" alt="Category"></a>
				</div>
				<div class="col-sm-2">
					<p class="iconcaption bolder">Decor</p>
					<a href="#categories" id="filter-decor" class="filter linethrough"><img src="http://placehold.it/58x58" width="58" height="58" alt="Category"></a>
				</div>
			</div>
		</div>
		<div id="carousel-container">
			<div id="myCarousel-chaires" class="container-fluid withaddtocart related carousel slide">
				<div class="carousel-inner chaires">
					<div class="row prod-grid-6-next prod-grid-6 item active">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
					<div class="row prod-grid-6 prod-grid-6-next item">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
				</div>
			</div>
			<div id="myCarousel-living" class="container-fluid withaddtocart related carousel slide">
				<div class="carousel-inner living">
					<div class="row prod-grid-6-next prod-grid-6 item active">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
					<div class="row prod-grid-6 prod-grid-6-next item">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
				</div>
			</div>


			<div id="myCarousel-storage" class="container-fluid withaddtocart related carousel slide">
				<div class="carousel-inner storage">
					<div class="row prod-grid-6-next prod-grid-6 item active">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
					<div class="row prod-grid-6 prod-grid-6-next item">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
				</div>
			</div>
			<div id="myCarousel-mattresses" class="container-fluid withaddtocart related carousel slide">
				<div class="carousel-inner mattresses">
					<div class="row prod-grid-6-next prod-grid-6 item active">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
					<div class="row prod-grid-6 prod-grid-6-next item">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
				</div>
			</div>
			<div id="myCarousel-interiors" class="container-fluid withaddtocart related carousel slide">
				<div class="carousel-inner interiors">
					<div class="row prod-grid-6-next prod-grid-6 item active">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
					<div class="row prod-grid-6 prod-grid-6-next item">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
				</div>
			</div>
			<div id="myCarousel-decor" class="container-fluid withaddtocart related carousel slide">
				<div class="carousel-inner decor">
					<div class="row prod-grid-6-next prod-grid-6 item active">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
					<div class="row prod-grid-6 prod-grid-6-next item">
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Mono Lounge Chair</a>
							<p>$899.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Cleon Lounge Chair</a>
							<p>$1,199.00</p>
						</div>
						<div class="col-sm-3">
							<div class="addtocart">
								<ul>
									<li><a href="#"><img src="http://placehold.it/21x20" alt="Add to cart" width="21" height="20">ADD TO CART</a>
									</li><li><a href="#"><img src="http://placehold.it/19x17" alt="Wishlist" width="19" height="17"></a>
									</li><li><a href="#"><img src="http://placehold.it/17x17" alt="Fullscreen" width="17" height="17"></a></li>
								</ul>
							</div>
							<a href="#"><img src="http://placehold.it/386x386" alt="Product"><br>Hot Mesh Lounge Chair</a>
							<p>$299.00</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row navlinks centered">
				<div class="col-sm-1 col-sm-offset-5 col-xs-6">
					<img src="http://placehold.it/26x50" alt="Previous" width="26" height="50"><a href="#myCarousel" class="left1 linethrough" role="button" data-slide="prev">PREV</a>
				</div>
				<div class="col-sm-1 col-xs-6">
					<a href="#myCarousel" class="right1 linethrough" role="button" data-slide="next">NEXT</a><img src="http://placehold.it/26x50" alt="Next" width="26" height="50">
				</div>
			</div>
		</div>

		<section class="jumbotron latest centered">
			<div class="container">
				<div class="row">
					<div class="col-sm-2 col-sm-offset-5">
						<a href="#playvideo"><img src="http://placehold.it/102x102" id="playvideo" alt="Play Icon" width="102" height="102"></a>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<h2>Your Dream Living Room</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-sm-offset-3">
						<h3 class="linethrough">HOME EXCLUSIVE FURNITURE</h3>
					</div>
				</div>
			</div>
		</section>
		<section class="container latestnews">
			<div class="row">
				<div class="col-sm-12">
					<h2 class="centered">Latest News</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<p>Lorem Ipsum is simply dummy text of the printing and type dard dummy text ever since the 1500s.</p>
				</div>
			</div>
		</section>
		<div id="myCarousel2" class="container latestnews carousel slide">
			<div class="carousel-inner">
				<div class="row item active">
					<div class="col-sm-4">
						<img src="http://placehold.it/370x200" alt="Latest News 01">
						<p>Jan 13, 2016 / 20 Comments</p>
						<p class="bolder">Contrary to popular belief, Lorem Ipsum is not simply random text.</p>
					</div>
					<div class="col-sm-4">
						<img src="http://placehold.it/370x200" alt="Latest News 02">
						<p>Jan 13, 2016 / 20 Comments</p>
						<p class="bolder">There are many variations of passages of Lorem Ipsum available.</p>
					</div>
					<div class="col-sm-4">
						<img src="http://placehold.it/370x200" alt="Latest News 03">
						<p>Jan 13, 2016 / 20 Comments</p>
						<p class="bolder">A search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
					</div>
				</div>
				<div class="row item">
					<div class="col-sm-4">
						<img src="http://placehold.it/370x200" alt="Latest News 01">
						<p>Jan 13, 2016 / 20 Comments</p>
						<p class="bolder">Contrary to popular belief, Lorem Ipsum is not simply random text.</p>
					</div>
					<div class="col-sm-4">
						<img src="http://placehold.it/370x200" alt="Latest News 02">
						<p>Jan 13, 2016 / 20 Comments</p>
						<p class="bolder">There are many variations of passages of Lorem Ipsum available.</p>
					</div>
					<div class="col-sm-4">
						<img src="http://placehold.it/370x200" alt="Latest News 03">
						<p>Jan 13, 2016 / 20 Comments</p>
						<p class="bolder">A search for 'lorem ipsum' will uncover many web sites still in their infancy.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="row navlinks centered">
				<div class="col-sm-1 col-sm-offset-5 col-xs-6">
					<img src="http://placehold.it/26x50" alt="Previous" width="26" height="50"><a href="#myCarousel2" class="left2 linethrough">PREV</a>
				</div>
				<div class="col-sm-1 col-xs-6">
					<a href="#myCarousel2" class="right2 linethrough">NEXT</a><img src="http://placehold.it/26x50" alt="Next" width="26" height="50">
				</div>
			</div>
		</div>
		<section id="myCarousel3" class="jumbotron latest carousel slide">
			<div class="container carousel-inner">
				<div class="item active">
					<div class="row">
						<div class="col-sm-2 col-sm-offset-5 quotes centered">
							<img src="http://placehold.it/69x60" alt="Quotes" width="69" height="60">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<p class="centered">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC,<br>
							making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked<br>
	 						cites of the word in classical literature, discovered the undoubtable source.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<h3 class="centered">DUDLEY WARD</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<p class="centered">Web designer</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="row">
						<div class="col-sm-2 col-sm-offset-5 quotes centered">
							<img src="http://placehold.it/69x60" alt="Quotes" width="69" height="60">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<p class="centered">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC,<br>
							making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked<br>
	 						cites of the word in classical literature, discovered the undoubtable source.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<h3 class="centered">DUDLEY WARD</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<p class="centered">Web designer</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="row">
						<div class="col-sm-2 col-sm-offset-5 quotes centered">
							<img src="http://placehold.it/69x60" alt="Quotes" width="69" height="60">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<p class="centered">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC,<br>
							making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked<br>
	 						cites of the word in classical literature, discovered the undoubtable source.</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<h3 class="centered">DUDLEY WARD</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<p class="centered">Web designer</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-sm-offset-4">
					<ul class="round-pagination carousel-indicators">
						<li data-target="#myCarousel3" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel3" data-slide-to="1"></li>
						<li data-target="#myCarousel3" data-slide-to="2"></li>
					</ul>
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
		<script type="text/javascript" src="assets/js/slider.js"></script>
		<script type="text/javascript" src="assets/js/hovers.js"></script>
		<script type="text/javascript" src="assets/js/carousel.js"></script>
		<script type="text/javascript" src="assets/js/video.js"></script>
		<script type="text/javascript" src="assets/js/topsearch.js"></script>
		<script type="text/javascript" src="assets/js/filter.js"></script>
	</body>
</html>