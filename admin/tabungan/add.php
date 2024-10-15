<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add data
if (isset($_POST['nasabah_id']) && isset($_POST['jumlah'])) {
    $nasabah_id = $_POST['nasabah_id'];
    $jumlah = $_POST['jumlah'];

    // Prepare and execute stored procedure
    if ($stmt = $conn->prepare("CALL insert_tabungan(?, ?)")) {
        $stmt->bind_param("si", $nasabah_id, $jumlah); // "si" means string, integer types

        if ($stmt->execute()) {
            header("Location: tabungan.php?message=" . urlencode("Data berhasil ditambahkan!"));
            exit(); // Ensure no further code is executed after redirect
        } else {
            echo "Error executing procedure: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

$conn->close();
?>
