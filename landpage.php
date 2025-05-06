<?php

// Koneksi Database
include "./config/dbkoneksi.php";

// Tanggal Hari ini (Live)
$today = date('Y-m-d');

// Query
$areaQuery = "SELECT * FROM area_parkir";
$areaResult = $dbh->query($areaQuery);

// Simpan semua area dalam Array
$areas = [];
while ($area = $areaResult->fetch(PDO::FETCH_ASSOC)) {
    // Hitung Kendaraan parkir hari ini untuk setiap acara
    $area_id = $area['id'];
    $vehicleQuery = "SELECT COUNT(*) as total FROM transaksi WHERE area_parkir_id = $area_id AND tanggal = '$today'";
    $vehicleResult = $dbh->query($vehicleQuery);
    $vehicle = $vehicleResult->fetch(PDO::FETCH_ASSOC);

    $occupied = $vehicle['total'];
    $capacity = $area['kapasitas'];
    $remaining = $capacity - $occupied;

    if ($remaining <= 0) {
        $notification = "Parkiran Penuh";
        $warna = "bg-red-100 border border-red-400";
    } elseif ($remaining <= 10) {
        $notification = "Sisa $remaining slot tersedia";
        $warna = "bg-yellow-100 border border-yellow-400";
    } else {
        $notification = "Sisa $remaining slot tersedia";
        $warna = "bg-blue-100 border border-blue-400";
    }    

    $areas[] = [
        'nama' => $area['nama'],
        'vehicles_today' => $occupied, // nama field disamakan
        'notification' => $notification,
        'warna' => $warna
    ];
}

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Parkir Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">Parkir Kampus</div>
            <div>
                <a href="./Fitur/login.php" class="text-gray-700 hover:text-blue-500 px-3">Login</a>
                <a href="#features" class="text-gray-700 hover:text-blue-500 px-3">Fitur</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-500 text-white py-20">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Sistem Informasi Parkir Kampus STT Nurul Fikri</h1>
            <p class="text-lg md:text-xl mb-8">Kelola parkir lebih mudah, agit man, dan efisien</p>
            <a href="./Fitur/login.php" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Login Sekarang</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-gray-100 relative">
    <div class="max-w-7xl mx-auto px-4 relative">
        <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Fitur Unggulan</h2>
        
        <!-- Kontainer tombol di luar slider -->
        <button id="prevBtn" class="absolute -left-6 top-[60%] transform -translate-y-1/2 bg-blue-600 text-white p-3 rounded-full shadow-lg z-20 hover:bg-blue-700">
            &#10094;
        </button>

        <button id="nextBtn" class="absolute -right-6 top-[60%] transform -translate-y-1/2 bg-blue-600 text-white p-3 rounded-full shadow-lg z-20 hover:bg-blue-700">
            &#10095;
        </button>

        <!-- Slider -->
        <div id="slider" class="overflow-x-auto scroll-smooth no-scrollbar">
            <div class="flex space-x-6 min-w-max">
                <?php foreach ($areas as $area) : ?>
                    <div class="<?= $area['warna'] ?> flex-shrink-0 w-80 p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <h3 class="text-xl font-semibold mb-3 text-blue-600"><?= htmlspecialchars($area['nama']) ?></h3>
                        <p class="text-gray-600">Kendaraan parkir hari ini: <?= $area['vehicles_today'] ?></p>
                        <p class="text-gray-600 mt-2"><?= htmlspecialchars($area['notification']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<style>
  .no-scrollbar::-webkit-scrollbar {
    display: none;
  }
  .no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style>



<script>
  const slider = document.getElementById('slider');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  prevBtn.addEventListener('click', () => {
    slider.scrollBy({ left: -300, behavior: 'smooth' });
  });

  nextBtn.addEventListener('click', () => {
    slider.scrollBy({ left: 300, behavior: 'smooth' });
  });
</script>

    <!-- Footer -->
    <!-- Remove the container if you want to extend the Footer to full width. -->
<div class="container my-5">

<!-- Footer -->
<!-- Footer -->
<footer class="bg-gray-900 text-white mt-20">
  <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
    <!-- Company Info -->
    <div>
      <h6 class="uppercase font-bold mb-4">Parkir Kampus</h6>
      <p class="text-gray-400 text-sm">
        Sistem informasi parkir kampus STT Nurul Fikri yang memudahkan pengelolaan parkir secara efisien dan aman.
      </p>
    </div>

    <!-- Produk -->
    <div>
      <h6 class="uppercase font-bold mb-4">Produk</h6>
      <ul class="space-y-2 text-sm text-gray-400">
        <li><a href="#" class="hover:underline">Dashboard Admin</a></li>
        <li><a href="#" class="hover:underline">Manajemen Parkir</a></li>
        <li><a href="#" class="hover:underline">Laporan Transaksi</a></li>
        <li><a href="#" class="hover:underline">Integrasi Kampus</a></li>
      </ul>
    </div>

    <!-- Tautan Berguna -->
    <div>
      <h6 class="uppercase font-bold mb-4">Tautan Berguna</h6>
      <ul class="space-y-2 text-sm text-gray-400">
        <li><a href="#" class="hover:underline">Akun Anda</a></li>
        <li><a href="#" class="hover:underline">Bantuan</a></li>
        <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
        <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
      </ul>
    </div>

    <!-- Kontak -->
    <div>
      <h6 class="uppercase font-bold mb-4">Kontak</h6>
      <ul class="space-y-2 text-sm text-gray-400">
        <li><i class="fas fa-map-marker-alt mr-2"></i> Depok, Jawa Barat</li>
        <li><i class="fas fa-envelope mr-2"></i> info@sttnf.ac.id</li>
        <li><i class="fas fa-phone mr-2"></i> +62 812 3456 7890</li>
      </ul>
    </div>
  </div>

  <div class="text-center text-sm py-4 bg-gray-800 text-gray-400">
    &copy; <?= date('Y') ?> Parkir Kampus STT Nurul Fikri. All rights reserved.
  </div>
</footer>
<!-- Footer -->

</div>
<!-- End of .container -->
</body>
</html>
