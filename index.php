<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['user'];
    $pass = $_POST['pass'];

    if ($admin = $spp->petugas->findOne(['username' => $username, 'password' => $pass, 'level' => 'admin'])) {
        $_SESSION['level'] = $admin['level'];
        $_SESSION['id'] = $admin['_id'];
        header('location: admin.php');
    } else if ($petugas = $spp->petugas->findOne(['username' => $username, 'password' => $pass, 'level' => 'petugas'])) {
        $_SESSION['level'] = $petugas['level'];
        $_SESSION['id'] = $petugas['_id'];
        header('location: admin.php');
    } else if ($siswa = $spp->siswa->findOne(['nisn' => intval($username), 'password' => $pass])) {
        $_SESSION['idsiswa'] = $siswa['_id'];
        header('location: siswa.php');
    } else {
        echo 'salah';
    }
}


?>

<form action="" method="post">
    <label for="username">Username</label>
    <input type="text" name="user">
    <label for="password">password</label>
    <input type="text" name="pass">
    <button name="login">login</button>
</form>