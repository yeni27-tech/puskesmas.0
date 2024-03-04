<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    // Sanitize user input to prevent SQL injection
    $id_kat_pasien = isset($_REQUEST['id_kat_pasien']) ? intval($_REQUEST['id_kat_pasien']) : 0;
    $id_kat_pasien = mysqli_real_escape_string($koneksi, $id_kat_pasien);

    $update = mysqli_query($koneksi, "DELETE FROM pskm_mst_kategori_pasien_t WHERE id_kat_pasien = '$id_kat_pasien'");

    if ($update) {
        header("location:index.php?utama=frm_view_mst_kategori_pasien");
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
} else {
    header("location:index.html");
}
?>
