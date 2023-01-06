<?= $this->extend("layout/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
        </div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-6 col-xl-3 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Bekerja</span>
                                <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2"><?= $rekapData_status['bekerja'] ?></h4>
                                </div>
                                <small>Siswa</small>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fa-solid fa-briefcase fa-2xl"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Belum Bekerja</span>
                                <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2"><?= $rekapData_status['belum_bekerja'] ?></h4>
                                </div>
                                <small>Siswa</small>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fa-solid fa-search fa-2xl"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Melanjutkan</span>
                                <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2"><?= $rekapData_status['kuliah'] ?></h4>
                                </div>
                                <small>Siswa</small>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fa-solid fa-graduation-cap fa-2xl"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                                <span>Berwirausaha</span>
                                <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2"><?= $rekapData_status['berwirausaha'] ?></h4>
                                </div>
                                <small>Siswa</small>
                            </div>
                            <span class="badge bg-label-primary rounded p-2">
                                <i class="fa-solid fa-graduation-cap fa-2xl"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="col-lg-12 my-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Informasi</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-12">
                            <span class="badge bg-warning">PERINGATAN : </span>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12">
                            <p> Jika siswa belum mengisi atau belum memperbaharui data jurusan dari profil siswa, maka rekapan nilai akan mengambil siswa yang sudah mengisi data jurusan nya.</p>
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
                                <?php foreach ($rekapData_jurusan as $rekapData): ?>
                                    <tr>
                                        <td><?= $rekapData['jurusan'] ?></td>
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