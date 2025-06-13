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

// Update ulang detail_penyakit setelah penghapusan gejala
// Ambil semua id_konsultasi aktif
$konsultasi = $conn->query("SELECT DISTINCT id_konsultasi FROM detail_konsultasi");

while ($row = $konsultasi->fetch_assoc()) {
    $id_konsultasi = $row['id_konsultasi'];

    // Hapus hasil lama di detail_penyakit
    $conn->query("DELETE FROM detail_penyakit WHERE id_konsultasi='$id_konsultasi'");

    // Ambil semua penyakit
    $penyakit = $conn->query("SELECT * FROM penyakit");

    while ($p = $penyakit->fetch_assoc()) {
        $id_penyakit = $p['id_penyakit'];

        // Hitung total gejala penyakit dari rules_base
        $q1 = "
            SELECT COUNT(*) AS total_gejala
            FROM rules_base
            JOIN rules_base_detail ON rules_base.id_rules = rules_base_detail.id_rules
            WHERE id_penyakit = '$id_penyakit'";
        $res1 = $conn->query($q1)->fetch_assoc();
        $total_gejala = $res1['total_gejala'];

        // Hitung gejala yang cocok di konsultasi
        $q2 = "
            SELECT COUNT(*) AS cocok
            FROM rules_base
            JOIN rules_base_detail ON rules_base.id_rules = rules_base_detail.id_rules
            WHERE id_penyakit = '$id_penyakit'
            AND id_gejala IN (
                SELECT id_gejala FROM detail_konsultasi WHERE id_konsultasi = '$id_konsultasi'
            )";
        $res2 = $conn->query($q2)->fetch_assoc();
        $jumlah_cocok = $res2['cocok'];

        // Hitung dan simpan presentase
        if ($total_gejala > 0) {
            $presentase = round(($jumlah_cocok / $total_gejala) * 100, 2);
            if ($presentase > 0) {
                $conn->query("INSERT INTO detail_penyakit VALUES ('$id_konsultasi', '$id_penyakit', '$presentase')");
            }
        }
    }
}

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Gejala berhasil dihapus'); window.location.href='?page=gejala';</script>";
} else {
    echo "<script>alert('Gagal menghapus gejala'); window.location.href='?page=gejala';</script>";
}

$conn->close();
?>
