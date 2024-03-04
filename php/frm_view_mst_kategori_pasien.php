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

    $query_kategori = mysql_query("SELECT * FROM pskm_mst_kategori_pasien_t ORDER BY id_kat_pasien ASC LIMIT $offset,$limit");
    $no = 1;
?>

<html>
<head>
    <title>Rekam Medis Application System</title>
</head>
<body>
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
            <td valign="top">
                <table width="60%" border="0" cellpadding="3" cellspacing="3">
                    <!-- Your HTML table structure here -->
                    <!-- ... -->
                </table>

                <?php
                $tampil2 = "SELECT * FROM pskm_mst_kategori_pasien_t";
                $hasil2 = mysql_query($tampil2);
                $jumbaris = mysql_num_rows($hasil2);
                $total_halaman = ceil($jumbaris / $limit);

                if (!empty($halaman) && $halaman != 1) {
                    $sebelumnya = $halaman - 1;
                    echo "<a href='index.php?utama=frm_view_mst_kategori_pasien&halaman=$sebelumnya'>Sebelumnya</a> - ";
                } else {
                    echo "Sebelumnya - ";
                }

                for ($i = 1; $i <= $total_halaman; $i++) {
                    if ($i != $halaman) {
                        echo "<a href='index.php?utama=frm_view_mst_kategori_pasien&halaman=$i'>$i</a> - ";
                    } else {
                        echo "$i - ";
                    }
                }

                if ($halaman < $total_halaman) {
                    $berikutnya = $halaman + 1;
                    echo "<a href='index.php?utama=frm_view_mst_kategori_pasien&halaman=$berikutnya'>Berikutnya</a>";
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
