<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (!empty($_POST['faktur2'])) {
        $faktur2 = mysqli_real_escape_string($koneksi, $_POST['faktur2']);

        $query_no = mysqli_query($koneksi, "SELECT no_kunj FROM pskm_trans_head_t WHERE faktur = '$faktur2'");
        $data_no = mysqli_fetch_array($query_no);

        if (!empty($data_no)) {
            $no_kunj = $data_no[0];
            $update_flag = mysqli_query($koneksi, "UPDATE pskm_pendaftaran_t SET flag_tindakan = '3' WHERE no_kunj = '$no_kunj'") or die(mysqli_error($koneksi));
            header("location:frm_diagnosa_pasien.php");
        } else {
            header("location:frm_resep_obat.php");
        }
    } else {
        echo "Data faktur tidak lengkap";
    }
} else {
    header("location:index.html");
}
?>
