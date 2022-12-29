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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Profile</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('alumni/profile/save') ?>" method="post" id="triggerForm">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?= (isset($data['name']) == true ? $data['name'] : '') ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label for="username">Username </label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?= (isset($data['username']) == true ? $data['username'] : '') ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= (isset($data['email']) == true ? $data['email'] : '') ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="save" disabled>
                        <i class="fa fa-file"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('css'); ?>

<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
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

    $(document).on('click', '#btn-edit', function () {
        let form = $('form')
        let inputs = form.find("input")
        for (i = 0; i < inputs.length; i++) {
            inputs[i].removeAttribute('readonly')
        }

        $('#save').removeAttr("disabled")
    })
</script>
<?= $this->endSection(); ?>