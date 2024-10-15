<?php
include '../Petugas_Gudang/koneksi_gudang.php';

// Pastikan parameter tersedia
if (isset($_GET['gudang_id']) && isset($_GET['sampah_id'])) {
    $gudang_id = $_GET['gudang_id']; // Ambil ID dari query string
    $sampah_id = $_GET['sampah_id']; // Ambil ID dari query string

    $sql = "DELETE FROM gudang_sampah WHERE gudang_id = ? AND sampah_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ii', $gudang_id, $sampah_id);

    if ($stmt->execute()) {
        header('Location: Gudang.php'); // Redirect setelah berhasil
        exit(); // Pastikan script berhenti setelah redirect
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Parameter tidak valid.";
}

$conn->close();
?>