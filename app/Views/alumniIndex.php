<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Cari Alumni</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url('theme/regna') ?>/img/favicon.png" rel="icon">
	<link href="<?= base_url('theme/regna') ?>/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?= base_url('theme/regna') ?>/vendor/aos/aos.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
	<link href="<?= base_url('theme/regna') ?>/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('theme/regna/vendor/DataTables/datatables.min.css') ?>">

	<!-- Template Main CSS File -->
	<link href="<?= base_url('theme/regna') ?>/css/style.css" rel="stylesheet">
</head>

<body>
	<?= $this->include('layout/partials/header'); ?>
	<main id="main">
		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">
					<h2>Cari Alumni</h2>
					<ol>
						<li><a href="<?= base_url() ?>">Home</a></li>
						<li><a href="<?= base_url('cari') ?>">Cari</a></li>
						<li>Alumni</li>
					</ol>
				</div>

			</div>
		</section><!-- Breadcrumbs Section -->

		<!-- ======= Portfolio Details Section ======= -->
		<section id="portfolio-details" class="portfolio-details" style="height: 100vh;">
			<div class="container">
				<div class="table-responsive">
					<table id="table" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>Nama Lengkap</th>
								<th>Jurusan</th>
								<th>Tahun Lulus</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</section><!-- End Portfolio Details Section -->

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
	<script src="<?= base_url('theme/regna/vendor/jquery/jquery.js') ?>"></script>
	<script src="<?= base_url('theme/regna/vendor/DataTables/datatables.min.js') ?>"></script>
	<!-- Template Main JS File -->
	<script src="<?= base_url('theme/regna') ?>/js/main.js"></script>
	<script>
		BASE_URL = '<?= base_url() ?>'
		$(document).ready(function() {
			$("#table").DataTable({
				responsive: true,
				ajax: {
					url: BASE_URL + '/api/alumni/getall',
					method: 'post',
					dataSrc: 'data'
				},
				columns: [
					{
						'data': 'name'
					},
					{
						'data': 'jurusan.name',
						'render': function (data, type, row) {
							if (data == "" || data == null) {
								return 'Data tidak diketahui'
							} else {
								return data
							}
						}
					},
					{
						'data': 'tahun_lulus'
					}
				]
			})
		})
	</script>

</body>

</html>