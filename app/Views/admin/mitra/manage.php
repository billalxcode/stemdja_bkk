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
                                    <th>Nama Mitra</th>
                                    <th>Alamat</th>
                                    <th>Website</th>
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
                <form action="<?= base_url('admin/mitra/save') ?>" method="post" id="triggerForm">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="name">Nama Mitra</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nama Mitra" autofocus>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="address">Alamat Mitra</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Alamat Mitra">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="site">Website</label>
                            <input type="text" name="site" id="site" class="form-control" placeholder="Website Mitra">
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

<script>
    $("form").keypress(function (e) {
        let key = e.which
        if (key == 13) {
            $("#sendForm").trigger("click")
        }
    })

    $(document).on("click", "#sendForm", function (e) {
        $("#triggerForm").submit()
    })

    $(document).ready(function () {
        $("#table").DataTable({
            responsive: true,
            ajax: {
                url: BASE_URL + '/api/mitra/getall',
                method: 'POST'
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'address',
                    render: function (data) {
                        if (data === null) {
                            return "Data kosong"
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'site',
                    render: function (data) {
                        if (data === null) {
                            return "Data kosong"
                        } else {
                            return data
                        }
                    }
                },
                {
                    data: 'id',
                    render: function (data) {
                        let button_delete = document.createElement("a")
                        button_delete.className = 'btn btn-danger btn-sm'
                        button_delete.href = BASE_URL + '/admin/mitra/delete?id=' + data
                        button_delete.innerHTML = '<i class="fa fa-trash"></i>'

                        return button_delete.outerHTML
                    }
                }
            ]
        })
    })
</script>
<?= $this->endSection(); ?>