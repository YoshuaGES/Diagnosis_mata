<?php
session_start();
//konekin database
    include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis Penyakit Mata</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Bootsrap css -->

    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <!-- datatable css -->

    <link rel="stylesheet" href="assets/css/all.css">
    <!-- FontAwesome css -->

    <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
    <!-- chosen css buat checkbox -->

    <style>
    .navbar-nav .nav-link:hover {
        color:rgb(229, 255, 0) !important; /* kuning telor */
        transition: color 0.3s ease;
    }

    .navbar-nav .nav-item.active .nav-link {
        color: #ffffff;
    }
</style>

</head>
<body>

    <!-- ini buat navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>

        <!-- setting akses -->
            <?php
                if($_SESSION['role']=="Dokter"){
                
            ?>

                <li class="nav-item active">
                    <a class="nav-link" href="?page=users">Users</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=rulesBase">Rules Base</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=konsultasi_dokter">Konsultasi</a>
                </li>

            <?php
                }elseif($_SESSION['role']=="Admin") {
            ?>
            
                <li class="nav-item active">
                    <a class="nav-link" href="?page=gejala">Gejala</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=penyakit">Penyakit</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=rulesBase">Rules Base</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="?page=konsultasi_dokter">Konsultasi</a>
                </li>

            <?php
                }else{
            ?>

                <li class="nav-item active">
                    <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
                </li>

            <?php
                }
            ?>

            <li class="nav-item active">
                <a class="nav-link" href="?page=logout">Logout</a>
            </li>
        </ul>
    </nav>

    <!-- cek status login -->
    <?php 
    if($_SESSION['status']!="y"){
        header("Location:login.php");
    }
    ?>

    <!-- ini buat menu -->
    <div class="container mt-4 mb-4">
        <?php
            $page = isset($_GET['page']) ? $_GET['page'] : "";
            $action = isset($_GET['action']) ? $_GET['action'] : "";

            if ($page==""){
                include "welcome.php";
            }elseif ($page=="gejala"){
                if ($action==""){
                    include "tampilan_gejala.php";
                }elseif ($action=="tambah"){
                    include "tambah_gejala.php";
                }elseif ($action=="update"){
                    include "update_gejala.php";
                }else{
                    include "delete_gejala.php";
                }
            }elseif ($page=="penyakit"){
                if ($action==""){
                    include "tampilan_penyakit.php";
                }elseif ($action=="tambah"){
                    include "tambah_penyakit.php";
                }elseif ($action=="update"){
                    include "update_penyakit.php";
                }else{
                    include "delete_penyakit.php";
                }
            }elseif ($page=="rulesBase"){
                if ($action==""){
                    include "tampilan_rulesBase.php";
                }elseif ($action=="tambah"){
                    include "tambah_rulesBase.php";
                }elseif ($action=="detail"){
                    include "detail_rulesBase.php";
                }elseif ($action=="update"){
                    include "update_rulesBase.php";
                }elseif ($action=="delete_gejala"){
                    include "delete_detail_rulesBase.php";
                }else{
                    include "delete_rulesBase.php";
                }
            }elseif ($page=="konsultasi"){
                if ($action==""){
                    include "tampilan_konsultasi.php";
                }else{
                    include "hasil_konsultasi.php";
                }
            }elseif ($page=="konsultasi_dokter"){
                if ($action==""){
                    include "tampilan_konsultasi_dokter.php";
                }else{
                    include "hasil_konsultasi_dokter.php";
                }
            }elseif ($page=="users"){
                if ($action==""){
                    include "tampilan_users.php";
                }elseif ($action=="tambah"){
                    include "tambah_users.php";
                }elseif ($action=="update"){
                    include "update_users.php";
                }else{
                    include "delete_users.php";
                }
            }else {
                include "logout.php";
            }
        ?>
    </div>

    <!-- Bootstrap jquery -->
    <script src="assets/js/jquery-3.7.0.min.js"></script>

    <!-- Bootstrap js -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Datatables js -->
    <script src="assets/js/datatables.min.js"></script>
    
    <!-- Buat Table di tampilan gejala -->
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        } );
        </script>

    <!-- FontAwesome js -->
    <script src="assets/js/all.js"></script>
    
    <!-- Chosen -->
    <script src="assets/js/chosen.jquery.min.js"></script>
    <!-- Function Chosen -->
    <script>
      $(function() {
        $('.chosen').chosen();
      });
    </script>

</body>
</html>