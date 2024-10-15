<?php
include '../koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $alamat = $conn->real_escape_string($_POST['alamat']);
    $no_telp = $conn->real_escape_string($_POST['no_telp']);
    $tipe = $conn->real_escape_string($_POST['tipe']);
    $rt = intval($_POST['rt']);
    $rw = intval($_POST['rw']);

    $sql = "INSERT INTO nasabah (name, alamat, no_telp, tipe, rt, rw) VALUES ('$name', '$alamat', '$no_telp', '$tipe', $rt, $rw)";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header("Location: nasabah.php");
    exit();
}
?>