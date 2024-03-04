<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    $tanggal = date('d');
    $bulan = date('m');
    $tahun = date('Y');
    $tgl = $tahun.'-'.$bulan.'-'.$tanggal;

    echo "<form method=\"post\" action=\"$SELF_PHP\">";
    echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";
    echo "<tr><td colspan=\"14\"><b>View Resep Obat</b></td></tr>";
    echo "<tr><td colspan=\"14\"><br></td></tr>";
    echo "<tr><td>NIP</td><td>:</td><td colspan=\"2\"><select name=\"no_kunj\" onchange=\"this.form.submit()\">";
    echo "<option value=\"kosong\">:::NIP:::</option>";

    $query1 = mysql_query("SELECT * FROM pskm_pendaftaran_t a WHERE tgl_proses = '$tgl' AND flag_tindakan = '4' ORDER BY no_antrian ASC") or die(mysql_error());

    while ($data1 = mysql_fetch_array($query1)) {
        if ($_POST['no_kunj'] == $data1[0]) {
            echo "<option value=\"$data1[0]\" selected>$data1[2]</option>";
        } else {
            echo "<option value=\"$data1[0]\">$data1[2]</option>";
        }
    }

    echo "</select></td></tr>";

    $query_pasien = mysql_query("SELECT d.nama, d.jenis_kelamin, c.keluhan, c.diagnosa, b.faktur FROM pskm_pendaftaran_t a, pskm_trans_head_t b, pskm_trans_det1_t c, pskm_mst_pasien_t d WHERE a.no_kunj = '$_POST[no_kunj]' AND a.no_kunj = b.no_kunj AND a.nip = d.nip AND a.nip = d.nip AND b.faktur = c.faktur");
    $data_pasien = mysql_fetch_array($query_pasien);

    echo "<tr><td>Nama</td><td>:</td><td colspan=\"11\">$data_pasien[0]</td></tr>";

    if ($data_pasien[1] == 'P') {
        $jk = 'Perempuan';
    } else if ($data_pasien[1] == 'L') {
        $jk = 'Laki-Laki';
    }

    echo "<tr><td>Jenis Kelamin</td><td>:</td><td colspan=\"11\">$jk</td></tr>";
    echo "<tr><td>Keluhan</td><td>:</td><td colspan=\"11\">$data_pasien[2]</td></tr>";
    echo "<tr><td>Diagnosa</td><td>:</td><td colspan=\"11\">$data_pasien[3]</td></tr>";
    echo "<tr></tr>";
    echo "<tr height=\"30\" bgcolor=\"#93CDF5\">
        <td align=\"center\">ID</td>
        <td colspan=\"6\" align=\"center\">Description</td>
        <td colspan=\"4\" align=\"center\">Satuan</td>
        <td colspan=\"2\" align=\"center\">Quantity</td>
        <td align=\"center\">Keterangan</td>
    </tr>";

    $query_resep = mysql_query("SELECT a.id_obat, b.descp, b.satuan, a.qty, c.keterangan FROM pskm_trans_det3_t a, pskm_mst_obat_t b, pskm_trans_det2_t c WHERE a.id_obat = b.id_obat AND a.faktur = '$data_pasien[4]' AND c.faktur = '$data_pasien[4]' AND a.id_obat = c.id_obat ORDER BY a.id_obat ASC");

    while ($data_resep = mysql_fetch_array($query_resep)) {
        echo "<tr>
            <td>$data_resep[0]</td>
            <td colspan=\"6\">$data_resep[1]</td>
            <td colspan=\"4\">$data_resep[2]</td>
            <td align=\"right\">$data_resep[3]</td>
        </tr>";
    }

    echo "<tr bgcolor=\"#dedede\"><td colspan=\"14\"></td></tr>";
    echo "<tr></tr></form>";
    echo "<form method=\"post\" action=\"index.php?utama=cek_view_resep_obat\">";
    echo "<tr>
        <td colspan=\"14\" align=\"center\">
            <input type=\"submit\" value=\"Simpan\">
            <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\" />
            <input type=\"hidden\" name=\"faktur\" value=\"$data_pasien[4]\">
            <input type=\"hidden\" name=\"no_kunj\" value=\"$_POST[no_kunj]\">
            <input type=\"hidden\" name=\"id_obat2\" value=\"$data_det[0]\">
            <input type=\"hidden\" name=\"onhand2\" value=\"$data_det[4]\">
        </td>
    </tr></form>";
    echo "</table>";
    echo "</td></tr></table>";
    echo "</body></html>";
} else {
    header("location:index.html");
}
?>
