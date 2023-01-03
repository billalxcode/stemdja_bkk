<?= $this->extend("layout/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
        </div>
        <div class="col-lg-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Semua Aksi</h4>
                </div>
                <div class="card-body">
                    <button class="btn btn-primary" id="btn-edit"><i class="fa fa-edit"></i> Edit Data</button>
                </div>
            </div>
        </div>
        <form action="<?= base_url('admin/school/save') ?>" method="post" id="triggerForm">
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Sekolah</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="nama_sekolah">Nama Sekolah</label>
                                <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" placeholder="Nama Sekolah" value="<?= (isset($data['nama_sekolah']) == true ? $data['nama_sekolah'] : '') ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label for="alamat">Alamat Lengkap </label>
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="alamat" value="<?= (isset($data['alamat']) == true ? $data['alamat'] : '') ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="skoperasional">SK Izin Operasional</label>
                                <input type="text" name="skoperasional" id="skoperasional" class="form-control" placeholder="SK Operasional" value="<?= (isset($data['skoperasional']) == true ? $data['skoperasional'] : '') ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label for="tgl_skoperasional">Tanggal Izin Operasional</label>
                                <input type="date" name="tgl_skoperasional" id="tgl_skoperasional" class="form-control" placeholder="Tanggal Izin Operasional" value="<?= (isset($data['tgl_skoperasional']) == true ? $data['tgl_skoperasional'] : '') ?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="nama_kepsek">Nama Kepala Sekolah</label>
                                <input type="text" name="nama_kepsek" id="nama_kepsek" class="form-control" placeholder="Nama Kepala Sekolah" value="<?= (isset($data['nama_kepsek']) == true ? $data['nama_kepsek'] : '') ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label for="nama_operator">Nama Operator</label>
                                <input type="text" name="nama_operator" id="nama_operator" class="form-control" placeholder="Nama Kepala Sekolah" value="<?= (isset($data['operator']) == true ? $data['operator'] : '') ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Visi</h4>
                    </div>
                    <div class="card-body">
                            <textarea name="visi" id="visi"><?= (isset($data['visi']) == true ? $data['visi'] : '') ?></textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Misi</h4>
                    </div>
                    <div class="card-body">
                            <textarea name="misi" id="misi"><?= (isset($data['misi']) == true ? $data['misi'] : '') ?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pendahuluan</h4>
                    </div>
                    <div class="card-body">
                            <p>Teks berikut akan tampil di halaman utama website</p>
                            <textarea name="pendahuluan" id="pendahuluan"><?= (isset($data['pendahuluan']) == true ? $data['pendahuluan'] : '') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary" id="save" disabled><i class="fa fa-save"></i> Simpan</button>
                    </div>
                </div>
            </div>
        </form>
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
    ClassicEditor.create(document.querySelector('#visi')).catch(error => {
        console.log(error)
    })
    

    ClassicEditor.create(document.querySelector('#misi')).catch(error => {
        console.log(error)
    })

    ClassicEditor.create(document.querySelector('#pendahuluan')).catch(error => {
        console.log(error)
    })

    $(document).on("change", "#status", function() {
        let val = $(this).val()
        if (val == "belum_bekerja") {
            $("#tempat_kerja").attr("readonly", true)
        } else {
            $("#tempat_kerja").attr("readonly", false)
        }
    })

    $(document).on("click", "#save", function() {
        $("#triggerForm").submit()
    })

    $(document).on('click', '#btn-edit', function() {
        let form = $('form')
        let inputs = form.find("input")
        let textarea = form.find("textarea")
        for (i = 0; i < inputs.length; i++) {
            inputs[i].removeAttribute('readonly')
        }
        for (i = 0; i < textarea.length; i++) {
            inputs[i].removeAttribute('readonly')
        }

        $("#save").removeAttr("disabled")
    })
</script>
<?= $this->endSection(); ?>