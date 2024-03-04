<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    echo "<html><head><title>Rekam Medis Application System</title></head><body>";
    echo "<table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\"><tr><td valign=\"top\">";

    echo "<form method=\"post\" action=\"" . $_SERVER['PHP_SELF'] . "\">";
    echo "<table width=\"90%\" border=\"0\" cellpadding=\"3\" cellspacing=\"5\">";
    echo "<tr><td colspan=\"3\"><b>Kunjungan Berobat</b></td></tr>";
    echo "<tr><td colspan=\"3\"><br></td></tr>";
    echo "<tr><td width=\"20%\">NIP</td><td>:</td><td><select name=\"nip\" onchange=\"this.form.submit()\">";
    echo "<option value=\"kosong\">:::NIP:::</option>";

    $query1 = mysql_query("select * from pskm_mst_pasien_t a order by nip asc") or die(mysql_error());
    while ($data1 = mysql_fetch_array($query1)) {
        $selected = ($_POST['nip'] == $data1[1]) ? 'selected' : '';
        echo "<option value=\"$data1[1]\" $selected>$data1[1]</option>";
    }

    echo "</select></td></tr>";
    $query_pasien = mysql_query("select a.nama, a.jenis_kelamin, date_format(a.tgl_lahir,'%d %M %Y'), b.kategori_pasien from pskm_mst_pasien_t a, pskm_mst_kategori_pasien_t b where a.nip = '$_POST[nip]' and a.id_kat_pasien = b.id_kat_pasien") or die(mysql_error());
    $data_pasien = mysql_fetch_array($query_pasien);
    echo "<tr><td>Nama</td><td>:</td><td>$data_pasien[0]</td></tr>";
    $jk = ($data_pasien[1] == 'P') ? 'Perempuan' : 'Laki-Laki';
    echo "<tr><td>Jenis Kelamin</td><td>:</td><td>$jk</td></tr>";
    echo "<tr><td>Tgl Lahir</td><td>:</td><td>$data_pasien[2]</td></tr>";
    echo "<tr><td>Jenis Poli</td><td>:</td><td><select name=\"jenis_poli\" onchange=\"this.form.submit()\">";

    $query2 = mysql_query("select * from pskm_mst_jenis_poli_t order by jenis_poli asc") or die(mysql_error());
    while ($data2 = mysql_fetch_array($query2)) {
        $selected = ($_POST['jenis_poli'] == $data2[0]) ? 'selected' : '';
        echo "<option value=\"$data2[0]\" $selected>$data2[1]</option>";
    }

    echo "</select></td></tr>";
    echo "</form>";
    
    echo "<form method=\"post\" action=\"cek_kunjungan.php\" target=\"_blank\">";
    echo "<input name=\"nip2\" type=\"hidden\" value=$_POST[nip]>";
    echo "<input name=\"nama\" type=\"hidden\" value=$data_pasien[0]>";
    echo "<input name=\"jenis_poli2\" type=\"hidden\" value=$_POST[jenis_poli]>";
    echo "<tr><td></td><td></td><td>";
    echo "<input type=\"submit\" value=\"Simpan\"><input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\" />";
    echo "</td></tr>";
    echo "</form>";

    echo "</table></td></tr><tr><td colspan=\"3\"><br></td></tr></table></body></html>";
} else {
    header("location:index.html");
}
?>
