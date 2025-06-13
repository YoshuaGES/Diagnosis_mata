<?php
session_start();
include "config.php";

// Cek status login sebelum ada output HTML
if (!isset($_SESSION['status']) || $_SESSION['status'] != "y") {
    header("Location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Diagnosis Penyakit Mata</title>

  <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
  <!-- file utama CSS dari Bootstrap digunakan untuk membangun layout web responsif dan komponen siap pakai seperti navbar, form, tombol, dll. -->
  <link rel="stylesheet" href="assets/css/datatables.min.css"/>
  <!-- pustaka jQuery yang digunakan untuk menampilkan tabel data interaktif: pencarian, pagination, sort, dll. -->
  <link rel="stylesheet" href="assets/css/all.css"/>
  <!-- pustaka ikon berbasis font -->
  <link rel="stylesheet" href="assets/css/bootstrap-chosen.css"/>
  <!-- pustaka jQuery yang meningkatkan tampilan dan interaksi <select> (dropdown), seperti pencarian dalam dropdown. -->

  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    .navbar-nav .nav-link:hover {
      color: rgb(229, 255, 0) !important;
      transition: color 0.3s ease;
    }
    .navbar-nav .nav-item.active .nav-link {
      color: #ffffff;
    }
    .container {
      flex: 1;
    }
    footer {
      background:rgb(41, 41, 41);
      color: #fff;
      padding: 20px;
      text-align: center;
      font-size:12px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <ul class="navbar-nav">
        <!-- Pengecekan buat 3 role -->
      <?php if ($_SESSION['role'] == "Admin") { ?>
        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=gejala">Gejala</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=penyakit">Penyakit</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=rulesBase">Rules Base</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=konsultasi_dokter">Konsultasi</a></li>
      <?php } elseif ($_SESSION['role'] == "Dokter") { ?>
        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=users">Users</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=rulesBase">Rules Base</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=konsultasi_dokter">Konsultasi</a></li>
      <?php } else { ?>
        <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=about">About</a></li>
        <li class="nav-item active"><a class="nav-link" href="?page=konsultasi">Konsultasi</a></li>
      <?php } ?>

      <li class="nav-item active"><a class="nav-link" href="?page=logout">Logout</a></li>
    </ul>
  </nav>

  <!-- Menu Konten -->
  <div class="container mt-4 mb-4">
    <?php
    $page = $_GET['page'] ?? "";
    // Mengambil nilai dari parameter URL page.
    $action = $_GET['action'] ?? "";
    // Digunakan untuk mengetahui aksi spesifik apa yang akan dijalankan pada halaman tersebut (misalnya tambah, update, delete, dsb).

    if ($page == "") {
      if ($_SESSION['role'] == "Admin") {
        include "welcome_admin.php";
      } elseif ($_SESSION['role'] == "Dokter") {
        include "welcome_dokter.php";
      } else {
        include "welcome.php";
      }

    } elseif ($page == "gejala") {
      if ($action == "") {
        include "tampilan_gejala.php";
      } elseif ($action == "tambah") {
        include "tambah_gejala.php";
      } elseif ($action == "update") {
        include "update_gejala.php";
      } else {
        include "delete_gejala.php";
      }

    } elseif ($page == "penyakit") {
      if ($action == "") {
        include "tampilan_penyakit.php";
      } elseif ($action == "tambah") {
        include "tambah_penyakit.php";
      } elseif ($action == "update") {
        include "update_penyakit.php";
      } else {
        include "delete_penyakit.php";
      }

    } elseif ($page == "rulesBase") {
      if ($action == "") {
        include "tampilan_rulesBase.php";
      } elseif ($action == "tambah") {
        include "tambah_rulesBase.php";
      } elseif ($action == "detail") {
        include "detail_rulesBase.php";
      } elseif ($action == "update") {
        include "update_rulesBase.php";
      } elseif ($action == "delete_gejala") {
        include "delete_detail_rulesBase.php";
      } else {
        include "delete_rulesBase.php";
      }

    } elseif ($page == "konsultasi") {
      if ($action == "") {
        include "tampilan_konsultasi.php";
      } else {
        include "hasil_konsultasi.php";
      }

    } elseif ($page == "konsultasi_dokter") {
      if ($action == "") {
        include "tampilan_konsultasi_dokter.php";
      } elseif ($action == "detail") {
        include "hasil_konsultasi_dokter.php";
      } else {
        include "delete_konsultasi.php";
      }

    } elseif ($page == "users") {
      if ($action == "") {
        include "tampilan_users.php";
      } elseif ($action == "tambah") {
        include "tambah_users.php";
      } elseif ($action == "update") {
        include "update_users.php";
      } else {
        include "delete_users.php";
      }

    } elseif ($page == "about") {
        include "about.php";
     
    } else {
      include "logout.php";
    }
    ?>
  </div>

  <!-- Footer -->
  <footer>
    &copy; <?= date("Y") ?> Sistem Pakar Diagnosis Penyakit Mata - All rights reserved.
  </footer>

  <!-- Scripts -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/datatables.min.js"></script>
  <script src="assets/js/all.js"></script>
  <script src="assets/js/chosen.jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
      $('.chosen').chosen();
    });
  </script>

</body>
</html>
