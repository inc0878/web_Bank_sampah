<?php
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sampah_id = $_POST['sampah_id'];
    $berat = $_POST['berat'];

    $sql = "INSERT INTO gudang (sampah_id, berat) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('id', $sampah_id, $berat);

    if ($stmt->execute()) {
        header('Location: Gudang.php'); // Redirect setelah berhasil
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang</title>
    <link rel="stylesheet" href="Gudang.css">
</head>
<body>
    <header>
        <h1>Bank Sampah</h1>
    </header>
    <main>
        <h2>Tambah Data Gudang</h2>
        <form action="create_gudang.php" method="post">
            <label for="sampah_id">Sampah ID:</label>
            <input type="number" id="sampah_id" name="sampah_id" required>

            <label for="berat">Berat:</label>
            <input type="number" id="berat" name="berat" step="0.01" required>

            <input type="submit" value="Tambah Data">
        </form>
    </main>
</body>
</html>
