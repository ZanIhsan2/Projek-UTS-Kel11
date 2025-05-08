<?php
include "./config/dbkoneksi.php";

$today = date('Y-m-d');
$areaQuery = "SELECT * FROM area_parkir";
$areaResult = $dbh->query($areaQuery);

while ($area = $areaResult->fetch(PDO::FETCH_ASSOC)) {
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

    $progress = ($capacity > 0) ? ($occupied / $capacity) * 100 : 0;
    $badge_class = 'bg-blue-500';
    $badge_label = 'Tersedia';

    if ($notification === 'Parkiran Penuh') {
        $badge_class = 'bg-red-500';
        $badge_label = 'Penuh';
    } elseif ($occupied >= $capacity - 10) {
        $badge_class = 'bg-yellow-500';
        $badge_label = 'Hampir Penuh';
    }

    echo '<div class="' . $warna . ' relative flex-shrink-0 w-80 p-6 rounded-lg shadow-md hover:scale-105 transform transition hover:shadow-xl">';
    echo '<h3 class="text-xl font-semibold mb-3 text-blue-600 truncate w-[85%]">' . htmlspecialchars($area['nama']) . '</h3>';
    echo '<p class="text-gray-600"><i class="fas fa-car mr-2 text-blue-600"></i>Kendaraan hari ini: ' . $occupied . '</p>';
    echo '<p class="text-gray-600 mt-2">' . htmlspecialchars($notification) . '</p>';
    echo '<div class="w-full bg-gray-300 rounded-full h-2.5 mt-4"><div class="bg-blue-600 h-2.5 rounded-full" style="width:' . $progress . '%"></div></div>';
    echo '<span class="inline-block mb-1 mt-4 px-4 py-2 text-xs font-bold rounded-full text-white ' . $badge_class . '">' . $badge_label . '</span>';
    echo '</div>';
}
