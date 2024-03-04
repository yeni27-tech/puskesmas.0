<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $akses = mysql_query("select * from pskm_emply_t where nik = '$_SESSION[nik]'") or die(mysql_error());
    $data_akses = mysql_fetch_array($akses);

    if ($data_akses[5] == 'Rekam_Medis') {
        ?>
        <html>

        <head>
            <title>Rekam Medis Application System</title>
        </head>

        <body>
            <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
                <tr>
                    <td valign="top">
                        <table border="0" cellpadding="3" cellspacing="5">
                            <form method="post" action="index.php?utama=cek_mst_kat_pasien">
                                <tr>
                                    <td colspan="3" valign="top" align="center">
                                        <b>Master Kategori Pasien</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3" valign="top"><br /></td>
                                </tr>
                                <tr>
                                    <td>Id Kategori</td>
                                    <td>:</td>
                                    <td><input name="id_kategori" type="text" size="10" maxlength="8" required /></td>
                                </tr>
                                <tr>
                                    <td>Kategori Pasien</td>
                                    <td>:</td>
                                    <td><input name="kategori_pasien" type="text" size="50" maxlength="60" required /></td>
                                </tr>
                                <tr>
                                    <td>Biaya</td>
                                    <td>:</td>
                                    <td><input name="biaya" type="text" size="15" required /></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center">
                                        <input type="submit" value="Simpan" />
                                        <input type="reset" value="Batal" />
                                    </td>
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
        header("location:./index.php");
    }
} else {
    header("location:../html./index.html");
}
?>
