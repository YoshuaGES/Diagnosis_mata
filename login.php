<!-- proses login -->
<?php
session_start();
require "config.php";

if(isset($_POST["submit"])){

    //ambil data dari form
    $username=$_POST["username"];
    $password=md5($_POST["password"]);

    // cek username dan password
    $sql = "SELECT * FROM users WHERE username='$username' AND password ='$password'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($result->num_rows > 0) {
        
    //jika login berhasil
    //membuat session
    $_SESSION['username'] = $row["username"];
    $_SESSION['role'] = $row["role"];
    $_SESSION['status'] = "y";
    
    header("Location:index.php");

    } else {
        //bila login gagal
        header("Location:?msg=n");
    }
}

    if (isset($_POST["guest"])) {
        $_SESSION['username'] = "Guest";
        $_SESSION['role'] = "User";
        $_SESSION['status'] = "y";
        header("Location: index.php");
        exit;
    }

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>

    <!-- CSS Bootstrap -->

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

<!-- validasi login gagal -->
<?php 
if(isset($_GET['msg'])){
    if($_GET['msg'] == "n"){
    ?>
    <div class="alert alert-danger" align="center">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Login Gagal</strong>
    </div>
    <?php
    }       
}
?>

<div class="container-fluid" style="margin-top:150px">
    <div class="row">
        <div class="col-lg-4 offset-lg-4">
            <form method="POST">
                <div class="card border-dark">
                    <div class="card-header bg-primary text-light border-dark">
                        <strong>LOGIN</strong>
                    </div>
                    <div class="card-body border">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" autocomplete="off" required>
                        </div>
                        <input type="submit" class="btn btn-primary" name="submit" value="Login">
                    </div>
                </div>
                </form>

                <!-- Form khusus untuk User biasa -->
                <form method="POST" style="margin: 20px;">
                <button type="submit" class="btn btn-success w-100" name="guest">Masuk sebagai User</button>
                </form>
        </div>
    </div>
</div>

<!-- Jquery -->
<script src="assets/js/jquery-3.7.0.min.js"></script>
<!-- bootstrap js -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>