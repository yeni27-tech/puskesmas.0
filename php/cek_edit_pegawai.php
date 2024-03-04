<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    // Check if all required fields are set
    if (isset($_POST['nama'], $_POST['jk'], $_POST['agama'], $_POST['nik'])) {
        // Escape user inputs for security
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
        $nik = mysqli_real_escape_string($koneksi, $_POST['nik']);

        // Update query
        $update = mysqli_query($koneksi, "UPDATE pskm_mst_pegawai_t SET nama = '$nama', jenis_kelamin = '$jk', agama = '$agama' WHERE nik = '$nik'") or die(mysqli_error($koneksi));

        // Check if update was successful
        if ($update) {
            header("location:index.php?utama=frm_view_pegawai");
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
