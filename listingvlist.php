<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="zxx"> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang="zxx"> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang="zxx"> <![endif]-->
<!--[if gt IE 8]><!-->	<html class="no-js" lang="zxx"> <!--<![endif]-->
<?php require 'includes/header3.php' ?>
		<!--************************************
				Header End
		*************************************-->
		<!--************************************
				Main Start
		*************************************-->
		<main id="listar-main" class="listar-main listar-haslayout">
			<div id="listar-content" class="listar-content">
				<div class="listar-listing">
					<!-- <div id="listar-mapclustring" class="listar-mapclustring">
						<div class="listar-maparea">
							<div id="listar-listingmap" class="listar-listingmap"></div>
							<div class="listar-mapcontrols">
								<span id="doc-mapplus"><i class="fa fa-plus"></i></span>
								<span id="doc-mapminus"><i class="fa fa-minus"></i></span>
								<span id="doc-lock"><i class="fa fa-lock"></i></span>
								<span id="listar-geolocation"><i class="fa fa-crosshairs"></i></span>
							</div>
						</div>
					</div> -->
					<div class="listar-listingbox">
						<div class="row">
							<div class="listar-listingarea">
								<div class="listar-innerpagesearch">
									<div class="listar-innersearch">
										<div class="listar-searchstatus"><h1><span>Results For</span> Food &amp; Drinks Listings</h1></div>
										<form onsubmit="$('#hero-demo').blur();return false;" class="listar-formtheme listar-formsearchlisting">
											<fieldset>
												<div class="form-group listar-inputwithicon">
													<i class="icon-icons185"></i>
													<input type="text" name="q" id="listar-autosearch" class="form-control" placeholder="What are you looking for ?">
												</div>
												<div class="form-group listar-inputwithicon">
													<i class="icon-global"></i>
													<div class="listar-select listar-selectlocation">
														<select id="listar-locationchosen" class="listar-locationchosen listar-chosendropdown">
														<option>Choose a Location</option>
													<option>Garki</option>
													<option>Apo</option>
													<option>Asokoro</option>
													<option>Maitama</option>
													<option>Gwarimpa</option>
													<option>Wuse</option>
														</select>
													</div>
												</div>
												<div class="form-group listar-inputwithicon">
													<i class="icon-layers"></i>
													<div class="listar-select listar-selectlocation">
														<select id="listar-categorieschosen" class="listar-categorieschosen listar-chosendropdown">
															<option>All Categories</option>
															<option class="icon-entertainment">Housing</option>
													<option class="icon-spa">Electrical</option>
													<option class="icon-education">Housing</option>
													<option class="icon-healthfitness">Fitness</option>
													<option class="icon-tourism">Moving</option>
													<option class="icon-localservice">Health</option>
													<option class="icon-nightlife">Education</option>
													<option class="icon-foods">Cleaning</option>
														</select>
													</div>
												</div>
											</fieldset>
											<!-- <fieldset>
												<div class="listar-distance">
													<h2>Distance Radius</h2>
													<input id="listar-distancerangeslider" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14">
												</div>
											</fieldset> -->
											<!-- <fieldset>
												<div class="listar-leftbox">
													<a id="listar-btnadvancefeatures" class="listar-btnadvancefeatures" href="javascript:void(0);"><i class="icon-minus"></i><span>Advanced Features</span></a>
												</div>
												<div class="listar-rightbox">
													<div class="listar-select">
														<select>
															<option>Default Order</option>
															<option>Ascending</option>
															<option>Descending</option>
														</select>
													</div>
													<ul class="listar-views">
														<li><a href="listingv2.html"><i class="icon-grid"></i></a></li>
														<li class="listar-active"><a href="listingvlist.html"><i class="icon-icons152"></i></a></li>
													</ul>
												</div>
												<div id="listar-advancefitures" class="listar-advancefitures">
													<span class="listar-checkbox">
														<input id="listar-aircondation" type="checkbox" name="Advanced Features" value="Air Conditioning">
														<label for="listar-aircondation">Air Conditioning</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-freeparking" type="checkbox" name="Advanced Features" value="Free Parking">
														<label for="listar-freeparking">Free Parking</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-cardpayment" type="checkbox" name="Advanced Features" value="Card Payment">
														<label for="listar-cardpayment">Card Payment</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-smokingallowed" type="checkbox" name="Advanced Features" value="Smoking Allowed">
														<label for="listar-smokingallowed">Smoking Allowed</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-wifi" type="checkbox" name="Advanced Features" value="Wi-Fi">
														<label for="listar-wifi">Wi-Fi</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-swimmingpool" type="checkbox" name="Advanced Features" value="Swimming Pool">
														<label for="listar-swimmingpool">Swimming Pool</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-balcony" type="checkbox" name="Advanced Features" value="Balcony">
														<label for="listar-balcony">Balcony</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-reservations" type="checkbox" name="Advanced Features" value="Reservations">
														<label for="listar-reservations">Reservations</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-snackbar" type="checkbox" name="Advanced Features" value="Snack bar">
														<label for="listar-snackbar">Snack bar</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-familyfriendly" type="checkbox" name="Advanced Features" value="Family Friendly">
														<label for="listar-familyfriendly">Family Friendly</label>
													</span>
													<span class="listar-checkbox">
														<input id="listar-guidedtours" type="checkbox" name="Advanced Features" value="Guided Tours">
														<label for="listar-guidedtours">Guided Tours</label>
													</span>
												</div>
											</fieldset> -->
											<button type="button" class="listar-btn listar-btngreen button">Submit Result</button>
										</form>
									</div>
								</div>
								<div class="listar-themeposts listar-placesposts listar-listview">
									<div class="listar-themepost listar-placespost">
										<figure class="listar-featuredimg"><a href="detailv1.html"><img src="images/post/img-13.jpg" alt="image description" class="mCS_img_loaded"></a></figure>
										<div class="listar-postcontent">
											<h3><a href="detailv1.html">Tourist Guide</a></h3>
											<div class="listar-description">
												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod Aenean sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit</p>
											</div>
											<div class="listar-reviewcategory">
												<div class="listar-review">
													<span class="listar-stars"><span></span></span>
													<em>(3 Review)</em>
												</div>
												<a href="javascript:void(0);" class="listar-category">
													<i class="icon-nightlife"></i>
													<span>Night Life</span>
												</a>
											</div>
											<div class="listar-themepostfoot">
												<a class="listar-location" href="javascript:void(0);">
													<i class="icon-icons74"></i>
													<em>New York</em>
												</a>
												<div class="listar-postbtns">
													<a class="listar-btnquickinfo" href="#" data-toggle="modal" data-target=".listar-placequickview"><i class="icon-expand"></i></a>
													<a class="listar-btnquickinfo" href="javascript:void(0);"><i class="icon-heart2"></i></a>
													<div class="listar-btnquickinfo">
														<div class="listar-shareicons">
															<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
														</div>
														<a class="listar-btnshare" href="javascript:void(0);">
															<i class="icon-share3"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="listar-themepost listar-placespost">
										<figure class="listar-featuredimg"><a href="detailv2.html"><img src="images/post/img-14.jpg" alt="image description" class="mCS_img_loaded"></a></figure>
										<div class="listar-postcontent">
											<h3><a href="detailv2.html">Serena Hotel</a><i class="icon-checkmark listar-postverified listar-themetooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified"></i></h3>
											<div class="listar-description">
												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod Aenean sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit</p>
											</div>
											<div class="listar-reviewcategory">
												<div class="listar-review">
													<span class="listar-stars"><span></span></span>
													<em>(3 Review)</em>
												</div>
												<a href="javascript:void(0);" class="listar-category">
													<i class="icon-tourism"></i>
													<span>Hotel</span>
												</a>
											</div>
											<div class="listar-themepostfoot">
												<a class="listar-location" href="javascript:void(0);">
													<i class="icon-icons74"></i>
													<em>New York</em>
												</a>
												<div class="listar-postbtns">
													<a class="listar-btnquickinfo" href="#" data-toggle="modal" data-target=".listar-placequickview"><i class="icon-expand"></i></a>
													<a class="listar-btnquickinfo listar-liked" href="javascript:void(0);"><i class="icon-heart2"></i></a>
													<div class="listar-btnquickinfo">
														<div class="listar-shareicons">
															<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
														</div>
														<a class="listar-btnshare" href="javascript:void(0);">
															<i class="icon-share3"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="listar-themepost listar-placespost">
										<figure class="listar-featuredimg"><a href="detailv1.html"><img src="images/post/img-15.jpg" alt="image description" class="mCS_img_loaded"></a></figure>
										<div class="listar-postcontent">
											<h3><a href="detailv1.html">Tourist Guide</a></h3>
											<div class="listar-description">
												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod Aenean sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit</p>
											</div>
											<div class="listar-reviewcategory">
												<div class="listar-review">
													<span class="listar-stars"><span></span></span>
													<em>(3 Review)</em>
												</div>
												<a href="javascript:void(0);" class="listar-category">
													<i class="icon-foods"></i>
													<span>Food and Drinks</span>
												</a>
											</div>
											<div class="listar-themepostfoot">
												<a class="listar-location" href="javascript:void(0);">
													<i class="icon-icons74"></i>
													<em>New York</em>
												</a>
												<div class="listar-postbtns">
													<a class="listar-btnquickinfo" href="#" data-toggle="modal" data-target=".listar-placequickview"><i class="icon-expand"></i></a>
													<a class="listar-btnquickinfo" href="javascript:void(0);"><i class="icon-heart2"></i></a>
													<div class="listar-btnquickinfo">
														<div class="listar-shareicons">
															<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
														</div>
														<a class="listar-btnshare" href="javascript:void(0);">
															<i class="icon-share3"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="listar-themepost listar-placespost">
										<figure class="listar-featuredimg"><a href="detailv2.html"><img src="images/post/img-13.jpg" alt="image description" class="mCS_img_loaded"></a></figure>
										<div class="listar-postcontent">
											<h3><a href="detailv2.html">Tourist Guide</a></h3>
											<div class="listar-description">
												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod Aenean sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit</p>
											</div>
											<div class="listar-reviewcategory">
												<div class="listar-review">
													<span class="listar-stars"><span></span></span>
													<em>(3 Review)</em>
												</div>
												<a href="javascript:void(0);" class="listar-category">
													<i class="icon-nightlife"></i>
													<span>Night Life</span>
												</a>
											</div>
											<div class="listar-themepostfoot">
												<a class="listar-location" href="javascript:void(0);">
													<i class="icon-icons74"></i>
													<em>New York</em>
												</a>
												<div class="listar-postbtns">
													<a class="listar-btnquickinfo" href="#" data-toggle="modal" data-target=".listar-placequickview"><i class="icon-expand"></i></a>
													<a class="listar-btnquickinfo" href="javascript:void(0);"><i class="icon-heart2"></i></a>
													<div class="listar-btnquickinfo">
														<div class="listar-shareicons">
															<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
														</div>
														<a class="listar-btnshare" href="javascript:void(0);">
															<i class="icon-share3"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="listar-themepost listar-placespost">
										<figure class="listar-featuredimg"><a href="detailv1.html"><img src="images/post/img-14.jpg" alt="image description" class="mCS_img_loaded"></a></figure>
										<div class="listar-postcontent">
											<h3><a href="detailv1.html">Serena Hotel</a><i class="icon-checkmark listar-postverified listar-themetooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verified"></i></h3>
											<div class="listar-description">
												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod Aenean sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit</p>
											</div>
											<div class="listar-reviewcategory">
												<div class="listar-review">
													<span class="listar-stars"><span></span></span>
													<em>(3 Review)</em>
												</div>
												<a href="javascript:void(0);" class="listar-category">
													<i class="icon-tourism"></i>
													<span>Hotel</span>
												</a>
											</div>
											<div class="listar-themepostfoot">
												<a class="listar-location" href="javascript:void(0);">
													<i class="icon-icons74"></i>
													<em>New York</em>
												</a>
												<div class="listar-postbtns">
													<a class="listar-btnquickinfo" href="#" data-toggle="modal" data-target=".listar-placequickview"><i class="icon-expand"></i></a>
													<a class="listar-btnquickinfo listar-liked" href="javascript:void(0);"><i class="icon-heart2"></i></a>
													<div class="listar-btnquickinfo">
														<div class="listar-shareicons">
															<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
														</div>
														<a class="listar-btnshare" href="javascript:void(0);">
															<i class="icon-share3"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="listar-themepost listar-placespost">
										<figure class="listar-featuredimg"><a href="detailv2.html"><img src="images/post/img-15.jpg" alt="image description" class="mCS_img_loaded"></a></figure>
										<div class="listar-postcontent">
											<h3><a href="detailv2.html">Tourist Guide</a></h3>
											<div class="listar-description">
												<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit sed diam nonummy nibh euismod Aenean sollicitudin lorem quis bibendum auctor, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit, nisi elit consequat ipsum nec sagittis sem nibh id elit</p>
											</div>
											<div class="listar-reviewcategory">
												<div class="listar-review">
													<span class="listar-stars"><span></span></span>
													<em>(3 Review)</em>
												</div>
												<a href="javascript:void(0);" class="listar-category">
													<i class="icon-foods"></i>
													<span>Food and Drinks</span>
												</a>
											</div>
											<div class="listar-themepostfoot">
												<a class="listar-location" href="javascript:void(0);">
													<i class="icon-icons74"></i>
													<em>New York</em>
												</a>
												<div class="listar-postbtns">
													<a class="listar-btnquickinfo" href="#" data-toggle="modal" data-target=".listar-placequickview"><i class="icon-expand"></i></a>
													<a class="listar-btnquickinfo" href="javascript:void(0);"><i class="icon-heart2"></i></a>
													<div class="listar-btnquickinfo">
														<div class="listar-shareicons">
															<a href="javascript:void(0);"><i class="fa fa-twitter"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-facebook"></i></a>
															<a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a>
														</div>
														<a class="listar-btnshare" href="javascript:void(0);">
															<i class="icon-share3"></i>
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<nav class="listar-pagination">
										<ul>
											<li class="listar-prevpage"><a href="javascript:void(0);"><i class="fa fa-angle-left"></i></a></li>
											<li class="listar-active"><a href="javascript:void(0);">1</a></li>
											<li><a href="javascript:void(0);">2</a></li>
											<li><a href="javascript:void(0);">3</a></li>
											<li class="listar-nextpage"><a href="javascript:void(0);"><i class="fa fa-angle-right"></i></a></li>
										</ul>
									</nav>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
		<!--************************************
				Main End
		*************************************-->
		<!--************************************
				Footer Start
		*************************************-->
	<?php require 'includes/footer.php' ?>
</body>
</html>