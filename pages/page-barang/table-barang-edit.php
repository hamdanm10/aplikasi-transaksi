<?php
$sql = $conn->query("SELECT * FROM m_barang WHERE id_barang='$_GET[id_barang]'");
$row = $sql->fetch_assoc();
?>
<div class="col-xl-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Barang</h6>
        </div>
        <div class="card-body">
            <form action="proccess.php" method="POST" onsubmit="return validateBarang()">

                <!-- Duplicate Entry -->
                <?php
                if (isset($_GET['duplicate'])) {
                    if ($_GET['duplicate'] == 'yes') {
                        alertValidate('Kode Barang sudah digunakan!', 'danger');
                    } else {
                        alertValidate('Data Barang berhasil diubah!', 'success');
                    }
                }
                ?>
                <div id="alertValidate"></div>

                <input type="text" class="d-none" name="id_barang" value="<?= $row['id_barang'] ?>" hidden>
                <div class="form-group row">
                    <label for="kode_barang" class="col-sm-3 col-form-label">Kode Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" value="<?= $row['kode_barang'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_barang" class="col-sm-3 col-form-label">Nama Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?= $row['nama_barang'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="harga_barang" class="col-sm-3 col-form-label">Harga Barang</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="harga_barang" name="harga_barang" onkeypress="return onlyNumber(event)" value="<?= $row['harga_barang'] ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="edit_barang"><span class="fas fa-save mr-2"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>