<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (isset($_POST['id_poli']) && isset($_POST['description'])) {
        $id_poli = mysql_real_escape_string($_POST['id_poli']);
        $description = mysql_real_escape_string($_POST['description']);

        $update = mysqli_query($koneksi, "UPDATE pskm_mst_jenis_poli_t SET jenis_poli = '$description' WHERE id_jns_poli = '$id_poli'");

        if ($update) {
            header("location:index.php?utama=frm_view_mst_jenis_poli");
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
