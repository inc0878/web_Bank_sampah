<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bank_sampah";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT id, pengurus_id, pengepul_id, sampah_id, berat, total, tanggal FROM transaksi_pengepul WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaksi Pengepul</title>
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
            max-width: 1200px
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
            padding-bottom: 60px;
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
    </style>
</head>
<body>
    <header>
        <h1>Update Transaksi Pengepul</h1>
    </header>
    <main>
        <section>
            <h2>Update Data Transaksi</h2>
            <form action="update_transaksi_pengepul_action.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <input type="text" name="pengurus_id" value="<?php echo $row['pengurus_id']; ?>" required>
                <input type="text" name="pengepul_id" value="<?php echo $row['pengepul_id']; ?>" required>
                <input type="text" name="sampah_id" value="<?php echo $row['sampah_id']; ?>" required>
                <input type="number" name="berat" value="<?php echo $row['berat']; ?>" required>
                <input type="number" name="total" value="<?php echo $row['total']; ?>" required>
                <input type="date" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
                <button type="submit">Update Data</button>
            </form>
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
