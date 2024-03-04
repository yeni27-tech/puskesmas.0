<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (!empty($_POST['id_obat2']) && !empty($_POST['faktur']) && !empty($_POST['qty'])) {
        $id_obat2 = mysqli_real_escape_string($koneksi, $_POST['id_obat2']);
        $faktur = mysqli_real_escape_string($koneksi, $_POST['faktur']);
        $qty = mysqli_real_escape_string($koneksi, $_POST['qty']);
        $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

        $insert_resep = mysqli_query($koneksi, "INSERT INTO pskm_trans_det2_t VALUES ('$faktur', '$id_obat2', '$qty', '', '$_SESSION[nik]')");

        if ($insert_resep) {
            $onhand = $_POST['onhand2'] - $qty;

            $update = mysqli_query($koneksi, "UPDATE pskm_mst_obat_t SET on_hand = '$onhand' WHERE id_obat = '$id_obat2'");

            if ($update) {
                $insert_trans = mysqli_query($koneksi, "INSERT INTO pskm_trans_det3_t VALUES ('$faktur', '$id_obat2', '$qty', '$_SESSION[nik]', '$harga')");

                if ($insert_trans) {
                    header("location:frm_resep_obat.php");
                } else {
                    echo "Transaksi gagal";
                }
            } else {
                echo "Gagal update on-hand";
            }
        } else {
            echo "Gagal insert resep";
        }
    } else {
        echo "Data tidak lengkap";
    }
} else {
    header("location:index.html");
}
?>
