<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (isset($_POST['id_kategori'], $_POST['description'], $_POST['biaya'])) {
        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
        $description = mysqli_real_escape_string($koneksi, $_POST['description']);
        $biaya = mysqli_real_escape_string($koneksi, $_POST['biaya']);

        $update = mysqli_query($koneksi, "UPDATE pskm_mst_kategori_pasien_t SET kategori_pasien = '$description', biaya = '$biaya' WHERE id_kat_pasien = '$id_kategori'");

        if ($update) {
            header("location:index.php?utama=frm_view_mst_kategori_pasien");
            exit();
        } else {
            die("Error updating record: " . mysqli_error($koneksi));
        }
    } else {
        echo "Invalid data received.";
    }
} else {
    header("location:index.html");
    exit();
}
?>
