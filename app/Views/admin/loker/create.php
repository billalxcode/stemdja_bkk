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
                            <div class="col-12">
                                <label for="title">Judul Loker</label>
                                <input type="text" name="title" id="title" class="form-control" placeholder="Judul Loker" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="corporate_name">Nama Perusahaan</label>
                                <input type="text" name="corporate_name" id="corporate_name" class="form-control" placeholder="Nama Perusahaan">
                            </div>
                            <div class="col-6">
                                <label for="corporate_contact">Kontak Perusahaan</label>
                                <input type="text" name="corporate_contact" id="corporate_contact" class="form-control" placeholder="Kontak Perusahaan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="pendidikan">Pendidikan</label>
                                <select name="pendidikan" id="pendidikan" class="form-control">
                                    <option value="Semua Pendidikan" selected>Semua Pendidikan</option>
                                    <option value="SMA / SMK / STM / MA">SMA / SMK / STM</option>
                                    <option value="Diploma S1/S2/S3">Diploma D1/D2/D3</option>
                                    <option value="Sarjana S1">Sarjana S1</option>
                                    <option value="Master S2">Master S2</option>
                                    <option value="Doctor S3">Doctor S3</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="tipe_pekerjaan">Tipe Pekerjaan</label>
                                <select name="tipe_pekerjaan" id="tipe_pekerjaan" class="form-control">
                                    <option value="tetap" selected>Tetap</option>
                                    <option value="magang">Magang</option>
                                    <option value="freelance">Freelance</option>
                                    <option value="fulltime">Full Time</option>
                                    <option value="contract">Kontrak</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-select" aria-placeholder="Pilih Provinsi">
                                    
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="kota">Kota</label>
                                <select name="kota" id="kota" class="form-select"></select>
                            </div>
                            <div class="col-4">
                                <label for="expired_date">Tanggal Akhir</label>
                                <input type="date" name="expired_date" id="expired_date" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <textarea name="deskripsi" id="deskripsi"></textarea>
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
<link rel="stylesheet" href="<?= base_url('assets/vendor/libs/select2/sl/select2.css') ?>">
<style>
    .ck-content {
        height: 140px;
    }
    
</style>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url('/assets/vendor/libs/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= base_url('assets/vendor/libs/select2/sl/select2.js') ?>"></script>
<!-- #696cff -->
<script>
    ClassicEditor.create(document.querySelector('#deskripsi')).catch(error => {
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

    $(document).on("change", "#provinsi", function () {
        let province_code = $(this).val()
        $("#kota").select2({
            placeholder: "Pilih Kota",
            ajax: {
                url: BASE_URL + '/api/wilayah/get-cities?code=' + province_code,
                method: "POST",
                data: function (params) {
                    return {
                        query: params.term
                    }
                },
                processResults: function (data) {
                    console.log(data)
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name,
                                id: item.code
                            }
                        })
                    }
                }
            }
        })
    })

    $(document).ready(function () {
        $('#provinsi').select2({
            placeholder: "Pilih Provinsi",
            ajax: {
                url: BASE_URL + '/api/wilayah/get-provinsi',
                method: 'POST',
                data: function (params) {
                    return {
                        query: params.term
                    }
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.data, function (item) {
                            return {
                                text: item.name,
                                id: item.code
                            }
                        })
                    }
                }
            }
        })
        $("#kota").select2({
            placeholder: "Pilih Kota"
        })
    })
</script>
<?= $this->endSection(); ?>