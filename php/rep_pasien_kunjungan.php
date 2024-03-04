<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['theDate']) || empty($_POST['theDate2'])) {
        echo '<script language="javascript">alert("Periode belum dipilih !");self.close()</script>';
    } else {
        include "koneksi.php";

        $tgl_awal = $_POST['tahun1'] . '-' . $_POST['bulan1'] . '-' . $_POST['tanggal1'];
        $tgl_akhir = $_POST['tahun2'] . '-' . $_POST['bulan2'] . '-' . $_POST['tanggal2'];

        echo "<table border='0' width='85%' cellpadding='0' cellspacing='0'>";
        // ... (Header section)

        $q_pasien = mysqli_query($koneksi, "SELECT * FROM pskm_mst_pasien_t WHERE nip = '$_POST[nip]'");
        $data_pasien = mysqli_fetch_array($q_pasien);

        echo "<tr><td>NIP</td><td colspan='4'>: $_POST[nip]</td></tr>";
        echo "<tr><td>Nama</td><td colspan='4'>: $data_pasien[nama]</td></tr>";

        if ($data_pasien['jenis_kelamin'] == 'P') {
            $jk = 'Perempuan';
        } elseif ($data_pasien['jenis_kelamin'] == 'L') {
            $jk = 'Laki-Laki';
        }

        echo "<tr><td>Jenis Kelamin</td><td colspan='4'>: $jk</td></tr>";
        echo "<tr><td colspan='9'><hr></td></tr>";

        echo "<tr>
                <td align='center'>Tanggal</td>
                <td align='center'>Poli</td>
                <td align='center'>Keluhan</td>
                <td align='center'>Pemeriksaan</td>
                <td align='center'>Diagnosa</td>
                <td align='center'>Tindakan</td>
                <td align='center'>Ket</td>
                <td align='center'>Dokter</td>
            </tr>";

        echo "<tr><td colspan='9'><hr></td></tr>";

        $q_kunj = mysqli_query(
            $koneksi,
            "SELECT A.TGL_PROSES, B.JENIS_POLI, D.KELUHAN, D.PEMERIKSAAN, D.DIAGNOSA, D.TINDAKAN, D.KET, E.NAMA
            FROM PSKM_PENDAFTARAN_T A
            JOIN PSKM_MST_JENIS_POLI_T B ON A.ID_JNS_POLI = B.ID_JNS_POLI
            JOIN PSKM_TRANS_HEAD_T C ON A.NO_KUNJ = C.NO_KUNJ
            JOIN PSKM_TRANS_DET1_T D ON C.FAKTUR = D.FAKTUR
            JOIN PSKM_MST_PEGAWAI_T E ON D.NIK = E.NIK
            WHERE A.NIP = '$_POST[nip]' AND C.FLAG_TRANS = '2'
            AND A.TGL_PROSES BETWEEN '$_POST[theDate]' AND '$_POST[theDate2]'
            ORDER BY A.TGL_PROSES DESC"
        );

        if (mysqli_num_rows($q_kunj) >= 1) {
            while ($data_kunj = mysqli_fetch_array($q_kunj)) {
                echo "<tr>
                        <td align='center'>$data_kunj[0]</td>
                        <td>$data_kunj[1]</td>
                        <td>$data_kunj[2]</td>
                        <td>$data_kunj[3]</td>
                        <td>$data_kunj[4]</td>
                        <td>$data_kunj[5]</td>
                        <td>$data_kunj[6]</td>
                        <td>$data_kunj[7]</td>
                    </tr>";
            }
            echo "<tr><td colspan='9'><hr></td></tr>";
            echo "</table>";
        } else {
            echo '<script language="javascript">alert("Maaf data tidak ditemukan !");self.close()</script>';
        }
    }
} else {
    header("location:index.html");
    exit();
}
?>
