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
                    <a href="<?= base_url('admin/loker/create') ?>" class="btn btn-primary mx-1"><i class="fa fa-plus"></i> Tambah Data</a>
                    <a href="<?= base_url('admin/loker/store') ?>" class="btn btn-primary mx-1"><i class="fa fa-file"></i> Store</a>
                </div>
            </div>
        </div>
        <div class="col-lg-12 my-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Loker</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap" id="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Judul Loker</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Kontak Perusahaan</th>
                                    <th>Tanggal Akhir</th>
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
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.css">
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#table').DataTable({
            ajax: {
                url: BASE_URL + '/admin/loker/getall',
                method: 'post',
                dataSrc: 'data'
            },
            columns: [
                {
                    'data': 'title'
                },
                {
                    'data': 'corporate_name'
                },
                {
                    'data': 'corporate_contact'
                },
                {
                    'data': 'expired_date'
                },
                {
                    'data': 'id',
                    'render': function (data, type, row) {
                        return data
                    }   
                }
            ]
        })
    })
</script>
<?= $this->endSection(); ?>