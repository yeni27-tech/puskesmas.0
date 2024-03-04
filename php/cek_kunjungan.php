<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    if (isset($_POST['nip2'], $_POST['jenis_poli2'])) {
        $nip2 = mysqli_real_escape_string($koneksi, $_POST['nip2']);
        $jenis_poli2 = mysqli_real_escape_string($koneksi, $_POST['jenis_poli2']);

        $rec1 = mysqli_query($koneksi, "SELECT * FROM pskm_mst_pasien_t WHERE nip = '$nip2'") or die(mysqli_error($koneksi));

        if (mysqli_num_rows($rec1) == 1) {
            $rec2 = mysqli_query($koneksi, "SELECT * FROM pskm_pendaftaran_t WHERE nip = '$nip2' AND flag_tindakan < '4' AND tgl_proses = CURDATE()") or die(mysqli_error($koneksi));

            if (mysqli_num_rows($rec2) == 0) {
                // Your existing logic for generating antrian, no_kunj, no_trans, and faktur
                // ...

                // Example queries (replace with your actual queries)
                $insert_kunj = mysqli_query($koneksi, "INSERT INTO pskm_pendaftaran_t VALUES ('$no_kunj', '$no', '$nip2', '$jenis_poli2', '1', CURRENT_TIMESTAMP, '$_SESSION[nik]')") or die(mysqli_error($koneksi));

                $insert_head = mysqli_query($koneksi, "INSERT INTO pskm_trans_head_t VALUES ('$no_trans', '$no_kunj', '$faktur', '$nip2', '$jenis_poli2', '2', '', CURRENT_TIMESTAMP, '$_SESSION[nik]', '')") or die(mysqli_error($koneksi));

                // Output HTML table and other details
                echo "<table border=\"0\">";
                // ... Your table content ...
                echo "</table>";
            } else {
                echo '<script language="javascript">alert("Silahkan selesaikan terlebih dahulu registrasi!");document.location.href="index.php?utama=frm_kunjungan";history.back()</script>';
            }
        } else {
            echo '<script language="javascript">alert("Data belum dipilih!");self.close()</script>';
        }
    } else {
        echo "Invalid data received.";
    }
} else {
    header("location:index.html");
    exit();
}
?>
