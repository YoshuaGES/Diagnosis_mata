<?php
include "config.php";

$id_gejala = $_GET['id'] ?? '';

if (empty($id_gejala)) {
    echo "<script>alert('ID gejala tidak ditemukan'); window.location.href='?page=gejala';</script>";
    exit;
}

// Hapus relasi dari rules_base_detail
$conn->query("DELETE FROM rules_base_detail WHERE id_gejala='$id_gejala'");

// Hapus relasi dari detail_konsultasi
$conn->query("DELETE FROM detail_konsultasi WHERE id_gejala='$id_gejala'");

// Hapus dari tabel gejala
$sql = "DELETE FROM gejala WHERE id_gejala='$id_gejala'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Gejala berhasil dihapus'); window.location.href='?page=gejala';</script>";
} else {
    echo "<script>alert('Gagal menghapus gejala'); window.location.href='?page=gejala';</script>";
}

$conn->close();
?>
