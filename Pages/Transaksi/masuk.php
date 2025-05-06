<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Masuk Kendaraan</title>
    <style>
        body {
            font-family: sans-serif;
            background-color:rgb(128, 130, 133);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: left;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 0.9em;
            font-weight: bold;
        }

        input[type="text"],
        input[type="time"],
        select {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }

        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="currentColor" viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 100%;
            background-position-y: 5px;
            padding-right: 20px;
        }

        .form-actions {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary:hover {
            background-color: #545b62;
        }

        .back-link {
            display: block;
            margin-bottom: 15px;
            color: #fff;
            text-decoration: none;
            font-size: 0.9em;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Masuk Kendaraan</h2>
        <a href="list.php" class="back-link">← Kembali</a>
        <form method="POST">
            <div class="form-group">
                <label for="nopol">Nomor Kendaraan:</label>
                <input type="text" id="nopol" name="nopol" placeholder="Masukkan nomor polisi" required>
            </div>
            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                <select id="jenis_kendaraan" name="jenis_kendaraan" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Mobil">Mobil</option>
                    <option value="Motor">Sepeda Motor</option>
                    <option value="Sepeda">Sepeda</option>
                </select>
            </div>
            <div class="form-group">
                <label for="jam_masuk">Jam Masuk:</label>
                <input type="time" id="jam_masuk" name="jam_masuk" required>
            </div>
            <div class="form-group">
                <label for="area_parkir_id">Area Parkir:</label>
                <select id="area_parkir_id" name="area_parkir_id" required>
                    <option value="">-- Pilih Area Parkir --</option>
                    <?php
                    include "../../config/dbkoneksi.php";
                    $stmtArea = $dbh->query("SELECT id, nama FROM area_parkir");
                    $areaList = $stmtArea->fetchAll();
                    foreach ($areaList as $area):
                    ?>
                        <option value="<?= $area['id'] ?>"><?= htmlspecialchars($area['nama']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
               <div class="form-actions">
                 <button type="submit" class="btn btn-primary">Simpan</button>
               <a href="list.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>