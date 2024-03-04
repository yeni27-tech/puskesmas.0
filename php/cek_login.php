<?php
include "../conection/koneksi.php";
$pass = md5($_POST['password']);
$nik = mysqli_real_escape_string($koneksi, $_POST['nik']);  // Use mysqli_real_escape_string to prevent SQL injection
$login = mysqli_query($koneksi, "SELECT * FROM Pskm_emply_t WHERE nik = '$nik' AND password = '$pass'");

if (mysqli_num_rows($login) == 1) {
    $data = mysqli_fetch_array($login);
    session_start();
    $_SESSION['nik'] = $data['nik'];  // Use column name instead of index
    $_SESSION['id_jns_poli'] = $data['id_jns_poli'];  // Use column name instead of index
    $_SESSION['sudah_login'] = true;
    header("location:index1.php");
} else {
    // handle unsuccessful login here
}
?>


