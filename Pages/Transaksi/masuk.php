<?php
include "../../config/dbkoneksi.php";
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nopol = $_POST['nopol'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $area_parkir_id = $_POST['area_parkir_id'];
    $jam_masuk = $_POST['jam_masuk'];
    $tanggal = date('Y-m-d');

    $stmt = $dbh->prepare("SELECT id FROM kendaraan WHERE nopol = ?");
    $stmt->execute([$nopol]);
    $kendaraan = $stmt->fetch();

    if ($kendaraan) {
        $kendaraan_id = $kendaraan['id'];
    } else {
        $stmt = $dbh->prepare("SELECT id FROM jenis WHERE nama = ?");
        $stmt->execute([$jenis_kendaraan]);
        $jenisRow = $stmt->fetch();
        if (!$jenisRow) {
            die("Jenis kendaraan tidak valid.");
        }
        $jenis_id = $jenisRow['id'];

        $stmt = $dbh->prepare("INSERT INTO kendaraan (merk, pemilik, nopol, tahun_beli, deskripsi, jenis_kendaraan_id) 
                               VALUES ('-', '-', ?, 0, '-', ?)");
        $stmt->execute([$nopol, $jenis_id]);
        $kendaraan_id = $dbh->lastInsertId();
    }

    $stmt = $dbh->prepare("INSERT INTO transaksi (tanggal, mulai, akhir, keterangan, biaya, kendaraan_id, area_parkir_id) 
                           VALUES (?, ?, NULL, 'Belum Selesai', 0, ?, ?)");
    $stmt->execute([$tanggal, $jam_masuk, $kendaraan_id, $area_parkir_id]);

    $_SESSION['notif'] = "Kendaraan berhasil masuk!";
    header("Location: list.php");
    exit();
}
?>

<h1>Parkiran Management</h1> <hr>
<h3>Form Masuk Kendaraan</h3>

<?php if (!empty($_SESSION['notif'])): ?>
    <div class="alert alert-success"><?= $_SESSION['notif']; unset($_SESSION['notif']); ?></div>
<?php endif; ?>

<?php
$stmtArea = $dbh->query("SELECT id, nama FROM area_parkir");
$areaList = $stmtArea->fetchAll();
?>

<form method="POST">

    <div>
        <a href="list.php"><- Kembali</a>
    </div>

    <div class="mb-3">
        <label>No Kendaraan</label>
        <input type="text" name="nopol" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Jenis Kendaraan</label>
        <select name="jenis_kendaraan" class="form-control" required>
            <option value="Mobil">Mobil</option>
            <option value="Motor">Sepeda Motor</option>
            <option value="Sepeda">Sepeda</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Jam Masuk</label>
        <input type="time" name="jam_masuk" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Area Parkir</label>
            <select name="area_parkir_id" class="form-control" required>
                <option value="">-- Pilih Area --</option>
            <?php foreach ($areaList as $area): ?>
                <option value="<?= $area['id'] ?>"><?= htmlspecialchars($area['nama']) ?></option>
            <?php endforeach; ?>
            </select>
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>