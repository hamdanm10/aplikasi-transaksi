<?php
include 'connection.php';
if (isset($_POST['tambah_customer'])) {
    $kode_customer = htmlspecialchars($_POST['kode_customer']);
    $nama_customer = htmlspecialchars($_POST['nama_customer']);
    $telp = $_POST['telp'];

    $sqlCustomer = $conn->query("SELECT * FROM m_customer WHERE kode_customer = '$kode_customer'");
    $matchCustomer = $sqlCustomer->num_rows;

    if ($matchCustomer >= 1) {
        echo "<script>location='index.php?page=table-customers-tambah&duplicate=yes'</script>";
    } else {
        $conn->query("INSERT INTO m_customer (kode_customer, nama_customer, telp) VALUES ('$kode_customer', '$nama_customer', '$telp')");
        echo "<script>location='index.php?page=table-customers-tambah&duplicate=no'</script>";
    }
}

if (isset($_POST['edit_customer'])) {
    $id_customer = htmlspecialchars($_POST['id_customer']);
    $kode_customer = htmlspecialchars($_POST['kode_customer']);
    $nama_customer = htmlspecialchars($_POST['nama_customer']);
    $telp = $_POST['telp'];

    $sqlCustomer = $conn->query("SELECT * FROM m_customer WHERE id_customer = '$id_customer'");
    $row = $sqlCustomer->fetch_assoc();

    $sqlCustomer2 = $conn->query("SELECT * FROM m_customer WHERE kode_customer = '$kode_customer' AND kode_customer != '$row[kode_customer]'");
    $matchCustomer = $sqlCustomer2->num_rows;

    if ($matchCustomer >= 1) {
        echo "<script>location='index.php?page=table-customers-edit&id_customer=" . $id_customer . "&duplicate=yes'</script>";
    } else {
        $conn->query("UPDATE m_customer SET kode_customer = '$kode_customer', nama_customer = '$nama_customer', telp = '$telp' WHERE id_customer = '$id_customer'");
        echo "<script>location='index.php?page=table-customers-edit&id_customer=" . $id_customer . "&duplicate=no'</script>";
    }
}

if (isset($_POST['tambah_barang'])) {
    $kode_barang = htmlspecialchars($_POST['kode_barang']);
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $harga_barang = $_POST['harga_barang'];

    $sqlBarang = $conn->query("SELECT * FROM m_barang WHERE kode_barang = '$kode_barang'");
    $matchBarang = $sqlBarang->num_rows;

    if ($matchBarang >= 1) {
        echo "<script>location='index.php?page=table-barang-tambah&duplicate=yes'</script>";
    } else {
        $conn->query("INSERT INTO m_barang (kode_barang, nama_barang, harga_barang) VALUES ('$kode_barang', '$nama_barang', '$harga_barang')");
        echo "<script>location='index.php?page=table-barang-tambah&duplicate=no'</script>";
    }
}

if (isset($_POST['edit_barang'])) {
    $id_barang = htmlspecialchars($_POST['id_barang']);
    $kode_barang = htmlspecialchars($_POST['kode_barang']);
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $harga_barang = $_POST['harga_barang'];

    $sqlBarang = $conn->query("SELECT * FROM m_barang WHERE id_barang = '$id_barang'");
    $row = $sqlBarang->fetch_assoc();

    $sqlBarang2 = $conn->query("SELECT * FROM m_barang WHERE kode_barang = '$kode_barang' AND kode_barang != '$row[kode_barang]'");
    $matchBarang = $sqlBarang2->num_rows;

    if ($matchBarang >= 1) {
        echo "<script>location='index.php?page=table-barang-edit&id_barang=" . $id_barang . "&duplicate=yes'</script>";
    } else {
        $conn->query("UPDATE m_barang SET kode_barang = '$kode_barang', nama_barang = '$nama_barang', harga_barang = '$harga_barang' WHERE id_barang = '$id_barang'");
        echo "<script>location='index.php?page=table-barang-edit&id_barang=" . $id_barang . "&duplicate=no'</script>";
    }
}

if (isset($_POST['tambah_transaksi'])) {
    if (empty($_POST['kode_barang'])) {
        echo "<script>location='index.php?page=table-transaksi-tambah&empty=yes'</script>";
    } else {
        $kode_sales = $_POST['kode_sales'];
        $tgl = $_POST['tgl'];
        $kode_customer = $_POST['kode_customer'];
        $subtotal = $_POST['subtotal'];
        $diskon = $_POST['diskon'];
        $ongkir = $_POST['ongkir'];
        $total_bayar = $_POST['total_bayar'];
        $kode_barang = $_POST['kode_barang'];
        $harga_bandrol = $_POST['harga_bandrol'];
        $qty = $_POST['qty'];
        $diskon_pct = $_POST['diskon_pct'];
        $diskon_nilai = $_POST['diskon_nilai'];
        $harga_diskon = $_POST['harga_diskon'];
        $total = $_POST['total'];

        $sqlCostumer = $conn->query("SELECT * FROM m_customer WHERE kode_customer='$kode_customer'");
        $rowCustomer = $sqlCostumer->fetch_assoc();

        $conn->query("INSERT INTO t_sales (kode_sales, tgl, id_customer, subtotal, diskon, ongkir, total_bayar) VALUES ('$kode_sales', '$tgl', '$rowCustomer[id_customer]', '$subtotal', '$diskon', '$ongkir', '$total_bayar')");

        $sqlSales = $conn->query("SELECT * FROM t_sales WHERE kode_sales='$kode_sales'");
        $rowSales = $sqlSales->fetch_assoc();

        foreach ($kode_barang as $index => $kode_barang2) {
            $sqlBarang = $conn->query("SELECT * FROM m_barang WHERE kode_barang='$kode_barang2'");
            $rowBarang = $sqlBarang->fetch_assoc();

            $s_kode_sales = $rowSales['id_sales'];
            $s_harga_bandrol = $harga_bandrol[$index];
            $s_qty = $qty[$index];
            $s_diskon_pct = $diskon_pct[$index];
            $s_diskon_nilai = $diskon_nilai[$index];
            $s_harga_diskon = $harga_diskon[$index];
            $s_total = $total[$index];

            $conn->query("INSERT INTO t_sales_det (id_sales, id_barang, harga_bandrol, qty, diskon_pct, diskon_nilai, harga_diskon, total) VALUES ('$s_kode_sales', '$rowBarang[id_barang]', '$s_harga_bandrol', '$s_qty', '$s_diskon_pct', '$s_diskon_nilai', '$s_harga_diskon', '$s_total')");
        }
        echo "<script>location='index.php?page=table-transaksi&data=tambah'</script>";
    }
}
