<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Penerima bantuan</li>
    </ol>
    <form>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table mr-1"></i>
            Tambah Penerima bantuan
        </div>
        <div class="card-body">
           
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="jenis_bantuan">Jenis Bantuan</label>
                        <input type="hidden" class="form-control" id="id_bantuan" name="id_bantuan" placeholder="Pilih jenis bantuan" >
                        <input type="text" class="form-control input-modal" id="jenis_bantuan" name="bantuan" placeholder="Pilih jenis bantuan" data-modal="bantuan" readonly data-toggle="modal">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="periode">Periode</label>
                        <input type="text" class="form-control input-modal" id="periode" name="periode" placeholder="periode bantuan" data-modal="bantuan" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="no_kk">No KK</label>
                        <input type="hidden" class="form-control" id="id_keluarga" name="id_keluarga" placeholder="Pilih jenis bantuan">
                        <input type="text" class="form-control input-modal" id="no_kk" name="no_kk" placeholder="pilih No KK" data-modal="penduduk" readonly>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="keluarga">Keluarga</label>
                        <input type="text" class="form-control input-modal" name="keluarga" id="keluarga" placeholder="periode bantuan" data-modal="penduduk" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="status">Status penerima</label>
                        <select class="form-control" id="status" name="status">
                            <?php foreach($data['status_penerima'] as $status) : ?>
                                <option value="<?= $status ?>"><?= $status ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="tgl_terima">Tanggal Terima</label>
                        <input type="date" class="form-control" id="tgl_terima" placeholder="periode bantuan">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    <p class="font-weight-bold">Upload Bukti Terima</p>
                    </div>
                    <div class="col-sm-12">
                        <label for="bukti_terima">
                            <div class="row">
                                <div class="col-sm-12">
                                <div class="card col-sm-12">
                                <div class="card-body text-center">
                                    <div class="row justify-content-center">
                                        <div class="col-sm-6">
                                            <img src="<?= BASE_URL ?>assets/images/upload-icon.png" width="50%" alt="bukti terima" id="preview" >
                                        </div>
                                       
                                    </div>
                                    <div class="row justify-content-center">
                                    <div class="col-sm-6">
                                            <p>Upload File</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                        </label>
                       <input type="file" name="bukti_terima" style="display: none" id="bukti_terima">
                    </div>
                </div>
                
            
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-sm-6">
                    <a href="" class="btn btn-sm btn-danger">Batal</a>
                </div>
                <div class="col-sm-6 text-right">
                    <button class="btn btn-sm btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    </form>
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

<!-- Modal Penduduk-->
<div class="modal fade" id="penduduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pilih Keluarga penerima</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="table-penduduk" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No KK</th>
                            <th>Keluarga</th>
                            <th>Pekerjaan</th>
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
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>