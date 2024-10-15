<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$pengurus_id = $_POST['pengurus_id'];
$pengepul_id = $_POST['pengepul_id'];
$sampah_id = $_POST['sampah_id'];
$berat = $_POST['berat'];
$total = $_POST['total'];
$tanggal = $_POST['tanggal'];

// Insert query
$sql = "INSERT INTO transaksi_pengepul (pengurus_id, pengepul_id, sampah_id, berat, total, tanggal)
        VALUES ('$pengurus_id', '$pengepul_id', '$sampah_id', '$berat', '$total', '$tanggal')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: transaksi_p.php");
?>
