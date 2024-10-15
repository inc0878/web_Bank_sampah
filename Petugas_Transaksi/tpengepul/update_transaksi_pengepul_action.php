<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$pengurus_id = $_POST['pengurus_id'];
$pengepul_id = $_POST['pengepul_id'];
$sampah_id = $_POST['sampah_id'];
$berat = $_POST['berat'];
$total = $_POST['total'];
$tanggal = $_POST['tanggal'];

// Update query
$sql = "UPDATE transaksi_pengepul SET
        pengurus_id='$pengurus_id',
        pengepul_id='$pengepul_id',
        sampah_id='$sampah_id',
        berat='$berat',
        total='$total',
        tanggal='$tanggal'
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: transaksi_p.php");
?>
