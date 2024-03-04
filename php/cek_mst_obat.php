<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['id_obat']) || empty($_POST['descp']) || empty($_POST['satuan'])) {
        echo '<script language="javascript">alert("Maaf data tidak lengkap!");history.back()</script>';
    } else {
        include "koneksi.php";
        
        $id_obat = mysqli_real_escape_string($koneksi, $_POST['id_obat']);
        $descp = mysqli_real_escape_string($koneksi, $_POST['descp']);
        $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

        $id_query = mysqli_query($koneksi, "SELECT * FROM pskm_mst_obat_t WHERE id_obat = '$id_obat'");

        if (mysqli_num_rows($id_query) == 0) {
            $insert_query = mysqli_query($koneksi, "INSERT INTO pskm_mst_obat_t VALUES ('$id_obat', '$descp', '$satuan', '$harga', '0')");

            if ($insert_query) {
                echo '<script language="javascript">alert("Data obat sudah tersimpan!");history.back()</script>';
            } else {
                echo '<script language="javascript">alert("Gagal menyimpan data obat!");history.back()</script>';
            }
        } else {
            echo '<script language="javascript">alert("ID Obat sudah terdaftar!");history.back()</script>';
        }
    }
} else {
    header("location:index.html");
    exit();
}
?>
