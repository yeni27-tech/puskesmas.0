<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['nik']) || empty($_POST['no_ktp']) || empty($_POST['nama']) || empty($_POST['alamat'])) {
        echo '<script language="javascript">alert("Maaf data tidak lengkap!");history.back()</script>';
    } else {
        include "koneksi.php";

        $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
        $no_ktp = mysqli_real_escape_string($koneksi, $_POST['no_ktp']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        $ktp_query = mysqli_query($koneksi, "SELECT * FROM pskm_mst_pegawai_t WHERE no_ktp = '$no_ktp' AND nik = '$nik'");

        if (mysqli_num_rows($ktp_query) == 0) {
            $insert_query = mysqli_query($koneksi, "INSERT INTO pskm_mst_pegawai_t VALUES ('$nik', '$no_ktp', '$nama', '$jenis_kelamin', '$agama', '$alamat')") or die("Gagal input data pegawai !" . mysqli_error($koneksi));

            echo '<script language="javascript">alert("Data sudah tersimpan!");history.back()</script>';
        } else {
            echo '<script language="javascript">alert("Maaf data sudah terdaftar!");self.close()</script>';
        }
    }
} else {
    header("location:index.html");
}
?>
