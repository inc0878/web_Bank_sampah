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
                    <th>id</th>
                    <th>sampah_id</th>
                    <th>berat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../koneksi/koneksi.php';

                $sql = "SELECT * FROM gudang";
                $result = $conn->query($sql);
                $no = 1;

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['sampah_id']) . "</td>";
                        echo "<td>" . number_format($row['berat'], 2, ',', '.') . "</td>";
                        echo "<td>
                            <a href='update_gudang.php?id=" . htmlspecialchars($row['id']) . "'>Edit</a> |
                            <a href='delete_gudang.php?id=" . htmlspecialchars($row['id']) . "' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\");'>Hapus</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                $conn->close();
            ?>
            </tbody>
        </table>
        <a href="create_gudang.php">Tambah Gudang</a>
    </main>
    <section>
            <h2>Vertical view gudang</h2>
            <form action="vertical_view.php" method="GET">
                <button type="submit">Fetch vertical View</button>
    </section>
</body>
</html>