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
                        <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="<?= (isset($data['name']) ? $data['name'] : '') ?>" readonly autofocus>
                            </div>
                            <div class="col-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="<?= (isset($data['email']) ? $data['email'] : '') ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username" value="<?= (isset($data['username']) ? $data['username'] : '') ?>" readonly>
                            </div>
                            <div class="col-6">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" placeholder="Password" readonly>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-select" disabled>
                                    <?php if (empty($jurusans)): ?>
                                        <option value="">Data masih kosong</option>
                                    <?php else: ?>
                                        <?php foreach ($jurusans as $jurusan): ?>
                                            <?php if (isset($data['details']['jurusan_id']) && $data['details']['jurusan_id'] == $jurusan['id']): ?>
                                                <option value="<?= $jurusan['id'] ?>" selected><?= $jurusan['name'] ?> - <?= $jurusan['short'] ?></option>
                                            <?php else: ?>
                                                <option value="<?= $jurusan['id'] ?>"><?= $jurusan['name'] ?> - <?= $jurusan['short'] ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="tahun_luluss">Tahun Lulus</label>
                                <select name="tahun_lulus" id="tahun_lulus" class="form-select" disabled>
                                    <?php for ($i = 2000; $i < date('Y'); $i++): ?>
                                        <?php if ($data['details'] == null && $i == (date('Y') - 1)): ?>
                                            <option value="<?= $i ?>" selected><?= $i ?></option>
                                        <?php else: ?>
                                            <option value="<?= $i ?>" <?= ($data['details']['tahun_lulus'] == $i ? 'selected' : '') ?> ><?= $i ?></option>
                                        <?php endif ?>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select" disabled>
                                    <option value="belum_bekerja" <?= (isset($data['details']['status']) && $data['details']['status'] == 'belum_bekerja' ? 'selected' : '') ?>>Belum Bekerja</option>
                                    <option value="bekerja" <?= (isset($data['details']['status']) && $data['details']['status'] == 'bekerja' ? 'selected' : '') ?>>Bekerja</option>
                                    <option value="kuliah" <?= (isset($data['details']['status']) && $data['details']['status'] == 'kuliah' ? 'selected' : '') ?>>Kuliah</option>
                                    <option value="berwirausaha" <?= (isset($data['details']['status']) && $data['details']['status'] == 'berwirausaha' ? 'selected' : '') ?>>Berwirausaha</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="tempat_kerja">Tempat Kerja (Nama)</label>
                                <input type="text" name="tempat_kerja" id="tempat_kerja" class="form-control" placeholder="Tempat Kerja (sekakarang)" value="<?= (isset($data['details']['tempat_kerja']) ? $data['details']['tempat_kerja'] : '') ?>" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" disabled>
                                    <option value="male" <?= (isset($data['details']['jenis_kelamin']) && $data['details']['jenis_kelamin'] == 'male' ? 'selected' : '') ?>>Laki-Laki</option>
                                    <option value="female" <?= (isset($data['details']['jenis_kelamin']) && $data['details']['jenis_kelamin'] == 'female' ? 'selected' : '') ?>>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap" value="<?= (isset($data['details']['alamat']) ? $data['details']['alamat'] : '') ?>" readonly>
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

        let selects = form.find("select")
        for (i = 0; i < selects.length; i++) {
            selects[i].removeAttribute("disabled")
        }
        $('#save').removeAttr("disabled")
    })
</script>
<?= $this->endSection(); ?>