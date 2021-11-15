<div class="col-xl-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Barang</h6>
        </div>
        <div class="card-body">
            <form action="proccess.php" method="POST" onsubmit="return validateBarang()">

                <!-- Duplicate Entry -->
                <?php
                if (isset($_GET['duplicate'])) {
                    if ($_GET['duplicate'] == 'yes') {
                        alertValidate('Kode Barang sudah digunakan!', 'danger');
                    } else {
                        alertValidate('Data Barang berhasil ditambahkan!', 'success');
                    }
                }
                ?>
                <div id="alertValidate"></div>

                <div class="form-group row">
                    <label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_barang" class="col-sm-3 col-form-label">Harga Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_barang" name="harga_barang" onkeypress="return onlyNumber(event)" value="">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="tambah_barang"><span class="fas fa-save mr-2"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>