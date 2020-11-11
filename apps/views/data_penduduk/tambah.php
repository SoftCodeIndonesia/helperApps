<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active">Tambah data penduduk </li>
    </ol>
    <form action="<?= BASE_URL; ?>datapenduduk/storeCreated" method="post">
<div class="card">
  <div class="card-header">
    Tambah data penduduk
  </div>
  <div class="card-body">
    
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="nokk">Nomor Kartu Keluarga</label>
                <input type="number" class="form-control" maxlength="16" id="nokk" name="nokk" max autocomplete="off" placeholder="Masukan nomor kartu keluarga" required>
            </div>
            <div class="form-group  col-sm-6">
                <label for="kepala_keluarga">Kepala Keluarga</label>
                <input type="text" class="form-control" id="kepala_keluarga" name="kepala_keluarga" autocomplete="off" placeholder="Masukan nama kepala keluarga" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="jml_kel">Jumlah keluarga</label>
                <input type="number" class="form-control" maxlength="2" id="jml_kel" name="jml_kel" max autocomplete="off" placeholder="Masukan jumlah anggota keluarga" required>
            </div>
            <div class="form-group  col-sm-6">
                <label for="jumlah_anak">Jumlah anak</label>
                <input type="number" class="form-control" id="jumlah_anak" maxlength="2" name="jumlah_anak" autocomplete="off" placeholder="Masukan jumlah anak" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="rt">RT</label>
                <input type="number" class="form-control" maxlength="5" id="rt" name="rt" max autocomplete="off" placeholder="Masukan nomor RT" required>
            </div>
            <div class="form-group  col-sm-6">
                <label for="rw">RW</label>
                <input type="number" class="form-control" id="rw" maxlength="5" name="rw" autocomplete="off" placeholder="Masukan nomor RW" required>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="rt">Pekerjaan</label>
                <input type="text" class="form-control" maxlength="5" id="rt" name="rt" max autocomplete="off" placeholder="Masukan nomor RT" required>
            </div>
            <div class="form-group col-sm-6">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" maxlength="5" name="alamat" autocomplete="off" placeholder="Masukan alamat" required>
            </div>
        </div>
    
  </div>
  <div class="card-footer">
    <div class="row">
        <div class="col-sm-6"><button type="submit" class="btn btn-sm btn-danger">Batal</button></div>
        <div class="col-sm-6 text-right"><button type="submit" class="btn btn-sm btn-primary">Simpan</button></div>
    </div>
  </div>
</div>
</form>
</div>
