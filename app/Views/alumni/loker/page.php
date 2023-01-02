<?= $this->extend("layout/alumni/app"); ?>
<?php

use CodeIgniter\I18n\Time;
?>
<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form action="<?= current_url(false) ?>" method="get">
                            <div class="col-12">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Cari Loker" name="s" aria-label="Cari Loker" aria-describedby="addon-wrapping" value="<?= (isset($search) ? $search : '') ?>">
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>
        <h5 class="order-2">List Loker:</h5>
        <div class="col-lg-12 mb-4 order-3">
            <?php if (count($lokerData) == 0): ?>
                <div class="alert alert-danger">
                    Mohon maaf saat ini loker <?= (isset($search) ? "<span class='fw-bold'>'" . $search . "'</span>" : '') ?> tidak tersedia
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($lokerData as $loker): ?>
                        <div class="col-lg-6 col-12 col-sm-12 col-md-4 my-2">
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
                                                    <span class="fw-bold">Perusahaan</span>: <?= $loker['corporate_name'] ?>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-4">
                                            <!-- <div id="qrcode" data-text="Test saja sihh" onload="generate_qrcode()"></div> -->
                                            <img src="<?= $loker['loker_qr_uri'] ?>" alt="Loker" style="width:120px;height:148px;">
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
                                    <!-- <a href="https://wa.me/<?= $loker['corporate_contact'] ?>" class="btn btn-danger btn-sm float-end mx-1">
                                        Lamar
                                    </a> -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<!-- <script src="<?= base_url('assets/vendor/libs/qrcode/qrcode.min.js') ?>"></script>
<script>
    
</script> -->
<?= $this->endSection(); ?>