<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $id ? 'Edit' : 'Tambah' ?> Data Area Parkir</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: rgb(133, 127, 127);
            background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
            background-repeat: repeat;
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
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn-group {
            margin-top: 20px;
            text-align: right;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-left: 10px;
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
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<?php
require_once '../../config/dbkoneksi.php';

        $id = $_GET['id'] ?? '';
        $data = [];
        if ($id) {
            $sql = "SELECT * FROM area_parkir WHERE id = ?";
            $stmt = $dbh->prepare($sql);
            $stmt->execute([$id]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $sqlKampus = "SELECT id, nama FROM kampus";
        $stmtKampus = $dbh->query($sqlKampus);
        $kampusList = $stmtKampus->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="container">
            <h2><?= $id ? 'Edit' : 'Tambah' ?> Data Area Parkir</h2>
            <form method="POST" action="proses_area.php">
                <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">
                <div class="form-group">
                    <label for="nama">Nama Parkiran:</label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="kapasitas">Kapasitas:</label>
                    <input type="number" id="kapasitas" name="kapasitas" value="<?= htmlspecialchars($data['kapasitas'] ?? '') ?>" required>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan:</label>
                    <input type="text" id="keterangan" name="keterangan" value="<?= htmlspecialchars($data['keterangan'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="kampus_id">Kampus:</label>
                    <select id="kampus_id" name="kampus_id" required>
                        <option value="">-- Pilih Kampus --</option>
                        <?php foreach ($kampusList as $kampus): ?>
                            <option value="<?= $kampus['id'] ?>" <?= ($data['kampus_id'] ?? '') == $kampus['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kampus['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="btn-group">
                    <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>" class="btn btn-primary"><?= $id ? 'Update' : 'Simpan' ?></button>
                    <a href="list_area.php" class="btn btn-secondary">Batal</a>
                </div>
            </form>
            <a href="list_area.php" class="back-link">← Kembali ke Daftar Area Parkir</a>
        </div>

        </body>
        </html>
