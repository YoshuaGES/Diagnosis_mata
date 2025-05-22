<!-- Proses konsultasi-->
<?php
date_default_timezone_set("Asia/Jakarta");

if(isset($_POST['proses'])){

    //1. Mengambil data dari form
    $nama_pasien=$_POST['nama_pasien'];
    $tgl=date("Y/m/d");

    //proses simpan Konsultasi
    $sql = "INSERT INTO konsultasi VALUES (Null,'$tgl','$nama_pasien')";
    mysqli_query($conn,$sql);

    //Mengambil ID gejala
    $id_gejala=$_POST['id_gejala'];

    //proses mengambil data konsultasi
    $sql = "SELECT * FROM konsultasi ORDER BY id_konsultasi DESC";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id_konsultasi = $row['id_konsultasi'];
        
    //proses simpan detail_konsultasi
    $jumlah = count($id_gejala);
    $i=0;
    while($i < $jumlah){
        $id_gejalaNew = $id_gejala[$i];
        $sql = "INSERT INTO detail_konsultasi VALUES ($id_konsultasi,'$id_gejalaNew')";
        mysqli_query($conn,$sql);
        $i++;
    }

    //mengambil data dari tabel penyakit untuk mengecek di rules base
    $sql = "SELECT*FROM penyakit";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {

        $id_penyakit = $row['id_penyakit'];
        $nama_penyakit = $row['nama_penyakit'];
        $jumlah_data=0;

        //mencari jumlah gejala di rules base berdasarkan penyakitnya
        $sql2 = "SELECT COUNT(id_penyakit) AS jlm_gejala
                 FROM rules_base INNER JOIN rules_base_detail
                 ON rules_base.id_rules=rules_base_detail.id_rules
                 WHERE id_penyakit='$id_penyakit'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $jlm_gejala = $row2['jlm_gejala'];

        //mencari gejala berdasarkan rules_base
        $sql3 = "SELECT id_penyakit, id_gejala
                 FROM rules_base INNER JOIN rules_base_detail
                 ON rules_base.id_rules=rules_base_detail.id_rules
                 WHERE id_penyakit='$id_penyakit'";
        $result3 = $conn->query($sql3);
        while($row3 = $result3->fetch_assoc()){

            $id_gejala1=$row3['id_gejala'];

            //membandingkan apakah yg dipilih pada konsultasi sesuai
            $sql4 = "SELECT id_gejala FROM detail_konsultasi
                     WHERE id_konsultasi='$id_konsultasi' AND id_gejala='$id_gejala1'";
            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) {
                $jumlah_data+=1;
            }
        }

        // mencari presentase
        if($jlm_gejala>0){
            $peluang = round(($jumlah_data/$jlm_gejala)*100,2);
        } else {
            $peluang = 0;
        }

        //simpan data detail_penyakit
        if($peluang>0){
            $sql = "INSERT INTO detail_penyakit VALUES ($id_konsultasi,'$id_penyakit','$peluang')";
            mysqli_query($conn,$sql);
        }

        // header("Location:?page=konsultasi&action=hasil&id_konsultasi=$id_konsultasi");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiForm()">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Halaman Konsultasi Penyakit</strong></div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Pasien</label>
                        <input type="text" class="form-control" name="nama_pasien" maxlength="50" required>
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

                <input class="btn btn-primary" type="submit" name="proses" value="Proses">
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">

    function validasiForm(){

        // Validasi gejala yang belum dipilih
        let checkbox = document.getElementsByName('<?php echo 'id_gejala[]'; ?>');

        let check = false;

        for(let i=0;i<checkbox.length;i++){
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