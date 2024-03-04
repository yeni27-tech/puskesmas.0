<?php
require '../conection/koneksi.php';
$fullname = $_POST["fullname"];
$username = $_POST["username"];
$alamat = $_POST["alamat"];
$email = $_POST["email"];
$password = $_POST["password"];

$query_sql = "INSERT INTO tbl_users (fullname, username, alamat, email, password)
            VALUES ('$fullname', '$username', '$alamat', '$email', '$password')";

            if (mysqli_query($koneksi, $query_sql)){
                header ("location:./login.php");
            }else {
                echo "pendaftaran gagal:" . mysqli_error($koneksi);
            }