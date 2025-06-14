<?php
include "config.php";

// Mengambil ID dari parameter
$id_rules = $_GET['id'] ?? '';

if (empty($id_rules)) {
    echo "<script>alert('ID rules tidak ditemukan'); window.location.href='?page=rulesBase';</script>";
    exit;
}

// Ambil semua id_gejala dari rules_base_detail yang akan dihapus
$gejala_ids = [];
$sql_gejala = $conn->query("SELECT id_gejala FROM rules_base_detail WHERE id_rules='$id_rules'");
while ($row = $sql_gejala->fetch_assoc()) {
    $gejala_ids[] = $row['id_gejala'];
}

// Hapus dari rules_base_detail
$conn->query("DELETE FROM rules_base_detail WHERE id_rules='$id_rules'");

// Hapus dari rules_base
$conn->query("DELETE FROM rules_base WHERE id_rules='$id_rules'");

// Cek untuk tiap gejala, apakah masih digunakan oleh rules lain
foreach ($gejala_ids as $id_gejala) {
    $check = $conn->query("SELECT COUNT(*) as total FROM rules_base_detail WHERE id_gejala='$id_gejala'");
    $data = $check->fetch_assoc();
    
    // Jika tidak digunakan lagi di rules lain, hapus dari detail_konsultasi
    if ($data['total'] == 0) {
        $conn->query("DELETE FROM detail_konsultasi WHERE id_gejala='$id_gejala'");
    }
}

$conn->close();

echo "<script>alert('Rule dan gejala yang tidak digunakan berhasil dihapus'); window.location.href='?page=rulesBase';</script>";
?>
