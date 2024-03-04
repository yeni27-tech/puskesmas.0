<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php"; // Include the database connection file at the beginning

    $query2 = mysql_query("SELECT * FROM pskm_mst_jenis_poli_t ORDER BY jenis_poli ASC") or die(mysql_error());
?>

<html>
<head>
    <title>Rekam Medis Application System</title>
    <link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    <script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
</head>
<body>
    <form method="post" action="rep_periode_kunjungan_perpoli.php" target="_blank">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
            <tr>
                <td valign="top">
                    <table width="70%" border="0" cellpadding="0" cellspacing="5">
                        <tr>
                            <td colspan="3"><strong>Laporan Kunjungan Per Poliklinik</strong></td>
                        </tr>
                        <tr>
                            <td colspan="3"><br /></td>
                        </tr>
                        <tr>
                            <td>Jenis Poli</td>
                            <td>:</td>
                            <td>
                                <select name="jenis_poli">
                                    <option value="kosong">::::::Jenis Poli::::::</option>
                                    <?php
                                    while ($data2 = mysql_fetch_array($query2)) {
                                        echo "<option value=\"$data2[0]\">$data2[1]</option>";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Periode</td>
                            <td>:</td>
                            <td>
                                <input type="text" value="" readonly name="theDate" size="15">
                                <input type="button" value="Cal" onclick="displayCalendar(document.forms[0].theDate,'yyyy/mm/dd',this)">s/d
                                <input type="text" value="" readonly name="theDate2" size="15">
                                <input type="button" value="Cal" onclick="displayCalendar(document.forms[0].theDate2,'yyyy/mm/dd',this)">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <input type="submit" name="proses" value="Proses" />
                                <input type="reset" name="batal" value="Batal" />
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
} else {
    header("location:index.html");
}
?>
