
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active">Tambah catatan bantuan </li>
    </ol>
    <form action="<?= BASE_URL; ?>catatanbantuan/storeCreated" method="post">
<div class="card">
  <div class="card-header">
    Tambah catatan bantuan
  </div>
  <div class="card-body">
    
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="jenis">jenis bantuan</label>
                <select class="form-control" id="jenis" name="kategori">
                    <?php foreach($data['kategori'] as $value) : ?>
                        <option value="<?= $value['id_kategori_bantuan'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                
            </div>
            <div class="form-group  col-sm-6">
                <label for="periode">Periode</label>
                <input type="date" class="form-control" required autocomplete="off" name="periode">
                <p class="text-danger font-italic"> <?= $this->helper->form_error("periode") ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="description">Deskripsi bantuan</label>
                <textarea class="form-control" name="description" id="description" rows="3"><?= $this->helper->set_value('description') ?></textarea>
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

