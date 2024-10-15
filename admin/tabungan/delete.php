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

// Menghapus data
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM tabungan WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: tabungan.php?message=Data berhasil dihapus!");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
