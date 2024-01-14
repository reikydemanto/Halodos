<?= $this->include('include/header') ?>
<?= $this->include('include/sidebar') ?>
<?= $this->include('include/navbar') ?>

<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800"><?= $title ?></h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="#" class="btn btn-primary btn-icon-split" onclick="return modalForm('Tambah Master Topic', '<?= base_url('topic/form/master') ?>')">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </a>
            <a href="#" class="btn btn-primary btn-icon-split" onclick="return modalForm('Tambah Detail Topic', '<?= base_url('topic/form/detail') ?>')">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Sub Topic</span>
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Topik</th>
                            <th>Master Topik</th>
                            <th>Prodi</th>
                            <th>Images</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('include/footer') ?>