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
                    <h4 class="card-title">Semua Aksi</h4>
                </div>
                <div class="card-body">
                    <a class="btn btn-primary" href="<?= base_url('admin/alumni/rekap') ?>">
                        <i class="fa fa-list-alt"></i> Rekap
                    </a>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPrint" disabled>
                        <i class="fas fa-print"></i> Cetak
                    </button>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalReset">
                        <i class="fa fa-trash"></i> Reset
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Alumni</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table nowrap" id="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Nama Lengkap</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Lulus</th>
                                    <th>Alamat</th>
                                    <th>Status</th>
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

<div class="modal fade" id="modalTrashData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTrashDataLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus data ini secara permanen? Klik OK untuk mengkonfirmasi penghapusan.
                <form action="<?= base_url('admin/alumni/trash') ?>" method="post" id="triggerForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="data_id">
                    <div class="form-check mt-3">
                        <input type="checkbox" name="force" id="force" value="ya" class="form-check-input" checked>
                        <label class="form-check-label" for="force">
                            Paksa Penghapusan
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="sendForm">OK</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPrint" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPrintLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/alumni/print') ?>" method="post" id="triggerForm">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-12">
                            <label for="paper">Opsi: </label>
                            <select name="paper" id="paper" class="form-select">
                                <option value="A4">Kertas A4 (Default)</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="sendForm">Cetak PDF</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalReset" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalResetLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span class="badge bg-warning fw-bold text-white">PERINGATAN: </span> Aksi ini akan menghapus semua data yang ada di database kecuali primary user (admin). Mohon konfirmasi bahwa saya menghapus ini dengan sadar.
                <form action="<?= base_url('admin/alumni/reset') ?>" method="post" id="triggerFormReset">
                    <?= csrf_field() ?>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="sendFormReset"">Ya</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUpdateLabel">Update Data <span id="fullname" class="fw-bold"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/alumni/update') ?>" method="post" id="triggerForm">
                    <?= csrf_field() ?>
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="row">
                        <div class="col-12">
                            <label for="status">Satus: </label>
                            <select name="status" id="status" class="form-select">
                                <option value="belum_bekerja">Belum Bekerja</option>
                                <option value="bekerja">Bekerja</option>
                                <option value="kuliah" selected>Kuliah</option>
                                <option value="berwirausaha">Berwirausaha</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="jurusan">Jurusan</label>
                            <select name="jurusan" id="jurusan" class="form-select">
                                <?php if (empty($jurusans)) : ?>
                                    <option value="">Data masih kosong</option>
                                <?php else : ?>
                                    <?php foreach ($jurusans as $jurusan) : ?>
                                        <option value="<?= $jurusan['id'] ?>"><?= $jurusan['name'] ?> - <?= $jurusan['short'] ?></option>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="button" class="btn btn-primary" id="sendForm">Update</button>
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
    $(document).on("click", "#sendForm", function() {
        let body = $(this).parent().parent()
        let form = body.find('form#triggerForm')
        form.submit()
    })

    $(document).on("click", "#sendFormReset", function () {
        let body = $(this).parent().parent()
        let form = body.find("form#triggerFormReset")
        form.submit()
    })

    $(document).on("click", "#triggerTrash", function() {
        let data = $(this).data('id')
        let modalTrashData = $("#modalTrashData")
        let input = modalTrashData.find("input#data_id")
        input.val(data)
        modalTrashData.modal("show")
    })

    $(document).on("click", "#triggerEdit", function() {
        let data = $(this).data('id')
        $.ajax({
            url: BASE_URL + '/api/alumni/find',
            method: 'post',
            data: {
                'user_id': data
            },
            success: function(response) {
                if (response['status'] == true) {
                    let name            = response['data']['name']
                    let status_val      = response['data']['status']
                    let jurusan_id      = response['data']['jurusan_id']

                    let modalUpdateData = $("#modalUpdate")
                    let user_id         = $(modalUpdateData).find("form").find("input[type='hidden']#user_id")
                    let status          = $(modalUpdateData).find("form").find("select#status")
                    let jurusan         = $(modalUpdateData).find("form").find("select#jurusan")
                    user_id.val(data)
                    status.val(status_val)
                    jurusan.val(jurusan_id)
                    modalUpdateData.find(".modal-title").find("span#fullname").text(name)
                    modalUpdateData.modal("show")
                }
            }
        })
    })

    $(document).ready(function() {
        $("#table").DataTable({
            responsive: true,
            ajax: {
                url: BASE_URL + '/admin/alumni/getall',
                method: 'post',
                dataSrc: 'data'
            },
            columns: [{
                    'data': 'name'
                },
                {
                    'data': 'jurusan.name',
                    'render': function(data, type, row) {
                        if (data == "" || data == null) {
                            return 'Data tidak diketahui'
                        } else {
                            return data
                        }
                    }
                },
                {
                    'data': 'tahun_lulus'
                },
                {
                    'data': 'alamat'
                },
                {
                    'data': 'status'
                },
                {
                    'data': 'id',
                    'render': function(data, type, row) {

                        let button_group = document.createElement('span')

                        let button_delete = document.createElement('button')
                        button_delete.className = 'btn btn-danger btn-sm mx-1'
                        button_delete.innerHTML = '<i class="fa fa-trash"></i>'
                        button_delete.setAttribute('data-id', data)
                        button_delete.id = "triggerTrash"

                        let button_update = document.createElement("button")
                        button_update.className = 'btn btn-primary btn-sm mx-1'
                        button_update.innerHTML = '<i class="fa fa-edit"></i>'
                        button_update.setAttribute("data-id", data)
                        button_update.id = 'triggerEdit'

                        button_group.appendChild(button_delete)
                        button_group.appendChild(button_update)
                        return button_group.outerHTML
                    }
                }
            ]
        })
    })
</script>
<?= $this->endSection(); ?>