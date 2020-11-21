<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Daftar penduduk</li>
    </ol>
    <?php if(!empty($_SESSION['flash'])) : ?>
    <input type="hidden" name="flash" value="<?= $_SESSION['flash'] ?>">
    <?php endif; ?>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Catatan data penduduk
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-add-rules" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No KK</th>
                            <th>Keluarga</th>
                            <th>Pekerjaan</th>
                            <th>Jumlah keluarga</th>
                            <th>Jumlah anak</th>
                            <th>RT</th>
                            <th>RW</th>
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