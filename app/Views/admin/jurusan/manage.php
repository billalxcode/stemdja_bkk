<?= $this->extend("layout/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
        </div>
        <div class="col-lg-12 my-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Aksi Utama</h4>
                </div>
                <div class="card-body">
                    <div class="btn-group">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal"><i class="fa fa-plus"></i> Tambah Data</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 my-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Jurusan</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table nowrap" id="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Jurusan</th>
                                    <th>Singkatan</th>
                                    <th>Aksi</th>
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

<div class="modal fade" id="formModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/jurusan/save') ?>" method="post" id="triggerForm">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name">Nama Jurusan</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama jurusan" autofocus>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="short">Singkatan Jurusan</label>
                            <input type="text" name="short" id="short" class="form-control" placeholder="Nama jurusan" autofocus>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="sendForm">Save changes</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.css">
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.js"></script>
<script src="<?= base_url() ?>/assets/js/dashboards-analytics.js"></script>
<script src="<?= base_url() ?>/assets/js/alumni-manage.js"></script>
<?= $this->endSection(); ?>