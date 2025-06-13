<?php
include "config.php";

$id_penyakit = $_GET['id'] ?? '';

if (empty($id_penyakit)) {
    echo "<script>alert('ID penyakit tidak ditemukan'); window.location.href='?page=penyakit';</script>";
    exit;
}

// 1. Ambil semua id_rules dari rules_base yang pakai id_penyakit ini
$result = $conn->query("SELECT id_rules FROM rules_base WHERE id_penyakit='$id_penyakit'");

while ($row = $result->fetch_assoc()) {
    $id_rules = $row['id_rules'];

    // 2. Hapus dulu detail yang berelasi dengan rules tersebut
    $conn->query("DELETE FROM rules_base_detail WHERE id_rules='$id_rules'");
}

// 3. Hapus rules_base
$conn->query("DELETE FROM rules_base WHERE id_penyakit='$id_penyakit'");

// ✅ 4. Hapus relasi dari detail_penyakit yang pakai id_penyakit ini
$conn->query("DELETE FROM detail_penyakit WHERE id_penyakit='$id_penyakit'");

// 5. Hapus dari tabel penyakit
$sql = "DELETE FROM penyakit WHERE id_penyakit='$id_penyakit'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Penyakit berhasil dihapus'); window.location.href='?page=penyakit';</script>";
} else {
    echo "<script>alert('Gagal menghapus penyakit'); window.location.href='?page=penyakit';</script>";
}

$conn->close();
?>
