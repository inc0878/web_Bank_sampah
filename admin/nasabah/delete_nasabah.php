<?php
include '../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $sql = "DELETE FROM nasabah WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error menghapus data: " . $conn->error;
    }

    $conn->close();
    header("Location: nasabah.php");
    exit();
} else {
    echo "ID tidak ditemukan";
}
?>