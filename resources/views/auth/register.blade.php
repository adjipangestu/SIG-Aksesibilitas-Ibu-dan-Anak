<!DOCTYPE html>
<!-- 
Template Name: Pangong - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/
License: You must have a valid license purchased only from themeforest to legally use the template for your project.
-->
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<title>Daftar | SIG AKIA</title>
		<meta name="description" content="SIG Aksesibilitas Ibu dan Anak merupakan sistem informasi berbasis geografis yang menampilkan persebaran dan indeks aksesibilitas fasilitas kesehatan ibu dan anak yang berada di wilayah kota Bandarlampung. Aksesibilitas merupakan" />
		
		<!-- Favicon -->
		<link rel="shortcut icon" href="favicon.ico">
		<link rel="icon" href="favicon.ico" type="image/x-icon">
		
		<!-- Toggles CSS -->
		<link href="assets/vendors/jquery-toggles/css/toggles.css" rel="stylesheet" type="text/css">
		<link href="assets/vendors/jquery-toggles/css/themes/toggles-light.css" rel="stylesheet" type="text/css">
		
		<!-- Custom CSS -->
		<link href="assets/dist/css/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<!-- Preloader -->
		<div class="preloader-it">
			<div class="loader-pendulums"></div>
		</div>
		<!-- /Preloader -->
		
		<!-- HK Wrapper -->
		<div class="hk-wrapper">
			
			<!-- Main Content -->
			<div class="hk-pg-wrapper hk-auth-wrapper">
				<header class="d-flex justify-content-end align-items-center">
					<div class="btn-group btn-group-sm">
						<a href="#" class="btn btn-outline-secondary">Help</a>
						<a href="#" class="btn btn-outline-secondary">About Us</a>
					</div>
				</header>
				<div class="container-fluid">
					<div class="row">
						<div class="col-xl-12 pa-0">
							<div class="auth-form-wrap pt-xl-0 pt-70">
								<div class="auth-form w-xl-30 w-lg-55 w-sm-75 w-100">
									<form method="POST" action="{{ route('register') }}">
										@csrf
										<h1 class="display-4 text-center mb-10">Sign up for free</h1>
										<p class="text-center mb-30">Create your account and start your free trial today</p> 
                                        <div class="form-group">
											<input id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nama" type="text" required autofocus>
											@error('name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
										<div class="form-group">
											<input id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" type="text" required autofocus>
											@error('username')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
                                        <div class="form-group">
											<input id="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" type="text" required autofocus>
											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
										<div class="form-group">
											<div class="input-group">
												<input class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" type="password">
												<div class="input-group-append">
													<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
												</div>
												@error('password')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
                                        <div class="form-group">
											<div class="input-group">
												<input class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required placeholder="Password Confirmation" type="password">
												<div class="input-group-append">
													<span class="input-group-text"><span class="feather-icon"><i data-feather="eye-off"></i></span></span>
												</div>
											</div>
										</div>
										<div class="custom-control custom-checkbox mb-25">
                                            <input class="custom-control-input" id="same-address" type="checkbox" checked>
                                            <label class="custom-control-label font-14" for="same-address">I have read and agree to the <a href=""><u>term and conditions</u></a></label>
                                        </div>
                                        <button class="btn btn-primary btn-block" type="submit">Register</button>
                                        <hr>
                                        <div class="option-sep">or</div>
                                        <p class="text-center">Sudah punya akun? <a href="/login">Login</a></p>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Main Content -->
		
		</div>
		<!-- /HK Wrapper -->
		
		<!-- JavaScript -->
		
		<!-- jQuery -->
		<script src="assets/vendors/jquery/dist/jquery.min.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="assets/vendors/popper.js/dist/umd/popper.min.js"></script>
		<script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
		
		<!-- Slimscroll JavaScript -->
		<script src="assets/dist/js/jquery.slimscroll.js"></script>
	
		<!-- Fancy Dropdown JS -->
		<script src="assets/dist/js/dropdown-bootstrap-extended.js"></script>
		
		<!-- FeatherIcons JavaScript -->
		<script src="assets/dist/js/feather.min.js"></script>
		
		<!-- Init JavaScript -->
		<script src="assets/dist/js/init.js"></script>
	</body>
</html>