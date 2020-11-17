<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Daftar pekerjaan</li>
    </ol>
    <?php if(!empty($_SESSION['flash'])) : ?>
    <input type="hidden" name="flash" value="<?= $_SESSION['flash'] ?>">
    <?php endif; ?>
    <div class="row mb-4">
        <div class="col-sm-6">
            <?php if(!empty($_SESSION['userdata'])) : ?>
            <a href="<?= BASE_URL; ?>pekerjaan/created" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> tambah pekerjaan</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Daftar pekerjaan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-pekerjaan" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pekerjaan</th>
                            <th>Description</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>