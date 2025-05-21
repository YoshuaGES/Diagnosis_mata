<!-- Proses menampilkan data penyakit berdasarkan rules base yang dipilih -->
<?php
// 1, Mengambil id dari parameter
$id_rules=$_GET['id'];

$sql = "SELECT rules_base.id_rules, rules_base.id_penyakit, penyakit.nama_penyakit
        FROM rules_base INNER JOIN penyakit
        ON rules_base.id_penyakit=penyakit.id_penyakit WHERE id_rules='$id_rules'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//proses update
if(isset($_POST['update'])){
    $id_gejala=$_POST['id_gejala'];

     //proses simpan rules_base_detail
     if($id_gejala!=Null){
         $jumlah = count($id_gejala);
         $i=0;
         while($i < $jumlah){
             $id_gejalaNew = $id_gejala[$i];
             $sql = "INSERT INTO rules_base_detail VALUES ($id_rules,'$id_gejalaNew')";
             mysqli_query($conn,$sql);
             $i++;
         }
    }
    header("Location:?page=rulesBase");
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Edit Rules Base</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Penyakit</label>
                        <input type="text" class="form-control" value="<?php echo $row['nama_penyakit']; ?>" name="nama_penyakit" maxlength="200" readonly>
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
                                    <th width="50px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor=1;
                                    $sql = "SELECT*FROM gejala ORDER BY nama_gejala ASC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {

                                        $id_gejala=$row['id_gejala'];

                                        //cek ke tabel rules_base_detail
                                        $sql2 = "SELECT * FROM rules_base_detail WHERE id_rules='$id_rules' AND id_gejala='$id_gejala'";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                        //jika ada maka akan ditampilkan datanya checklist (mati) kalau hapus (aktif)
                                ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" disabled="disabled"></td>
                                        <td><?php echo $nomor++ ?></td>
                                        <td><?php echo $row['nama_gejala']; ?></td>
                                        <td align="center">
                                            <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=rulesBase&action=delete_gejala&id_rules=<?php echo $id_rules?>&id_gejala=<?php echo $id_gejala?>">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                    } else {
                                        // jika tidak ditemukan maka checklistnya aktif hapusnya mati
                                ?>
                                    <tr>
                                        <td align="center"><input type="checkbox" class="check-item" name="<?php echo 'id_gejala[]';?>" value="<?php echo $row['id_gejala']; ?>"></td>
                                        <td><?php echo $nomor++ ?></td>
                                        <td><?php echo $row['nama_gejala']; ?></td>
                                        <td align="center">
                                            <i class="fas fa-trash"></i>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>
                    </div>
                <input class="btn btn-primary" type="submit" name="update" value="Update">
                <a class="btn btn-danger" href="?page=rulesBase">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
