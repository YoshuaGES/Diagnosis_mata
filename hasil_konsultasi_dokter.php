<!-- Proses menampilkan data hasil konsultasi dokter -->
<?php 
// ambil id dari parameter
$id_konsultasi=$_GET['id'];

$sql = "SELECT * FROM konsultasi WHERE id_konsultasi='$id_konsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- Tampilan Halaman Hasil Konsultasi -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                <div class="card-header bg-primary text-white border-dark"><strong>Hasil Konsultasi</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="">Nama Pasien</label>
                            <input type="text" class="form-control" value="<?php echo $row['nama']?>" name="nama" readonly>
                        </div>

                        <!-- Tabel gejala-gejala -->
                        <label for="">Gejala-gejala penyakit yang sudah dipilih:</label>
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
                                    $sql = "SELECT detail_konsultasi.id_konsultasi, detail_konsultasi.id_gejala, gejala.nama_gejala
                                            FROM detail_konsultasi INNER JOIN gejala
                                            ON detail_konsultasi.id_gejala=gejala.id_gejala WHERE id_konsultasi='$id_konsultasi'";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td><?php echo $row['nama_gejala']; ?></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>

                        <!-- Hasil konsultasi penyakit -->
                        <label for="">Hasil Konsultasi Penyakit</label>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th width="200px">Nama Penyakit</th>
                                <th width="50px">Presentase</th>
                                <th width="500px">Solusi</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $nomor=1;
                                    $sql = "SELECT * FROM penyakit";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        $id_penyakit = $row['id_penyakit'];
                                        $nama_penyakit = $row['nama_penyakit'];
                                        $solusi = $row['solusi'];

                                        // Ambil total gejala dari rules base
                                        $sql2 = "SELECT COUNT(*) as total FROM rules_base rb
                                                INNER JOIN rules_base_detail rbd ON rb.id_rules = rbd.id_rules
                                                WHERE rb.id_penyakit = '$id_penyakit'";
                                        $result2 = $conn->query($sql2);
                                        $total_gejala = $result2->fetch_assoc()['total'];

                                        // Ambil jumlah gejala yang cocok dengan konsultasi
                                        $sql3 = "SELECT COUNT(*) as cocok FROM rules_base rb
                                                INNER JOIN rules_base_detail rbd ON rb.id_rules = rbd.id_rules
                                                WHERE rb.id_penyakit = '$id_penyakit'
                                                AND rbd.id_gejala IN (
                                                    SELECT id_gejala FROM detail_konsultasi WHERE id_konsultasi = '$id_konsultasi'
                                                )";
                                        $result3 = $conn->query($sql3);
                                        $cocok = $result3->fetch_assoc()['cocok'];

                                        // Hitung presentase
                                        if ($total_gejala > 0) {
                                            $presentase = round(($cocok / $total_gejala) * 100);
                                        } else {
                                            $presentase = 0;
                                        }

                                        // Tampilkan hanya jika ada kecocokan
                                        if ($cocok > 0) {
                                            echo "<tr>
                                                    <td>" . $nomor . "</td>
                                                    <td>{$nama_penyakit}</td>
                                                    <td align='center'>{$presentase}%</td>
                                                    <td>{$solusi}</td>
                                                  </tr>";
                                                  $nomor++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                        <a class="btn btn-danger" href="?page=konsultasi_dokter">Kembali</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

