<?php
include "config.php";

// Mengambil ID dari parameter yg mau dihapus
$id_konsultasi = $_GET['id'] ?? '';

// Validasi: Jika id_konsultasi kosong atau tidak ada, maka tampilkan alert dan redirect kembali ke halaman konsultasi_dokter.
if (empty($id_konsultasi)) {
    echo "<script>alert('ID konsultasi tidak ditemukan'); window.location.href='?page=konsultasi_dokter';</script>";
    exit;
}

// Hapus dulu semua data relasi yang bergantung pada foreign key
$conn->query("DELETE FROM detail_konsultasi WHERE id_konsultasi='$id_konsultasi'");
$conn->query("DELETE FROM detail_penyakit WHERE id_konsultasi='$id_konsultasi'");

// Baru hapus data utama
$conn->query("DELETE FROM konsultasi WHERE id_konsultasi='$id_konsultasi'");

$conn->close();

//jika data dihapus maka tampilkan alert
echo "<script>alert('Data konsultasi berhasil dihapus'); window.location.href='?page=konsultasi_dokter';</script>";
?>
