<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['id_jns_poli']) || empty($_POST['jenis_poli'])) {
        echo '<script language="javascript">alert("Maaf data tidak lengkap!");history.back()</script>';
    } else {
        include "koneksi.php";
        
        $id_jns_poli = mysqli_real_escape_string($koneksi, $_POST['id_jns_poli']);
        $jenis_poli = mysqli_real_escape_string($koneksi, $_POST['jenis_poli']);

        $id_query = mysqli_query($koneksi, "SELECT * FROM pskm_mst_jenis_poli_t WHERE id_jns_poli = '$id_jns_poli'");

        if (mysqli_num_rows($id_query) == 0) {
            $insert_query = mysqli_query($koneksi, "INSERT INTO pskm_mst_jenis_poli_t VALUES ('$id_jns_poli', '$jenis_poli')");

            if ($insert_query) {
                echo '<script language="javascript">alert("Data poli sudah tersimpan!");history.back()</script>';
            } else {
                echo '<script language="javascript">alert("Gagal menyimpan data poli!");history.back()</script>';
            }
        } else {
            echo '<script language="javascript">alert("ID Jenis poli sudah terdaftar!");history.back()</script>';
        }
    }
} else {
    header("location:index.html");
    exit();
}
?>
