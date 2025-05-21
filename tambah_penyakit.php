<!-- proses tambah data-->
<?php
if(isset($_POST['simpan'])){

    // ambil data dari form
    $nama_gejala=$_POST['nama_gejala'];
	
   
	//proses simpan
        $sql = "INSERT INTO gejala VALUES (Null,'$nama_gejala')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=gejala");
        }
    }
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Data Penyakit</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Penyakit</label>
                        <input type="text" class="form-control" name="nama_penyakit" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" maxlength="200" required>
                    </div>
                    <div class="form-group">
                        <label for="">Solusi</label>
                        <input type="text" class="form-control" name="solusi" maxlength="200" required>
                    </div>
                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=gejala">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>