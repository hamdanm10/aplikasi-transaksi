<?php
$sqlGenerateKodeSales = $conn->query("SELECT MAX(REGEXP_SUBSTR(kode_sales,'[0-9]+')) AS generateKodeSales FROM t_sales");
$rowGenerateKodeSales = $sqlGenerateKodeSales->fetch_assoc();
$kodeSales = 'TR-' . ($rowGenerateKodeSales['generateKodeSales'] + 1);

$sqlCustomer = "SELECT * FROM m_customer ORDER BY kode_customer ASC";
$resultCustomer = $conn->query($sqlCustomer);

$sqlBarang = "SELECT * FROM m_barang ORDER BY kode_barang ASC";
$resultBarang = $conn->query($sqlBarang);
?>
<form action="proccess.php" method="POST" onsubmit="return validateTransaksi()">
    <div id="alertValidate"></div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="kode_sales" class="col-sm-3 col-form-label">No</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kode_sales" name="kode_sales" value="<?= $kodeSales ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl" name="tgl" value="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#customerModal">Pilih Customer</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="kode_customer" class="col-sm-3 col-form-label">Kode Customer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="kode_customer" name="kode_customer" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="telp" class="col-sm-3 col-form-label">No Telp</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="telp" name="telp" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#barangModal"><span class="fas fa-plus mr-2"></span>Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Empty Validate -->
            <?php
            if (isset($_GET['empty'])) {
                if ($_GET['empty'] == 'yes') {
                    alertValidate('Data Transaksi belum dimasukkan!', 'danger');
                }
            }
            ?>
            <div class="table-responsive mb-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga Bandrol</th>
                            <th scope="col">Diskon (%)</th>
                            <th scope="col">Diskon (Rp)</th>
                            <th scope="col">Harga Diskon</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBarang"></tbody>
                </table>
            </div>
            <hr>
            <div class="row justify-content-end">
                <div class="col-md-4">
                    <div class="form-group row">
                        <label for="subtotal" class="col-sm-4 col-form-label font-weight-bold">Sub Total</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="subtotal" name="subtotal" value="0" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-sm-4 col-form-label font-weight-bold">Diskon</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="diskon" name="diskon" onkeypress="return onlyNumber(event)" onkeyup="totalBayar()" value="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ongkir" class="col-sm-4 col-form-label font-weight-bold">Ongkir</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ongkir" name="ongkir" onkeypress="return onlyNumber(event)" onkeyup="totalBayar()" value="0">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="total_bayar" class="col-sm-4 col-form-label font-weight-bold">Total Bayar</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="0" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="tambah_transaksi"><span class="fas fa-save mr-2"></span>Simpan</button>
            </div>
        </div>
    </div>
</form>

<!-- Customer Modal-->
<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pilih Customer</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Kode Customer</th>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($resultCustomer->num_rows > 0) { ?>
                                <?php while ($rowCustomer = $resultCustomer->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?= $rowCustomer['kode_customer'] ?></td>
                                        <td><?= $rowCustomer['nama_customer'] ?></td>
                                        <td>
                                            <button onclick="selectCustomer('<?= $rowCustomer['kode_customer'] ?>','<?= $rowCustomer['nama_customer'] ?>','<?= $rowCustomer['telp'] ?>')" class="btn btn-sm btn-primary" data-dismiss="modal">Pilih</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Barang Modal-->
<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="alertValidateTransaksi"></div>
                <div class="form-group">
                    <label for="kode_barang">Nama Barang</label>
                    <select class="form-control" id="kode_barang" onchange="selectBarang(this.value); total();">
                        <option value="" selected disabled>Pilih barang...</option>
                        <?php if ($resultBarang->num_rows > 0) { ?>
                            <?php while ($rowBarang = $resultBarang->fetch_assoc()) { ?>
                                <option value="<?= $rowBarang['nama_barang'] ?>-<?= $rowBarang['harga_barang'] ?>"><?= $rowBarang['kode_barang'] ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control" id="nama_barang" readonly>
                </div>
                <div class="form-group">
                    <label for="qty">Qty</label>
                    <input type="number" class="form-control" id="qty" min="0" value="0" onkeyup="total()" onchange="total()">
                </div>
                <div class="form-group">
                    <label for="harga_bandrol">Harga Bandrol</label>
                    <input type="text" class="form-control" id="harga_bandrol" onkeypress="return onlyNumber(event)" value="0" readonly>
                </div>
                <div class="form-group">
                    <label for="diskon_pct">Diskon (%)</label>
                    <input type="number" class="form-control" id="diskon_pct" value="0" min="0" onkeyup="total()" onchange="total()">
                </div>
                <div class="form-group">
                    <label for="diskon_nilai">Diskon (Rp)</label>
                    <input type="text" class="form-control" id="diskon_nilai" onkeypress="return onlyNumber(event)" value="0" readonly>
                </div>
                <div class="form-group">
                    <label for="harga_diskon">Harga Diskon</label>
                    <input type="text" class="form-control" id="harga_diskon" onkeypress="return onlyNumber(event)" value="0" readonly>
                </div>
                <div class="form-group">
                    <label for="total">Total</label>
                    <input type="text" class="form-control" id="total" onkeypress="return onlyNumber(event)" value="0" readonly>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" onclick="addRow()" id="modalTransaksi"><span class="fas fa-save mr-2"></span>Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>

<?php $conn->close(); ?>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>