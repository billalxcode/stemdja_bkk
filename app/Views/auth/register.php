<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url() ?>/assets/" data-template="vertical-menu-template-free">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Bursa Kerja Khusus SMKN 1 Maja</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/favicon/favicon.ico" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

	<!-- Icons. Uncomment required icon fonts -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/fonts/boxicons.css" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?= base_url() ?>/assets/css/demo.css" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

	<!-- Page CSS -->
	<!-- Page -->
	<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/css/pages/page-auth.css" />
	<!-- Helpers -->
	<script src="<?= base_url() ?>/assets/vendor/js/helpers.js"></script>

	<script src="<?= base_url() ?>/assets/js/config.js"></script>
</head>

<body>
	<!-- Content -->

	<div class="container-xxl">
		<div class="authentication-wrapper authentication-basic container-p-y">
			<div class="authentication-inner">
				<!-- Register -->
				<div class="card">
					<div class="card-body">
						<!-- Logo -->
						<div class="app-brand justify-content-center">
							<a href="<?= base_url() ?>" class="app-brand-link gap-2">
								<span class="app-brand-text demo text-body fw-bolder text-uppercase">Bursa Kerja Khusus</span>
							</a>
						</div>
						<!-- /Logo -->

						<form id="formAuthentication" class="mb-3" action="<?= base_url('/save') ?>" method="POST">
							<?= csrf_field() ?>
							<div class="row">
								<div class="col-12">
									<?php if (session()->getFlashdata('error')): ?>
										<div class="alert alert-danger">
											<?= session()->getFlashdata('error') ?>
										</div>
									<?php endif ?>
								</div>
								<div class="col-12">
                                    <div class="mb-3">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" autofocus>
                                    </div>
									<div class="mb-3">
										<label for="email" class="form-label">Username</label>
										<input type="text" class="form-control" id="email" name="username" value="<?= old('username') ?>" placeholder="Enter your username" autofocus />
									</div>
                                    <div class="mb-3">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="jurusan">Jurusan</label>
                                        <select name="jurusan" id="jurusan" class="form-select">
                                            <?php if (empty($jurusans)): ?>
                                                <option value="">Data masih kosong</option>
                                            <?php else: ?>
                                                <?php foreach ($jurusans as $jurusan): ?>
                                                    <option value="<?= $jurusan['id'] ?>"><?= $jurusan['name'] ?> - <?= $jurusan['short'] ?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                            <option value="male">Laki-Laki</option>
                                            <option value="female">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tahun_luluss">Tahun Lulus</label>
                                        <select name="tahun_lulus" id="tahun_lulus" class="form-select">
                                            <?php for ($i = 2000; $i < date('Y'); $i++): ?>
                                                <?php if ($i == (date("Y") - 1)): ?>
                                                    <option value="<?= $i ?>" selected><?= $i ?></option>
                                                <?php else: ?>
                                                    <option value="<?= $i ?>"><?= $i ?></option>
                                                <?php endif ?>
                                            <?php endfor ?>
                                        </select>
                                    </div>
									<div class="mb-3 form-password-toggle">
										<div class="d-flex justify-content-between">
											<label class="form-label" for="password">Password</label>
										</div>
										<div class="input-group input-group-merge">
											<input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
											<span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
										</div>
									</div>
									<div class="mb-3">
										<button class="btn btn-primary d-grid w-100" type="submit">Sign up</button>
									</div>
								</div>
							</div>

						</form>

						<p class="text-center">
							<span>Copyright &copy; 2022 Billal Fauzan</span>
						</p>
					</div>
				</div>
				<!-- /Register -->
			</div>
		</div>
	</div>

	<!-- / Content -->
	<!-- Core JS -->
	<!-- build:js assets/vendor/js/core.js -->
	<script src="<?= base_url() ?>/assets/vendor/libs/jquery/jquery.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/libs/popper/popper.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/js/bootstrap.js"></script>
	<script src="<?= base_url() ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

	<script src="<?= base_url() ?>/assets/vendor/js/menu.js"></script>
	<!-- endbuild -->

	<!-- Vendors JS -->

	<!-- Main JS -->
	<script src="<?= base_url() ?>/assets/js/main.js"></script>

</body>

</html>