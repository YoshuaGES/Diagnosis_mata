<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Daftar Gejala Mata</strong></div>
  <div class="card-body">
  <a class="btn btn-primary mb-2" href="?page=gejala&action=tambah">Tambah</a>
  <table class="table table-bordered" id="myTable">
      <thead>
        <tr>
          <th width="20px">No</th>
          <th width="800px">Nama Gejala</th>
          <th width="100px"></th>
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
                  <td><?php echo $nomor++; ?></td>
                  <td><?php echo $row['nama_gejala']; ?></td>
                  <td align="center">
                      <a class="btn btn-warning" href="?page=gejala&action=update&id=<?php echo $row['id_gejala']; ?>">
                          <i class="far fa-edit"></i>

                      </a>
                      <!-- ini buat edit -->
                      <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=gejala&action=hapus&id=<?php echo $row['id_gejala']; ?>">
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