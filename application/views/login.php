<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>K3 PT. Petro Jordan Abadi</title>
	<meta content="" name="descriptison">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url() ?>flexor/assets/img/K3_kecil.png" rel="icon">
	<link href="<?= base_url() ?>flexor/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>flexor/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>flexor/assets/vendor/icofont/icofont.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>flexor/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>flexor/assets/vendor/venobox/venobox.css" rel="stylesheet">
	<link href="<?= base_url() ?>flexor/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>flexor/assets/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url() ?>assets/dist/dist/sweetalert2.all.min.js">

	<!-- Template Main CSS File -->
	<link href="<?= base_url() ?>flexor/assets/css/style.css" rel="stylesheet">

	<!-- =======================================================
  * Template Name: Flexor - v2.2.0
  * Template URL: https://bootstrapmade.com/flexor-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-none d-lg-block">
		<div class="container d-flex">
			<div class="contact-info mr-auto">
				<ul>
					<li><i class="icofont-envelope"></i><a href="mailto:contact@example.com">admin@pja-gresik.com</a></li>
					<li><i class="icofont-phone"></i>+62 31 399 1887</li>
					<li><i class="icofont-clock-time icofont-flip-horizontal"></i> Mon-Fri 7am - 4pm</li>
				</ul>

			</div>
			<div class="cta">
				<a href="#about" class="scrollto">Get Started</a>
			</div>
		</div>
	</section>

	<!-- ======= Header ======= -->
	<header id="header">
		<div class="container d-flex">

			<div class="logo mr-auto">
				<h1 class="text-light"><a href="<?= base_url() ?>"><span>SHE - PJA</span></a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
			</div>

			<nav class="nav-menu d-none d-lg-block">
				<ul>
					<li><a href="<?= base_url() ?>">Home</a></li>
					<li><a href="#about">Profile</a></li>
					<li><a href="#services">Berita</a></li>
					<li><a href="#contact">Kontak</a></li>
					<li class="active"><a href="<?= site_url('auth/login'); ?>">Login</a></li>

				</ul>
			</nav><!-- .nav-menu -->

		</div>
	</header><!-- End Header -->

	<section id="testimonials" class="testimonials1">
		<div class="container" data-aos="fade-up">
			<div class="row justify-content-center">
				<div class="testimonial-item">
					<div class="info-box">
						<p>Sign in to start your session</p>
						<form action="<?= site_url('auth/process') ?>" method="post">
							<div class="form-group has-feedback">
								<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
								<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
							</div>
							<div class="form-group has-feedback">
								<input type="password" name="password" class="form-control" placeholder="Password" required>
								<span class="glyphicon glyphicon-lock form-control-feedback"></span>
							</div>
							<button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Vendor JS Files -->
	<script src="<?= base_url() ?>flexor/assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/php-email-form/validate.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/jquery-sticky/jquery.sticky.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/venobox/venobox.min.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?= base_url() ?>flexor/assets/vendor/aos/aos.js"></script>
	<script src="<?= base_url() ?>assets/dist/dist/sweetalert2.all.min.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url() ?>flexor/assets/js/main.js"></script>
</body>

</html>
