<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $id_kat_pasien = mysqli_real_escape_string($koneksi, $_REQUEST['id_kat_pasien']);
    $q_kat = mysqli_query($koneksi, "SELECT * FROM pskm_mst_kategori_pasien_t WHERE id_kat_pasien = '$id_kat_pasien'") or die(mysqli_error($koneksi));
    $data_kat = mysqli_fetch_array($q_kat);
    
    if ($data_kat) {
?>
        <html>
        <head>
            <title>Rekam Medis Application System</title>
        </head>
        <body>
            <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
                <tr>
                    <td valign="top">
                        <table border="0" cellpadding="3" cellspacing="0">
                            <form method="post" action="cek_edit_kategori_pasien.php">
                                <tr>
                                    <td colspan="3" align="center"><strong>Edit Kategori Pasien</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center"><br /></td>
                                </tr>
                                <tr>
                                    <td width="25%">ID Kategori</td>
                                    <td>:</td>
                                    <td><input type="text" value="<?php echo $data_kat[0]; ?>" readonly name="id_kategori" /></td>
                                </tr>
                                <tr>
                                    <td>Description</td>
                                    <td>:</td>
                                    <td><input type="text" value="<?php echo $data_kat[1]; ?>" size="50" name="description" /></td>
                                </tr>
                                <tr>
                                    <td>Biaya</td>
                                    <td>:</td>
                                    <td><input type="text" value="<?php echo $data_kat[2]; ?>" size="10" name="biaya" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>&nbsp;</td>
                                    <td>
                                        <input type="submit" value="Update" />
                                        <input type="button" value="Batal" onclick="self.history.back()" />
                                    </td>
                                </tr>
                                <tr>
                                    <td><br /></td>
                                </tr>
                            </form>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
<?php
    } else {
        echo "Kategori Pasien not found.";
    }
} else {
    header("location:index1.html");
}
?>
