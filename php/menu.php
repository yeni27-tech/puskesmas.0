<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    $nik = isset($_SESSION['nik']) ? mysqli_real_escape_string($koneksi, $_SESSION['nik']) : '';

    $akses = mysqli_query($koneksi, "SELECT * FROM pskm_emply_t WHERE nik = '$nik'");
    $data_akses = mysqli_fetch_array($akses);

    if (!empty($data_akses)) {
        switch ($data_akses[5]) {
            case "Pendaftaran":
                include "menu_pendaftaran.html";
                break;
            case "Pengobatan":
                include "menu_pengobatan.html";
                break;
            case "Pembayaran":
                include "menu_pembayaran.html";
                break;
            case "Apotik":
                include "menu_apotik.html";
                break;
            case "Rekam_Medis":
                include "menu_rekammedis.html";
                break;
            case "kp":
                include "menu_kepala_puskesmas.html";
                break;
            default:
                // Handle unknown access level
                break;
        }
    }
} else {
    header("location:index.html");
    exit();
}
?>
