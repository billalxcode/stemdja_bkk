<div class="modal fade" id="demoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title badge bg-danger" id="">Demo Warning!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hi! Selamat datang di Bursa Kerja Khusus SMKN 1 Maja. Kamu sedang mengakses halaman demo dengan versi BETA, saat ini aplikasi sedang dalam tahap pengembangan. Tunggu versi stabil nya ya <i class="fa fa-smile"></i>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Saya tahu!</button>
            </div>
        </div>
    </div>
</div>

<?= $this->section('scriptDemo'); ?>
<script>
    $(window).on('load', function () {
        $("#demoModal").modal("hide")
    })
</script>
<?= $this->endSection(); ?>