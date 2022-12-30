<?= $this->extend("layout/alumni/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 mb-4 order-1">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="input-group flex-nowrap">
                                <span class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></span>
                                <input type="text" class="form-control" placeholder="Cari Loker" aria-label="Cari Loker" aria-describedby="addon-wrapping">
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        <h5 class="order-2">List Loker:</h5>
        <div class="col-lg-12 mb-4 order-3">
            <div class="row">
                <?php foreach ($lokerData as $loker): ?>
                    <div class="col-lg-6 col-12 col-sm-12 col-md-6 my-2">
                        <div class="card">
                            <div class="card-header">
                                <a href="<?= base_url('alumni/loker/' . $loker['id']) ?>" class="card-title">
                                    <?= $loker['title'] ?>
                                </a>
                            </div>
                            <div class="card-body">
                                <?= $loker['kualifikasi'] ?>
                                
                            </div>
                            <div class="card-footer">
                                <div class="float-start">
                                    <b><?= $loker['corporate_name'] ?></b>
                                </div>
                                <a href="<?= base_url('https://wa.me/' . $loker['corporate_contact']) ?>" class="btn btn-danger btn-sm float-end">
                                    Lamar
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script src="<?= base_url() ?>/assets/js/dashboards-analytics.js"></script>
<?= $this->endSection(); ?>