<?php
$sql = "SELECT t_sales.id_sales AS id_sales, t_sales.kode_sales AS kode_sales, t_sales.tgl AS tgl, m_customer.nama_customer AS nama_customer, SUM(t_sales_det.qty) AS qty, t_sales.subtotal AS subtotal, t_sales.diskon AS diskon, t_sales.ongkir AS ongkir, t_sales.total_bayar AS total_bayar  
        FROM ((t_sales 
        INNER JOIN m_customer ON t_sales.id_customer = m_customer.id_customer)
        INNER JOIN t_sales_det ON t_sales.id_sales = t_sales_det.id_sales)
        GROUP BY kode_sales
        ORDER BY tgl DESC";
$result = $conn->query($sql);

$sqlGrandTotal = $conn->query("SELECT SUM(total_bayar) AS grand_total FROM t_sales");
$rowGrandTotal = $sqlGrandTotal->fetch_assoc();
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            <a href="index.php?page=table-transaksi-tambah" class="btn btn-sm btn-success"><span class="fa fa-plus mr-2"></span>Tambah Data</a>
        </div>
    </div>
    <div class="card-body">
        <?php
        if (isset($_GET['data'])) {
            if ($_GET['data'] == 'tambah') {
                alertValidate('Data Transaksi berhasil ditambahkan!', 'success');
            }
        }
        ?>

        <!-- Alert Delete -->
        <?php
        if (isset($_GET['delete'])) {
            if ($_GET['delete'] == 'yes') {
                alertValidate('Data berhasil dihapus!', 'success');
            }
        }
        ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>Qty Barang</th>
                        <th>Sub Total</th>
                        <th>Diskon</th>
                        <th>Ongkir</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>No Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>Qty Barang</th>
                        <th>Sub Total</th>
                        <th>Diskon</th>
                        <th>Ongkir</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php $no = 1; ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['kode_sales'] ?></td>
                                <td><?= date("d-M-Y", strtotime($row['tgl'])) ?></td>
                                <td><?= $row['nama_customer'] ?></td>
                                <td><?= $row['qty'] ?></td>
                                <td><?= number_format($row['subtotal']) ?></td>
                                <td><?= number_format($row['diskon']) ?></td>
                                <td><?= number_format($row['ongkir']) ?></td>
                                <td><?= number_format($row['total_bayar']) ?></td>
                                <td>
                                    <a href="index.php?page=table-transaksi-info&id_sales=<?= $row['id_sales'] ?>" class="btn btn-sm btn-info"><span class="fas fa-info"></span></a>
                                    <a href="index.php?page=table-transaksi-hapus&id_sales=<?= $row['id_sales'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Jika Anda menghapus data transaksi ini maka data transaksi detail yang menggunakan data transaksi ini otomatis terhapus, Apakah anda yakin?')"><span class="fas fa-trash-alt"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mb-4">
    <div class="card shadow">
        <div class="card-body p-0 pt-3 px-3">
            <p class="text-center font-weight-bold">Grand Total : Rp. <?= number_format($rowGrandTotal['grand_total']) ?></p>
            <?php $conn->close(); ?>
        </div>
    </div>
</div>