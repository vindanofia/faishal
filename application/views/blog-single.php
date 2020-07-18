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
				<h1 class="text-light"><a href="<?= base_url() ?>"><span>EFIMA</span></a></h1>
				<!-- Uncomment below if you prefer to use an image logo -->
				<!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
			</div>

			<nav class="nav-menu d-none d-lg-block">
				<ul>
					<li class="active"><a href="<?= base_url() ?>">Home</a></li>
					<li><a href="#about">Profile</a></li>
					<li><a href="#services">Berita</a></li>
					<li><a href="#contact">Kontak</a></li>
					<li><a href="<?= site_url('auth/login'); ?>">Login</a></li>

				</ul>
			</nav><!-- .nav-menu -->

		</div>
	</header><!-- End Header -->

	<main id="main">

		<!-- ======= Breadcrumbs ======= -->
		<section id="breadcrumbs" class="breadcrumbs">
			<div class="container">
				<ol>
					<li><a href="<?= base_url() ?>">Home</a></li>
					<li><a href="<?= base_url() ?>">Konten</a></li>
				</ol>
			</div>
		</section><!-- End Breadcrumbs -->

		<!-- ======= Blog Section ======= -->
		<section id="blog" class="blog">
			<div class="container">

				<div class="row">

					<div class="col-lg-12 entries">

						<article class="entry entry-single">

							<div class="entry-img">
								<img src="<?= base_url('uploads/konten/' . $row['foto']) ?>" alt="" class="img-fluid">
							</div>

							<h2 class="entry-title">
								<a href="blog-single.html"><?php echo $row['judul_konten'] ?></a>
							</h2>

							<div class="entry-meta">
								<ul>
									<li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href="blog-single.html"><time datetime="2020-01-01"><?php echo $row['created'] ?></time></a></li>
								</ul>
							</div>

							<div class="entry-content">
								<?php echo nl2br($row['deskripsi_konten']) ?>
							</div>
						</article><!-- End blog entry -->
					</div>
				</div>
			</div>
		</section><!-- End Blog Section -->

	</main><!-- End #main -->

	<!-- ======= Footer ======= -->
	<footer id="footer">
		<div class="container d-lg-flex py-4">

			<div class="mr-lg-auto text-center text-lg-left">
				<div class="copyright">
					&copy; Copyright <strong><span>PT. Petro Jordan Abadi</span></strong>. All Rights Reserved
				</div>
			</div>
			<div class="social-links text-center text-lg-right pt-3 pt-lg-0">
				<a href="https://www.youtube.com/channel/UCH4LLNX5kF68ACSVO9Jt1VQ" class="youtube"><i class="bx bxl-youtube"></i></a>
				<a href="https://www.facebook.com/PT-Petro-Jordan-Abadi-182495098473089" class="facebook"><i class="bx bxl-facebook"></i></a>
				<a href="https://www.instagram.com/petrojordanabadi_official/" class="instagram"><i class="bx bxl-instagram"></i></a>
			</div>
		</div>
	</footer><!-- End Footer -->

	<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

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

	<!-- Template Main JS File -->
	<script src="<?= base_url() ?>flexor/assets/js/main.js"></script>

</body>

</html>
