<?php

$host = 'localhost';
$db = ''; // Nama Database
$user = 'root';
$charset = 'utf8mb4';

// Buat Data Source nama (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

// Buat Objek koneksi PDO
$dbh = new PDO($dsn, $user, $pass, $opt);
?>