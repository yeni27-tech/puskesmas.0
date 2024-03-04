<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    // Check if all required fields are set
    if (isset($_POST['nama'], $_POST['ktp'], $_POST['jk'], $_POST['agama'], $_POST['theDate'], $_POST['kategori'], $_POST['no_tlp'], $_POST['alamat'], $_POST['nip'])) {
        // Escape user inputs for security
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $ktp = mysqli_real_escape_string($koneksi, $_POST['ktp']);
        $jk = mysqli_real_escape_string($koneksi, $_POST['jk']);
        $agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
        $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['theDate']);
        $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
        $no_tlp = mysqli_real_escape_string($koneksi, $_POST['no_tlp']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
        $nip = mysqli_real_escape_string($koneksi, $_POST['nip']);

        // Update query
        $update = mysqli_query($koneksi, "UPDATE pskm_mst_pasien_t SET nama = '$nama', no_ktp = '$ktp', jenis_kelamin = '$jk', agama = '$agama', tgl_lahir = '$tgl_lahir', id_kat_pasien = '$kategori', no_tlp = '$no_tlp', alamat = '$alamat' WHERE nip = '$nip'");

        // Check if update was successful
        if ($update) {
            header("location:index.php?utama=frm_view_pasien");
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
