<?= $this->extend("layout/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
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
    $(document).on("click", "#sendForm", function () {
        $("#triggerForm").submit()
    })

    $(document).on("click", "#triggerTrash", function () {
        let data = $(this).data('id')
        let modalTrashData = $("#modalTrashData")
        let input = modalTrashData.find("input#data_id")
        input.val(data)
        modalTrashData.modal("show")
    })

    $(document).ready(function () {
        $("#table").DataTable({
            responsive: true,
            ajax: {
                url: BASE_URL + '/admin/alumni/getall',
                method: 'post',
                dataSrc: 'data'
            },
            columns: [
                {
                    'data': 'name'
                },
                {
                    'data': 'jurusan.name',
                    'render': function (data, type, row) {
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
                    'render': function (data, type, row) {
                        let button_group = document.createElement('div')
                        button_group.className = "btn-group"
                        
                        let button_delete = document.createElement('button')
                        button_delete.className = 'btn btn-danger btn-sm'
                        button_delete.innerHTML = '<i class="fa fa-trash"></i>'
                        button_delete.setAttribute('data-id', data)
                        button_delete.id = "triggerTrash"
                        button_group.appendChild(button_delete)
                        return button_group.outerHTML
                    }
                }
            ]
        })
    })
</script>
<?= $this->endSection(); ?>