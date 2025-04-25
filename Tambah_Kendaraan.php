<?php
require_once 'db_koneksi.php';

$data_jenis = $dbh->query("SELECT * FROM jenis ORDER BY nama ASC");

$kendaraan_id = $_GET['id'] ?? 0;
if ($kendaraan_id) {
    $sqlKendaraan = "SELECT * FROM kendaraan WHERE id = ?";
    $stmt = $dbh->prepare($sqlKendaraan);
    $stmt->execute([$kendaraan_id]);
    $tombol = "ubah";
    if ($stmt->rowCount()) {
        $kendaraan = $stmt->fetch();
    } else {
        header('location: ./data_kendaraan.php');
    }
} else {
    $tombol = "simpan";
}

include_once './layouts/top.php';
include_once './layouts/navbar.php';
include_once './layouts/sidebar.php';
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Kendaraan</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Kendaraan</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="proses_kendaraan.php">
                    <div class="form-group row">
                        <label for="merk" class="col-4 col-form-label">Merk</label>
                        <div class="col-8">
                            <input id="merk" name="merk" type="text" class="form-control" value="<?= $kendaraan['merk'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="pemilik" class="col-4 col-form-label">Pemilik</label>
                        <div class="col-8">
                            <input id="pemilik" name="pemilik" type="text" class="form-control" value="<?= $kendaraan['pemilik'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nopol" class="col-4 col-form-label">No Polisi</label>
                        <div class="col-8">
                            <input id="nopol" name="nopol" type="text" class="form-control" value="<?= $kendaraan['nopol'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="thn_beli" class="col-4 col-form-label">Tahun Beli</label>
                        <div class="col-8">
                            <input id="thn_beli" name="thn_beli" type="number" class="form-control" value="<?= $kendaraan['thn_beli'] ?? '' ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="deskripsi" class="col-4 col-form-label">Deskripsi</label>
                        <div class="col-8">
                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="3">"<?= $kendaraan['deskripsi'] ?? '' ?>">
