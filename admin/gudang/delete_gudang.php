<?php
include '../koneksi/koneksi.php';

$id = $_GET['id']; // Ambil ID dari query string

$sql = "DELETE FROM gudang WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    header('Location: Gudang.php'); // Redirect setelah berhasil
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
