<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (empty($_POST['kata'])) {
        echo '<script language="javascript">alert("Kata kunci belum diisi!");document.location.href="index.php?utama=frm_view_pasien";</script>';
    } else {
        $q_hak = mysql_query("SELECT akses FROM pskm_emply_t WHERE nik = '$_SESSION[nik]'");
        $data_hak = mysql_fetch_array($q_hak);

        $field = $_POST['field'];
        $kata = $_POST['kata'];

        echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"3\">";
        echo "<tr><td colspan=\"6\" align=\"center\"><b>Hasil Pencarian Pasien</b></td></tr>";
        echo "<tr><td colspan=\"6\" align=\"center\"><br></td></tr>";
        echo "<tr bgcolor=\"#dedede\"><td align=\"center\">NIP</td><td align=\"center\">Nama</td><td align=\"center\">Jenis Kelamin</td><td align=\"center\">No KTP</td><td align=\"center\">Kategori</td><td align=\"center\">Tool</td></tr>";

        $query_pasien = mysql_query("SELECT a.nip, a.nama, a.jenis_kelamin, a.no_ktp, b.kategori_pasien FROM pskm_mst_pasien_t a, pskm_mst_kategori_pasien_t b WHERE a.id_kat_pasien = b.id_kat_pasien AND $field LIKE '%$kata%' ORDER BY a.nip ASC") or die(mysql_error());

        if (mysql_num_rows($query_pasien) == 0) {
            echo '<script language="javascript">alert("Data tidak ditemukan!");document.location.href="index.php?utama=frm_view_pasien";</script>';
        } else {
            while ($data_pasien = mysql_fetch_array($query_pasien)) {
                $jk = ($data_pasien[2] == 'L') ? 'Laki-Laki' : 'Perempuan';

                echo  "<tr><td>$data_pasien[0]</td><td>$data_pasien[1]</td><td>$jk</td><td>$data_pasien[3]</td><td>$data_pasien[4]</td><td>[
                        <a href=\"index.php?utama=frm_edit_pasien&id=$data_pasien[0]\">Edit</a>]";

                if ($data_hak[0] !== "Pendaftaran") {
                    echo "[<a href=\"delete_pasien.php?id=$data_pasien[0]\">Delete</a>]";
                }

                echo "</td></tr>";
            }
            echo "<tr bgcolor=\"#dedede\"><td colspan=\"6\"></td></tr>";
            echo "</table>";
        }
    }
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
