<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Catatan penerima bantuan</li>
    </ol>
    <?php if(!empty($_SESSION['flash'])) : ?>
    <input type="hidden" name="flash" value="<?= $_SESSION['flash'] ?>">
    <?php endif; ?>
    <form action="<?= BASE_URL ?>penerimabantuan/printPdf" method="post">
    <div class="row mb-4">
        <div class="col-sm-2">
            <a href="<?= BASE_URL ?>penerimabantuan/tambah" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> tambah penerima</a>
        </div>
         <div class="col-sm-2">
            <button type="submit" id="btn-print" class="btn btn-sm btn-success"><i class="fa fa-fw fa-print"></i> Cetak ke PDF</button>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="jenis_bantuan">Jenis Bantuan</label>
                        <input type="hidden" class="form-control" id="id_bantuan" name="id_bantuan" placeholder="Pilih jenis bantuan" >
                        <input type="text" class="form-control input-modal" id="jenis_bantuan" name="bantuan" placeholder="Pilih jenis bantuan" data-modal="bantuan" readonly data-toggle="modal" required>
                        <p class="text-danger font-italic" id="alert-jenis-bantuan"></p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="periode">Periode</label>
                        <input type="text" class="form-control input-modal" id="periode" name="periode" placeholder="periode bantuan" data-modal="bantuan" readonly>
                        <p class="text-danger font-italic" id="alert-periode"></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">RT</label>
                    <select class="form-control" name="rt" id="rt">
                        <option value=""><== pilih RT ==></option>
                        <?php foreach($data['rt'] as $value) : ?>
                        <option value="<?= $value['rt'] ?>"> <?= $value['rt'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">RW</label>
                    <select class="form-control" name="rw" id="rw">
                        <option value=""><== pilih RW ==></option>
                        <?php foreach($data['rw'] as $value) : ?>
                        <option value="<?= $value['rw'] ?>"> <?= $value['rw'] ?> </option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Catatan penerima bantuan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-penerima" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jenis bantuan</th>
                            <th>periode</th>
                            <th>No KK</th>
                            <th>Keluarga</th>
                            <th>pekerjaan</th>
                            <th>Status penerimaan</th>
                            <th>Tangggal terima</th>
                            <th>Bukti terima</th>
                            <th>Dibuat oleh</th>
                            <th>Dibuat pada</th>
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


<!-- Modal Bantuan -->
<div class="modal fade" id="bantuan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih jenis bantuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table class="table table-bordered" id="table-catatan" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis</th>
                        <th>periode</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                </tbody>
            </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>