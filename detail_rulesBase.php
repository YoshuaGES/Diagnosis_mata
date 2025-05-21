<!-- Proses menampilkan data rules Base -->
<?php 
// ambil id dari parameter
$id_rules=$_GET['id'];

$sql = "SELECT rules_base.id_rules, rules_base.id_penyakit,
               penyakit.nama_penyakit, penyakit.keterangan
        FROM rules_base INNER JOIN penyakit ON rules_base.id_penyakit = penyakit.id_penyakit
        WHERE rules_base.id_rules='$id_rules'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<!-- Tampilan Halaman Detail -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Detail Rules Base</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Nama Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['nama_penyakit']?>" name="nama" readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" value="<?php echo $row['keterangan']?>" name="keterangan" readonly>
                        </div>

                        <!-- Tabel gejala-gejala -->
                        <label for="">Gejala-Gejala Penyakit:</label>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th width="700px">Nama Gejala</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor=1;
                                    $sql = "SELECT rules_base_detail.id_rules, rules_base_detail.id_gejala, gejala.nama_gejala
                                            FROM rules_base_detail INNER JOIN gejala
                                            ON rules_base_detail.id_gejala=gejala.id_gejala WHERE rules_base_detail.id_rules='$id_rules'";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td><?php echo $row['nama_gejala']; ?></td>
                                    </tr>
                                <?php
                                    }
                                    $conn->close();
                                ?>
                            </tbody>
                        </table>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=rulesBase">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>