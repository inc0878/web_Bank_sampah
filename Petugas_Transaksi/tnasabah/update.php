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

$id = $_GET['id'];
$sql = "SELECT * FROM transaksi_nasabah WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pengurus_id = $_POST['pengurus_id'];
    $sampah_id = $_POST['sampah_id'];
    $nasabah_id = $_POST['nasabah_id'];
    $berat = $_POST['berat'];
    $total = $_POST['total'];
    $tanggal = $_POST['tanggal'];

    $sql = "UPDATE transaksi_nasabah SET pengurus_id='$pengurus_id', sampah_id='$sampah_id', nasabah_id='$nasabah_id', berat='$berat', total='$total', tanggal='$tanggal' WHERE id=$id";

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
    <title>Update Data</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Update Data</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="pengurus_id">Pengurus ID:</label>
                <input type="text" class="form-control" id="pengurus_id" name="pengurus_id" value="<?php echo $row['pengurus_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="sampah_id">Sampah ID:</label>
                <input type="text" class="form-control" id="sampah_id" name="sampah_id" value="<?php echo $row['sampah_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nasabah_id">Nasabah ID:</label>
                <input type="text" class="form-control" id="nasabah_id" name="nasabah_id" value="<?php echo $row['nasabah_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="berat">Berat:</label>
                <input type="text" class="form-control" id="berat" name="berat" value="<?php echo $row['berat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="total">Total:</label>
                <input type="text" class="form-control" id="total" name="total" value="<?php echo $row['total']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
