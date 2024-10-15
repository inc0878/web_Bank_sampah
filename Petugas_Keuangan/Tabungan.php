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
        <h2>Tabel Tabungan</h2>

        <!-- Formulir untuk menambah data -->
        <form action="create_tabungan.php" method="post">
            <h3>Tambah Data Tabungan</h3>
            <label for="nasabah_id">Nasabah ID:</label>
            <input type="number" id="nasabah_id" name="nasabah_id" required>

            <label for="jumlah">Jumlah Tabungan:</label>
            <input type="number" id="jumlah" name="jumlah" required>

            <label for="rank">Rank:</label>
            <input type="text" id="rank" name="rank" required>
            
            <input type="submit" value="Tambah Data">
        </form>

        <!-- Tabel data tabungan -->
        <table class="data-table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nasabah_id</th>
                    <th>Jumlah Tabungan</th>
                    <th>Rank</th>
                    <th>Aksi</th> <!-- Kolom untuk aksi -->
                </tr>
            </thead>
            <tbody>
            <?php
                include '../koneksi/koneksi_keuangan.php';

                $sql = "CALL show_tabungan();";
                $result = $conn->query($sql);
                $no = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nasabah_id']) . "</td>";
                        echo "<td>" . number_format($row['jumlah'], 0, ',', '.') . "</td>";
                        echo "<td>" . htmlspecialchars($row['rank']) . "</td>";
                        echo "<td><a href='delete_tabungan.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")'>Hapus</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
    </main>
</body>
</html>