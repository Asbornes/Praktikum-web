<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CypherBot - Toko Komputer Cyber</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $search_query = '';
    $message = '';

    if (isset($_GET['search'])) {
        $search_query = htmlspecialchars($_GET['search']);

        if (!empty($search_query)) {
            $message = "Hasil pencarian untuk: <strong>" . $search_query . "</strong>";
        } else {
            $message = "Anda belum memasukkan kata kunci pencarian.";
        }
    }
    ?>

    <header>
        <nav>
            <h1>Toko Komputer Cypher</h1>
            <ul>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#tentang-kami">Tentang Kami</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li class="nav-buttons"><a href="#" class="btn btn-login">Login</a></li>
                <li class="nav-buttons"><a href="#" class="btn btn-register">Registrasi</a></li>
            </ul>
        </nav>
        <form method="GET" action="index.php">
            <label for="search-input">Cari Produk:</label>
            <input type="search" id="search-input" name="search" placeholder="Masukkan kata kunci..." value="<?php echo $search_query; ?>">
            <button type="submit">Cari</button>
        </form>
    </header>

    <main>
        <?php if (!empty($message)): ?>
            <section id="search-results">
                <h2>Pencarian Produk</h2>
                <p><?php echo $message; ?></p>
            </section>
            <hr/>
        <?php endif; ?>

        <aside>
            <h2>Categories</h2>
            <ul>
                <li><a href="index.php?category=gaming-notebook">Gaming Notebook</a></li>
                <li><a href="index.php?category=notebook">Notebook</a></li>
                <li><a href="index.php?category=desktop-mini-pc">Desktop - Mini PC</a></li>
                <li><a href="index.php?category=processor">Processor</a></li>
                <li><a href="index.php?category=mainboard">Mainboard</a></li>
                <li><a href="index.php?category=memory">Memory</a></li>
                <li><a href="index.php?category=harddisk-ssd">HardDisk - SSD</a></li>
                <li><a href="index.php?category=vga-card">VGA Card</a></li>
                <li><a href="index.php?category=casing-pc">Casing PC</a></li>
                <li><a href="index.php?category=cooler-modding-kit">Cooler - Modding Kit</a></li>
                <li><a href="index.php?category=power-supply">Power Supply</a></li>
                <li><a href="index.php?category=monitor-bracket">Monitor - Bracket</a></li>
                <li><a href="index.php?category=keyboard-mouse">Keyboard - Mouse</a></li>
                <li><a href="index.php?category=streaming-recording">Streaming - Recording</a></li>
                <li><a href="index.php?category=aksesoris">Aksesoris</a>
                    <ul>
                        <li><a href="index.php?category=aksesoris-audio">. Audio</a></li>
                        <li><a href="index.php?category=aksesoris-console">. Console</a></li>
                        <li><a href="index.php?category=aksesoris-gamepad">. Gamepad</a></li>
                        <li><a href="index.php?category=aksesoris-gaming-chair">. Gaming Chair</a></li>
                        <li><a href="index.php?category=aksesoris-gaming-desk">. Gaming Desk (Meja)</a></li>
                        <li><a href="index.php?category=aksesoris-flash-disk">. Flash Disk - MMC</a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <section id="hero">
            <h2>Selamat Datang di Toko Komputer Cypher</h2>
            <p>Temukan komputer dan aksesoris terbaik untuk kebutuhanmu dengan teknologi cyber terdepan.</p>
            <div class="video-container">
                <video src="LOQ 15IRX9.mp4" autoplay muted loop></video>
            </div>
            <div class="video-container-2">
                <video src="2024 Nitro V 15  Live for Victory  Acer.mp4" autoplay muted loop></video>
            </div>
        </section>

        <section id="produk">
            <h2>Produk Unggulan</h2>
            <article>
                <img src="loq.webp" alt="Gambar Laptop Gaming">
                <h3>Laptop Gaming Super Cepat</h3>
                <p>Laptop dengan performa tinggi untuk para gamer profesional.</p>
            </article>
            <article>
                <img src="PC-Rakitan.webp" alt="Gambar PC Rakitan">
                <h3>PC Rakitan Custom</h3>
                <p>Buat PC impianmu sesuai spesifikasi yang kamu inginkan.</p>
            </article>
            <article>
                <img src="Aksesoris-untuk-laptop-dan-komputer-doc-swalayan-komputer.webp" alt="Gambar Aksesoris Komputer">
                <h3>Aksesoris Lengkap</h3>
                <p>Mulai dari mouse, keyboard, hingga monitor berkualitas.</p>
            </article>
        </section>

        <section id="layanan">
            <h2>Layanan Kami</h2>
            <ul>
                <li>Jasa rakit PC custom sesuai kebutuhan dan budget</li>
                <li>Perbaikan hardware dan software komputer</li>
                <li>Konsultasi spesifikasi komputer dan upgrade</li>
                <li>Instalasi Jaringan & Peripheral</li>
                <li>Upgrade Komponen</li>
                <li>Garansi & Maintenance Berkala</li>
            </ul>
        </section>
    </main>

    <section id="tentang-kami">
        <h2>Tentang Kami</h2>
        <p>Kami berkomitmen untuk menyediakan produk dan layanan terbaik (klik untuk baca selengkapnya).</p>
    </section>

    <footer>
        <section id="kontak">
            <h2>Hubungi Kami</h2>
            <p>Email: info@komputercypherbot.com</p>
            <p>Telepon: (021) 123-4567</p>
        </section>
        <p>&copy; 2025 Toko Komputer CypherBot. Semua hak dilindungi.</p>
        referensi : 
        <a href="https://www.klikgalaxy.com/" target="_blank">klikgalaxy</a>
    </footer>

    <script src="script.js"></script>
</body>
</html>