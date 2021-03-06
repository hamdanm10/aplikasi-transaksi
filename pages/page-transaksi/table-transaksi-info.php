<?php
$sqlTransaksi = $conn->query("SELECT t_sales.kode_sales AS kode_sales, t_sales.tgl AS tgl, m_customer.kode_customer AS kode_customer, m_customer.nama_customer AS nama_customer, m_customer.telp AS telp, SUM(t_sales_det.total) AS subtotal, t_sales.diskon AS diskon, t_sales.ongkir AS ongkir, t_sales.total_bayar AS total_bayar
    FROM ((t_sales 
    INNER JOIN m_customer ON t_sales.id_customer = m_customer.id_customer)
    INNER JOIN t_sales_det ON t_sales.id_sales = t_sales_det.id_sales)
    WHERE t_sales.id_sales = '$_GET[id_sales]'
    GROUP BY t_sales.kode_sales");
$rowTransaksi = $sqlTransaksi->fetch_assoc();

$sqlTransaksi2 = "SELECT m_barang.kode_barang AS kode_barang, m_barang.nama_barang AS nama_barang, t_sales_det.qty AS qty, t_sales_det.harga_bandrol AS harga_bandrol, t_sales_det.diskon_pct AS diskon_pct, t_sales_det.diskon_nilai AS diskon_nilai, t_sales_det.harga_diskon AS harga_diskon, t_sales_det.total AS total, t_sales_det.id_sales AS id_sales, t_sales_det.id_barang AS id_barang
            FROM ((t_sales_det
            INNER JOIN t_sales ON t_sales_det.id_sales = t_sales.id_sales)
            INNER JOIN m_barang ON t_sales_det.id_barang = m_barang.id_barang)
            WHERE t_sales_det.id_sales = '$_GET[id_sales]'";
$resultTransaksi2 = $conn->query($sqlTransaksi2);
?>
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
                        <input type="text" class="form-control" id="kode_sales" name="kode_sales" value="<?= $rowTransaksi['kode_sales'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="tgl" class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="date" class="form-control" id="tgl" name="tgl" value="<?= date("Y-m-d", strtotime($rowTransaksi['tgl'])) ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="kode_customer" class="col-sm-3 col-form-label">Kode Customer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="kode_customer" name="kode_customer" value="<?= $rowTransaksi['kode_customer'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_customer" class="col-sm-3 col-form-label">Nama Customer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="<?= $rowTransaksi['nama_customer'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="telp" class="col-sm-3 col-form-label">No Telp</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="telp" name="telp" value="<?= $rowTransaksi['telp'] ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
    </div>
    <div class="card-body">
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
                    </tr>
                </thead>
                <tbody id="tableBarang">
                    <?php if ($resultTransaksi2->num_rows > 0) { ?>
                        <?php while ($rowTransaksi2 = $resultTransaksi2->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $rowTransaksi2['kode_barang'] ?></td>
                                <td><?= $rowTransaksi2['nama_barang'] ?></td>
                                <td><?= $rowTransaksi2['qty'] ?></td>
                                <td><?= $rowTransaksi2['harga_bandrol'] ?></td>
                                <td><?= $rowTransaksi2['diskon_pct'] ?></td>
                                <td><?= $rowTransaksi2['diskon_nilai'] ?></td>
                                <td><?= $rowTransaksi2['harga_diskon'] ?></td>
                                <td><?= $rowTransaksi2['total'] ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <hr>
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="form-group row">
                    <label for="subtotal" class="col-sm-4 col-form-label font-weight-bold">Sub Total</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="subtotal" name="subtotal" value="<?= $rowTransaksi['subtotal'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="diskon" class="col-sm-4 col-form-label font-weight-bold">Diskon</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="diskon" name="diskon" value="<?= $rowTransaksi['diskon'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="ongkir" class="col-sm-4 col-form-label font-weight-bold">Ongkir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="ongkir" name="ongkir" value="<?= $rowTransaksi['ongkir'] ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="total_bayar" class="col-sm-4 col-form-label font-weight-bold">Total Bayar</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="total_bayar" name="total_bayar" value="<?= $rowTransaksi['total_bayar'] ?>" readonly>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $conn->close(); ?>