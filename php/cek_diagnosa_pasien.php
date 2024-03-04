<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (!empty($_POST['faktur'])) {
        $keluhan = mysql_real_escape_string($_POST['keluhan']);
        $diagnosa = mysql_real_escape_string($_POST['diagnosa']);
        $tindakan = mysql_real_escape_string($_POST['tindakan']);
        $pemeriksaan = mysql_real_escape_string($_POST['pemeriksaan']);
        $keterangan = mysql_real_escape_string($_POST['ket']);
        $nik = $_SESSION['nik'];

        $insert = mysql_query("INSERT INTO pskm_trans_det1_t VALUES ('$_POST[faktur]', '$keluhan', '$diagnosa', '$tindakan', '$pemeriksaan', '$keterangan', '$nik')");

        if ($insert) {
            $update = mysql_query("UPDATE pskm_pendaftaran_t SET flag_tindakan = '2' WHERE no_kunj = '$_POST[no_kunj]'");

            echo '<script language="javascript">alert("Data sudah disimpan!");document.location.href="index.php?utama=frm_resep_obat";</script>';
        } else {
            echo '<script language="javascript">alert("Error occurred while saving data!");history.back()</script>';
        }
    } else {
        echo '<script language="javascript">alert("NO ANTRIAN belum dipilih, Silahkan pilih NO ANTRIAN!");history.back()</script>';
    }
} else {
    header("location:index.html");
}
?>
