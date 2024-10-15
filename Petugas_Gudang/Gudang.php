<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Gudang</title>
    <link rel="stylesheet" href="Gudang.css">
</head>
<body>
    <header>
        <h1>Bank Sampah</h1>
    </header>
    <main>
        <h2>Tabel Gudang</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>gudang_id</th>
                    <th>sampah_id</th>
                    <th>berat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../Petugas_Gudang/koneksi_gudang.php';

                $sql = "SELECT * FROM gudang_sampah";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['gudang_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sampah_id']) . "</td>";
                        echo "<td>" . number_format($row['berat'], 2, ',', '.') . "</td>";
                        echo "<td>
                            <a href='update_gudang.php?gudang_id=" . htmlspecialchars($row['gudang_id']) . "&sampah_id=" . htmlspecialchars($row['sampah_id']) . "'>Edit</a> |
                            <a href='delete_gudang.php?gudang_id=" . htmlspecialchars($row['gudang_id']) . "&sampah_id=" . htmlspecialchars($row['sampah_id']) . "' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
        <a href="create_gudang.php">Tambah Gudang</a>
    </main>
</body>
</html>