<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Nasabah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Daftar Nasabah</h1>
    </header>
    <main class="main-container">
        <section>
            <div class="back-button">
                <a href="http://localhost/Sampah/admin/admin.php">Back</a>
            </div>

            <div class="form-container">
                <h3>Tambah Data Nasabah</h3>
                <form action="create_nasabah.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                    <label for="alamat">Alamat:</label>
                    <input type="text" id="alamat" name="alamat" required>
                    <label for="no_telp">No Telp:</label>
                    <input type="text" id="no_telp" name="no_telp" required>
                    <label for="tipe">Tipe:</label>
                    <input type="text" id="tipe" name="tipe" required>
                    <label for="rt">RT:</label>
                    <input type="number" id="rt" name="rt" required>
                    <label for="rw">RW:</label>
                    <input type="number" id="rw" name="rw" required>
                    <input type="submit" value="Tambah Data">
                </form>
            </div>
            
            <form method="GET" class="search-form">
                <input type="text" name="search_name" placeholder="Search by Name" value="<?php echo isset($_GET['search_name']) ? htmlspecialchars($_GET['search_name']) : ''; ?>">
                <input type="text" name="search_no_telp" placeholder="Search by No Telp" value="<?php echo isset($_GET['search_no_telp']) ? htmlspecialchars($_GET['search_no_telp']) : ''; ?>">
                <input type="text" name="search_rt" placeholder="Search by RT" value="<?php echo isset($_GET['search_rt']) ? htmlspecialchars($_GET['search_rt']) : ''; ?>">
                <button type="submit">Search</button>
            </form>


            <h2>Nasabah</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Tipe</th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Aksi</th>
                </tr>
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

                // Get search terms
                $search_no_telp = isset($_GET['search_no_telp']) ? $conn->real_escape_string($_GET['search_no_telp']) : '';
                $search_rt = isset($_GET['search_rt']) ? $conn->real_escape_string($_GET['search_rt']) : '';
                $search_name = isset($_GET['search_name']) ? $conn->real_escape_string($_GET['search_name']) : '';

                // Build the SQL query
                $sql = "SELECT id, name, alamat, no_telp, tipe, rt, rw FROM nasabah WHERE 1=1";
                if ($search_no_telp) {
                    $sql .= " AND no_telp LIKE '%$search_no_telp%'";
                }
                if ($search_rt) {
                    $sql .= " AND rt LIKE '%$search_rt%'";
                }
                if ($search_name) {
                    $sql .= " AND name LIKE '%$search_name%'";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["alamat"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["no_telp"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["tipe"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["rt"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["rw"]) . "</td>";
                        echo "<td><a class='edit-link' href='update_nasabah.php?id=" . htmlspecialchars($row["id"]) . "'>Edit</a> | <a class='delete-link' href='delete_nasabah.php?id=" . htmlspecialchars($row["id"]) . "' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
                }

                $conn->close();
                ?>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>