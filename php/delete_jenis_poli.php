<?php
include "koneksi.php";

// Sanitize user input to prevent SQL injection
$id = mysqli_real_escape_string($koneksi, $_REQUEST['id']);

$data = mysqli_query($koneksi, "DELETE FROM pskm_mst_jenis_poli_t WHERE id_jns_poli = '$id'") or die(mysqli_error($koneksi));
header("location:index.php?utama=frm_view_mst_jenis_poli");
?>
