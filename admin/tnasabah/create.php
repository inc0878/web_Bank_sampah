<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['sampah_id'])) {
        $id = $_POST['sampah_id'];
        $sql = "SELECT harga_per_kg FROM sampah WHERE id='$id'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $harga_per_kg = $row['harga_per_kg'];
        } else {
            die("Sampah ID tidak valid.");
        }
    } else {
        die("Sampah ID tidak ditemukan.");
    }

    $pengurus_id = $_POST['pengurus_id'];
    $sampah_id = $_POST['sampah_id'];
    $nasabah_id = $_POST['nasabah_id'];
    $berat = $_POST['berat'];
    $tanggal = $_POST['tanggal'];
    $ditabung = $_POST['ditabung'];

    $sql = "INSERT INTO transaksi_nasabah (pengurus_id, sampah_id, nasabah_id, berat, total, ditabung, tanggal)
            VALUES ('$pengurus_id', '$sampah_id', '$nasabah_id', '$berat', calculate_total($harga_per_kg,$berat),'$ditabung', '$tanggal')";

    if ($conn->query($sql) === TRUE) {
        header("Location: transaksi_n.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Data</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="pengurus_id">Pengurus ID:</label>
                <input type="text" class="form-control" id="pengurus_id" name="pengurus_id" required>
            </div>
            <div class="form-group">
                <label for="sampah_id">Sampah ID:</label>
                <input type="text" class="form-control" id="sampah_id" name="sampah_id" required>
            </div>
            <div class="form-group">
                <label for="nasabah_id">Nasabah ID:</label>
                <input type="text" class="form-control" id="nasabah_id" name="nasabah_id" required>
            </div>
            <div class="form-group">
                <label for="berat">Berat:</label>
                <input type="text" class="form-control" id="berat" name="berat" required>
            </div>
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="text" class="form-control" id="total" name="total" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
