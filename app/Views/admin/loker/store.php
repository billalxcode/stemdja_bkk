<?= $this->extend("layout/app"); ?>

<?= $this->section('content'); ?>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12">
            <?= $this->include("layout/partials/alert"); ?>
        </div>
        <div class="col-lg-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Import Loker</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/loker/store') ?>" method="post" id="triggerForm" enctype="multipart/form-data">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="files">Sumber File</label>
                                <input type="file" name="files" id="files" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label for="fileformat">Format File</label>
                                <select name="fileformat" id="fileformat" class="form-control">
                                    <option value="csv">CSV (*.csv)</option>
                                    <option value="xlsx">Excel 2007-372 (*.xlsx)</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="save">
                        <i class="fa fa-save"></i> Store
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Export Data Loker</h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/loker/download') ?>" method="post" id="triggerForm2" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="fileformat">Save as: </label>
                                <select name="fileformat" id="fileformat" class="form-control">
                                    <option value="csv">CSV (*.csv)</option>
                                    <option value="xlsx">Excel 2007-372 (*.xlsx)</option>
                                    <option value="ods">Open Document Spreadsheet (*.ods)</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" id="export">
                        <i class="fa fa-save"></i> Store
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
    $(document).on('click', "#export", function () {
        $("#triggerForm2").submit();
    })

    $(document).on("click", "#save", function () {
        $("#triggerForm").submit()
    })
</script>
<?= $this->endSection(); ?>