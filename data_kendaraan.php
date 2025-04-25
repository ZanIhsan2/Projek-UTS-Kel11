<?php

require_once './db_koneksi.php'; 

$sql = 'SELECT * FROM pasien';
$getPasien =$dbh -> query ($sql);

include_once './layouts/top.php';
include_once './layouts/navbar.php';
include_once './layouts/sidebar.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kendaraan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data Kendaraan</h3>
        </div>
        <div class="card-body">
            <div class="card-body">
                <table class="table">
                    <thead>
                       <tr>
                           <th>No</th>
                           <th>Kode</th>
                           <th>Pemilik</th>
                           <th>No Polisi</th>
                           <th>Tahun Lahir</th>
                           <th>Deskripsi</th>
                           <th>ID Jenis</th>
                           <th>Action</th>                    
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getPasien as $key =>$pasien) : ?>
                        <tr>
                            <td><?= ++$key?></td>
                            <td><?= $kendaraan['merk']?></td>
                            <td><?= $kendaraan['pemilik']?></td>
                            <td><?= $kendaraan['nopol']?></td>
                            <td><?= $kendaraan['thn_beli']?></td>
                            <td><?= $kendaraan['deskripsi']?></td>
                            <td><?= $kendaraan['Jenis_kendaraan_id']?></td>
                            <td>
                              <a href="form_pasien.php?id=<?= $pasien ['id']?>" class="btn btn-sm btn-warning">Ubah</a>
                              <a href="proses_pasien.php?id=<?= $pasien ['id']?> &proses=hapus" class="btn btn-sm btn-danger">hapus</a>

                            </td>
                        <?php endforeach ?>
                        </tr>
                    </tbody> 
                </table>
            </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>

<?php
  include_once './layouts/bottom.php';
?>