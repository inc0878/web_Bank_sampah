<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Tabungan</title>
    <link rel="stylesheet" href="Tabel.css">
</head>
<body>
    <header>
        <h1>Bank Sampah</h1>
        <nav>
            <ul>
                <li><a href="Tabungan.php">Tabel Tabungan</a></li>
                <li><a href="Transaksi_Tabungan.php">Tabel Transaksi Tabungan</a></li>
                <li><a href="Transaksi_Nasabah.php">Tabel Transaksi Nasabah</a></li>
                <li><a href="Transaksi_Pengepul.php">Tabel Transaksi Pengepul</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Tabel Transaksi Pengepul</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>pengurus_id</th>
                    <th>Pengepul_id</th>
                    <th>sampah_id</th>
                    <th>berat</th>
                    <th>total</th>
                    <th>tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../koneksi/koneksi.php';

                $sql = "SELECT * FROM transaksi_pengepul";
                $result = $conn->query($sql);
                $no = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pengurus_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pengepul_id']) . "</td>"; // Pastikan nama kolom sesuai
                        echo "<td>" . htmlspecialchars($row['sampah_id']) . "</td>"; // Pastikan nama kolom sesuai
                        echo "<td>" . number_format($row['berat'], 2, ',', '.') . "</td>"; // Format berat dengan 2 desimal
                        echo "<td>" . number_format($row['total'], 2, ',', '.') . "</td>"; // Format total dengan 2 desimal
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </main>
</body>
</html>