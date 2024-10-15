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
        </nav>
    </header>
    <main>
        <h2>Tabel Transaksi Nasabah</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>tabungan_id</th>
                    <th>nasabah_id</th>
                    <th>pengurus_id</th>
                    <th>tanggal</th>
                    <th>jumlah</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../koneksi/koneksi.php';

                $sql = "SELECT * FROM transaksi_tabungan";
                $result = $conn->query($sql);
                $no = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tabungan_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nasabah_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['pengurus_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "<td>" . number_format($row['jumlah'], 0, ',', '.') . "</td>";
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
    <section>
            <h2>Horizontal View Transaksi</h2>
            <form action="horizontal_view.php" method="GET">
                <button type="submit">Fetch Horizontal View</button>
        </section>
</body>
</html>