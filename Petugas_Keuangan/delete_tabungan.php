<?php
include '../koneksi/koneksi.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus baris terkait di transaksi_tabungan
    $deleteTransaksi = "DELETE FROM transaksi_tabungan WHERE tabungan_id = $id";
    if ($conn->query($deleteTransaksi) === TRUE) {
        // Hapus baris di tabungan setelah transaksi_tabungan dihapus
        $deleteTabungan = "DELETE FROM tabungan WHERE id = $id";
        if ($conn->query($deleteTabungan) === TRUE) {
            echo "Data tabungan berhasil dihapus";
        } else {
            echo "Error menghapus data tabungan: " . $conn->error;
        }
    } else {
        echo "Error menghapus data transaksi tabungan: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan";
}

$conn->close();
?>
