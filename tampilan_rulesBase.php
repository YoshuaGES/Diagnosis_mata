<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Rules Base</strong></div>
  <div class="card-body">
<a class="btn btn-primary mb-2" href="?page=rulesBase&action=tambah">Tambah</a>
<table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th width="20px">No</th>
        <th width="120px">Nama Penyakit</th>
        <th width="700px">Keterangan Penyakit</th>
        <th width="150px"></th>
      </tr>
    </thead>
    <tbody>
		<?php
            $nomor=1;
            $sql = "SELECT rules_base.id_rules, rules_base.id_penyakit, 
                           penyakit.nama_penyakit, penyakit.keterangan 
                    FROM   rules_base INNER JOIN penyakit
                    ON     rules_base.id_penyakit = penyakit.id_penyakit
                    ORDER BY nama_penyakit ASC";
            $result = $conn->query($sql);
            while($row = $result->fetch_assoc()) {
        ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $row['nama_penyakit']; ?></td>
                <td><?php echo $row['keterangan']; ?></td>
                <td align="center">
                    <a class="btn btn-primary" href="?page=rulesBase&action=detail&id=<?php echo $row['id_rules']; ?>">
                        <i class="fas fa-list"></i>
                    </a>
                    <!-- ini buat detail -->
                    <a class="btn btn-warning" href="?page=rulesBase&action=update&id=<?php echo $row['id_rules']; ?>">
                        <i class="far fa-edit"></i>
                    </a>
                    <!-- ini buat edit -->
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=rulesBase&action=hapus&id=<?php echo $row['id_rules']; ?>">
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