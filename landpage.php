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
        $warna = "bg-red-200 border border-red-400";
    } elseif ($remaining <= 10) {
        $notification = "Sisa $remaining slot tersedia";
        $warna = "bg-yellow-200 border border-yellow-400";
    } else {
        $notification = "Sisa $remaining slot tersedia";
        $warna = "bg-blue-200 border border-blue-400";
    }

    $areas[] = [
        'nama' => $area['nama'],
        'vehicles_today' => $occupied,
        'kapasitas' => $capacity,
        'notification' => $notification,
        'warna' => $warna
    ];
}

// Logika untuk data Statistik
$total_area = count($areas);
$total_kapasitas = array_sum(array_column($areas, 'kapasitas'));
$total_kendaraan = array_sum(array_column($areas, 'vehicles_today'));
?>


<!DOCTYPE html>
<html lang="id" style="scroll-behavior: smooth;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Parkir Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar -->
    <nav class="bg-white/40 backdrop-blur-md shadow-md fixed top-0 w-full h-16 z-50">
      <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
        <div class="text-xl font-bold text-blue-600">Parkir Kampus</div>

        <!-- Tombol Hamburger -->
        <button id="menu-toggle" class="md:hidden text-gray-600 focus:outline-none">
          <i class="fas fa-bars text-xl"></i>
        </button>

        <!-- Menu Navigasi -->
        <div id="menu" class="hidden md:flex md:items-center md:space-x-6 absolute md:static top-16 left-0 w-full md:w-auto bg-white md:bg-transparent shadow-md md:shadow-none px-4 py-4 md:p-0 transition-all duration-300 flex-col md:flex-row space-y-4 md:space-y-0 z-40">
          
          <!-- Link Navigasi -->
          <div class="flex flex-col md:flex-row md:items-center md:space-x-4 w-full md:w-auto">
            <a href="#info" class="text-gray-700 hover:text-blue-500">Informasi</a>
            <a href="#features" class="text-gray-700 hover:text-blue-500">Fitur</a>
            <a href="#about" class="text-gray-700 hover:text-blue-500">Tentang</a>
            <a href="./Fitur/login.php" class="text-gray-700 hover:text-blue-500">Login</a>
          </div>

          <!-- Form Pencarian -->
          <div class="flex flex-col md:flex-row md:items-center md:space-x-2 w-full md:w-auto">
            <input type="text" id="searchArea" placeholder="Cari area parkir..." class="px-4 py-2 border border-gray-300 rounded w-full md:w-64 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" />
            <button id="searchBtn" class="flex items-center justify-center bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition w-full md:w-auto mt-2 md:mt-0">
              <i class="fas fa-search mr-2"></i>Cari
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-blue-500 text-white pt-20 md:pt-24 pb-12 md:pb-20">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di Sistem Informasi Parkir Kampus STT Nurul Fikri</h1>
            <p class="text-lg md:text-xl mb-8">Sistem pintar untuk manajemen parkir kampus yang efisien dan aman</p>
            <a href="./Fitur/login.php" class="bg-white text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-gray-100 transition">Login Sekarang</a>
        </div>
    </section>

    <section id="about" class="bg-white pt-20 md:pt-24 pb-12 md:pb-20">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl mb-12">About</h1>
        <p class="text-lg md:text-xl mt-12">
            Sistem Informasi Parkir Kampus adalah platform digital yang dirancang untuk mempermudah pengelolaan dan pemantauan aktivitas parkir di lingkungan kampus. Sistem ini bertujuan untuk menciptakan pengalaman parkir yang tertib, efisien, dan transparan bagi seluruh civitas akademika, termasuk mahasiswa, dosen, dan staf kampus.
        </p>
    </div>
    </section>


    <h2 id="info" class="py-16 text-3xl font-bold text-center text-gray-800">Informasi Area Parkir</h2>

    <!-- Informasi Singkat Parkiran -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10 text-center text-gray-800 mt-2">
      <div class="bg-white shadow rounded-lg p-5">
        <h4 class="text-lg font-semibold">Total Area</h4>
        <p class="text-2xl font-bold text-blue-600"><?= $total_area ?></p>
      </div>
      <div class="bg-white shadow rounded-lg p-5">
        <h4 class="text-lg font-semibold">Total Kapasitas</h4>
        <p class="text-2xl font-bold text-green-600"><?= $total_kapasitas ?></p>
      </div>
      <div class="bg-white shadow rounded-lg p-5">
        <h4 class="text-lg font-semibold">Kendaraan Hari Ini</h4>
        <p class="text-2xl font-bold text-red-600"><?= $total_kendaraan ?></p>
      </div>
    </div>

    <!-- Features Section -->
    <section id="features" class="py-4 bg-gray-100 relative">
        <div class="max-w-7xl mx-auto px-4 relative">

            <!-- Filter Kapasitas Area Parkir -->
            <div class="mb-6 flex justify-center">
              <select id="statusFilter" class="px-4 py-2 border border-gray-300 rounded w-full md:w-1/3 shadow-sm">
                <option value="">Semua Status</option>
                <option value="Tersedia">Tersedia</option>
                <option value="Hampir Penuh">Hampir Penuh</option>
                <option value="Penuh">Penuh</option>
              </select>
            </div>

            <!-- Legend -->
            <div class="flex justify-center gap-6 mb-6 text-sm">
              <span class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-blue-500"></span> Tersedia
              </span>
              <span class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-yellow-500"></span> Hampir Penuh
              </span>
              <span class="flex items-center gap-2">
                <span class="w-3 h-3 rounded-full bg-red-500"></span> Penuh
              </span>
            </div>

            <style>
              .no-scrollbar::-webkit-scrollbar {
                  display: none;
              }
              .no-scrollbar {
                  -ms-overflow-style: none;
                  scrollbar-width: none;
              }
            </style>

            <div id="sliderWrapper" class="relative">
              <!-- Slider -->
              <div id="slider" class="overflow-x-auto scroll-smooth no-scrollbar">
                <div id="areaCards" class="flex space-x-6 min-w-max">
                    <!-- Data akan ke Refresh setiap 70 detik -->
                </div>
              </div>
              <!-- Tombol di kiri dan kanan slider -->
              <button id="prevBtn" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700">
                &#10094;
              </button>
              <button id="nextBtn" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700">
                &#10095;
              </button>
            </div>
        </div>
    </section>

    <!-- JavaScript -->

    <!-- Toogle atau Hamburger menu -->
    <script>
      document.getElementById("menu-toggle").addEventListener("click", function () {
        const menu = document.getElementById("menu");
        menu.classList.toggle("hidden");
      });
    </script>

    <!-- Slider -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        function initSlider() {
            const slider = document.getElementById("slider");
            const prevBtn = document.getElementById("prevBtn");
            const nextBtn = document.getElementById("nextBtn");

            // Pastikan elemen-elemen ditemukan
            if (!slider || !prevBtn || !nextBtn) {
                console.error("Elemen slider atau tombol tidak ditemukan!");
                return;
            }

            let scrollAmount = 0;
            const scrollStep = 320;
            const maxScroll = () => slider.scrollWidth - slider.clientWidth;

            function slideNext() {
                scrollAmount = (scrollAmount < maxScroll()) ? scrollAmount + scrollStep : 0;
                slider.scrollTo({ left: scrollAmount, behavior: "smooth" });
            }

            function slidePrev() {
                scrollAmount = (scrollAmount > 0) ? scrollAmount - scrollStep : maxScroll();
                slider.scrollTo({ left: scrollAmount, behavior: "smooth" });
            }

            nextBtn.addEventListener("click", slideNext);
            prevBtn.addEventListener("click", slidePrev);

            // Menjalankan fungsi slideNext secara otomatis setiap 4 detik
            setInterval(slideNext, 3500);
          }

          initSlider();
        });
    </script>


    <!-- Pencarian -->
    <script>
      const searchInput = document.getElementById('searchArea');
      const searchBtn = document.getElementById('searchBtn');

      let debounceTimer;

      function filterAndScroll() {
        const keyword = searchInput.value.toLowerCase();
        const cards = document.querySelectorAll('#slider .flex > div');
        let foundMatch = false;

        cards.forEach(card => {
          const nama = card.querySelector('h3').innerText.toLowerCase();
          if (nama.includes(keyword)) {
            card.style.display = 'block';
            foundMatch = true;
          } else {
            card.style.display = 'none';
          }
        });

        if (foundMatch) {
          document.getElementById('features').scrollIntoView({ behavior: 'smooth' });
        }
      }

      // Debounce saat ngetik
      searchInput.addEventListener('keyup', function (e) {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
          filterAndScroll();
        }, 1000);
      });

      // Tekan Enter = langsung cari
      searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
          clearTimeout(debounceTimer);
          filterAndScroll();
        }
      });

      // Klik tombol cari = langsung cari
      searchBtn.addEventListener('click', function () {
        clearTimeout(debounceTimer);
        filterAndScroll();
      });
    </script>


    <!-- Filter Area Parkir -->
    <script>
      document.getElementById('statusFilter').addEventListener('change', function () {
        const selectedStatus = this.value.toLowerCase();
        const cards = document.querySelectorAll('#slider .flex > div');
        cards.forEach(card => {
          const badge = card.querySelector('span').innerText.toLowerCase();
          if (!selectedStatus || badge.includes(selectedStatus)) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    </script>

    <!-- Refres Data -->
    <script>
        async function fetchAreaData() {
          try {
            const res = await fetch('data.php'); // ⬅️ Panggil file baru ini
            const html = await res.text();
            document.getElementById('areaCards').innerHTML = html;
          } catch (err) {
            console.error('Gagal mengambil data area:', err);
          }
        }

        // Panggil pertama kali
        fetchAreaData();

        // Lalu refresh otomatis setiap 70 detik
        setInterval(fetchAreaData, 70000);
    </script>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h6 class="uppercase font-bold mb-4">Parkir Kampus</h6>
                <p class="text-gray-400 text-sm">
                    Sistem informasi parkir kampus STT Nurul Fikri yang memudahkan pengelolaan parkir secara efisien dan aman.
                </p>
            </div>
            <div>
                <h6 class="uppercase font-bold mb-4">Produk</h6>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:underline">Dashboard Admin</a></li>
                    <li><a href="#" class="hover:underline">Manajemen Parkir</a></li>
                    <li><a href="#" class="hover:underline">Laporan Transaksi</a></li>
                    <li><a href="#" class="hover:underline">Integrasi Kampus</a></li>
                </ul>
            </div>
            <div>
                <h6 class="uppercase font-bold mb-4">Tautan Berguna</h6>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:underline">Akun Anda</a></li>
                    <li><a href="#" class="hover:underline">Bantuan</a></li>
                    <li><a href="#" class="hover:underline">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:underline">Kebijakan Privasi</a></li>
                </ul>
            </div>
            <div>
                <h6 class="uppercase font-bold mb-4">Kontak</h6>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><i class="fas fa-map-marker-alt mr-2"></i> Depok, Jawa Barat</li>
                    <li><i class="fas fa-envelope mr-2"></i> info@sttnf.ac.id</li>
                    <li><i class="fas fa-phone mr-2"></i> +62 821 1662 7234</li>
                </ul>
            </div>
        </div>
        <div class="text-center text-sm py-4 bg-gray-800 text-gray-400">
            &copy; <?= date('Y') ?> Parkir Kampus STT Nurul Fikri. All rights reserved.
        </div>
    </footer>
</body>
</html>
