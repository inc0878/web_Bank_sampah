<?php
include '../koneksi/koneksi.php';

$id = $_GET['id']; // Ambil ID dari query string

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tabungan_id = $_POST['tabungan_id'];
    $nasabah_id = $_POST['nasabah_id'];
    $pengurus_id = $_POST['pengurus_id'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $sql = "UPDATE transaksi_tabungan SET tabungan_id=?, nasabah_id=?, pengurus_id=?, tanggal=?, jumlah=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iissii', $tabungan_id, $nasabah_id, $pengurus_id, $tanggal, $jumlah, $id);

    if ($stmt->execute()) {
        header('Location: Transaksi_Tabungan.php'); // Redirect setelah berhasil
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    $sql = "SELECT * FROM transaksi_tabungan WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaksi Tabungan</title>
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
        <h2>Update Transaksi Tabungan</h2>
        <form action="update_transaksi.php?id=<?php echo $id; ?>" method="post">
            <label for="tabungan_id">Tabungan ID:</label>
            <input type="number" id="tabungan_id" name="tabungan_id" value="<?php echo htmlspecialchars($data['tabungan_id']); ?>" required>

            <label for="nasabah_id">Nasabah ID:</label>
            <input type="number" id="nasabah_id" name="nasabah_id" value="<?php echo htmlspecialchars($data['nasabah_id']); ?>" required>

            <label for="pengurus_id">Pengurus ID:</label>
            <input type="number" id="pengurus_id" name="pengurus_id" value="<?php echo htmlspecialchars($data['pengurus_id']); ?>" required>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal']); ?>" required>

            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($data['jumlah']); ?>" required>

            <input type="submit" value="Update Data">
        </form>
    </main>
</body>
</html>
