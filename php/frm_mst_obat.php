<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $akses = mysql_query("select * from pskm_emply_t where nik = '$_SESSION[nik]'") or die(mysql_error());
    $data_akses = mysql_fetch_array($akses);

    if (($data_akses[5] == 'Registrasi') or ($data_akses[5] == 'Apotik')) {
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
                            <form method="post" action="index.php?utama=cek_mst_obat">
                                <tr>
                                    <td colspan="3"><b>Master Obat</b></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><br /></td>
                                </tr>
                                <tr>
                                    <td>ID Obat</td>
                                    <td>:</td>
                                    <td><input name="id_obat" type="text" size="10" maxlength="7" /></td>
                                </tr>
                                <tr>
                                    <td>Descp</td>
                                    <td>:</td>
                                    <td><input name="descp" type="text" size="60" maxlength="120" /></td>
                                </tr>
                                <tr>
                                    <td>Satuan</td>
                                    <td>:</td>
                                    <td>
                                        <select name="satuan">
                                            <option value="Botol">Botol</option>
                                            <option value="Kapsul">Kapsul</option>
                                            <option value="Tablet">Tablet</option>
                                            <option value="Kaplet">Kaplet</option>
                                            <option value="Tube">Tube</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Harga</td>
                                    <td>:</td>
                                    <td><input name="harga" type="text" size="20" /></td>
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
