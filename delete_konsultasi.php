<?php
include "config.php";

// Mengambil ID dari parameter
$id_konsultasi = $_GET['id'] ?? '';

if (empty($id_konsultasi)) {
    echo "<script>alert('ID konsultasi tidak ditemukan'); window.location.href='?page=konsultasi_dokter';</script>";
    exit;
}

// Hapus dulu semua relasi yang bergantung
$conn->query("DELETE FROM detail_konsultasi WHERE id_konsultasi='$id_konsultasi'");
$conn->query("DELETE FROM detail_penyakit WHERE id_konsultasi='$id_konsultasi'");

// Baru hapus data utama
$conn->query("DELETE FROM konsultasi WHERE id_konsultasi='$id_konsultasi'");

$conn->close();

echo "<script>alert('Data konsultasi berhasil dihapus'); window.location.href='?page=konsultasi_dokter';</script>";
?>
