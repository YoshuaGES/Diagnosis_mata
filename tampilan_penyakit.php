<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Daftar Penyakit Mata</strong></div>
  <div class="card-body">
<a class="btn btn-primary mb-2" href="?page=penyakit&action=tambah">Tambah</a>
<table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="10px">No</th>
        <th width="130px">Nama Penyakit</th>
        <th width="400px">Keterangan Penyakit</th>
        <th width="300px">Solusi</th>
        <th width="100px"></th>
      </tr>
    </thead>
    <tbody>
		<?php
            $nomor=1;
            $sql = "SELECT*FROM penyakit ORDER BY nama_penyakit ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $row['nama_penyakit']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td><?php echo $row['solusi']; ?></td>
                <td align="center">
                    <a class="btn btn-warning" href="?page=penyakit&action=update&id=<?php echo $row['id_penyakit']; ?>">
                        <i class="far fa-edit"></i>

                    </a>
                    <!-- ini buat edit -->
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=penyakit&action=hapus&id=<?php echo $row['id_penyakit']; ?>">
                        <i class="fas fa-trash"></i>

                    </a>
                    <!-- ini buat hapus -->
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