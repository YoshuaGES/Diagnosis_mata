<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Hasil Konsultasi</strong></div>
  <div class="card-body">
<table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="20px">No</th>
        <th width="400px">Tanggal Konsultasi</th>
        <th width="400px">Nama Pasien</th>
        <th width="80px"></th>
      </tr>
    </thead>
    <tbody>
		<?php
            $nomor=1;
            $sql = "SELECT * FROM konsultasi ORDER BY tanggal DESC, nama ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $row['tanggal']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td align="center">
                    <a class="btn btn-primary" href="?page=konsultasi_dokter&action=detail&id=<?php echo $row['id_konsultasi']; ?>">
                        <i class="fas fa-list"></i>
                    </a>
                    <!-- ini buat detail -->
                </td>
            </tr>
        <?php
            }
            $conn->close();
        ?>
   </tbody>
</table>
</div>
</div>