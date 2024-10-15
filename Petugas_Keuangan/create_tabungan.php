<?php
include '../koneksi/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nasabah_id = $_POST['nasabah_id'];
    $jumlah = $_POST['jumlah'];
    $rank = $_POST['rank'];

    $sql = "INSERT INTO tabungan (nasabah_id, jumlah, rank) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $nasabah_id, $jumlah, $rank);

    if ($stmt->execute()) {
        header("Location: Tabungan.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
