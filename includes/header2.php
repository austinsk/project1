<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>YokeUs</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="favicon.png">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-slider.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/chosen.css">
	<link rel="stylesheet" href="css/prettyPhoto.css">
	<link rel="stylesheet" href="css/scrollbar.css">
	<link rel="stylesheet" href="css/morris.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/YouTubePopUp.css">
	<link rel="stylesheet" href="css/auto-complete.css">
	<link rel="stylesheet" href="css/jquery.navhideshow.css">
	<link rel="stylesheet" href="css/transitions.css">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="dbstyle.css">
	<link rel="stylesheet" href="css/color.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/dbresponsive.css">
	<script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
</head>
<body>
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!--************************************
			Preloader Start
	*************************************-->
	<div class="preloader-outer">
		<div class="pin"></div>
		<div class="pulse"></div>
	</div>
	<!--************************************
			Preloader End
	*************************************-->
	<!--************************************
			Wrapper Start
	*************************************-->
	<div id="listar-wrapper" class="listar-wrapper listar-haslayout">
		<!--************************************
				Header Start
		*************************************-->
		<header id="listar-dashboardheader" class="listar-dashboardheader listar-haslayout">
			<div class="cd-auto-hide-header listar-haslayout">
				<div class="container-fluid">
					<div class="row">
						<strong class="listar-logo"><a href="index.php"><img class="logo2" src="images/logo.png" alt="company logo here"></a></strong>
						<nav class="listar-addnav">
							<ul>
								<li>
									<div class="dropdown listar-dropdown">
										<a class="listar-userlogin listar-btnuserlogin" href="javascript:void(0);" id="listar-dropdownuser" data-toggle="dropdown">
											<span><img src="images/author/img-10.jpg" alt="image description"></span>
											<em>John Parker</em>
											<i class="fa fa-angle-down"></i>
										</a>
										<div class="dropdown-menu listar-dropdownmen" aria-labelledby="listar-dropdownuser">
											<ul>
												<li>
													<a href="dashboard.php">
														<i class="icon-speedometer2"></i>
														<span>Dashboard</span>
													</a>
												</li>
												<li>
													<a href="dashboardlisting.php">
														<i class="icon-layers"></i>
														<span>My Listings</span>
													</a>
												</li>
												<li>
													<a href="dashboardmyprofile.php">
														<i class="icon-user2"></i>
														<span>My Profile</span>
													</a>
												</li>
												<li>
													<a href="index.php">
														<i class="icon-lock6"></i>
														<span>Logout</span>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<a class="listar-btn listar-btngreen" href="dashboardaddlisting.php">
										<i class="icon-plus"></i>
										<span>Add Listing</span>
									</a>
								</li>
							</ul>
						</nav>
						<nav id="listar-nav" class="listar-nav">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#listar-navigation" aria-expanded="false">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div id="listar-navigation" class="collapse navbar-collapse listar-navigation">
                            <ul>
									<li class=" current-menu-item">
										<a href="index.php">Home</a>
										<!-- <ul class="sub-menu">
											<li class="current-menu-item"><a href="index.php">Home v 1</a></li>
											<li><a href="indexv2.php">Home v 2</a></li>
											<li><a href="indexv3.php">Home v 3</a></li>
											<li><a href="indexv4.php">Home v 4</a></li>
										</ul> -->
									</li>
									<li class="menu-item-has-children">
										<a href="listingvlist.php">Explore</a>
										<ul class="sub-menu">
											<li><a href="listingvlist.php">All Listings</a></li>
											<li class="menu-item-has-children">
												<a href="listingvlist.php">Housing</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php">Plumbing</a></li>
													<li><a href="listingvlist.php">Painting</a></li>
													<li><a href="listingvlist.php">Carpet</a></li>
													<li><a href="listingvlist.php">Carpentry</a></li>
													<li><a href="listingvlist.php">Roofing</a></li>
													<!-- <li><a href="listingv2.php">Bakeries</a></li> -->
												</ul>
											</li>
											<li class="menu-item-has-children">
												<a href="listingvlist.php">Automobile</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php">Car Paint</a></li>
													<!-- <li><a href="listingv2.php">Movie Theater</a></li>
													<li><a href="listingv1.php">Theme Parks</a></li>
													<li><a href="listingv2.php">Music Life</a></li> -->
												</ul>
											</li>
											<li class="menu-item-has-children">
												<a href="listingvlist.php;">Electrical</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php">Air Condition</a></li>
													<li><a href="listingvlist.php">Phone</a></li>
													<!-- <li><a href="listingv1.php">University</a></li>
													<li><a href="listingv2.php">Short Courses</a></li> -->
												</ul>
											</li>
											<li class="menu-item-has-children">
												<a href="javascript:void(0);">Moving</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php">Welder</a></li>
													<li><a href="listingvlist.php">Moving</a></li>
													<!-- <li><a href="listingv1.php">Nightclub</a></li>
													<li><a href="listingv2.php">Lounge</a></li> -->
												</ul>
											</li>
											<li class="menu-item-has-children">
												<a href="javascript:void(0);">Health</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php">Fitness</a></li>
													<!-- <li><a href="listingv2.php">Fashion</a></li>
													<li><a href="listingv1.php">Furniture</a></li>
													<li><a href="listingv2.php">Sport Equipment</a></li> -->
												</ul>
                                            </li>
                                            <li class="menu-item-has-children">
												<a href="listingvlist.php">Cleaning</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php"></a></li>
													<!-- <li><a href="listingv2.php">Fashion</a></li>
													<li><a href="listingv1.php">Furniture</a></li>
													<li><a href="listingv2.php">Sport Equipment</a></li> -->
												</ul>
											</li>
                                            <li class="menu-item-has-children">
												<a href="listingvlist.php">Education</a>
												<ul class="sub-menu">
													<li><a href="listingvlist.php">Tutors</a></li>
													<!-- <li><a href="listingv2.php">Fashion</a></li>
													<li><a href="listingv1.php">Furniture</a></li>
													<li><a href="listingv2.php">Sport Equipment</a></li> -->
												</ul>
											</li>
										</ul>
									</li>
									<li class="menu-item-has-children">
										<a href="javascript:void(0);">Pages</a>
										<ul class="sub-menu">
											<!-- <li><a href="howitwork.php">How It Works</a></li> -->
											<li><a href="services.php">Services</a></li>
											<!-- <li><a href="pkgprice.php">Packages</a></li> -->
											<li><a href="testimonials.php">Testimonials</a></li>

											<!-- <li><a href="404error.php">404 Error</a></li>
											<li><a href="comingsoon.php">Coming Sooon</a></li> -->
										</ul>
									</li>
									<!-- <li>
										<a href="newsv1.php">News</a>
										<ul class="sub-menu">
											<li><a href="newsv1.php">Blog Standard</a></li>
											<li><a href="newsv2.php">Blog Classic</a></li>
											<li><a href="newsv3.php">Blog sidebar</a></li>
										</ul>
                                    </li> -->
                                    <!-- <li><a href="contactus.php">Contact Us</a></li> -->
									<!-- <li class="current-menu-item"><a href="dashboard.php">Dasboard</a></li> -->
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
			<div id="listar-sidebarwrapper" class="listar-sidebarwrapper">
				<strong class="listar-logo"><a href="index.php"><img src="images/logo.png" alt="company logo here"></a></strong>
				<span id="listar-btnmenutoggle" class="listar-btnmenutoggle"><i class="fa fa-angle-left"></i></span>
				<div id="listar-verticalscrollbar" class="listar-verticalscrollbar">
					<nav id="listar-navdashboard" class="listar-navdashboard">
						<div class="listar-menutitle"><span>Main</span></div>
						<ul>
							<li class="listar-active">
								<a href="dashboard.php">
									<i class="icon-speedometer2"></i>
									<span>Dashboard</span>
								</a>
							</li>
							<li>
								<a href="dashboardlisting.php">
									<i class="icon-profile-male"></i>
									<span>users List</span>
								</a>
							</li>
							<li>
								<a href="dashboardlisting.php">
									<i class="icon-layers"></i>
									<span>My Listings</span>
								</a>
							</li>
							<li>
								<a href="dashboardreviews.php">
									<i class="icon-star4"></i>
									<span>Reviews</span>
								</a>
							</li>
							<li>
								<a href="dashboardwishlist.php">
									<i class="icon-heart3"></i>
									<span>Wishlist</span>
								</a>
							</li>
							<li>
								<a href="dashboardaddlisting.php">
									<i class="icon-pencil3"></i>
									<span>Add Listing</span>
								</a>
							</li>
						</ul>
						<div class="listar-menutitle listar-menutitleaccount"><span>Account</span></div>
						<ul>
							<li>
								<a href="dashboardmyprofile.php">
									<i class="icon-lock6"></i>
									<span>My Profile</span>
								</a>
							</li>
							<li>
								<a href="dashboard-profile-setting.php">
									<i class="icon-user4"></i>
									<span>Logout</span>
								</a>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</header>
