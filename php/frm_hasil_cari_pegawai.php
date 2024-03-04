<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (empty($_POST['kata'])) {
        echo '<script language="javascript">alert("Maaf kata kunci tidak boleh kosong!");history.back()</script>';
    } else {
        $field = $_POST['field'];
        $kata = $_POST['kata'];

        echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";
        echo "<form method=\"post\" action=\"index.php?utama=frm_hasil_cari_pegawai\">";
        echo "<tr><td>Field</td><td><select name=\"field\"><option value=\"nik\">NIK</option><option value=\"nama\">Nama</option></select></td>";
        echo "<td>Kata kunci</td><td><input type=\"text\" name=\"kata\" value=\"$kata\" /></td>";
        echo "<td><input type=\"submit\" value=\"Cari\" /></td></tr></form>";
        echo "</table>";

        echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";
        echo "<tr><td colspan=\"5\" align=\"center\"><b>Hasil Pencarian Pegawai</b></td></tr>";
        echo "<tr bgcolor=\"#dedede\"><td align=\"center\">NIK</td><td align=\"center\">Nama</td><td align=\"center\">Jenis Kelamin</td><td align=\"center\">Agama</td><td align=\"center\">Tool</td></tr>";

        $query_pegawai = mysql_query("SELECT * FROM pskm_mst_pegawai_t WHERE $field LIKE '%$kata%' ORDER BY nik ASC") or die(mysql_error());

        if (mysql_num_rows($query_pegawai) == 0) {
            echo '<script language="javascript">alert("Data tidak ditemukan!");document.location.href="frm_view_pegawai.php";</script>';
        } else {
            while ($data_pegawai = mysql_fetch_array($query_pegawai)) {
                $jk = ($data_pegawai[3] == 'L') ? 'Laki-Laki' : 'Perempuan';
                echo "<tr><td>$data_pegawai[0]</td><td>$data_pegawai[2]</td><td>$jk</td><td>$data_pegawai[4]</td>";
                echo "<td>[<a href=\"index.php?utama=frm_edit_pegawai&id=$data_pegawai[0]\">Edit</a>] [<a href=\"delete_pegawai.php?id=$data_pegawai[0]\">Delete</a>]</td></tr>";
            }
            echo "<tr bgcolor=\"#dedede\"><td colspan=\"5\"></td></tr>";
            echo "</table>";
        }
    }
?>
</body>
</html>
<?php
} else {
    header("location:../html./index.html");
    exit;
}
?>
