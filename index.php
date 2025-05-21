<?php
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
</head>
<body>

    <!-- ini buat navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
            </li>
            <!-- buat admin -->
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
            <a class="nav-link" href="#">Konsultasi</a>
            </li>
            <li class="nav-item active">
            <a class="nav-link" href="#">Logout</a>
            </li>
        </ul>
    </nav>

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
            }else{
                include "NAMA_HALAMAN";
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