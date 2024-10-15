<?php
$servername = "localhost";
$username = "user2";
$password = "password2";
$dbname = "bank_sampah";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>