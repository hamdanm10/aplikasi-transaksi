<?php
$conn->query("DELETE FROM t_sales_det WHERE id_barang='$_GET[id_barang]'");
$conn->query("DELETE FROM m_barang WHERE id_barang='$_GET[id_barang]'");

echo "<script>location='index.php?page=table-barang&delete=yes'</script>";
