<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['id_kategori']) || empty($_POST['kategori_pasien']) || empty($_POST['biaya'])) {
        echo '<script language="javascript">alert("Maaf data tidak lengkap!");history.back()</script>';
    } else {
        include "koneksi.php";
        
        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
        $kategori_pasien = mysqli_real_escape_string($koneksi, $_POST['kategori_pasien']);
        $biaya = mysqli_real_escape_string($koneksi, $_POST['biaya']);

        $id_query = mysqli_query($koneksi, "SELECT * FROM pskm_mst_kategori_pasien_t WHERE id_kat_pasien = '$id_kategori'");

        if (mysqli_num_rows($id_query) == 0) {
            $insert_query = mysqli_query($koneksi, "INSERT INTO pskm_mst_kategori_pasien_t VALUES ('$id_kategori', '$kategori_pasien', '$biaya')");

            if ($insert_query) {
                echo '<script language="javascript">alert("Data kategori pasien sudah tersimpan!");history.back()</script>';
            } else {
                echo '<script language="javascript">alert("Gagal menyimpan data kategori pasien!");history.back()</script>';
            }
        } else {
            echo '<script language="javascript">alert("ID Kategori sudah terdaftar!");self.close()</script>';
        }
    }
} else {
    header("location:index.html");
    exit();
}
?>
