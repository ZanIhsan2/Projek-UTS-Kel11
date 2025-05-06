<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($_GET['id']) ? 'Edit' : 'Tambah' ?> Data Jenis</title>
    <style>
        body {
            background-color: rgb(155, 153, 153); /* Warna dasar */
            background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
            background-repeat: repeat;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            background-color:rgb(255, 255, 255);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .mb-4 {
            margin-bottom: 15px;
        }

        .text-right {
            text-align: right;
        }

        .text-blue-500 {
            color: rgb(58, 120, 219);
        }

        .text-blue-500:hover {
            color: #2563eb;
        }

        .block {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .w-full {
            width: 100%;
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem;
        }

        .py-2 {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .mt-2 {
            margin-top: 0.5rem;
        }

        .border {
            border-width: 1px;
            border-style: solid;
            border-color: #ccc;
        }

        .rounded-md {
            border-radius: 0.375rem;
        }

        .focus\:outline-none:focus {
            outline: 2px solid transparent;
            outline-offset: 2px;
        }

        .focus\:ring-2:focus {
            --ring-offset-shadow: 0 0 #0000;
            --ring-shadow: 0 0 #0000;
            box-shadow: var(--ring-offset-shadow), var(--ring-shadow), var(--ring-inset) 0 0 0 calc(2px) var(--ring-color, #3b82f6);
        }

        .bg-blue-500 {
            background-color: #3b82f6;
        }

        .text-white {
            color: #fff;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .hover\:bg-blue-600:hover {
            background-color: #2563eb;
        }

        .mt-6 {
            margin-top: 1.5rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .text-gray-500 {
            color: rgb(68, 78, 97);
        }

        .text-gray-700 {
            color: rgb(96, 135, 189);
        }

        .text-gray-800 {
            color: #1f2937;
        }

        .hover\:text-gray-700:hover {
            color: rgb(72, 80, 94);
        }
    </style>
      </head>
         <body>
            <?php
                require_once '../../config/dbkoneksi.php';

                $id = $_GET['id'] ?? '';
                $data = [];
                if ($id) {
                    $sql = "SELECT * FROM jenis WHERE id = ?";
                    $stmt = $dbh->prepare($sql);
                    $stmt->execute([$id]);
                    $data = $stmt->fetch(PDO::FETCH_ASSOC);
                }
                ?>

                <div class="container">
                    <h2 class="text-2xl font-semibold text-center text-gray-800"><?= $id ? 'Edit' : 'Tambah' ?> Data Jenis</h2>

                    <div class="mb-4 text-right">
                        <a href="list_jenis.php" class="text-blue-500 hover:text-blue-700">← Kembali ke Daftar Jenis</a>
                    </div>
                    <form action="proses_jenis.php" method="POST">
                        <input type="hidden" name="id_edit" value="<?= $data['id'] ?? '' ?>">
                        <div class="mb-4">
                            <label for="nama" class="block text-gray-700 font-medium">Jenis Kendaraan</label>
                            <input type="text" name="nama" id="nama" value="<?= $data['nama'] ?? '' ?>" class="w-full px-4 py-2 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="flex items-center justify-between mt-6">
                            <button type="submit" name="proses" value="<?= $id ? 'Update' : 'Simpan' ?>" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-600 focus:outline-none">
                                <?= $id ? 'Update' : 'Simpan' ?>
                            </button>
                            <a href="list_jenis.php" class="text-gray-500 hover:text-gray-700">Batal</a>
                        </div>
                    </form>
                </div>
                </body>
                </html>
