<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

// Delete query
$sql = "DELETE FROM transaksi_pengepul WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: transaksi_p.php");
?>
