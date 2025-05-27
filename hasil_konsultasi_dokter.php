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
                                    $sql = "SELECT detail_penyakit.id_konsultasi, detail_penyakit.id_penyakit, penyakit.nama_penyakit,
                                                   penyakit.solusi, detail_penyakit.presentase
                                            FROM detail_penyakit INNER JOIN penyakit
                                            ON detail_penyakit.id_penyakit=penyakit.id_penyakit WHERE id_konsultasi='$id_konsultasi'
                                            ORDER BY presentase DESC";
                                    $result = $conn->query($sql);
                                    while($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $nomor++; ?></td>
                                        <td><?php echo $row['nama_penyakit']; ?></td>
                                        <td align="center"><?php echo $row['presentase'] . "%"; ?></td>
                                        <td><?php echo $row['solusi']; ?></td>
                                    </tr>
                                <?php
                                    }
                                    $conn->close();
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

