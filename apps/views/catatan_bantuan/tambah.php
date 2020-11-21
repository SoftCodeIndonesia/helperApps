
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
                <label for="exampleFormControlSelect1">jenis bantuan</label>
                <select class="form-control" id="exampleFormControlSelect1">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                </select>
            </div>
            <div class="form-group  col-sm-6">
                <label for="periode">Periode</label>
                <textarea class="form-control" name="periode" id="periode" rows="3"><?= $this->helper->set_value('description') ?></textarea>
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

