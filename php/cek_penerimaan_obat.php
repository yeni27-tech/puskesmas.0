<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (!empty($_POST['faktur2'])) {
        $faktur2 = mysqli_real_escape_string($koneksi, $_POST['faktur2']);
        
        $query_faktur = mysqli_query($koneksi, "SELECT * FROM pskm_trans_head_t WHERE faktur = '$faktur2'");
        
        if (mysqli_num_rows($query_faktur) == 0) {
            $query_no = mysqli_query($koneksi, "SELECT MAX(no_trans + 1) FROM pskm_trans_head_t WHERE flag_trans = '4'");
            $data_no = mysqli_fetch_array($query_no);

            $notrans = empty($data_no[0]) ? 1 : $data_no[0];

            $insert_faktur = mysqli_query($koneksi, "INSERT INTO pskm_trans_head_t VALUES ('$notrans', '', '$faktur2', '', '', '4', '0', NOW(), '$_SESSION[nik]', '9')") or die(mysqli_error($koneksi));
            
            if ($insert_faktur) {
                $id_obat = mysqli_real_escape_string($koneksi, $_POST['id_obat']);
                $qty = mysqli_real_escape_string($koneksi, $_POST['qty']);
                
                $insert_obat = mysqli_query($koneksi, "INSERT INTO pskm_trans_det3_t VALUES ('$faktur2', '$id_obat', '$qty', '$_SESSION[nik]')") or die(mysqli_error($koneksi));

                header("location:frm_penerimaan_obat.php");
            } else {
                echo "Gagal";
            }
        } else {
            echo "Faktur sudah terdaftar";
        }
    } else {
        echo "Faktur kosong";
    }
} else {
    header("location:index.html");
}
?>
