
	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top d-flex align-items-center <?= isset($transparent) && $transparent == true ? 'header-transparent' : '' ?>">
		<div class="container d-flex justify-content-between align-items-center">

			<div id="logo">
				<a href="index.html"><img src="assets/img/logo.png" alt=""></a>
				<!-- Uncomment below if you prefer to use a text logo -->
				<!--<h1><a href="index.html">Regna</a></h1>-->
			</div>

			<nav id="navbar" class="navbar">
				<ul>
					<li><a class="nav-link scrollto active" href="<?= base_url() ?>">Home</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>/#about">Tentang</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>/#services">Layanan</a></li>
					<li><a class="nav-link scrollto " href="<?= base_url('loker') ?>">Pekerjaan</a></li>
					<li class="dropdown"><a href="#"><span>Alumni</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="<?= base_url('cari') ?>">Cari Alumni</a></li>
							<li><a href="<?= base_url('register') ?>">Daftar Alumni</a></li>
						</ul>
					</li>
					<li><a class="nav-link scrollto" href="<?= base_url('login') ?>">Login</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->
		</div>
	</header><!-- End Header -->
