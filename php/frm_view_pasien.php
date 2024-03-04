<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    $limit = 9;
    $halaman = $_GET['halaman'];
    if (empty($halaman)) {
        $offset = 0;
        $halaman = 1;
    } else {
        $offset = ($halaman - 1) * $limit;
    }

    $q_hak = mysql_query("SELECT akses FROM pskm_emply_t WHERE nik = '$_SESSION[nik]'");
    $data_hak = mysql_fetch_array($q_hak);

    $query_pasien = mysql_query("SELECT a.nip, a.nama, a.jenis_kelamin, a.no_ktp, b.kategori_pasien
                                 FROM pskm_mst_pasien_t a, pskm_mst_kategori_pasien_t b
                                 WHERE a.id_kat_pasien = b.id_kat_pasien
                                 ORDER BY a.nip ASC LIMIT $offset, $limit") or die(mysql_error());

    $no = 1;
?>

<html>
<head>
    <title>Rekam Medis Application System</title>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
            <td>
                <table border="0">
                    <form method="post" action="index.php?utama=frm_hasil_cari_pasien">
                        <tr>
                            <td>Field</td>
                            <td>
                                <select name="field">
                                    <option value="nip">NIP</option>
                                    <option value="nama">Nama</option>
                                </select>
                            </td>
                            <td>Kata kunci</td>
                            <td><input type="text" name="kata" /></td>
                            <td><input type="submit" value="Cari" /></td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
        <tr>
            <td valign="top">
                <table border="0" width="100%" cellpadding="3" cellspacing="3">
                    <!-- Your HTML table structure here -->
                    <!-- ... -->
                </table>

                <?php
                $tampil2 = "SELECT * FROM pskm_mst_pasien_t";
                $hasil2 = mysql_query($tampil2);
                $jumbaris = mysql_num_rows($hasil2);
                $total_halaman = ceil($jumbaris / $limit);

                if (!empty($halaman) && $halaman != 1) {
                    $sebelumnya = $halaman - 1;
                    echo "<a href='index.php?utama=frm_view_pasien&halaman=$sebelumnya'>Sebelumnya</a> - ";
                } else {
                    echo "Sebelumnya - ";
                }

                for ($i = 1; $i <= $total_halaman; $i++) {
                    if ($i != $halaman) {
                        echo "<a href='index.php?utama=frm_view_pasien&halaman=$i'>$i</a> - ";
                    } else {
                        echo "$i - ";
                    }
                }

                if ($halaman < $total_halaman) {
                    $berikutnya = $halaman + 1;
                    echo "<a href='index.php?utama=frm_view_pasien&halaman=$berikutnya'>Berikutnya</a>";
                } else {
                    echo "Berikutnya";
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>

<?php
} else {
    header("location:index.html");
}
?>
