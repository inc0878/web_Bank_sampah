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

// Query to get savings data including rank from the database
$sql = "CALL show_tabungan()";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tabungan</title>
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
        <h1>Daftar Tabungan</h1>
    </header>
    <main>
        <a href="http://localhost/Sampah/admin/admin.php" class="back-button">Back</a>
        <section>
            <h2>Tambah Tabungan</h2>
            <form action="add.php" method="POST">
                <input type="text" name="nasabah_id" placeholder="Nasabah ID" required>
                <input type="number" name="jumlah" placeholder="Jumlah" required>
                <button type="submit">Tambah Data</button>
            </form>

            <h2>Hapus Tabungan</h2>
            <form action="delete.php" method="POST">
                <input type="number" name="id" placeholder="ID Tabungan" required>
                <button type="submit">Hapus Data</button>
            </form>

            <button class="view-button" onclick="window.location.href='view_largest_savings.php';">View Largest Savings</button>
        </section>

        <section>
            <h2>Data Tabungan</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nasabah ID</th>
                    <th>Jumlah</th>
                    <th>Rank</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    // Output data from each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["nasabah_id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["jumlah"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["rank"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }
                ?>
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
