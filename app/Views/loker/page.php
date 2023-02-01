<?php

use CodeIgniter\I18n\Time;

?>
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
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/fontawesome/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="<?= base_url('theme/regna') ?>/css/style.css" rel="stylesheet">
</head>

<body>
    <?= $this->include('layout/partials/header'); ?>
    <main id="main">
        <!-- ======= Breadcrumbs Section ======= -->
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-end align-items-center">
                    <!-- <h2>Cari Lowongan Pekerjaan</h2> -->
                    <ol>
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><a href="<?= base_url('cari') ?>">Cari</a></li>
                        <li>Loker</li>
                    </ol>
                </div>

            </div>
        </section><!-- Breadcrumbs Section -->

        <!-- ======= Portfolio Details Section ======= -->
        <section id="portfolio-details" class="portfolio-details" style="height: 100vh;">
            <div class="container wow fadeInUp">
                <div class="section-header">
                    <h3 class="section-title">Cari Pekerajaan</h3>
                    <form action="<?= current_url(false) ?>" method="get" class="d-flex justify-content-center align-items-center">
                        <div class="col-8 col-sm-12 col-md-12">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Cari Loker" name="s" aria-label="Cari Loker" aria-describedby="addon-wrapping" value="<?= (isset($search) ? $search : '') ?>">
                                <span><button class="btn btn-primary">Cari</button></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-lg-12 mb-4 order-3">
                        <?php if (count($lokerData) == 0) : ?>
                            <div class="alert alert-danger">
                                Mohon maaf saat ini loker <?= (isset($search) ? "<span class='fw-bold'>'" . $search . "'</span>" : '') ?> tidak tersedia
                            </div>
                        <?php else : ?>
                            <div class="row">
                                <?php foreach ($lokerData as $loker) : ?>
                                    <div class="col-lg-6 col-12 col-sm-12 col-md-12 my-4">
                                        <div class="card">
                                            <div class="card-header">
                                                <a href="<?= $loker['loker_uri'] ?>" class="card-title  text-center">
                                                    <span class="fw-bold"><?= $loker['title'] ?></span>
                                                    <small class="float-end text-dark">
                                                        <?php
                                                        $humanize = new Time($loker['created_at']);
                                                        echo $humanize->humanize();
                                                        ?>
                                                    </small>
                                                </a>
                                            </div>
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-8">
                                                        <h5 class="fw-bold">Kualifikasi: </h5>
                                                        <ul>
                                                            <li>
                                                                <span class="fw-bold">Pendidikan</span>: <?= $loker['pendidikan'] ?>
                                                            </li>
                                                            <li>
                                                                <span class="fw-bold">Tipe Pekerjaan</span>: <?= ucfirst($loker['tipe_pekerjaan']) ?>
                                                            </li>
                                                            <li>
                                                                <span class="fw-bold">Lokasi</span>: Jakarta Barat, Jakarta
                                                            </li>
                                                            <li>
                                                                <span class="fw-bold">Perusahaan</span>: <?= $loker['mitra']['name'] ?>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-4">
                                                        <!-- <div id="qrcode" data-text="Test saja sihh" onload="generate_qrcode()"></div> -->
                                                        <img src="<?= $loker['loker_qr_uri'] ?>" alt="Loker" style="width:120px;height:128px;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="float-start">
                                                    Berakhir pada: <?= Time::parse($loker['expired_date'], 'Asia/Jakarta', 'id_ID')->format('d F Y') ?>
                                                </div>
                                                <a href="<?= base_url('/alumni/loker/' . $loker['id']) ?>" class="btn btn-secondary float-end mx-1">
                                                    Lihat
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </section><!-- End Portfolio Details Section -->

    </main><!-- End #main -->

    <?= $this->include('layout/partials/footer'); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('theme/regna/vendor/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/aos/aos.js"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= base_url('theme/regna') ?>/vendor/php-email-form/validate.js"></script>
</body>

</html>