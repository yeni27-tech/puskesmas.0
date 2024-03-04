<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
?>

<html>
<head>
    <title>Rekam Medis Application System</title>
</head>
<body>
    <table width="101%" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
            <td valign="top">
                <?php
                echo "<table border='0' width='60%' cellpadding='0' cellspacing='3'>";
                echo "<tr><td colspan='5' align='center'><strong>OnHand Obat</td></tr>";
                echo "<tr><td colspan='5'><br></td></tr>";
                echo "<tr bgcolor='#93CDF5'>
                        <td width='10%' align='center' height='30'>No</td>
                        <td width='15%' align='center' height='30'>ID Obat</td>
                        <td width='45%' align='center'>Description</td>
                        <td width='15%' align='center'>Satuan</td>
                        <td width='15%' align='center'>OnHand</td></tr>";

                $limit = 10;
                $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
                $offset = ($halaman - 1) * $limit;

                $obat = mysqli_query($koneksi, "SELECT * FROM pskm_mst_obat_t ORDER BY id_obat ASC LIMIT $offset,$limit");
                $no = 1;

                while ($data_obat = mysqli_fetch_array($obat)) {
                    echo "<tr>
                            <td align='center'>$no<hr></td>
                            <td align='center'>$data_obat[0]<hr></td>
                            <td align='left'>$data_obat[1]<hr></td>
                            <td align='left'>$data_obat[2]<hr></td>
                            <td align='right'>$data_obat[4]<hr></td>
                          </tr>";
                    $no++;
                }

                echo "</table>";

                $tampil2 = "SELECT * FROM pskm_mst_obat_t";
                $hasil2 = mysqli_query($koneksi, $tampil2);
                $jumbaris = mysqli_num_rows($hasil2);
                $total_halaman = ceil($jumbaris / $limit);

                if (!empty($halaman) && $halaman != 1) {
                    $sebelumnya = $halaman - 1;
                    echo "<a href='index.php?utama=onhand_obat&halaman=$sebelumnya'>Sebelumnya</a> - ";
                } else {
                    echo "Sebelumnya - ";
                }

                for ($i = 1; $i <= $total_halaman; $i++) {
                    if ($i != $halaman) {
                        echo "<a href='index.php?utama=onhand_obat&halaman=$i'>$i</a> - ";
                    } else {
                        echo "$i - ";
                    }
                }

                if ($halaman < $total_halaman) {
                    $berikutnya = $halaman + 1;
                    echo "<a href='index.php?utama=onhand_obat&halaman=$berikutnya'>Berikutnya</a>";
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
    exit();
}
?>
