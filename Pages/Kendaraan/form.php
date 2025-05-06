<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Data Kendaraan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: rgb(137, 140, 146); /* gray-700 */
            background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
            background-repeat: repeat;
        }
    </style>
            </head>
            <body class="flex items-center justify-center min-h-screen">
            <?php
            require_once '../../config/dbkoneksi.php';
            $sqlJenis = "SELECT * FROM jenis";
            $rsJenis = $dbh->query($sqlJenis);
            $id = $_GET['id'] ?? '';
            $data = [];
            if ($id) {
                $sql = "SELECT * FROM kendaraan WHERE id = ?";
                $stmt = $dbh->prepare($sql);
                $stmt->execute([$id]);
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>

            <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
                <h2 class="text-xl font-bold mb-6"><?= $id ? 'Edit' : 'Tambah' ?> Data Kendaraan</h2>

                <a href="list.php" class="text-blue-600 hover:underline block mb-4">← Kembali ke Daftar Kendaraan</a>

                <form action="proses.php" method="POST">
                    <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Merek Kendaraan:</label>
                        <input type="text" name="merk" value="<?= $data['merk'] ?? '' ?>" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Pemilik:</label>
                        <input type="text" name="pemilik" value="<?= $data['pemilik'] ?? '' ?>" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Nopol:</label>
                        <input type="text" name="nopol" value="<?= $data['nopol'] ?? '' ?>" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Tahun Beli:</label>
                        <input type="text" name="tahun_beli" value="<?= $data['tahun_beli'] ?? '' ?>" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block font-semibold mb-1">Deskripsi:</label>
                        <input type="text" name="deskripsi" value="<?= $data['deskripsi'] ?? '' ?>" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div class="mb-6">
                        <label class="block font-semibold mb-1">Jenis Kendaraan:</label>
                        <select name="jenis_kendaraan_id" class="w-full border px-3 py-2 rounded">
                            <?php foreach ($rsJenis as $jenis): 
                                $selected = ($data['jenis_kendaraan_id'] ?? '') == $jenis['id'] ? 'selected' : '';
                            ?>
                                <option value="<?= $jenis['id'] ?>" <?= $selected ?>><?= $jenis['nama'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="flex justify-start gap-3">
                        <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Simpan
                        </button>
                        <a href="list.php" class="text-blue-600 hover:underline mt-2">Batal</a>
                    </div>
                </form>
            </div>

            </body>
            </html>
