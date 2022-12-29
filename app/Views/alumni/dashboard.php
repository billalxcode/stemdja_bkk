<?= $this->extend("layout/alumni/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-8 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Welcome <?= ($userdata['name'] ? $userdata['name'] : 'User') ?>! 🎉</h5>
                            <p class="mb-4">
                                Selamat datang kembali di halaman panel dashboard <b>Bursa Kerja Khusus</b> SMKN 1 Maja, di panel dashboard ini kamu bisa mencari lowongan pekerjaan.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="<?= base_url('assets/img/illustrations/man-with-laptop-light.png') ?>" height="140" alt="View Badge User" data-app-dark-img="<?= base_url('illustrations/man-with-laptop-dark.png') ?>" data-app-light-img="<?= base_url('illustrations/man-with-laptop-light.png') ?>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-3">Lowongan</span>
                            <h3 class="card-title mb-2"><?= count($lokerdata) ?></h3>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                                </div>
                            </div>
                            <span></span>
                            <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <!-- <div class="col-lg-12 mb-4 order-2">
            <div class="card">
                <div class="card-body">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Cari Loker" aria-label="Cari Loker" aria-describedby="addon-wrapping">
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/assets/js/dashboards-analytics.js"></script>
<?= $this->endSection(); ?>