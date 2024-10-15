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
$sql = "SELECT id, pengurus_id, pengepul_id, sampah_id, berat, total, tanggal FROM transaksi_pengepul";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Pengepul</title>
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
            flex: 1;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            padding-bottom: 60px;
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
        <h1>Transaksi Pengepul</h1>
    </header>
    <main>
        <a href="http://localhost/Sampah/admin/admin.php" class="back-button">Back</a>
        <section>
            <h2>Tambah Data Transaksi</h2>
            <form action="create_transaksi_pengepul.php" method="POST">
                <input type="text" name="pengurus_id" placeholder="Pengurus ID" required>
                <input type="text" name="pengepul_id" placeholder="Pengepul ID" required>
                <input type="text" name="sampah_id" placeholder="Sampah ID" required>
                <input type="number" name="berat" placeholder="Berat" required>
                <input type="number" name="total" placeholder="Total" required>
                <input type="date" name="tanggal" placeholder="Tanggal" required>
                <button type="submit">Tambah Data</button>
            </form>
        </section>

        <section>
            <h2>Data Transaksi Pengepul</h2>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pengurus ID</th>
                        <th>Pengepul ID</th>
                        <th>Sampah ID</th>
                        <th>Berat</th>
                        <th>Total</th>
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
                                    <td>{$row['pengepul_id']}</td>
                                    <td>{$row['sampah_id']}</td>
                                    <td>{$row['berat']}</td>
                                    <td>{$row['total']}</td>
                                    <td>{$row['tanggal']}</td>
                                    <td>
                                        <a href='update_transaksi_pengepul.php?id={$row['id']}' class='btn btn-primary btn-sm'>Update</a>
                                        <a href='delete_transaksi_pengepul.php?id={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
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
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
