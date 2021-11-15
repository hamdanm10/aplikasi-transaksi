<?php
$sql = $conn->query("SELECT * FROM m_customer WHERE id_customer='$_GET[id_customer]'");
$row = $sql->fetch_assoc();
?>
<div class="col-xl-6">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Customer</h6>
        </div>
        <div class="card-body">
            <form action="proccess.php" method="POST" onsubmit="return validateCustomer()">

                <!-- Duplicate Entry -->
                <?php
                if (isset($_GET['duplicate'])) {
                    if ($_GET['duplicate'] == 'yes') {
                        alertValidate('Kode Customer sudah digunakan!', 'danger');
                    } else {
                        alertValidate('Data Customer berhasil diubah!', 'success');
                    }
                }
                ?>
                <div id="alertValidate"></div>

                <input type="text" class="d-none" name="id_customer" value="<?= $row['id_customer'] ?>" hidden>
                <div class="form-group row">
                    <label for="kode_customer" class="col-sm-3 col-form-label">Kode Customer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_customer" name="kode_customer" value="<?= $row['kode_customer'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" onkeypress="return onlyChar(event)" value="<?= $row['nama_customer'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telp" class="col-sm-3 col-form-label">No Telp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="telp" name="telp" onkeypress="return onlyNumber(event)" value="<?= $row['telp'] ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" name="edit_customer"><span class="fas fa-save mr-2"></span>Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>