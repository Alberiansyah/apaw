<?php
require __DIR__ . '/../connections/connections.php';

global $pdo;
$username = $_POST['username'];
$password = $_POST['password'];
$query = $pdo->prepare("SELECT * FROM tb_user WHERE username = ?");
$query->execute([$username]);
$checkRow = $query->rowCount();
if ($checkRow === 1) {
    // Cari password di dalam database.
    $queryObject = $query->fetch(PDO::FETCH_OBJ);
    // Mencocokkan data.
    if (password_verify($password, $queryObject->password)) {
        $_SESSION['id_user'] = $queryObject->id_user;
        $_SESSION['role_id'] = $queryObject->role_id;
        $_SESSION['username'] = $queryObject->username;
        $_SESSION['nama_lengkap'] = $queryObject->nama_lengkap;
        if ($_SESSION['destination']) {
            $urlReturnTo = $_SESSION['destination'];
            header("Location: " . $urlReturnTo . "");
            unset($_SESSION['destination']);
            exit();
        } else {
            header('Location: ../home');
            exit();
        }
    } else {
        $_SESSION['gagal'] = ['type' => false, 'message' => 'Nama Pengguna/Kata Sandi tidak sah.'];
        header('Location: ../index');
        exit();
    }
} else {
    $_SESSION['gagal'] = ['type' => false, 'message' => 'Nama Pengguna/Kata Sandi tidak sah.'];
    header('Location: ../index');
    exit();
}
