<?php

// Koneksi Database
include "./config/dbkoneksi.php";

require_once './Layouts/top.php';
require_once './Layouts/navbar.php';
require_once './Layouts/sidebar.php';

// Ambil data total statistik untuk menampilkan jumlah
$jmlh_transaksi = $dbh->query("SELECT COUNT(*) FROM transaksi")-> fetchColumn();
$jmlh_kampus = $dbh->query("SELECT COUNT(*) FROM kampus")-> fetchColumn();
$jmlh_parkir = $dbh->query("SELECT COUNT(*) FROM area_parkir")-> fetchColumn();
$jmlh_kendaraan = $dbh->query("SELECT COUNT(*) FROM kendaraan")-> fetchColumn();
$jmlh_jenis = $dbh->query("SELECT COUNT(*) FROM jenis")-> fetchColumn();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1>Dashboard</h1>
<style>
  body {
    background-image: url('dist/img/parkir.jpg'); /* Ganti path sesuai lokasi gambarmu */
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    image-rendering: auto; /* pastikan tidak blur */
    -webkit-backface-visibility: hidden;
    -webkit-transform: translate3d(0,0,0); /* trick rendering lebih tajam */
  }

  .content-wrapper {
    background-color: rgba(71, 109, 10, 0); /* Biar isi tetap terbaca */
    padding: 20px;
    border-radius: 10px;
  }
</style>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <!-- /.card -->
<!-- Kotak dashboard di bawah blank page -->
<div class="row mt-3">
  <!-- Kotak 1: Jumlah Kendaraan -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3><?= $jmlh_kendaraan ?></h3>
        <p>Data Kendaraan</p>
      </div>
      <div class="icon">
        <i class="fas fa-car"></i>
      </div>
      <a href="data_kendaraan.php" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <!-- Kotak 2: Jumlah Jenis Kendaraan -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3><?= $jmlh_jenis ?></h3>
        <p>Jenis Kendaraan</p>
      </div>
      <div class="icon">
        <i class="nav-icon fas fa-th-list"></i>
      </div>
      <a href="Jenis_Kendaraan.php" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <!-- Kotak 3: Jumlah Area Parkir -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-purple">
      <div class="inner">
        <h3><?= $jmlh_parkir ?></h3>
        <p>Area Parkir</p>
      </div>
      <div class="icon">
        <i class="nav-icon fas fa-map-marker-alt"></i>
      </div>
      <a href="Area_Parkir.php" class="small-box-footer">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
</div>
  <!-- Kotak 4: Jumlah Transaksi Kampus -->
  <div class="col-lg-3 col-6">
    <div class="small-box" style="background-color:rgb(85, 110, 133); color: white;">
      <div class="inner">
        <h3><?= $jmlh_transaksi ?></h3>
        <p>Transaksi Parkir</p>
      </div>
      <div class="icon">
        <i class="nav-icon fas fa-exchange-alt"></i>
      </div>
      <a href="./Pages/Transaksi/list.php" class="small-box-footer text-white">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>

  <!-- Kotak 5: Data Kampus -->
  <div class="col-lg-3 col-6">
    <div class="small-box" style="background-color:rgb(133, 43, 156); color: white;">
      <div class="inner">
        <h3><?= $jmlh_kampus ?></h3>
        <p>Data Kampus</p>
      </div>
      <div class="icon">
        <i class="nav-icon fas fa-university"></i>
      </div>
      <a href="./Pages/Kampus/list.php" class="small-box-footer text-white">
        Lihat <i class="fas fa-arrow-circle-right"></i>
      </a>
    </div>
  </div>
    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->
<?php
require_once './Layouts/bottom.php';
?>