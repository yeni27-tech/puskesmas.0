<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    ?>
    <html>

    <head>
        <title>Rekam Medis Application System</title>
        <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
        <script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
    </head>

    <body>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
            <tr>
                <td valign="top">
                    <table width="90%" border="0" cellpadding="3" cellspacing="5">
                        <form method="post" action="cek_mst_pasien.php" target="_blank">
                            <tr>
                                <td colspan="3"><b>Master Pasien</b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><br /></td>
                            </tr>
                            <tr>
                                <td width="20%">No KTP</td>
                                <td>:</td>
                                <td><input name="no_ktp" type="text" size="20" maxlength="20" /></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><input name="nama" type="text" size="30" maxlength="40" /></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="jenis_kelamin" value="L" checked="checked" />Laki-Laki
                                    <input type="radio" name="jenis_kelamin" value="P" />Perempuan
                                </td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>
                                    <select name="agama">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>:</td>
                                <td>
                                    <input type="text" value="" readonly name="theDate">
                                    <input type="button" value="Cal" onclick="displayCalendar(document.forms[0].theDate,'yyyy/mm/dd',this)">
                                </td>
                            </tr>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>
                                    <select name="kategori">
                                        <?php
                                        include "koneksi.php";
                                        $query = mysql_query("select * from pskm_mst_kategori_pasien_t order by kategori_pasien asc") or die(mysql_error());
                                        while ($data = mysql_fetch_array($query)) {
                                            echo "<option value=\"$data[0]\">$data[1]</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>No Telepon</td>
                                <td>:</td>
                                <td><input type="text" name="no_tlp" /></td>
                            </tr>
                            <tr>
                                <td valign="top">Alamat</td>
                                <td valign="top">:</td>
                                <td><textarea name="alamat" cols="50" rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <input type="submit" value="Simpan" />
                                    <input type="reset" value="Batal" />
                                </td>
                            </tr>
                        </form>
                    </table>
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
