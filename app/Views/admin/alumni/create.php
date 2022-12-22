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
                    <h4 class="card-title">Tambah Data</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/alumni/save') ?>" method="post" id="triggerForm">
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" autofocus>
                            </div>
                            <div class="col-6">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="col-6">
                                <label for="password">Password</label>
                                <input type="text" name="password" id="password" class="form-control" placeholder="Password">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="jurusan">Jurusan</label>
                                <select name="jurusan" id="jurusan" class="form-select">
                                    <?php if (empty($jurusans)): ?>
                                        <option value="">Data masih kosong</option>
                                    <?php else: ?>
                                        <?php foreach ($jurusans as $jurusan): ?>
                                            <option value="<?= $jurusan['id'] ?>"><?= $jurusan['name'] ?> - <?= $jurusan['short'] ?></option>
                                        <?php endforeach ?>
                                    <?php endif ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="tahun_luluss">Tahun Lulus</label>
                                <select name="tahun_lulus" id="tahun_lulus" class="form-select">
                                    <?php for ($i = 2000; $i < date('Y'); $i++): ?>
                                        <?php if ($i == (date("Y") - 1)): ?>
                                            <option value="<?= $i ?>" selected><?= $i ?></option>
                                        <?php else: ?>
                                            <option value="<?= $i ?>"><?= $i ?></option>
                                        <?php endif ?>
                                    <?php endfor ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-select">
                                    <option value="belum_bekerja">Belum Bekerja</option>
                                    <option value="bekerja">Bekerja</option>
                                    <option value="kuliah" selected>Kuliah</option>
                                    <option value="berwirausaha">Berwirausaha</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="tempat_kerja">Tempat Kerja (Nama)</label>
                                <input type="text" name="tempat_kerja" id="tempat_kerja" class="form-control" placeholder="Tempat Kerja (sekakarang)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select">
                                    <option value="male">Laki-Laki</option>
                                    <option value="female">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat Lengkap">
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

    $(document).ready(function () {
        $("#table").DataTable()
    })
</script>
<?= $this->endSection(); ?>