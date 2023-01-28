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
                                    <th>Tanggal Akhir</th>
                                    <th>Tipe</th>
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
                <form action="<?= base_url('admin/loker/trash') ?>" method="post" id="triggerForm">
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
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/assets/vendor/libs/DataTables/datatables.min.js"></script>
<script>
    $(document).on('click', '#sendForm', function () {
        $('#triggerForm').submit()
    })

    $(document).on('click', '#btn-delete', function () {
        let data = $(this).data('id')
        let modal = $('#modalTrashData')
        let input = modal.find('input[type="hidden"]#data_id')
        input.val(data)
        modal.modal('show')
    })

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
                    'data': 'mitra.name'
                },
                {
                    'data': 'expired_date'
                },
                {
                    'data': 'tipe_pekerjaan',
                    'render': function (data, type, row) {
                        let badge = document.createElement("span")
                        badge.className = 'badge bg-success text-white'
                        badge.innerText = data
                        return badge.outerHTML
                    }
                },
                {
                    'data': 'id',
                    'render': function (data, type, row) {
                        let button_group = document.createElement("div")
                        let button_delete = document.createElement("button")
                        button_delete.className = 'btn btn-danger btn-sm'
                        button_delete.id = 'btn-delete'
                        button_delete.setAttribute('data-id', data)
                        button_delete.innerHTML = '<i class="fa fa-trash"></i>'

                        button_group.appendChild(button_delete)

                        return button_group.outerHTML
                    }   
                }
            ]
        })
    })
</script>
<?= $this->endSection(); ?>