<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    if (empty($_POST['no_ktp']) || empty($_POST['nama']) || empty($_POST['no_tlp']) || empty($_POST['alamat'])) {
        echo '<script language="javascript">alert("Maaf data tidak valid!");self.close()</script>';
    } else {
        include "koneksi.php";

        $no_ktp = mysqli_real_escape_string($koneksi, $_POST['no_ktp']);
        $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
        $jenis_kelamin = mysqli_real_escape_string($koneksi, $_POST['jenis_kelamin']);
        $agama = mysqli_real_escape_string($koneksi, $_POST['agama']);
        $tgl_lahir = mysqli_real_escape_string($koneksi, $_POST['theDate']);
        $no_tlp = mysqli_real_escape_string($koneksi, $_POST['no_tlp']);
        $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
        $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

        $ktp_query = mysqli_query($koneksi, "SELECT * FROM pskm_mst_pasien_t WHERE no_ktp = '$no_ktp'");

        if (mysqli_num_rows($ktp_query) == 0) {
            $no_urut_query = mysqli_query($koneksi, "SELECT MAX(no_urut + 1) FROM pskm_mst_pasien_t") or die(mysqli_error($koneksi));
            $row = mysqli_fetch_array($no_urut_query);
            $tgl = date("ym");

            if ($row[0] < 10) {
                $kosong = "000";
            } elseif ($row[0] >= 10 && $row[0] <= 99) {
                $kosong = "00";
            } elseif ($row[0] >= 100 && $row[0] <= 999) {
                $kosong = "0";
            } else {
                $kosong = "";
            }

            $nip = "$tgl$kosong$row[0]";
            $tgl_lahir = $_POST['tahun'] . '-' . $_POST['bulan'] . '-' . $_POST['tanggal'];

            $insert_query = mysqli_query($koneksi, "INSERT INTO pskm_mst_pasien_t VALUES ('$row[0]', '$nip', '$no_ktp', '$nama', '$jenis_kelamin', '$agama', '$tgl_lahir', '$no_tlp', '$kategori', 0, NOW(), '$alamat')");

            if ($insert_query) {
                $kartu_query = mysqli_query($koneksi, "SELECT a.nip, a.nama, a.jenis_kelamin, b.kategori_pasien FROM pskm_mst_pasien_t a, pskm_mst_kategori_pasien_t b WHERE nip = '$nip' AND a.id_kat_pasien = b.id_kat_pasien");
                $data1 = mysqli_fetch_array($kartu_query);
                $jk1 = $data1[2];
                $jk = ($jk1 == "L") ? "Laki-Laki" : "Perempuan";
                ?>
                <table border="0" cellpadding="3" cellspacing="3">
                    <tr>
                        <td colspan="3" align="center">
                            <b>DINAS KESEHATAN DAN KESEJAHTERAAN SOSIAL<br />
                            KABUPATEN LEBAK<br />PUSKESMAS MAJA<br /></b>Jl. Alun-alun kec. Maja Telp. (0252)281133
                        </td>
                    </tr>
                    <tr>
                        <td width="122">NIK</td>
                        <td width="3">:</td>
                        <td width="250"><?php echo $nip; ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?php echo $data1[1]; ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td><?php echo $jk; ?></td>
                    </tr>
                    <tr>
                        <td>Kategori Pasien</td>
                        <td>:</td>
                        <td><?php echo $data1[3]; ?></td>
                    </tr>
                </table>
                <?php
            } else {
                echo '<script language="javascript">alert("Terjadi kesalahan saat menyimpan data!");self.close()</script>';
            }
        } else {
            echo '<script language="javascript">alert("No KTP sudah terdaftar!");self.close()</script>';
        }
    }
} else {
    header("location:index.html");
}
?>
