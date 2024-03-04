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

    $query_pegawai = mysql_query("SELECT * FROM pskm_mst_pegawai_t ORDER BY nik ASC LIMIT $offset, $limit") or die(mysql_error());
    $no = 1;
?>

<html>
<head>
    <title>Rekam Medis Application System</title>
</head>
<body>
    <table border="0">
        <form method="post" action="index.php?utama=frm_hasil_cari_pegawai">
            <tr>
                <td>Field</td>
                <td>
                    <select name="field">
                        <option value="nik">NIK</option>
                        <option value="nama">Nama</option>
                    </select>
                </td>
                <td>Kata kunci</td>
                <td><input type="text" name="kata" /></td>
                <td><input type="submit" value="Cari" /></td>
            </tr>
        </form>
    </table>

    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
            <td valign="top">
                <table border="0" width="80%" cellpadding="3" cellspacing="3">
                    <tr>
                        <td colspan="6" align="center"><b>Master Pegawai</b></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center"><br></td>
                    </tr>
                    <tr bgcolor="#93CDF5">
                        <td height="30" align="center">No</td>
                        <td align="center">NIK</td>
                        <td align="center">Nama</td>
                        <td align="center">Jenis Kelamin</td>
                        <td align="center">Agama</td>
                        <td align="center">Tool</td>
                    </tr>

                    <?php
                    while ($data_pegawai = mysql_fetch_array($query_pegawai)) {
                        $jk = ($data_pegawai[3] == 'L') ? 'Laki-Laki' : 'Perempuan';
                        ?>

                        <tr>
                            <td align="center"><?= $no ?></td>
                            <td align="center"><?= $data_pegawai[0] ?></td>
                            <td><?= $data_pegawai[2] ?></td>
                            <td><?= $jk ?></td>
                            <td><?= $data_pegawai[4] ?></td>
                            <td align="center">
                                [<a href="index.php?utama=frm_edit_pegawai&id=<?= $data_pegawai[0] ?>">Edit</a>]
                                [<a href="delete_pegawai.php?id=<?= $data_pegawai[0] ?>">Delete</a>]
                            </td>
                        </tr>

                        <?php
                        $no++;
                    }
                    ?>

                    <tr bgcolor="#93CDF5">
                        <td colspan="6"></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center"><br></td>
                    </tr>
                </table>

                <?php
                $tampil2 = "SELECT * FROM pskm_mst_pegawai_t";
                $hasil2 = mysql_query($tampil2);
                $jumbaris = mysql_num_rows($hasil2);
                $total_halaman = ceil($jumbaris / $limit);

                if (!empty($halaman) && $halaman != 1) {
                    $sebelumnya = $halaman - 1;
                    echo "<a href='index.php?utama=frm_view_pegawai&halaman=$sebelumnya'>Sebelumnya</a> - ";
                } else {
                    echo "Sebelumnya - ";
                }

                for ($i = 1; $i <= $total_halaman; $i++) {
                    if ($i != $halaman) {
                        echo "<a href='index.php?utama=frm_view_pegawai&halaman=$i'>$i</a> - ";
                    } else {
                        echo "$i - ";
                    }
                }

                if ($halaman < $total_halaman) {
                    $berikutnya = $halaman + 1;
                    echo "<a href='index.php?utama=frm_view_pegawai&halaman=$berikutnya'>Berikutnya</a>";
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
