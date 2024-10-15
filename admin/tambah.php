<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data - Bank Sampah</title>
    <link rel="stylesheet" href="uht.css">
</head>
<body>
    <header>
        <h1>Tambah Data - Bank Sampah</h1>
    </header>
    <main>
        <section>
            <h2>Tambah Data</h2>
            <form action="proses_tambah.php" method="POST">
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <button type="submit" class="button add-button">Tambah</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>
