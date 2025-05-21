<?php
// Mengambil ID dari parameter
$id_rules=$_GET['id_rules'];
$id_gejala=$_GET['id_gejala'];

$sql = "DELETE FROM rules_base_detail WHERE id_rules='$id_rules' AND id_gejala='$id_gejala'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=rulesBase");
}
$conn->close();
?>