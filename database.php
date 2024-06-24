<?php
$dsn = 'pgsql:host=localhost;port=5432;dbname=pkl_registrasi';
$user = 'postgres';
$password = '342007';

try {
    $pdo = new PDO($dsn, $user, $password);
    // Menulis pesan ke log alih-alih menampilkannya di layar
    error_log('Koneksi berhasil!');
} catch (PDOException $e) {
    echo 'Koneksi gagal: ' . $e->getMessage();
}
?>