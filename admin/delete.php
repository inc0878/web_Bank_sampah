<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data - Bank Sampah</title>
    <link rel="stylesheet" href="uht.css">
</head>
<body>
    <header>
        <h1>Hapus Data - Bank Sampah</h1>
    </header>
    <main>
        <section>
            <h2>Hapus Data</h2>
            <form action="proses_hapus.php" method="POST">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" id="id" name="id" readonly value="1"> <!-- Contoh ID, bisa diganti -->
                </div>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" readonly value="Contoh Data 1"> <!-- Contoh Data, bisa diganti -->
                </div>
                <button type="submit" class="button delete-button">Hapus</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank Sampah</p>
    </footer>
</body>
</html>
