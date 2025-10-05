<?php
session_start();

// Jika user sudah login, redirect ke index.php 
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$error_message = '';
$username_valid = 'ridwan';
$password_valid = '106064';

// Memproses data dari form login menggunakan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Mengambil data dari form menggunakan $_POST
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Verifikasi sederhana
    if ($username === $username_valid && $password === $password_valid) {
        // Menyimpan data user ke dalam $_SESSION
        $_SESSION['username'] = $username;

        // Redirect ke halaman index.php setelah login berhasil
        header("Location: dashboard.php");
        exit();
    } else {
        $error_message = "Username atau Password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <h2>LOGIN CYPHRERBOT</h2>
        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <p class="info-text">Gunakan: ridwan, Password: 106064</p>
    </div>
</body>
</html>