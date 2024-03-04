<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['theDate']) || empty($_POST['theDate2'])) {
        echo '<script language="javascript">alert("Periode belum dipilih!"); self.close()</script>';
    } else {
        include "koneksi.php";

        $tgl_awal = $_POST['tahun1'] . '-' . $_POST['bulan1'] . '-' . $_POST['tanggal1'];
        $tgl_akhir = $_POST['tahun2'] . '-' . $_POST['bulan2'] . '-' . $_POST['tanggal2'];

        echo "<table border='0' width='60%' cellpadding='0' cellspacing='0'>";
        // Output table header and other information...

        $q_obat = mysqli_query($koneksi, "SELECT B.ID_OBAT, A.DESCP, A.SATUAN, SUM(B.QTY) 
                                         FROM PSKM_MST_OBAT_T A 
                                         JOIN PSKM_TRANS_DET3_T B ON A.ID_OBAT = B.ID_OBAT 
                                         WHERE B.FAKTUR IN (SELECT FAKTUR 
                                                           FROM PSKM_PENDAFTARAN_T A 
                                                           JOIN PSKM_TRANS_HEAD_T B ON A.NO_KUNJ = B.NO_KUNJ 
                                                           WHERE A.FLAG_TINDAKAN = '5' AND A.TGL_PROSES 
                                                           BETWEEN '$_POST[theDate]' AND '$_POST[theDate2]')
                                         GROUP BY B.ID_OBAT, A.DESCP, A.SATUAN") or die(mysqli_error($koneksi));

        if (mysqli_num_rows($q_obat) >= 1) {
            $no = 1;
            while ($data_obat = mysqli_fetch_array($q_obat)) {
                // Output table rows with data...
                $no++;
            }

            $q_subtotal = mysqli_query($koneksi, "SELECT SUM(B.QTY) 
                                                FROM PSKM_MST_OBAT_T A 
                                                JOIN PSKM_TRANS_DET3_T B ON A.ID_OBAT = B.ID_OBAT 
                                                WHERE B.FAKTUR IN (SELECT FAKTUR 
                                                                    FROM PSKM_PENDAFTARAN_T A 
                                                                    JOIN PSKM_TRANS_HEAD_T B ON A.NO_KUNJ = B.NO_KUNJ 
                                                                    WHERE A.FLAG_TINDAKAN = '5' AND A.TGL_PROSES 
                                                                    BETWEEN '$tgl_awal' AND '$tgl_akhir')") or die(mysqli_error($koneksi));

            $data_subtotal = mysqli_fetch_array($q_subtotal);
            // Output subtotal row...
            // Output closing HTML tags...
        } else {
            echo '<script language="javascript">alert("Data tidak ditemukan!"); self.close()</script>';
        }
    }
} else {
    header("location: index.html");
}
?>
