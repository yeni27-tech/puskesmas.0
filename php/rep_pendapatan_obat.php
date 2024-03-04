<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['theDate']) || empty($_POST['theDate2'])) {
        echo '<script language="javascript">alert("Periode belum dipilih !");self.close()</script>';
    } else {
        include "koneksi.php";

        $tgl_awal = $_POST['tahun1'] . '-' . $_POST['bulan1'] . '-' . $_POST['tanggal1'];
        $tgl_akhir = $_POST['tahun2'] . '-' . $_POST['bulan2'] . '-' . $_POST['tanggal2'];

        echo "<table border='0' width='50%' cellpadding='0' cellspacing='0'>";
        // ... (Header section)

        echo "<tr>
                <td align='center' width='6%'>No</td>
                <td align='center' width='6%'>Tanggal</td>
                <td align='center' width='44%'>Total</td>
            </tr>";

        echo "<tr><td colspan='3'><hr></td></tr>";

        $q_pendapatan = mysqli_query(
            $koneksi,
            "SELECT B.TGL_PROSES, SUM(TOT_BIAYA) 
            FROM PSKM_PENDAFTARAN_T A
            JOIN PSKM_TRANS_HEAD_T B ON A.NO_KUNJ = B.NO_KUNJ
            WHERE A.FLAG_TINDAKAN = '5' AND B.FLAG_TRANS = '2'
            AND A.TGL_PROSES BETWEEN '$_POST[theDate]' AND '$_POST[theDate2]'
            GROUP BY B.TGL_PROSES"
        ) or die(mysqli_error($koneksi));

        if (mysqli_num_rows($q_pendapatan) >= 1) {
            $no = 1;
            while ($data_pendapatan = mysqli_fetch_array($q_pendapatan)) {
                echo "<tr>
                        <td align='center'>$no</td>
                        <td align='center'>$data_pendapatan[0]</td>
                        <td align='right'>$data_pendapatan[1]</td>
                    </tr>";
                $no++;
            }

            echo "<tr><td colspan='3'><hr></td></tr>";

            $q_subtotal = mysqli_query(
                $koneksi,
                "SELECT SUM(TOT_BIAYA) 
                FROM PSKM_PENDAFTARAN_T A
                JOIN PSKM_TRANS_HEAD_T B ON A.NO_KUNJ = B.NO_KUNJ
                WHERE A.FLAG_TINDAKAN = '5' AND B.FLAG_TRANS = '2'
                AND A.TGL_PROSES BETWEEN '$_POST[theDate]' AND '$_POST[theDate2]'"
            ) or die(mysqli_error($koneksi));

            $data_subtotal = mysqli_fetch_array($q_subtotal);

            echo "<tr>
                    <td colspan='2' align='right'><strong>Subtotal</strong></td>
                    <td align='right'><strong>Rp. $data_subtotal[0]</strong></td>
                </tr>";

            echo "<tr><td colspan='3'><hr></td></tr>";
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
