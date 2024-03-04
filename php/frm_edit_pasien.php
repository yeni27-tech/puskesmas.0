<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $q_pasien = mysqli_query($koneksi, "SELECT * FROM pskm_mst_pasien_t WHERE nip = '$_REQUEST[id]'") or die(mysqli_error($koneksi));
    $data_pasien = mysqli_fetch_array($q_pasien);
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
                <?php
                echo "<table border='0' cellpadding='3' cellspacing='0'>";
                echo "<form method='post' action='cek_edit_pasien.php'>";
                echo "<tr><td colspan='3' align='center'><strong>Edit Data Pasien</strong></td></tr>";
                echo "<tr><td colspan='3' align='center'><br /></td></tr>";

                echo "<tr><td>NIP</td><td>:</td><td><input type='text' value='$data_pasien[1]' readonly name='nip' size='18' maxlength='18'></td></tr>";
                echo "<tr><td>Nama</td><td>:</td><td><input type='text' value='$data_pasien[3]' name='nama' size='30' maxlength='40'></td></tr>";
                echo "<tr><td>No KTP</td><td>:</td><td><input type='text' value='$data_pasien[2]' name='ktp' size='18' maxlength='18'></td></tr>";

                echo "<tr><td>Jenis Kelamin</td><td>:</td><td>";
                if ($data_pasien[4] == "L")
                    echo "<input type='radio' name='jk' value='L' checked>Laki-Laki<input type='radio' name='jk' value='P'>Perempuan";
                else
                    echo "<input type='radio' name='jk' value='L'>Laki-Laki<input type='radio' name='jk' value='P' checked>Perempuan</td></tr>";

                echo "<tr><td>Agama</td><td>:</td><td><select name='agama'>";
                $agama_options = array("Islam", "Kristen", "Katholik", "Hindu", "Budha");
                foreach ($agama_options as $option) {
                    echo "<option value='$option'";
                    if ($data_pasien[5] == $option) echo " selected";
                    echo ">$option</option>";
                }
                echo "</select></td></tr>";

                echo "<tr><td>Tanggal Lahir</td><td>:</td><td><input type='text' value='$data_pasien[6]' readonly name='theDate'>";
                echo "<input type='button' value='Cal' onclick='displayCalendar(document.forms[0].theDate,\"yyyy/mm/dd\",this)'></td></tr>";

                echo "<tr><td>Kategori</td><td>:</td><td><select name='kategori'>";
                $q_kat = mysqli_query($koneksi, "SELECT * FROM pskm_mst_kategori_pasien_t ORDER BY id_kat_pasien ASC") or die(mysqli_error($koneksi));
                while ($row_kat = mysqli_fetch_array($q_kat)) {
                    if ($data_pasien[8] == $row_kat[0])
                        echo "<option value='$row_kat[0]' selected>$row_kat[1]</option>";
                    else
                        echo "<option value='$row_kat[0]'>$row_kat[1]</option>";
                }
                echo "</select></td></tr>";

                echo "<tr><td>No Telepon</td><td>:</td><td><input type='text' value='$data_pasien[7]' name='no_tlp' size='18' maxlength='18'></td></tr>";
                echo "<tr><td>Alamat</td><td>:</td><td><input type='text' value='$data_pasien[11]' name='alamat' cols='60' rows='3'></td></tr>";

                echo "<tr><td></td><td></td><td><input type='submit' value='Update' /><input type='button' value='Batal' onclick='self.history.back()' /></td></tr>";
                echo "</form></table>";
                ?>
            </td>
        </tr>
    </table>
</body>

</html>

<?php
} else {
    header("location:../html./index1.html");
    exit;
}
?>
