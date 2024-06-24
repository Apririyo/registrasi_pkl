<?php
session_start();
require 'config/database.php';

// Pastikan pengguna telah login sebelum mengakses halaman profil
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

// Ambil informasi pengguna dari database
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    // Jika pengguna tidak ditemukan, lakukan penanganan kesalahan
    die('User not found!');
}

// Variabel untuk menampilkan informasi pengguna
$username = $user['username'];
$email = $user['email'];
$umur = $user['umur']; // Ambil informasi umur dari database
$alamat = $user['alamat']; // Ambil informasi alamat dari database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Profile Page</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="logout.php" class="logout-link">Logout</a></li>
        </ul>
    </nav>

    <main>
        <h2>Informasi Pengguna</h2>
        <p><strong>Username:</strong> <?php echo $username; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Umur:</strong> <?php echo $umur; ?></p>
        <p><strong>Alamat:</strong> <?php echo $alamat; ?></p>

        <!-- Tambahkan link untuk mengedit profil -->
        <a href="edit_profile.php" class="button">Edit Profile</a>
    </main>

    <footer>
        <p>&copy; 2024 Sarastya Technology</p>
    </footer>
</body>

</html>