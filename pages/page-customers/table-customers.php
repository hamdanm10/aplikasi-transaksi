<?php
$sql = "SELECT * FROM m_customer ORDER BY nama_customer ASC";
$result = $conn->query($sql);
?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Customers</h6>
            <a href="index.php?page=table-customers-tambah" class="btn btn-sm btn-success"><span class="fa fa-plus mr-2"></span>Tambah Data</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>

                    <!-- Alert Delete -->
                    <?php
                    if (isset($_GET['delete'])) {
                        if ($_GET['delete'] == 'yes') {
                            alertValidate('Data berhasil dihapus!', 'success');
                        }
                    }
                    ?>

                    <tr>
                        <th>No</th>
                        <th>Kode Customer</th>
                        <th>Nama Customer</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode Customer</th>
                        <th>Nama Customer</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php $no = 1; ?>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['kode_customer'] ?></td>
                                <td><?= $row['nama_customer'] ?></td>
                                <td><?= $row['telp'] ?></td>
                                <td>
                                    <a href="index.php?page=table-customers-edit&id_customer=<?= $row['id_customer'] ?>" class="btn btn-sm btn-warning"><span class="fas fa-pencil-alt"></span></a>
                                    <a href="index.php?page=table-customers-hapus&id_customer=<?= $row['id_customer'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Jika Anda menghapus data customer ini maka data transaksi yang menggunakan data customer ini otomatis terhapus, Apakah anda yakin?')"><span class="fas fa-trash-alt"></span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    <?php $conn->close(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>