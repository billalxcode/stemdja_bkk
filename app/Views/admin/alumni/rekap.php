<?= $this->extend("layout/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="fa-solid fa-briefcase fa-2xl"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Bekerja</span>
                            <h3 class="card-title mb-2"><span class="fw-bold">15</span> Orang</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="fa fa-search fa-2xl">

                                    </i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Belum Bekerja</span>
                            <h3 class="card-title mb-2"><span class="fw-bold">5</span> Orang</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="fa-solid fa-graduation-cap fa-2xl"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Kuliah</span>
                            <h3 class="card-title mb-2"><span class="fw-bold">7</span> Orang</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 my-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Rekap Data berdasarkan tahun lulus</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap" id="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <th>Jumlah Siswa Bekerja</th>
                                    <th>Jumlah Siswa Melanjutkan</th>
                                    <th>Jumlah Siswa Belum Bekerja</th>
                                    <th>Jumlah Siswa Berwirausaha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rekapData_tahunlulus as $rekapData): ?>
                                    <tr>
                                        <td><?= $rekapData['tahun_lulus'] ?></td>
                                        <td><?= $rekapData['bekerja'] ?> Orang</td>
                                        <td><?= $rekapData['kuliah'] ?> Orang</td>
                                        <td><?= $rekapData['belum_bekerja'] ?> Orang</td>
                                        <td><?= $rekapData['berwirausaha'] ?> Orang</td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 my-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Rekap Data berdasarkan jurusan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap" id="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tahun Lulus</th>
                                    <th>Jumlah Siswa Bekerja</th>
                                    <th>Jumlah Siswa Melanjutkan</th>
                                    <th>Jumlah Siswa Belum Bekerja</th>
                                    <th>Jumlah Siswa Berwirausaha</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.css">
<style>
    .table>tbody>tr>td {
        text-transform: capitalize;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.js"></script>
<script>
    
</script>
<?= $this->endSection(); ?>