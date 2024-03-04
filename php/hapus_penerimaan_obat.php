<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    // Sanitize user input to prevent SQL injection
    $faktur = isset($_REQUEST['faktur']) ? mysqli_real_escape_string($koneksi, $_REQUEST['faktur']) : '';

    // Delete records from pskm_trans_det3_t
    $hapus = "DELETE FROM pskm_trans_det3_t WHERE faktur = '$faktur'";
    $hasil = mysqli_query($koneksi, $hapus);

    if ($hasil) {
        $_SESSION['faktur1'] = $_POST['faktur'];
        header("location:index.php?utama=frm_penerimaan_obat");
        exit();
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
} else {
    header("location:index.html");
    exit();
}
?>
