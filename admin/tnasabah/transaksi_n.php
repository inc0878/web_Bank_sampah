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

// Fetch data
$sql = "SELECT id, pengurus_id, sampah_id, nasabah_id, berat, total, ditabung, tanggal FROM transaksi_nasabah";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Nasabah</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            width: 100%;
            background-color: #343a3f;
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        main {
            flex: 1; /* Flexible content area */
            width: 100%;
            max-width: 1200px;
            margin: 0 auto; /* Centering the main content */
            padding: 20px;
            box-sizing: border-box;
            padding-bottom: 60px; /* Add space at the bottom to avoid footer overlap */
        }

        section {
            margin: 20px 0;
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        @media screen and (max-width: 600px) {
            th, td {
                padding: 8px;
            }
        }

        footer {
            width: 100%;
            background-color: #343a3f;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
        }

        form {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        form input, form button {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: calc(100% - 22px);
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .view-button {
            margin: 20px 0;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .view-button:hover {
            background-color: #218838;
        }

        .back-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: white; /* White background */
            color: #6c757d; /* Gray text */
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #6c757d; /* Gray border */
        }

        .back-button:hover {
            background-color: #f8f9fa; /* Light gray background on hover */
            color: #6c757d; /* Gray text */
        }
    </style>
</head>
<body>
    <header>
        <h1>Transaksi Nasabah</h1>
    </header>
    <main>
        <a href="http://localhost/Sampah/admin/admin.php" class="back-button">Back</a>
        <section>
            <h2>Tambah Data Transaksi</h2>
            <form action="create.php" method="POST">
                <input type="text" name="pengurus_id" placeholder="Pengurus ID" required>
                <input type="text" name="sampah_id" placeholder="Sampah ID" required>
                <input type="text" name="nasabah_id" placeholder="Nasabah ID" required>
                <input type="text" name="berat" placeholder="Berat" required>
                <input type="date" name="tanggal" placeholder="Tanggal" required>
                <input type="text" name="ditabung" placeholder="ditabung ? yes = 1 , no = 0" required>
                <button type="submit">Tambah Data</button>
            </form>
        </section>

        <section>
            <h2>Transaksi Nasabah</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pengurus ID</th>
                        <th>Sampah ID</th>
                        <th>Nasabah ID</th>
                        <th>Berat</th>
                        <th>Total</th>
                        <th>Ditabung ?</th>
                        <th>Tanggal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['pengurus_id']}</td>
                                    <td>{$row['sampah_id']}</td>
                                    <td>{$row['nasabah_id']}</td>
                                    <td>{$row['berat']}</td>
                                    <td>{$row['total']}</td>
                                    <td>{$row['ditabung']}</td>
                                    <td>{$row['tanggal']}</td>
                                    <td>
                                        <a href='update.php?id={$row['id']}' class='btn btn-primary btn-sm'>Update</a>
                                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8'>No data found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Horizontal View Transaksi</h2>
            <form action="horizontal_view.php" method="GET">
                <button type="submit">Fetch Horizontal View</button>
        </section>
