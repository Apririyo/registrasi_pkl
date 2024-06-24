<?php
require 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $email = $_POST['email'];
    $umur = $_POST['umur']; // Menambahkan umur dari form
    $alamat = $_POST['alamat']; // Menambahkan alamat dari form

    $stmt = $pdo->prepare('INSERT INTO users (username, password, email, umur, alamat) VALUES (:username, :password, :email, :umur, :alamat)');
    if ($stmt->execute(['username' => $username, 'password' => $password, 'email' => $email, 'umur' => $umur, 'alamat' => $alamat])) {
        header('Location: login.php');
        exit();
    } else {
        $error = 'Terjadi kesalahan saat registrasi!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Register</h1>
    </header>

    <main>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="register.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="umur">Umur:</label> <!-- Menambahkan input umur -->
            <input type="number" id="umur" name="umur" required>

            <label for="alamat">Alamat:</label> <!-- Menambahkan input alamat -->
            <textarea id="alamat" name="alamat" rows="3" required></textarea>

            <button type="submit">Register</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Sarastya Technology</p>
    </footer>
</body>

</html>