
<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zxx"> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang="zxx"> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang="zxx"> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="zxx"> <!--<![endif]-->
<?php require 'includes/header2.php' ?>
		<!--************************************
				Header End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="listar-main" class="listar-main listar-haslayout">
			<!--************************************
					Dashboard Banner Start
			*************************************-->
			<div class="listar-dashboardbanner">
				<div class="listar-select">
					<select id="listar-subscriptionchosen" class="listar-subscriptionchosen listar-chosendropdown">
						<option value="">Select a Subscription</option>
						<option value="">Select a Subscription</option>
						<option value="">Select a Subscription</option>
						<option value="">Select a Subscription</option>
					</select>
				</div>
				<div class="listar-leftbox">
					<ol class="listar-breadcrumb">
						<li><a href="javascript:void(0);">Home</a></li>
						<li class="listar-active">Add Listing</li>
					</ol>
					<h1>Add Listing</h1>
					<div class="listar-description">
						<p>Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra doloremque laudantium, totam rem aperiam</p>
					</div>
				</div>
			</div>
			<!--************************************
					Dashboard Banner End
			*************************************-->
			<!--************************************
					Dashboard Content Start
			*************************************-->
			<div id="listar-content" class="listar-content">
				<form class="listar-formtheme listar-formaddlisting">
					<div id="listar-addlistingsteps" class="listar-addlistingsteps">
						<div class="listar-steptitle"><em>Basic Information</em></div>
						<section>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Basic Information</h3>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Listing Title</label>
											<input type="text" name="name" class="form-control" placeholder="Salt &amp; Pepper Restaurant">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Video Url <span>(Viemo or Youtube)</span></label>
											<input type="url" name="videourl" class="form-control" placeholder="//:http">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Categories</label>
											<input type="text" name="categories" class="form-control" placeholder="Housing">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Location <span>(optional)</span></label>
											<input type="text" name="location" class="form-control" placeholder="Pakistan">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Phone Number</label>
											<input type="text" name="phonenumber" class="form-control" placeholder="111 - 111 - 9870">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Website</label>
											<input type="url" name="website" class="form-control" placeholder="//:http">
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Description</label>
											<div class="clearfix"></div>
											<textarea id="listar-tinymceeditor" class="listar-tinymceeditor"></textarea>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
										<div class="form-group listar-dashboardfield">
											<label>Gallery</label>
											<label class="listar-fileuploadlabel" for="listar-photogallery">
												<span>Drag &amp; Drop file here</span>
												<span>Or</span>
												<span class="listar-btn">Browser Files</span>
												<input id="listar-photogallery" class="listar-fileinput" type="file" name="file">
											</label>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group listar-dashboardfield">
											<label>Amenities</label>
											<ul class="listar-amenities">
												<li><a href="javascript:void(0);">Pets Allowed</a></li>
												<li><a href="javascript:void(0);">Internet</a></li>
												<li><a href="javascript:void(0);">Family &amp; Friends</a></li>
												<li><a href="javascript:void(0);">Cable TV</a></li>
												<li><a href="javascript:void(0);">Gym</a></li>
											</ul>
										</div>
									</div>
								</div>
							</fieldset>
						</section>
						<div class="listar-steptitle"><em>Location</em></div>
						<section>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Location</h3>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="form-group listar-dashboardfield">
											<label>Address</label>
											<input type="text" name="website" class="form-control" placeholder="Search for address">
										</div>
										<iframe class="listar-postlocationmap" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3152.194140973736!2d144.95846281578753!3d-37.80892137975326!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d34d2754a9f%3A0xad27583c2c9e2890!2sElizabeth+St%2C+Melbourne+VIC+3000%2C+Australia!5e0!3m2!1sen!2s!4v1509393269805"></iframe>
									</div>
								</div>
							</fieldset>
						</section>
						<div class="listar-steptitle"><em>Price Setting</em></div>
						<section>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Price Setting</h3>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Price Segment</label>
											<div class="listar-select">
												<select>
													<option>Not to say</option>
													<option>Specify</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Minimum Price</label>
											<input type="text" name="name" class="form-control" placeholder="1000">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Maximum Price</label>
											<input type="text" name="name" class="form-control" placeholder="1,000,000">
										</div>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Pricing</h3>
								</div>
								<div class="row">
									<ul id="listar-sortable" class="listar-sortable">
										<li class="listar-slot">
											<span class="listar-arangeslot"><img src="images/icons/icon-09.jpg" alt="image description"></span>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
												<div class="form-group listar-dashboardfield">
													<label>Title</label>
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
												<div class="form-group listar-dashboardfield">
													<label>Desctiption</label>
													<input type="text" name="description" class="form-control" placeholder="Desctiption">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
												<div class="form-group listar-dashboardfield">
													<label>Product Image</label>
													<input type="file" name="name" class="form-control" id="productimage">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
												<div class="form-group listar-dashboardfield">
													<label>Price</label>
													<div class="listar-inputwithicon">
														<span>NGN</span>
														<input type="text" name="name" class="form-control" placeholder="Price">
													</div>
												</div>
											</div>
											<span class="listar-btndelete"><i class="icon-icons88"></i></span>
										</li>
										<li class="listar-slot">
											<span class="listar-arangeslot"><img src="images/icons/icon-09.jpg" alt="image description"></span>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
												<div class="form-group listar-dashboardfield">
													<label>Title</label>
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
												<div class="form-group listar-dashboardfield">
													<label>Desctiption</label>
													<input type="text" name="description" class="form-control" placeholder="Desctiption">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
												<div class="form-group listar-dashboardfield">
													<label>Product Image</label>
													<input type="file" name="name" class="form-control" id="productimage">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
												<div class="form-group listar-dashboardfield">
													<label>Price</label>
													<div class="listar-inputwithicon">
														<span>NGN</span>
														<input type="text" name="name" class="form-control" placeholder="Price">
													</div>
												</div>
											</div>
											<span class="listar-btndelete"><i class="icon-icons88"></i></span>
										</li>
										<li class="listar-slot">
											<span class="listar-arangeslot"><img src="images/icons/icon-09.jpg" alt="image description"></span>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
												<div class="form-group listar-dashboardfield">
													<label>Title</label>
													<input type="text" name="title" class="form-control" placeholder="Title">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-5">
												<div class="form-group listar-dashboardfield">
													<label>Desctiption</label>
													<input type="text" name="description" class="form-control" placeholder="Desctiption">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
												<div class="form-group listar-dashboardfield">
													<label>Product Image</label>
													<input type="file" name="name" class="form-control" id="productimage">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-2">
												<div class="form-group listar-dashboardfield">
													<label>Price</label>
													<div class="listar-inputwithicon">
														<span>NGN</span>
														<input type="text" name="name" class="form-control" placeholder="Price">
													</div>
												</div>
											</div>
											<span class="listar-btndelete"><i class="icon-icons88"></i></span>
										</li>
									</ul>
									<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">
										<div class="listar-btnarea">
											<div class="form-group listar-dashboardfield">
												<a class="listar-btnadd" href="javascript:void(0);">+</a>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</section>
						<div class="listar-steptitle"><em>Business Hours</em></div>
						<section>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Business Hours</h3>
								</div>
								<div class="row">
									<ul class="listar-businesshours">
										<li>
											<label>Monday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="8:00am">8:00am</option>
  												<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
  												<option value="6:00pm">6:00pm</option>
												</select>
											</div>
										</li>
										<li>
											<label>Tuesday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="8:00am">8:00am</option>
  												<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
  												<option value="6:00pm">6:00pm</option>
												</select>
											</div>
										</li>
										<li>
											<label>Wednesday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="8:00am">8:00am</option>
  												<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
  												<option value="6:00pm">6:00pm</option>
												</select>
											</div>
										</li>
										<li>
											<label>Thursday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="8:00am">8:00am</option>
  												<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
  												<option value="6:00pm">6:00pm</option>
												</select>
											</div>
										</li>
										<li>
											<label>Friday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="8:00am">8:00am</option>
  												<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
  												<option value="6:00pm">6:00pm</option>
												</select>
											</div>
										</li>
										<li>
											<label>Saturday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="Closed">Closed</option>
													<option value="8:00am">8:00am</option>
  												<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="Closed">Closed</option>
													<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
  												<option value="6:00pm">6:00pm</option>
												</select>
											</div>
										</li>
										<li>
											<label>Sunday</label>
											<div class="listar-select">
												<select>
													<option>Opening Time</option>
													<option value="Closed">Closed</option>
													<option value="9:00am">9:00am</option>
  												<option value="10:00am">10:00am</option>
  												<option value="11:00am">11:00am</option>
												</select>
											</div>
											<div class="listar-select">
												<select>
													<option>Closing Time</option>
													<option value="Closed">Closed</option>
													<option value="3:00pm">3:00pm</option>
  												<option value="4:00pm">4:00pm</option>
  												<option value="5:00pm">5:00pm</option>
												</select>
											</div>
										</li>
									</ul>
								</div>
							</fieldset>
						</section>
						<div class="listar-steptitle"><em>Additinoal Detail</em></div>
						<section>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Additional Details</h3>
								</div>
								<div class="row">
									<div class="listar-slot">
										<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
											<div class="form-group listar-dashboardfield">
												<label>Label</label>
												<input type="text" name="title" class="form-control" placeholder="Take Out">
											</div>
										</div>
										<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
											<div class="form-group listar-dashboardfield">
												<label>Value</label>
												<input type="text" name="description" class="form-control" placeholder="Yes">
											</div>
										</div>
										<a class="listar-btndelete" href="javascript:void(0);"><i class="icon-icons88"></i></a>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<div class="listar-btnarea">
											<div class="form-group listar-dashboardfield">
												<a class="listar-btnadd" href="javascript:void(0);">+</a>
											</div>
										</div>
									</div>
								</div>
							</fieldset>
						</section>
						<div class="listar-steptitle"><em>Social Media</em></div>
						<section>
							<fieldset>
								<div class="listar-boxtitle">
									<h3>Social Media</h3>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Facebook<span class="listar-socialurlicon listar-facebook"><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></span></label>
											<input type="url" name="urlfacebook" class="form-control" placeholder="enter facebook profile url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Twitter<span class="listar-socialurlicon listar-twitter"><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></span></label>
											<input type="url" name="urltwitter" class="form-control" placeholder="enter twitter profile url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Linkedin<span class="listar-socialurlicon listar-linkedin"><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></span></label>
											<input type="url" name="urllinkedin" class="form-control" placeholder="enter linkedin profile url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Google<span class="listar-socialurlicon listar-googleplus"><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></span></label>
											<input type="url" name="urlgoogle" class="form-control" placeholder="enter google profile url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Instagram<span class="listar-socialurlicon listar-instagram"><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></span></label>
											<input type="url" name="urlinstagram" class="form-control" placeholder="enter Instagram profile url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Pintrest<span class="listar-socialurlicon listar-pinterestp"><a href="javascript:void(0);"><i class="fa fa-pinterest"></i></a></span></label>
											<input type="url" name="urlpintrest" class="form-control" placeholder="enter pinterest profile url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Vimeo<span class="listar-socialurlicon listar-vimeo"><a href="javascript:void(0);"><i class="fa fa-vimeo"></i></a></span></label>
											<input type="url" name="urlvimeo" class="form-control" placeholder="enter vimeo url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Youtube<span class="listar-socialurlicon listar-youtube"><a href="javascript:void(0);"><i class="fa fa-youtube"></i></a></span></label>
											<input type="url" name="urlyoutube" class="form-control" placeholder="enter youtube url">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
										<div class="form-group listar-dashboardfield">
											<label>Tumblr<span class="listar-socialurlicon listar-tumblr"><a href="javascript:void(0);"><i class="fa fa-tumblr"></i></a></span></label>
											<input type="url" name="urltumblr" class="form-control" placeholder="enter Tumblr url">
											<button type="button" class="btn btn-outline-success">Success</button>
										</div>
									</div>
								</div>
							</fieldset>
						</section>
					</div>
				</form>
			</div>
			<!--************************************
						Dashboard Content End
			*************************************-->
		</main>
		<!--************************************
					Main End
		*************************************-->
		<!--************************************
					Footer Start
		*************************************-->
		<footer id="listar-footer" class="listar-footer listar-haslayout">
			<div class="listar-footerbar">
				<div class="container-fluid">
					<div class="row">
						<span class="listar-copyright">Copyright &copy; 2021 YokeUs. All rights reserved.</span>
					</div>
				</div>
			</div>
		</footer>
		<!--************************************
					Footer End
		*************************************-->
	</div>
	<!--************************************
				Wrapper End
	*************************************-->
	<script src="js/vendor/jquery-library.js"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/mapclustering/data.json"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyCR-KEWAVCn52mSdeVeTqZjtqbmVJyfSus&amp;language=en"></script>
	<script src="js/tinymce/tinymce.min.js?apiKey=4cuu2crphif3fuls3yb1pe4qrun9pkq99vltezv2lv6sogci"></script>
	<script src="js/mapclustering/markerclusterer.min.js"></script>
	<script src="js/mapclustering/infobox.js"></script>
	<script src="js/mapclustering/map.js"></script>
	<script src="js/ResizeSensor.js.js"></script>
	<script src="js/jquery.sticky-sidebar.js"></script>
	<script src="js/YouTubePopUp.jquery.js"></script>
	<script src="js/jquery.navhideshow.js"></script>
	<script src="js/backgroundstretch.js"></script>
	<script src="js/jquery.sticky-kit.js"></script>
	<script src="js/bootstrap-slider.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.vide.min.js"></script>
	<script src="JS/auto-complete.js"></script>
	<script src="js/chosen.jquery.js"></script>
	<script src="js/scrollbar.min.js"></script>
	<script src="js/isotope.pkgd.js"></script>
	<script src="js/jquery.steps.js"></script>
	<script src="js/prettyPhoto.js"></script>
	<script src="js/raphael-min.js"></script>
	<script src="js/parallax.js"></script>
	<script src="js/sortable.js"></script>
	<script src="js/countTo.js"></script>
	<script src="js/appear.js"></script>
	<script src="js/gmap3.js"></script>
	<script src="js/dev_themefunction.js"></script>
</body>
</html>
