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
    <section id="features" class="py-20 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Fitur Unggulan</h2>
                <div class="grid md:grid-cols-3 gap-10">
                    <?php foreach ($areas as $area) : ?>
                        <div class="<?= $area['warna'] ?> p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                            <h3 class="text-xl font-semibold mb-3 text-blue-600"><?= htmlspecialchars($area['nama']) ?></h3>
                            <p class="text-gray-600">Kendaraan parkir hari ini: <?= $area['vehicles_today'] ?></p>
                            <p class="text-gray-600 mt-2"><?= htmlspecialchars($area['notification']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
        </div>
    </section>

    <!-- Login Section -->
    <!-- <section id="login" class="py-20 bg-white">
        <div class="max-w-md mx-auto bg-gray-100 p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Login ke Akun Anda</h2>
            <form id="loginForm">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2" for="username">Username</label>
                    <input type="text" id="username" class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 mb-2" for="password">Password</label>
                    <input type="password" id="password" class="w-full px-4 py-2 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-400" required>
                </div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">Login</button>
            </form>
            <p id="loginMessage" class="text-center mt-4 text-red-500 hidden">Username atau Password salah!</p>
        </div>
    </section> -->

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <p>&copy; 2025 Sistem Informasi Parkir Kampus. All rights reserved.</p>
    </footer>

    <!-- JavaScript untuk Login -->
    <script>
        const loginForm = document.getElementById('loginForm');
        const loginMessage = document.getElementById('loginMessage');
    
        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Dummy data user
            const users = [
                { username: "admin", password: "1234", role: "admin" },
                { username: "user", password: "5678", role: "user" }
            ];
    
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
    
            // Cek apakah username dan password cocok
            const foundUser = users.find(user => user.username === username && user.password === password);
    
            if (foundUser) {
                if (foundUser.role === "admin") {
                    alert("Login Admin Berhasil!");
                    window.location.href = "dashboard.html"; // Redirect ke dashboard admin
                } else {
                    alert("Login User Berhasil! Anda tetap di halaman ini.");
                    document.getElementById('loginForm').reset();
                    loginMessage.classList.add('hidden');
                }
            } else {
                loginMessage.classList.remove('hidden');
            }
        });
    </script>
    

</body>
</html>
