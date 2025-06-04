<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>🌤️ Cuaca Ambon & Manado - Aplikasi Sederhana</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>🔍 Cek Cuaca: Ambon atau Manado</h2>
    <form action="proses.php" method="POST">
        <select name="kota" required>
            <option value="">-- Pilih Kota --</option>
            <option value="ambon">Ambon</option>
            <option value="manado">Manado</option>
        </select>
        <button type="submit">🌦️ Cek Cuaca</button>
    </form>

    <h3>📜 Riwayat Pencarian Cuaca</h3>
    <table>
        <tr>
            <th>Kota</th>
            <th>Suhu (°C)</th>
            <th>Kondisi</th>
            <th>Waktu</th>
        </tr>
        <?php
        $q = $koneksi->query("SELECT * FROM riwayat ORDER BY waktu DESC LIMIT 10");
        while ($row = $q->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['kota']}</td>
                    <td>{$row['suhu']}</td>
                    <td>{$row['kondisi']}</td>
                    <td>{$row['waktu']}</td>
                  </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
