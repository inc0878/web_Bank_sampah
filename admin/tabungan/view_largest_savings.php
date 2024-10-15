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

// Query to get data from the view
$sql = "SELECT * FROM vov_tabungan_platinum";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabungan Terbesar</title>
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
    </style>
</head>
<body>
    <header>
        <h1>Tabungan Terbesar</h1>
    </header>
    <main>
        <h2>Data Tabungan Terbesar</h2>
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
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
