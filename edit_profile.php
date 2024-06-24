<?php
// Mulai session
session_start();

// Periksa apakah pengguna tidak login, redirect ke halaman login
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Sertakan file konfigurasi database
require 'config/database.php';

// Ambil data pengguna dari database
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch();

// Periksa apakah pengguna ditemukan
if (!$user) {
    die('User not found!');
}

// Proses pengiriman formulir
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $umur = $_POST['umur'];
    $alamat = $_POST['alamat'];

    // Perbarui informasi pengguna di database
    $stmt = $pdo->prepare('UPDATE users SET username = :username, email = :email, umur = :umur, alamat = :alamat WHERE id = :user_id');
    $result = $stmt->execute([
        'username' => $username,
        'email' => $email,
        'umur' => $umur,
        'alamat' => $alamat,
        'user_id' => $user_id
    ]);

    if ($result) {
        // Redirect ke halaman profil setelah pembaruan berhasil
        header('Location: profile.php');
        exit();
    } else {
        echo "Error updating profile.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .footer-copyright {
            font-size: 12px;
            /* Atur ukuran teks sesuai kebutuhan */
            color: white;
            /* Atur warna teks jika diperlukan */
        }
    </style>
</head>

<body>
    <header>
        <h1>Edit Profile</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php" class="logout-link">Logout</a></li>
        </ul>
    </nav>

    <main class="form-container">
        <form action="edit_profile.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

            <label for="umur">Umur:</label>
            <input type="number" id="umur" name="umur" value="<?php echo $user['umur']; ?>" required>

            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" rows="3" required><?php echo $user['alamat']; ?></textarea>

            <button type="submit">Update Profile</button>
        </form>
    </main>

    <footer>
        <p class="footer-copyright">&copy; 2024 Sarastya Technology</p>
    </footer>
</body>

</html>