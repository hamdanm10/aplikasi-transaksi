<?php
$conn->query("DELETE FROM t_sales_det WHERE id_sales='$_GET[id_sales]'");
$conn->query("DELETE FROM t_sales WHERE id_sales='$_GET[id_sales]'");

echo "<script>location='index.php?page=table-transaksi&delete=yes'</script>";
