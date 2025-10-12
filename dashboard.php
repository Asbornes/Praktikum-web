<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);
$search_query = '';
$message = '';

// Handle pencarian produk
if (isset($_GET['search'])) {
    $search_query = htmlspecialchars($_GET['search']);
    if (!empty($search_query)) {
        $message = "Hasil pencarian untuk: <strong>" . $search_query . "</strong>";
    } else {
        $message = "Anda belum memasukkan kata kunci pencarian.";
    }
}

// Pesan sukses
if (isset($_SESSION['pesan'])) {
    $pesan = $_SESSION['pesan'];
    unset($_SESSION['pesan']);
}

// CRUD Produk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'] ?? '';
    $kategori = $_POST['kategori'] ?? '';
    $harga = floatval($_POST['harga'] ?? 0);

    $foto = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        if (!is_dir('uploads')) mkdir('uploads', 0777, true);
        $foto = 'uploads/' . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $foto);
    }

    // Tambah Produk
    if (isset($_POST['tambah'])) {
        $stmt = $conn->prepare("INSERT INTO produk (nama_produk, kategori, harga, foto) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssds", $nama_produk, $kategori, $harga, $foto);
        $stmt->execute();
        $_SESSION['pesan'] = "Produk berhasil ditambahkan!";
        header("Location: dashboard.php");
        exit();
    }

    // Update Produk
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        if ($foto) {
            $stmt = $conn->prepare("UPDATE produk SET nama_produk=?, kategori=?, harga=?, foto=? WHERE id=?");
            $stmt->bind_param("ssdsi", $nama_produk, $kategori, $harga, $foto, $id);
        } else {
            $stmt = $conn->prepare("UPDATE produk SET nama_produk=?, kategori=?, harga=? WHERE id=?");
            $stmt->bind_param("ssdi", $nama_produk, $kategori, $harga, $id);
        }
        $stmt->execute();
        $_SESSION['pesan'] = "Produk berhasil diperbarui!";
        header("Location: dashboard.php");
        exit();
    }
}

// Hapus Produk
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM produk WHERE id=$id");
    $_SESSION['pesan'] = "Produk berhasil dihapus!";
    header("Location: dashboard.php");
    exit();
}

// Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $editData = $conn->query("SELECT * FROM produk WHERE id=$id")->fetch_assoc();
}

// Ambil semua produk
$produk = $conn->query("SELECT * FROM produk ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - CypherBot</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <h1>Toko Komputer Cypher</h1>
            <ul>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#tentang-kami">Tentang Kami</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><span class="username">Halo, <?php echo $username; ?>!</span></li>
                <li><a href="logout.php" class="btn" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a></li>
            </ul>
        </nav>

        <form method="GET" action="dashboard.php">
            <label for="search-input">Cari Produk:</label>
            <input type="search" id="search-input" name="search" placeholder="Masukkan kata kunci..." value="<?php echo $search_query; ?>">
            <button type="submit" class="btn">Cari</button>
        </form>
    </header>

    <main>
        <section id="produk">
            <h2>Kelola Produk</h2>

            <?php if (isset($pesan)): ?>
                <div class="alert fade-out" id="alertBox">✅ <?php echo $pesan; ?></div>
            <?php endif; ?>

            <?php if ($editData): ?>
                <h3>Edit Produk</h3>
                <form method="POST" enctype="multipart/form-data" class="form-produk">
                    <input type="hidden" name="id" value="<?php echo $editData['id']; ?>">
                    <input type="text" name="nama_produk" value="<?php echo htmlspecialchars($editData['nama_produk']); ?>" required>
                    <input type="text" name="kategori" value="<?php echo htmlspecialchars($editData['kategori']); ?>" required>
                    <input type="number" name="harga" value="<?php echo htmlspecialchars($editData['harga']); ?>" required>
                    <input type="file" name="foto">
                    <?php if (!empty($editData['foto'])): ?>
                        <img src="<?php echo htmlspecialchars($editData['foto']); ?>" alt="Preview" width="100"><br>
                    <?php endif; ?>
                    <button type="submit" name="update" class="btn">Update</button>
                    <a href="dashboard.php" class="btn">Batal</a>
                </form>
            <?php else: ?>
                <h3>Tambah Produk</h3>
                <form method="POST" enctype="multipart/form-data" class="form-produk">
                    <input type="text" name="nama_produk" placeholder="Nama Produk" required>
                    <input type="text" name="kategori" placeholder="Kategori" required>
                    <input type="number" name="harga" placeholder="Harga" required step="0.01">
                    <input type="file" name="foto" required>
                    <button type="submit" name="tambah" class="btn">Tambah</button>
                </form>
            <?php endif; ?>

            <h3>Daftar Produk</h3>
            <table border="1" cellspacing="0" cellpadding="8" width="100%">
                <tr style="background-color:#007bff; color:white;">
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
                <?php while ($row = $produk->fetch_assoc()): ?>
                    <tr style="background-color:#fff;">
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                        <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                        <td>Rp<?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td>
                            <?php if (!empty($row['foto'])): ?>
                                <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Gambar Produk" width="80">
                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="dashboard.php?edit=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="dashboard.php?hapus=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </section>
    </main>

    <footer>
        <section id="kontak">
            <h2>Hubungi Kami</h2>
            <p>Email: info@komputercypherbot.com</p>
            <p>Telepon: (021) 123-4567</p>
        </section>
        <p>&copy; 2025 Toko Komputer CypherBot. Semua hak dilindungi.</p>
        referensi: 
        <a href="https://www.klikgalaxy.com/" target="_blank">klikgalaxy</a>
    </footer>

    <script>
        const alertBox = document.getElementById('alertBox');
        if (alertBox) {
            setTimeout(() => alertBox.classList.add('hidden'), 3000);
        }
    </script>
</body>
</html>
