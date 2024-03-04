<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $tanggal = date('d');
    $bulan = date('m');
    $tahun = date('Y');
    $tgl = $tahun . '-' . $bulan . '-' . $tanggal;
    ?>
    <html>
    <head>
        <title>Rekam Medis Application System</title>
    </head>
    <body>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
            <tr>
                <td valign="top">
                    <?php
                    echo "<form method=\"post\" action=\"$SELF_PHP\">";
                    echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";
                    echo "<tr><td colspan=\"14\"><b>Pembayaran Pengobatan</b></td></tr>";
                    echo "<tr><td colspan=\"14\"><br></td></tr>";
                    echo "<tr><td>NIP</td><td>:</td><td colspan=\"2\"><select name=\"no_kunj\" onchange=\"this.form.submit()\">";
                    echo "<option value=\"kosong\">:::NIP:::</option>";
                    $query1 = mysql_query("select * from pskm_pendaftaran_t a where tgl_proses = '$tgl' and flag_tindakan = '3' order by no_antrian asc") or die(mysql_error());
                    while ($data1 = mysql_fetch_array($query1)) {
                        if ($_POST['no_kunj'] == $data1[0]) {
                            echo "<option value=\"$data1[0]\" selected>$data1[2]</option>";
                        } else {
                            echo "<option value=\"$data1[0]\">$data1[2]</option>";
                        }
                    }
                    echo "</select></td></tr>";
                    $query_pasien = mysql_query("SELECT b.nama, b.jenis_kelamin, c.kategori_pasien, c.biaya, sum(total), d.faktur FROM pskm_pendaftaran_t a, pskm_mst_pasien_t b, pskm_mst_kategori_pasien_t c, pskm_trans_head_t d, pskm_trans_det3_t e where a.no_kunj = '$_POST[no_kunj]' and a.nip = b.nip and b.id_kat_pasien = c.id_kat_pasien and a.no_kunj = d.no_kunj and d.faktur = e.faktur group by b.nama, b.jenis_kelamin, c.kategori_pasien, c.biaya");
                    $data_pasien = mysql_fetch_array($query_pasien);
                    echo "<tr><td>Nama</td><td>:</td><td colspan=\"11\">$data_pasien[0]</td></tr>";
                    if ($data_pasien[1] == 'P') {
                        $jk = 'Perempuan';
                    } else {
                        $jk = 'Laki-Laki';
                    }
                    echo "<tr><td>Jenis Kelamin</td><td>:</td><td colspan=\"11\">$jk</td></tr>";
                    echo "<tr><td>Kategori Pasien</td><td>:</td><td colspan=\"11\">$data_pasien[2]</td></tr>";
                    echo "<tr><td colspan=\"3\"><hr></td></tr>";
                    echo "<tr><td>Biaya Registrasi</td><td>:</td><td colspan=\"11\">$data_pasien[3]</td></tr>";
                    echo "<tr><td>Biaya Pengobatan</td><td>:</td><td colspan=\"11\">$data_pasien[4]</td></tr>";
                    $total = $data_pasien[3] + $data_pasien[4];
                    echo "<tr><td colspan=\"3\"><hr></td></tr>";
                    echo "<tr><td>Total</td><td>:</td><td>$total</td></tr>";
                    echo "<tr></tr></form>";

                    echo "<form method=\"post\" action=\"cek_pembayaran.php\" target=\"_blank\">";
                    echo "<tr><td colspan=\"14\" align=\"center\">";
                    echo "<input type=\"submit\" value=\"Simpan\">
                        <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\" />";
                    echo "<input type=\"hidden\" name=\"faktur\" value=\"$data_pasien[5]\">";
                    echo "<input type=\"hidden\" name=\"total\" value=\"$total\">";
                    echo "<input type=\"hidden\" name=\"no_kunj\" value=\"$_POST[no_kunj]\">";
                    echo "</form></td>";
                    echo "</table>";
                    ?>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
} else {
    header("location:../html./index1.html");
}
?>
