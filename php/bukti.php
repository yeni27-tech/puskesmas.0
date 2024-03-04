<?php
echo "<table border='0'>";
echo "<tr><td colspan='3'>Bukti Pembayaran Pengobatan<br>Pusat Kesehatan Masyarakat</td></tr>";
echo "<tr><td colspan='2'>Tanggal</td><td>" . date("Y-m-d H:i:s") . "</td></tr>";

$no_kunj = mysqli_real_escape_string($koneksi, $_POST['no_kunj']);

$query_pasien = mysqli_query($koneksi, "SELECT b.nama, b.jenis_kelamin, c.kategori_pasien, c.biaya, SUM(total) as total_biaya, d.faktur 
                            FROM pskm_pendaftaran_t a, pskm_mst_pasien_t b, pskm_mst_kategori_pasien_t c, pskm_trans_head_t d, pskm_trans_det3_t e 
                            WHERE a.no_kunj = '$no_kunj' AND a.nip = b.nip AND b.id_kat_pasien = c.id_kat_pasien AND a.no_kunj = d.no_kunj AND d.faktur = e.faktur 
                            GROUP BY b.nama, b.jenis_kelamin, c.kategori_pasien, c.biaya");

$data_pasien = mysqli_fetch_array($query_pasien);

echo "<tr><td>Nama</td><td>:</td><td colspan='11'>$data_pasien[0]</td></tr>";
$jk = ($data_pasien[1] == 'P') ? 'Perempuan' : 'Laki-Laki';
echo "<tr><td>Jenis Kelamin</td><td>:</td><td colspan='11'>$jk</td></tr>";
echo "<tr><td>Kategori Pasien</td><td>:</td><td colspan='11'>$data_pasien[2]</td></tr>";
echo "<tr><td colspan='3'><hr></td></tr>";
echo "<tr><td>Biaya Registrasi</td><td>:</td><td colspan='11'>$data_pasien[3]</td></tr>";
echo "<tr><td>Biaya Pengobatan</td><td>:</td><td colspan='11'>$data_pasien[4]</td></tr>";

$total = $data_pasien[3] + $data_pasien[4];

echo "<tr><td colspan='3'><hr></td></tr>";
echo "<tr><td>Total</td><td>:</td><td>$total</td></tr>";
echo "</table>";
?>
