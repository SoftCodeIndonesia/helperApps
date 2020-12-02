<div class="container-fluid">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active">Catatan penerima bantuan</li>
    </ol>
    <div class="row mb-4">
        <div class="col-sm-6">
            <a href="<?= BASE_URL ?>penerimabantuan/tambah" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus"></i> tambah penerima</a>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Jenis bantuan</label>
                    <select class="form-control">
                        <option> <== pilih jenis bantuan ==> </option>
                    </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Periode</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">RT</label>
                    <select class="form-control" id="rt">
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
                    <select class="form-control" id="rw">
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