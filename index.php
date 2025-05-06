<?php
// Koneksi Database
include "./config/dbkoneksi.php";

// Template
require_once './Layouts/top.php';
require_once './Layouts/navbar.php';
require_once './Layouts/sidebar.php';

<<<<<<< HEAD
// Ambil data jumlah dari masing-masing tabel
$jmlh_transaksi = $dbh->query("SELECT COUNT(*) FROM transaksi")->fetchColumn();
$jmlh_kampus = $dbh->query("SELECT COUNT(*) FROM kampus")->fetchColumn();
$jmlh_parkir = $dbh->query("SELECT COUNT(*) FROM area_parkir")->fetchColumn();
$jmlh_kendaraan = $dbh->query("SELECT COUNT(*) FROM kendaraan")->fetchColumn();
$jmlh_jenis = $dbh->query("SELECT COUNT(*) FROM jenis")->fetchColumn();
=======
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Ambil data total statistik untuk menampilkan jumlah
$jmlh_transaksi = $dbh->query("SELECT COUNT(*) FROM transaksi")-> fetchColumn();
$jmlh_kampus = $dbh->query("SELECT COUNT(*) FROM kampus")-> fetchColumn();
$jmlh_parkir = $dbh->query("SELECT COUNT(*) FROM area_parkir")-> fetchColumn();
$jmlh_kendaraan = $dbh->query("SELECT COUNT(*) FROM kendaraan")-> fetchColumn();
$jmlh_jenis = $dbh->query("SELECT COUNT(*) FROM jenis")-> fetchColumn();
>>>>>>> 2984e2b6d718f657fbaca3f178b1190bff1b62be
?>

<style>
  body {
    background-image: url('dist/img/parkir.jpg'); 
    background-size: cover;
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    image-rendering: auto;
    -webkit-backface-visibility: hidden;
    -webkit-transform: translate3d(0,0,0);
  }

  .content-wrapper {
    background-color: rgba(27, 24, 24, 0.5);
    padding: 20px;
    border-radius: 10px;
  }
</style>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div>
      </div>
    </div>
  </section>

  <!-- Kartu Statistik -->
  <section class="content">
    <div class="container-fluid">
      <!-- Baris pertama -->
      <div class="row">
        <!-- Kendaraan -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3><?= $jmlh_kendaraan ?></h3>
              <p>Data Kendaraan</p>
            </div>
            <div class="icon">
              <i class="fas fa-car"></i>
            </div>
            <a href="./Pages/Kendaraan/list.php" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Jenis Kendaraan -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $jmlh_jenis ?></h3>
              <p>Jenis Kendaraan</p>
            </div>
            <div class="icon">
              <i class="fas fa-th-list"></i>
            </div>
            <a href="./Pages/jenis/list_jenis.PHP" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- Area Parkir -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?= $jmlh_parkir ?></h3>
              <p>Area Parkir</p>
            </div>
            <div class="icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <a href="./pages/Area_Parkir/list_area.php" class="small-box-footer">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>

      <!-- Baris kedua -->
      <div class="row">
        <!-- Transaksi Parkir -->
        <div class="col-lg-6 col-md-6 mb-4">
          <div class="small-box" style="background-color:rgb(85, 110, 133); color:white;">
            <div class="inner">
              <h3><?= $jmlh_transaksi ?></h3>
              <p>Transaksi Parkir</p>
            </div>
            <div class="icon">
              <i class="fas fa-exchange-alt"></i>
            </div>
            <a href="./Pages/Transaksi/list.php" class="small-box-footer text-white">Lihat <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- Kampus -->
        <div class="col-lg-6 col-md-6 mb-4">
          <div class="small-box" style="background-color:rgb(133, 43, 156); color:white;">
            <div class="inner">
              <h3><?= $jmlh_kampus ?></h3>
              <p>Data Kampus</p>
            </div>
              <div class="icon">
                <i class="fas fa-university"></i>
                    </div>
                    <a href="./Pages/Kampus/list.php" class="small-box-footer text-white">Lihat <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>

<?php require_once './Layouts/bottom.php'; ?>
