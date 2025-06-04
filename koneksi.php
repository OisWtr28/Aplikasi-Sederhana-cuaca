<?php
// Koneksi MySQL
$host = "localhost";
$user = "root";
$pass = "";
$db = "cuaca-app";

$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Load .env file
$env = parse_ini_file('.env');
$API_KEY_AMBON = $env['API_KEY_AMBON'];
$API_KEY_MANADO = $env['API_KEY_MANADO'];
?>
