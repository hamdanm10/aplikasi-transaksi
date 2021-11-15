<?php
$sql = $conn->query("SELECT * FROM t_sales WHERE id_customer='$_GET[id_customer]'");
$row = $sql->fetch_assoc();

$conn->query("DELETE FROM t_sales_det WHERE id_sales='$row[id_sales]'");
$conn->query("DELETE FROM t_sales WHERE id_customer='$_GET[id_customer]'");
$conn->query("DELETE FROM m_customer WHERE id_customer='$_GET[id_customer]'");

echo "<script>location='index.php?page=table-customers&delete=yes'</script>";
