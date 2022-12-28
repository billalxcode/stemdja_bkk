<?= $this->extend("layout/app"); ?>
<!-- Todo: CKEditor List Only -->
<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/loker/save') ?>" method="post" id="triggerForm">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="title">Judul Loker</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Judul Loker" autofocus>
                            </div>
                            <div class="col-6">
                                <label for="corporate_name">Nama Perusahaan</label>
                                <input type="text" name="corporate_name" id="corporate_name" class="form-control" placeholder="Nama Perusahaan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="corporate_contact">Kontak Perusahaan</label>
                                <input type="text" name="corporate_contact" id="corporate_contact" class="form-control" placeholder="Kontak Perusahaan">
                            </div>
                            <div class="col-6">
                                <label for="expired_date">Tanggal Akhir</label>
                                <input type="date" name="expired_date" id="expired_date" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <textarea name="kualifikasi" id="kualifikasi"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="save">
                        <i class="fa fa-file"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>
<style>
    .ck-content {
        height: 140px;
    }
</style>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('/assets/vendor/libs/ckeditor/ckeditor.js') ?>"></script>
<script>
    ClassicEditor.create(document.querySelector('#kualifikasi')).catch(error => {
        console.log(error)
    })

    $(document).on("change", "#status", function () {
        let val = $(this).val()
        if (val == "belum_bekerja") {
            $("#tempat_kerja").attr("readonly", true)
        } else {
            $("#tempat_kerja").attr("readonly", false)
        }
    })

    $(document).on("click", "#save", function () {
        $("#triggerForm").submit()
    })
</script>
<?= $this->endSection(); ?>