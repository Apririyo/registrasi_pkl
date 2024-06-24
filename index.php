<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Pendaftaran PKL/Prakerin Sarastya Technology</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Selamat Datang di Pendaftaran PKL/Prakerin Sarastya Technology</h1>
    </header>

    <nav>
        <ul>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php" class="logout-link">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <main>
        <h2>Informasi Umum</h2>
        <p>Selamat datang di platform pendaftaran PKL/Prakerin di Sarastya Technology. Silakan login atau registrasi
            untuk memulai.</p>
    </main>

    <footer>
        <p>&copy; 2024 Sarastya Technology</p>
    </footer>
</body>

</html>