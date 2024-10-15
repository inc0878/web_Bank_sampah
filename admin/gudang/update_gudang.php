<?php
include '../koneksi/koneksi.php';

$id = $_GET['id']; // Ambil ID dari query string

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sampah_id = $_POST['sampah_id'];
    $berat = $_POST['berat'];

    $sql = "UPDATE gudang SET sampah_id=?, berat=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('idi', $sampah_id, $berat, $id);

    if ($stmt->execute()) {
        header('Location: Gudang.php'); // Redirect setelah berhasil
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    $sql = "SELECT * FROM gudang WHERE id=?";
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
    <title>Update Gudang</title>
    <link rel="stylesheet" href="Gudang.css">
</head>
<body>
    <header>
        <h1>Bank Sampah</h1>
    </header>
    <main>
        <h2>Update Data Gudang</h2>
        <form action="update_gudang.php?id=<?php echo $id; ?>" method="post">
            <label for="sampah_id">Sampah ID:</label>
            <input type="number" id="sampah_id" name="sampah_id" value="<?php echo htmlspecialchars($data['sampah_id']); ?>" required>

            <label for="berat">Berat:</label>
            <input type="number" id="berat" name="berat" value="<?php echo htmlspecialchars($data['berat']); ?>" step="0.01" required>

            <input type="submit" value="Update Data">
        </form>
    </main>
</body>
</html>
