<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    // Sanitize user input to prevent SQL injection
    $id_obat = isset($_REQUEST['id']) ? mysqli_real_escape_string($koneksi, $_REQUEST['id']) : '';
    $id_faktur = isset($_REQUEST['id2']) ? mysqli_real_escape_string($koneksi, $_REQUEST['id2']) : '';
    $qty = isset($_REQUEST['qty']) ? (int)$_REQUEST['qty'] : 0;

    // Get the current stock quantity
    $onhand = mysqli_query($koneksi, "SELECT on_hand FROM pskm_mst_obat_t WHERE id_obat = '$id_obat'");
    $dtonhand = mysqli_fetch_array($onhand);
    $total = $dtonhand[0] + $qty;

    // Update the stock quantity
    $update = "UPDATE pskm_mst_obat_t SET on_hand = $total WHERE id_obat = '$id_obat'";
    $hasil = mysqli_query($koneksi, $update);

    // Delete records from pskm_trans_det2_t and pskm_trans_det3_t
    $hapus2 = "DELETE FROM pskm_trans_det2_t WHERE faktur = '$id_faktur'";
    $hapus3 = "DELETE FROM pskm_trans_det3_t WHERE faktur = '$id_faktur'";
    $hasil2 = mysqli_query($koneksi, $hapus2);
    $hasil3 = mysqli_query($koneksi, $hapus3);

    if ($hasil && $hasil2 && $hasil3) {
        header("location:frm_resep_obat.php");
        exit();
    } else {
        die("Error: " . mysqli_error($koneksi));
    }
} else {
    header("location:index.html");
    exit();
}
?>
