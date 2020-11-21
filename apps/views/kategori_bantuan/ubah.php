
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active">Ubah data bantuan </li>
    </ol>
    <form action="<?= BASE_URL; ?>Kategoribantuan/storeUpdated" method="post">
<div class="card">
  <div class="card-header">
    Ubah data bantuan
  </div>
  <div class="card-body">
        <input type="hidden" name="id_kategori_bantuan" value="<?= $data['kategori']['id_kategori_bantuan'] ?>">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="name">Nama bantuan</label>
                <input type="text" value="<?= $data['kategori']['name'] ?>" class="form-control" id="name" name="name" autocomplete="off" placeholder="Masukan nama bantuan" required>
                <p class="text-danger font-italic"> <?= $this->helper->form_error("name") ?> </p>
            </div>
            <div class="form-group col-sm-6">
                <label for="description">Deskripsi bantuan</label>
                <textarea class="form-control" name="description" id="description" rows="3"><?= $data['kategori']['description'] ?></textarea>
            </div>
        </div>
    
  </div>
  <div class="card-footer">
    <div class="row">
        <div class="col-sm-6"><a href="<?= BASE_URL ?>Kategoribantuan" class="btn btn-sm btn-danger">Batal</a></div>
        <div class="col-sm-6 text-right"><button type="submit" class="btn btn-sm btn-primary">Simpan</button></div>
    </div>
  </div>
</div>
</form>
</div>

