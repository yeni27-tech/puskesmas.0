<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (!empty($_POST['faktur'])) {
        $faktur = $_POST['faktur'];
        $update = mysqli_query($koneksi, "UPDATE pskm_pendaftaran_t SET flag_tindakan = '5' WHERE no_kunj = '$faktur'");

        if ($update) {
            echo '<script language="javascript">alert("Data berhasil disimpan!");history.back()</script>';
        } else {
            echo '<script language="javascript">alert("Gagal menyimpan data!");history.back()</script>';
        }
    } else {
        echo '<script language="javascript">alert("Data belum dipilih!");history.back()</script>';
    }
} else {
    header("location:index.html");
}
?>
