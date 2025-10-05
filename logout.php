<?php
session_start(); // Memulai session

// Menghapus semua data session yang terdaftar
$_SESSION = array();

// Menghapus session cookie. Ini perlu dilakukan untuk memastikan sesi benar-benar hilang.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Menghancurkan session di server
session_destroy();

// Redirect ke halaman index.php setelah logout
header("Location: login.php");
exit();


?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Berhasil</title>
    <link rel="stylesheet" href="logout.css">
</head>
<body>
    <div class="logout-container">
        <h2>Anda Berhasil Logout</h2>
        <p>Terima kasih telah menggunakan layanan kami.</p>
        <a href="index.php" class="btn-home">Kembali ke Beranda</a>
        <a href="login.php" class="btn-login-again">Login Lagi</a>
    </div>
</body>
</html>
?>