<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Pangong I Developer-friendly Admin Dashboard UI framework</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
	
	<!-- Lightgallery CSS -->
    <link href="assets/dist/css/lightgallery.css" rel="stylesheet" type="text/css">

    <!-- Custom CSS -->
    <link href="assets/dist/css/style.css" rel="stylesheet" type="text/css">

</head>

<body data-spy="scroll" data-target=".navbar" data-offset="60">
    <!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->

    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-alt-nav hk-landing">
		<div class="fixed-top bg-white shadow-sm">
			<div class="container px-0">
				<nav class="navbar navbar-expand-xl navbar-light hk-navbar hk-navbar-alt shadow-none">
					<a class="navbar-toggle-btn nav-link-hover navbar-toggler" href="javascript:void(0);" data-toggle="collapse" data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation"><span class="feather-icon"><i data-feather="menu"></i></span></a>
					<a class="navbar-brand" href="#">
						<h4>SIG AKIA</h4>
					</a>
					
					<div class="collapse navbar-collapse ml-auto" id="navbarCollapseAlt">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item mr-10">
								<a class="nav-link" href="#">Version<span class="badge badge-soft-success badge-sm badge-pill ml-10">v 1.0</span></a>
							</li>
						</ul>
					</div>
					<ul class="navbar-nav hk-navbar-content">
						<li class="nav-item">
							<a class="btn btn-outline-primary btn-rounded" href="#">Login</a>
						</li>
					</ul>
				</nav>
			</div>	
		</div>	
		<!-- Main Content -->
        <div class="hk-pg-wrapper pt-0">
			<!-- Row -->
			<div class="row">
				<div class="col-xl-12">					
					<!-- Utilities Sec -->
					<section class="hk-landing-sec pb-35">
						<div class="container">
							<h2 class="text-center">Selamat Datang di SIG Aksesibilitas Ibu dan Anak</h2>
							<p class="text-center mt-4">SIG Aksesibilitas Ibu dan Anak merupakan sistem informasi berbasis geografis yang menampilkan persebaran dan indeks aksesibilitas fasilitas kesehatan ibu dan anak yang berada di wilayah kota Bandarlampung. Aksesibilitas merupakan</p>
							<div class="row mt-50">
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-pink mr-15"><i data-feather="underline"></i></span>
											Utilities
										</span>
									</h5>
									<p>Easy styling with spacing, sizing, backgrounds, shadows and many more utilities.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-teal mr-15"><i data-feather="type"></i></span>
											Typography
										</span>	
									</h5>
									<p>The Typography, includes global settings, headings, body text, lists, responsive typography and more.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-orange mr-15"><i data-feather="command"></i></span>
											Colors
										</span>	
									</h5>
									<p>Play around contextual colors, 20+ base colors, 230+ color shades and many gradient color options.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-primary mr-15"><i data-feather="info"></i></span>	
											Icons
										</span>	
									</h5>
									<p>Over 1500 free icons. Each icon pack includes SVG or a webfont to easily add in css and html pages.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-green mr-15"><i data-feather="server"></i></span>
											Forms
										</span>	
									</h5>
									<p>A variety of form control styles, layouts, custom components, editor, form pickers, sliders and more.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-red mr-15"><i data-feather="list"></i></span>
											Tables
										</span>	
									</h5>
									<p>Add advance interaction controls like search, pagination & selectors, export using exclusive Data table.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-pumpkin mr-15"><i data-feather="pie-chart"></i></span>
											Charts
										</span>	
									</h5>
									<p>Interactive charts, complex charts, realtime data charts, pie & donut charts and more.</p>
								</div>
								<div class="col-lg-3 col-sm-6 mb-45">
									<h5 class="mb-20">
										<span class="d-flex align-items-center">
											<span class="feather-icon text-violet mr-15"><i data-feather="map"></i></span>
											Maps
										</span>	
									</h5>
									<p>Vector and google maps integration for location hierarchies, basic map view, and key mapping features.</p>
								</div>
							</div>
						</div>
					</section>
					<!-- /Utilities Sec -->
				
					
					<!-- Adv Sec -->
					<section class="hk-landing-sec bg-gradient-primary">
						<div class="container">
							<div id="map" style="height: 550px"></div>
						</div>
					</section>
					<!-- /Adv Sec -->
				</div>
			</div>
			<!-- /Row -->
            
			<!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Pampered by<a href="https://hencework.com/" class="text-dark" target="_blank">Hencework</a> © 2019</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="assets/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	
	<!-- Owl JavaScript -->
    <script src="assets/vendors/owl.carousel/dist/owl.carousel.min.js"></script>
	
	<!-- FeatherIcons JavaScript -->
    <script src="assets/dist/js/feather.min.js"></script>
	
	<!-- Gallery JavaScript -->
    <script src="assets/vendors/lightgallery/dist/js/lightgallery-all.min.js"></script>
    <script src="assets/dist/js/froogaloop2.min.js"></script>
    
	<!-- Init JavaScript -->
    <script src="assets/dist/js/lightgallery-all.js"></script>
    <script src="assets/dist/js/landing-data.js"></script>
    <script src="assets/dist/js/init.js"></script>
	<script
		src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPNpyLAPlS77x4m8e3NdunZAx2VcGme6w&callback=initMap&libraries=&v=weekly"
		async>
	</script>
	<script>
		// Initialize and add the map
		function initMap() {

			const uluru = { lat:-5.375130, lng:105.253640 };

			const map = new google.maps.Map(document.getElementById("map"), {
				zoom: 11,
				center: uluru,
			});

			const marker = new google.maps.Marker({
				position: uluru,
				map: map,
			});
		}
    </script>
	</body>

</html>	