<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (isset($_POST['id_obat'], $_POST['description'], $_POST['satuan'], $_POST['harga'])) {
        $id_obat = mysqli_real_escape_string($koneksi, $_POST['id_obat']);
        $description = mysqli_real_escape_string($koneksi, $_POST['description']);
        $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

        $update = mysqli_query($koneksi, "UPDATE pskm_mst_obat_t SET descp = '$description', satuan = '$satuan', harga = '$harga' WHERE id_obat = '$id_obat'");

        if ($update) {
            header("location:index.php?utama=frm_view_mst_obat");
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
