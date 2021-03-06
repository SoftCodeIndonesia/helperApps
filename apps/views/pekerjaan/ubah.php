
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active">Ubah data pekerjaan </li>
    </ol>
    <form action="<?= BASE_URL; ?>pekerjaan/storeUpdated" method="post">
<div class="card">
  <div class="card-header">
    Ubah data pekerjaan
  </div>
  <div class="card-body">
        <input type="hidden" name="id_pekerjaan" value="<?= $data['pekerjaan']['id_pekerjaan'] ?>">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Nama pekerjaan</label>
                <input type="text" value="<?= $data['pekerjaan']['name'] ?>" class="form-control" id="name" name="name" autocomplete="off" placeholder="Masukan nama pekerjaaan" required>
                <p class="text-danger font-italic"> <?= $this->helper->form_error("name") ?> </p>
            </div>
            <div class="form-group  col-sm-6">
                <label for="description">Deskripsi pekerjaan</label>
                <textarea class="form-control" name="description" id="description" rows="3"><?= $data['pekerjaan']['description'] ?></textarea>
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

