<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Bursa Kerja Khusus SMKN 1 Maja</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url('theme/regna') ?>/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="<?= base_url('theme/regna') ?>/css/style.css" rel="stylesheet">
</head>

<body>
	<?= $this->include('layout/partials/header'); ?>

	<!-- ======= Hero Section ======= -->
	<section id="hero" style="background: url('<?= base_url('theme/regna/img/banner.JPG') ?>') top center">
		<div class="hero-container" data-aos="zoom-in" data-aos-delay="100">
			<h1>Bursa Kerja Khusus SMKN 1 Maja</h1>
			<h2>Tempat terbaik untuk mencari lowongan pekerjaan bagi pelajar lulusan SMKN 1 Maja</h2>
			<a href="#about" class="btn-get-started">Cari Pekerjaan</a>
		</div>
	</section><!-- End Hero Section -->

	<main id="main">
		<!-- ======= About Section ======= -->
		<section id="about">
			<div class="container" data-aos="fade-up">
				<div class="row about-container">

					<div class="col-lg-6 content order-lg-1 order-2">
						<h2 class="title">Tentang SMKN 1 Maja</h2>
						<p>
							Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae accusantium debitis ipsa harum sequi error ratione quos eligendi voluptate delectus rem quae, et assumenda minus quaerat tenetur, placeat maxime nostrum!
						</p>

						<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
							<div class="icon"><i class="bi bi-map"></i></div>
							<h4 class="title"><a href="">Lokasi</a></h4>
							<p class="description"><a href="https://goo.gl/maps/nSwbZ4ZpG7j6eVJD9"></a> 4862+3J2, Maja Sel., Kec. Maja, Kabupaten Majalengka, Jawa Barat</p>
						</div>

						<div class="icon-box" data-aos="fade-up" data-aos-delay="200">
							<div class="icon"><i class="bi bi-envelope"></i></div>
							<h4 class="title"><a href="">Email</a></h4>
							<p class="description">smkn1maja@yahoo.co.id</p>
						</div>

						<div class="icon-box" data-aos="fade-up" data-aos-delay="300">
							<div class="icon"><i class="bi bi-globe"></i></div>
							<h4 class="title"><a href="">Website</a></h4>
							<p class="description">https://smkn1maja.sch.id</p>
						</div>

					</div>

					<div class="col-lg-6 order-lg-2 order-1" data-aos="fade-left">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/1vwf0beqPZ8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					</div>

					<!-- <div class="col-lg-6 background order-lg-2 order-1" data-aos="fade-left" data-aos-delay="100"></div> -->
				</div>

			</div>
		</section><!-- End About Section -->

		<!-- ======= Facts Section ======= -->
		<section id="facts">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title">Fakta</h3>
					<p class="section-description">Berikut informasi data yang ada di sekolah</p>
				</div>
				<div class="row counters">

					<div class="col-lg-3 col-6 text-center">
						<span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
						<p>Mitra</p>
					</div>

					<div class="col-lg-3 col-6 text-center">
						<span data-purecounter-start="0" data-purecounter-end="<?= $totalLoker ?>" data-purecounter-duration="1" class="purecounter"></span>
						<p>Loker</p>
					</div>

					<div class="col-lg-3 col-6 text-center">
						<span data-purecounter-start="0" data-purecounter-end="<?= $totalAlumni ?>" data-purecounter-duration="1" class="purecounter"></span>
						<p>Alumni Terdaftar</p>
					</div>

					<div class="col-lg-3 col-6 text-center">
						<span data-purecounter-start="0" data-purecounter-end="<?= $totalJurusan ?>" data-purecounter-duration="1" class="purecounter"></span>
						<p>Jurusan</p>
					</div>
				</div>

			</div>
		</section><!-- End Facts Section -->

		<!-- ======= Services Section ======= -->
		<section id="services">
			<div class="container" data-aos="fade-up">
				<div class="section-header">
					<h3 class="section-title">Layanan</h3>
					<p class="section-description">Berikut layanan yang kami berikan</p>
				</div>
				<div class="row">
					<div class="col-lg-4 col-md-6" data-aos="zoom-in">
						<div class="box">
							<div class="icon"><a href=""><i class="bi bi-briefcase"></i></a></div>
							<h4 class="title"><a href="">Penyedia</a></h4>
							<p class="description">Kami menyediakan pekerjaan untuk membantu siswa yang baru lulus dari sekolah atau perguruan tinggi dalam menemukan pekerjaan yang seduai dengan minat dan bakat</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6" data-aos="zoom-in">
						<div class="box">
							<div class="icon"><a href=""><i class="bi bi-card-checklist"></i></a></div>
							<h4 class="title"><a href="">Up to date</a></h4>
							<p class="description">Pekerjaan yang disediakan kepada pengguna selalu up-to-date dan akurat. Kami memastikan bahwa pengguna selalu dapat mengakses data yang akurat dan up-to-date</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-6" data-aos="zoom-in">
						<div class="box">
							<div class="icon"><a href=""><i class="bi bi-bar-chart"></i></a></div>
							<h4 class="title"><a href="">Peningkatan</a></h4>
							<p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</p>
						</div>
					</div>
				</div>

			</div>
		</section><!-- End Services Section -->

		<!-- ======= Contact Section ======= -->
		<section id="contact">
			<div class="container">
				<div class="section-header">
					<h3 class="section-title">PETA</h3>
					<p class="section-description">Katakan peta, katakan peta, peta.................</p>
				</div>
			</div>

			<!-- Uncomment below if you wan to use dynamic maps -->
			<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15844.024315570883!2d108.301505!3d-6.8898742!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x46c05262df72c867!2sSmkn%201%20maja!5e0!3m2!1sid!2sid!4v1674029834497!5m2!1sid!2sid" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</section><!-- End Contact Section -->

	</main><!-- End #main -->

	<?= $this->include('layout/partials/footer'); ?>

	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="<?= base_url('theme/regna') ?>/vendor/purecounter/purecounter_vanilla.js"></script>
	<script src="<?= base_url('theme/regna') ?>/vendor/aos/aos.js"></script>
	<script src="<?= base_url('theme/regna') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url('theme/regna') ?>/vendor/glightbox/js/glightbox.min.js"></script>
	<script src="<?= base_url('theme/regna') ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="<?= base_url('theme/regna') ?>/vendor/swiper/swiper-bundle.min.js"></script>
	<script src="<?= base_url('theme/regna') ?>/vendor/php-email-form/validate.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url('theme/regna') ?>/js/main.js"></script>

</body>

</html>