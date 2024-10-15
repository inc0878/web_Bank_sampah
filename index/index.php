<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <h1>Bank Sampah</h1>
    </header>
    <main>
        <section>
            <h2>Masuk Sebagai</h2>
            <ul class="admin-menu">
                <li><a href="../admin/admin.php">Admin</a></li>
                <li><a href="../Petugas_Keuangan/PK.php">Petugas Keuangan</a></li>
                <li><a href="../Petugas_Gudang/PG.php">Petugas Gudang</a></li>
                <li><a href="../Petugas_Transaksi/PT.php">Petugas Transaksi</a></li>
            </ul>
        </section>
        <section>
            <h2>Sampah yang sudah jadi emas:</h2>
            <p>
                <?php
                // Koneksi ke database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "bank_sampah";

                // Buat koneksi
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Cek koneksi
                if ($conn->connect_error) {
                    die("Koneksi gagal: " . $conn->connect_error);
                }

                // Panggil fungsi total_transaksi
                $sql = "SELECT total_transaksi() AS total";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data dari setiap baris
                    while($row = $result->fetch_assoc()) {
                        echo $row["total"];
                    }
                } else {
                    echo "0 hasil";
                }

                $conn->close();
                ?>
            </p>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>
