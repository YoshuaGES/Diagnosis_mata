<?php
// Mengambil ID dari parameter
$id_rules=$_GET['id'];

// Menghapus rules_base_detail
$sql = "DELETE FROM rules_base_detail WHERE id_rules='$id_rules'";
$conn->query($sql);

// Menghapus rules_base
$sql = "DELETE FROM rules_base WHERE id_rules='$id_rules'";
$conn->query($sql);


$conn->close();

header("Location:?page=rulesBase");
?>