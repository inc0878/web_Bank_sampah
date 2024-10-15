<?php
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $no_telp = $conn->real_escape_string($_POST['no_telp']);
    $tipe = $conn->real_escape_string($_POST['tipe']);
    $rt = intval($_POST['rt']);
    $rw = intval($_POST['rw']);

    $sql = "UPDATE nasabah SET name='$name', alamat='$alamat', no_telp='$no_telp', tipe='$tipe', rt=$rt, rw=$rw WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil diupdate";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: nasabah.php");
    exit();
} else {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM nasabah WHERE id=$id");
    $row = $result->fetch_assoc();
    if (!$row) {
        echo "Data tidak ditemukan";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Nasabah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Update Nasabah</h1>
    </header>
    <main class="main-container">
        <section>
            <div class="form-container">
                <h3>Update Data Nasabah</h3>
                <form action="update_nasabah.php" method="post">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" value="<?php echo htmlspecialchars($row['alamat']); ?>" required>
                    <label for="no_telp">No Telp:</label>
                    <input type="text" id="no_telp" name="no_telp" value="<?php echo htmlspecialchars($row['no_telp']); ?>" required>
                    <label for="tipe">Tipe:</label>
                    <input type="text" id="tipe" name="tipe" value="<?php echo htmlspecialchars($row['tipe']); ?>" required>
                    <label for="rt">RT:</label>
                    <input type="number" id="rt" name="rt" value="<?php echo htmlspecialchars($row['rt']); ?>" required>
                    <label for="rw">RW:</label>
                    <input type="number" id="rw" name="rw" value="<?php echo htmlspecialchars($row['rw']); ?>" required>
                    <input type="submit" value="Update Data">
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>