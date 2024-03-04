<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "rumah_sakit";

$koneksi = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}else {
    echo "koneksi berhasil geng";
}

// Select the database (although you can specify the database in mysqli_connect)
// mysqli_select_db($koneksi, $db);

// Your database connection is now established, and $koneksi can be used for queries.

// ... rest of your code ...

?>
