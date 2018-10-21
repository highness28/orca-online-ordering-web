<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Orite Copier and Supplies</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
        
		<link type="text/css" rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('css/slick.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('css/slick-theme.css') }}"/>
		<link type="text/css" rel="stylesheet" href="{{ url('css/nouislider.min.css') }}"/>
		<link rel="stylesheet" href="{{ url('css/font-awesome.min.cs') }}s">
		<link type="text/css" rel="stylesheet" href="{{ url('css/style.css') }}"/>
		@yield('css')
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0956-710-8146</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> oritecopiersolutions@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li>
							<div class="dropdown pull-right">
								<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" href="#">
									<i class="fa fa-user-o"></i>
									@if(getAuth() != null)
										{{ getAuth()->first_name . ' ' . getAuth()->last_name }}
									@else
										<span>Login</span>
									@endif
								</a>
								<div class="cart-dropdown">
									@if(Auth::check())
										<form method="POST" action="{{ route('logout') }}" id="logout-form">
											@csrf
											<div class="form-group">
												<img src="{{ url('img/logo.jpg') }}" alt="orite-logo" style="width: 100%;">
											</div>
											<div class="cart-btns">
												<a href="#">Profile</a>
												<a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
											</div>
										</form>
									@else
										<form method="POST" action="{{ route('login') }}" id="login-form">
											@csrf
											<div class="form-group">
												<img src="{{ url('img/logo.jpg') }}" alt="orite-logo" style="width: 100%;">
											</div>
											<div class="form-group">
												<input id="email" class="input" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
												@if ($errors->has('email'))
													<span class="invalid-feedback" role="alert" style="color: red;">
														<strong>{{ $errors->first('email') }}</strong>
													</span>
												@endif
											</div>
											<div class="form-group">
												<input id="password" class="input" type="password" name="password" placeholder="Passowrd" required>
												@if ($errors->has('password'))
													<span class="invalid-feedback" role="alert" style="color: red;">
														<strong>{{ $errors->first('password') }}</strong>
													</span>
												@endif
											</div>

											<input class="form-check-input" type="hidden" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

											<div class="cart-btns">
												<a href="{{ url('/register') }}">Register</a>
												<a href="#" onclick="document.getElementById('login-form').submit();">Login</a>
											</div>
										</form>
									@endif
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="#" class="logo">
                                    <span style="color: white; font-size: 48px; font-weight: bold;">Orite <span style="color: red;">.</span></span>
									<!-- <img src="./img/logo2.png" alt=""> -->
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form method="GET" action="{{ url('/products') }}">
									<select class="input-select">
										<option value="0">All Categories</option>
										@foreach(getGlobalCategories() as $category)
											<option value="{{ $category->id }}">{{ $category->category_name }}</option>
										@endforeach
									</select>
									<input class="input" name="product_name" placeholder="Search here">
									<button class="search-btn">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->
						
						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Wishlist -->
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
										<!-- <div class="qty">2</div> -->
									</a>
								</div>
								<!-- /Wishlist -->
								
								<!-- Cart -->
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" style="cursor: pointer;">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div id="cart-badge"></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list" id="cart-container">
											
										</div>
										<div class="cart-summary">
											<h5>Total: <span id="cart-total">Php {{ getCartTotal() }}</span></h5>
										</div>
										<div class="cart-btns">
											<button type="button" style="background-color: #0288D1; color: white; margin: 0; height: 40px; width: 100%;"><a href="{{ url('/checkout') }}" style="color: white; text-decoration: none;">Checkout</a></button>
										</div>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="{{ url('/') }}">Home</a></li>
						@foreach(getGlobalCategories() as $category)
							<li><a href="{{ url('/products?category='.$category->id) }}">{{ $category->category_name }}</a></li>
						@endforeach
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		@if (session('success'))
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="alert alert-success" role="alert">
							{{ session('success') }}
						</div>
					</div>
				</div>
			</div>
		@endif

		@yield('content')

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Orite Copier and Printer Supplies was established year 2013 by the owner named Mr. Noel O. Oray. It is located at Km30 Villa Carolina 1 National Road Tunasan, Muntinlupa City. Their business is to supply printer machines and parts of printer machines and they open every day from 8:00am to 5:00pm. They have one branch that located in Bacolod City, Negros Occidental, and also they have seven workers and their suppliers are both local and International.</p>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Contact us</h3>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>0956-710-8146</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>oritecopiersolutions@gmail.com</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li> -->
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<!-- <li><a href="#"><i class="fa fa-cc-discover"></i></a></li> -->
								<!-- <li><a href="#"><i class="fa fa-cc-amex"></i></a></li> -->
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This site is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by John David O. Ladrillo and Jhona A. Isidoro
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="{{ url('js/jquery.min.js') }}"></script>
		<script src="{{ url('js/bootstrap.min.js') }}"></script>
		<script src="{{ url('js/slick.min.js') }}"></script>
		<script src="{{ url('js/nouislider.min.js') }}"></script>
		<script src="{{ url('js/jquery.zoom.min.js') }}"></script>
		<script src="{{ url('js/main.js') }}"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$.get("/cart-qty", function( quantity ) {
					if(quantity != 0) {
						document.getElementById("cart-badge").textContent = quantity;
						document.getElementById("cart-badge").classList.add('qty');
					}  else {
						document.getElementById("cart-badge").textContent = "";
						document.getElementById("cart-badge").classList.remove('qty');
					}
				});

				$.ajax( '/cart', {
					type: "GET",
					success: function(products) {
						$product = JSON.parse(products);
						
						$.each($product, function(i, product) {
							$("#cart-container").append(`
								<div class="product-widget" id="cart-item-`+product.id+`">
									<div class="product-img">
										<img src="data:image/png;base64,`+product.name.split("splitHere")[1]+`" alt="">
									</div>
									<div class="product-body">
										<h3 class="product-name"><a href="#">`+product.name.split("splitHere")[0]+`</a></h3>
										<h4 class="product-price"><span class="qty" id="cart-qty-`+product.id+`">`+product.quantity+`x</span>`+product.price+`</h4>
									</div>
									<button class="delete cart-remove" onclick="removeCartItem(`+product.id+`)"><i class="fa fa-close"></i></button>
								</div>
							`)
						});
					},
					error: function(req, status, err) {
						alert(err)
					}
				});
			});

			function removeCartItem($id) {
				$.ajax({
					type: "GET",
					url: "/cart-remove",
					data: {
						id: $id
					},
					success: function(response) {
						// do nothing
					},
					error: function(req, status, err) {
						alert(err)
					}
				});
				
				$.get("/cart-total", function( total ) {
					document.getElementById("cart-total").textContent = total;
				});

				$.get("/cart-qty", function( quantity ) {
					if(quantity != 0) {
						document.getElementById("cart-badge").textContent = quantity;
					}  else {
						document.getElementById("cart-badge").textContent = "";
						document.getElementById("cart-badge").classList.remove('qty');
					}
				});

				document.getElementById("cart-item-"+$id).remove();
			}
		</script>
		@yield('js')
	</body>
</html>
