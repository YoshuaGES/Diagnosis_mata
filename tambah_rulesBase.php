<!-- proses tambah data-->
<?php

if(isset($_POST['simpan'])){
    $nama_penyakit=$_POST['nama_penyakit'];
	
    // validasi nama penyakit
    $sql = "SELECT rules_base.id_rules, rules_base.id_penyakit, penyakit.nama_penyakit
            FROM rules_base INNER JOIN penyakit ON rules_base.id_penyakit = penyakit.id_penyakit
            WHERE nama_penyakit='$nama_penyakit'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data rules base penyakit sudah ada</strong>
            </div>
        <?php
    }else{

        // mengambil Id data penyakit buat disimpan ke rules_base
        $sql = "SELECT * FROM penyakit WHERE nama_penyakit='$nama_penyakit'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_penyakit = $row['id_penyakit'];

        //proses simpan ke table rules_base
        $sql = "INSERT INTO rules_base VALUES (Null,'$id_penyakit')";
        mysqli_query($conn,$sql);

        //Mengambil ID gejala
        $id_gejala=$_POST['id_gejala'];

        //proses mengambil data rules_base
        $sql = "SELECT * FROM rules_base ORDER BY id_rules DESC";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_rules = $row['id_rules'];
        
        //proses simpan rules_base_detail
        $jumlah = count($id_gejala);
        $i=0;
        while($i < $jumlah){
            $id_gejalaNew = $id_gejala[$i];
            $sql = "INSERT INTO rules_base_detail VALUES ($id_rules,'$id_gejalaNew')";
            mysqli_query($conn,$sql);
            $i++;
        }
        header("Location:?page=rulesBase");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Tambah Rules Base</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Penyakit</label>
                        <select class="form-control chosen" data-placeholder="Pilih Nama Penyakit" name="nama_penyakit">
                            <option value=""></option>
                                <?php
                                    $sql = "SELECT * FROM penyakit ORDER BY nama_penyakit ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nama_penyakit']; ?>"><?php echo $row['nama_penyakit']; ?></option>
                                <?php
                                    }
                                ?>
                        </select>
                    </div>
                    
                    <!-- Tabel Gejala -->
                    <div class="form-group">
                        <label for="">Pilih Gejala Berikut:</label>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="40px"></th>
                                    <th width="25px">No</th>
                                    <th width="700px">Nama Gejala</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor=1;
                                    $sql = "SELECT*FROM gejala ORDER BY nama_gejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'id_gejala[]';?>" value="<?php echo $row['id_gejala']; ?>"></td>
                                        <td><?php echo $nomor++ ?></td>
                                        <td><?php echo $row['nama_gejala']; ?></td>
                                    </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>

                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=rulesBase">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    function validasiForm(){

        // Validasi nama penyakit
        const namaPenyakit = document.forms["Form"]["nama_penyakit"].value;

        if(namaPenyakit=="")
        {
            alert("Pilih nama penyakit");
            return false;
        }
        
        // Validasi gejala yang belum dipilih
        const checkbox = document.getElementsByName('<?php echo 'id_gejala[]';?>');

        const check = false;

        for(const i=0;i<check.length;i++){
            if(checkbox[i].checked){
                check = true;
                break;
            }
        }

        // jika belum ada yg di check
        if(!check){
            alert("Pilih setidaknya satu gejala!");
            return false;
        }

        return true;
    }

</script>