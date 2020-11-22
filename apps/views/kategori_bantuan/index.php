<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Kategori bantuan</li>
    </ol>
    <?php if(!empty($_SESSION['flash'])) : ?>
    <input type="hidden" name="flash" value="<?= $_SESSION['flash'] ?>">
    <?php endif; ?>
    <?php if(!empty($_SESSION['userdata'])) : ?>
    <div class="row mb-4">
        <div class="col-sm-6">
            <a href="<?= BASE_URL ?>Kategoribantuan/tambah" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> tambah kategori</a>
        </div>
    </div>
    <?php endif; ?>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Kategori bantuan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-kategori" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>nama bantuan</th>
                            <th>Descripsi</th>
                            <th>Dibuat oleh</th>
                            <th>Dibuat Tgl</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>