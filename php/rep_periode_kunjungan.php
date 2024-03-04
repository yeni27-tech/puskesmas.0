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
        echo "<tr><td align='center'><img src='image/1.jpeg' width='110' height='113'></td><td align='center' colspan='5'><strong>PUSAT KESEHATAN MASYARAKAT <br>PUSKESMAS<br>Kecamatan Maja Kabupaten Lebak Provinsi Banten</strong></td></tr>";
        echo "<tr><td colspan='5'><hr></td></tr>";
        echo "<tr><td align='center' colspan='5'>Laporan Kunjungan Per Pasien<br>Periode $_POST[theDate] s/d $_POST[theDate2]</td></tr>";
        echo "<tr><td colspan='5'><hr></td></tr>";
        echo "<tr><td align='center' width='10%'>No</td><td align='center' width='10%'>NIK</td><td align='center' width='10%'></td><td align='center' width='40%'>Nama</td><td align='center' width='10%'>Total</td></tr>";
        echo "<tr><td colspan='5'><hr></td></tr>";

        $q_kunj = mysql_query("SELECT A.NIP, A.NAMA, COUNT(B.NIP) AS TOTAL FROM PSKM_MST_PASIEN_T A, PSKM_PENDAFTARAN_T B WHERE A.NIP = B.NIP AND B.TGL_PROSES BETWEEN '$tgl_awal' AND '$tgl_akhir' GROUP BY A.NIP, A.NAMA") or die(mysql_error());

        if (mysql_num_rows($q_kunj) >= 1) {
            $no = 1;
            while ($data_kunj = mysql_fetch_array($q_kunj)) {
                echo "<tr><td align='center'>$no</td><td align='center'>$data_kunj[0]</td><td align='center'></td><td align='left'>$data_kunj[1]</td><td align='center'>$data_kunj[2]</td></tr>";
                $no++;
            }

            echo "<tr><td colspan='5'><hr></td></tr>";

            $q_subtotal = mysql_query("SELECT COUNT(B.NIP) AS TOTAL FROM PSKM_MST_PASIEN_T A, PSKM_PENDAFTARAN_T B WHERE A.NIP = B.NIP AND B.TGL_PROSES BETWEEN '$tgl_awal' AND '$tgl_akhir'") or die(mysql_error());
            $data_subtotal = mysql_fetch_array($q_subtotal);

            echo "<tr><td colspan='4' align='right'><strong>Total Kunjungan</strong></td><td align='center'><strong>$data_subtotal[0]</strong></td></tr>";
            echo "<tr><td colspan='5'><hr></td></tr>";
            echo "</table>";
        } else {
            echo '<script language="javascript">alert("Data tidak ditemukan !");self.close()</script>';
        }
    }
} else {
    header("location:index.html");
    exit();
}
?>
