<!-- proses tambah data-->
<?php
if(isset($_POST['simpan'])){

    // ambil data dari form
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $role=$_POST['role'];
	
	//proses simpan
        $sql = "INSERT INTO users VALUES (Null, '$username', '$password', '$role')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=users");
        }
    }
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Users</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" maxlength="10" required>
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control chosen" data-placeholder="Pilih Role" name="role">
                            <option value=""></option>
                            <option value="Dokter">Dokter</option>
                            <option value="Admin">Admin</option>
                            <option value="Pasien">Pasien</option>
                        </select>
                    </div>
                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=users">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>