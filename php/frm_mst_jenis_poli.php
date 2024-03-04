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
                            <form method="post" action="index.php?utama=cek_mst_jenis_poli">
                                <tr>
                                    <td colspan="3">
                                        <b>Master Jenis Poli</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br /></td>
                                </tr>
                                <tr>
                                    <td>Id Jenis Poli</td>
                                    <td>:</td>
                                    <td><input name="id_jns_poli" type="text" size="15" maxlength="12" required /></td>
                                </tr>
                                <tr>
                                    <td>Jenis Poli</td>
                                    <td>:</td>
                                    <td><input name="jenis_poli" type="text" size="35" maxlength="30" required /></td>
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
    header("location:index../html./index1.html");
}
?>
