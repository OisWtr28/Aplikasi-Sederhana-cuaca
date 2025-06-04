<?php
include 'koneksi.php';

$kota = htmlspecialchars($_POST['kota']);

if ($kota == 'ambon') {
    $apiKey = $API_KEY_AMBON;
} elseif ($kota == 'manado') {
    $apiKey = $API_KEY_MANADO;
} else {
    die("Kota tidak valid.");
}

$url = "https://api.openweathermap.org/data/2.5/weather?q={$kota}&appid={$apiKey}&units=metric";
$response = file_get_contents($url);
$data = json_decode($response, true);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cuaca Saat Ini</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background-image: url('img/awan.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #444;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
<?php
if ($data['cod'] == 200) {
    $suhu = $data['main']['temp'];
    $kondisi = $data['weather'][0]['description'];

    $stmt = $koneksi->prepare("INSERT INTO riwayat(kota, suhu, kondisi) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $kota, $suhu, $kondisi);
    $stmt->execute();
    $stmt->close();

    echo "<h2>📍 Cuaca saat ini " . ucfirst($kota) . "</h2>";
    echo "<p>Suhu: $suhu °C</p>";
    echo "<p>Kondisi: $kondisi</p>";
    echo "<a href='index.php'>🔙 Kembali</a>";
} else {
    echo "<p>❌ Data cuaca tidak ditemukan.</p>";
    echo "<a href='index.php'>Coba Lagi</a>";
}
?>
</div>
</body>
</html>
