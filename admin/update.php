<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data - Bank Sampah</title>
    <link rel="stylesheet" href="uht.css">
</head>
<body>
    <header>
        <h1>Update Data - Bank Sampah</h1>
    </header>
    <main>
        <section>
            <h2>Update Data</h2>
            <form action="proses_update.php" method="POST">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" id="id" name="id" readonly value="1"> <!-- Contoh ID, bisa diganti -->
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" value="Contoh Data 1"> <!-- Contoh Data, bisa diganti -->
                </div>
                <button type="submit" class="button update-button">Update</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>
d