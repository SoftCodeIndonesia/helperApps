
<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
    <li class="breadcrumb-item active">Ubah catatan bantuan </li>
    </ol>
    <form action="<?= BASE_URL; ?>catatanbantuan/storeUpdate" method="post">
<div class="card">
  <div class="card-header">
    Ubah catatan bantuan
  </div>
  <div class="card-body">
        <input type="hidden" name="id_bantuan" value="<?= $data['catatan']['id_bantuan'] ?>">
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="jenis">jenis bantuan</label>
                <select class="form-control" id="jenis" name="kategori">
                    <?php foreach($data['kategori'] as $value) : ?>
                        <?php if($value['id_kategori_bantuan'] == $data['catatan']['id_kategori_bantuan']) : ?>
                        <option value="<?= $value['id_kategori_bantuan'] ?>" selected><?= $value['name'] ?></option>
                        <?php else : ?>
                            <option value="<?= $value['id_kategori_bantuan'] ?>"><?= $value['name'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                
            </div>
            <div class="form-group  col-sm-6">
                <label for="periode">Periode</label>
                <input type="date" class="form-control" value="<?= date('Y-m-d', $data['catatan']['periode']) ?>" required autocomplete="off" name="periode">
                <p class="text-danger font-italic"> <?= $this->helper->form_error("periode") ?> </p>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="description">Deskripsi bantuan</label>
                <textarea class="form-control" name="description" id="description" rows="3"><?= $data['catatan']['description'] ?></textarea>
            </div>
        </div>
    
  </div>
  <div class="card-footer">
    <div class="row">
        <div class="col-sm-6"><a href="<?= BASE_URL ?>catatanbantuan" class="btn btn-sm btn-danger">Batal</a></div>
        <div class="col-sm-6 text-right"><button type="submit" class="btn btn-sm btn-primary">Simpan</button></div>
    </div>
  </div>
</div>
</form>
</div>

