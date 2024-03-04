<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['theDate']) || empty($_POST['theDate2'])) {
        echo '<script language="javascript">alert("Periode belum dipilih !");self.close()</script>';
    } else {
        include "koneksi.php";
        $tgl_awal = $_POST['tahun1'] . '-' . $_POST['bulan1'] . '-' . $_POST['tanggal1'];
        $tgl_akhir = $_POST['tahun2'] . '-' . $_POST['bulan2'] . '-' . $_POST['tanggal2'];

        echo "<table border='0' width='60%' cellpadding='0' cellspacing='0'>";
        echo "<tr><td align='center'><img src='image/1.jpeg' width='115' height='118'></td><td align='center' colspan='3'><strong>PUSAT KESEHATAN MASYARAKAT <br>PUSKESMAS<br>Kecamatan Maja Kabupaten Lebak Provinsi Banten</strong></td></tr>";
        echo "<tr><td colspan='5'><hr></td></tr>";
        echo "<tr><td align='center' colspan='5'>Laporan Penerimaan Obat <br>Periode $_POST[theDate] s/d $_POST[theDate2]</td></tr>";
        echo "<tr><td colspan='5'><hr></td></tr>";
        echo "<tr><td align='left' width='5%'>No</td><td align='center' width='15%'>ID Obat</td><td align='center' width='50%'>Description</td><td align='center' width='15%'>Satuan</td><td align='center' width='15%'>Total</td></tr>";
        echo "<tr><td colspan='5'><hr></td></tr>";

        $q_obat = mysql_query("SELECT a.id_obat, b.descp, b.satuan, SUM(a.qty) FROM pskm_trans_det3_t a, pskm_mst_obat_t b WHERE faktur IN (SELECT (faktur) FROM pskm_trans_head_t WHERE flag_trans = 4 AND flag_rec = 1 AND tgl_proses BETWEEN '$tgl_awal' AND '$tgl_akhir') AND a.id_obat = b.id_obat GROUP BY id_obat, b.descp, b.satuan ORDER BY a.id_obat ASC") or die(mysql_error());

        if (mysql_num_rows($q_obat) >= 1) {
            $no = 1;
            while ($data_obat = mysql_fetch_array($q_obat)) {
                echo "<tr><td align='left'>$no</td><td align='center'>$data_obat[0]</td><td>" . htmlspecialchars($data_obat[1]) . "</td><td>$data_obat[2]</td><td align='right'>$data_obat[3]</td></tr>";
                $no++;
            }

            echo "<tr><td colspan='5'><hr></td></tr>";

            $q_subtotal = mysql_query("SELECT SUM(B.QTY) FROM PSKM_MST_OBAT_T A, PSKM_TRANS_DET3_T B WHERE A.ID_OBAT = B.ID_OBAT AND B.FAKTUR IN (SELECT (faktur) FROM PSKM_TRANS_HEAD_T WHERE FLAG_TRANS = 4 AND FLAG_REC = 1 AND TGL_PROSES BETWEEN '$tgl_awal' AND '$tgl_akhir')") or die(mysql_error());
            $data_subtotal = mysql_fetch_array($q_subtotal);

            echo "<tr><td colspan='4' align='right'><strong>Subtotal</strong></td><td align='right'><strong>$data_subtotal[0]</strong></td></tr>";
            echo "<tr><td colspan='5'><hr></td></tr>";
            echo "</table>";
        } else {
            echo '<script language="javascript">alert("Data tidak ditemukan !");self.close()</script>';
        }
    }
} else {
    header("location:../html/index.html");
    exit();
}
?>
