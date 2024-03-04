<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
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
                        <form method="post" action="index.php?utama=cek_mst_pegawai">
                            <tr>
                                <td align="center" colspan="3"><b>Master Pegawai</b></td>
                            </tr>
                            <tr>
                                <td colspan="3"><br /></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>:</td>
                                <td><input name="nik" type="text" size="15" maxlength="13" /></td>
                            </tr>
                            <tr>
                                <td>No KTP</td>
                                <td>:</td>
                                <td><input name="no_ktp" type="text" size="20" maxlength="20" /></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><input name="nama" type="text" size="30" maxlength="40" /></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    <input type="radio" name="jenis_kelamin" value="L" checked="checked"/>Laki - Laki
                                    <input type="radio" name="jenis_kelamin" value="P" />Perempuan
                                </td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>
                                    <select name="agama">
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katholik">Katholik</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Budha">Budha</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">Alamat</td>
                                <td valign="top">:</td>
                                <td valign="top"><textarea name="alamat" cols="45" rows="2"></textarea></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><input type="submit" value="Simpan" /><input type="reset" value="Batal" /></td>
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
    header("location:../html./index1.html");
}
?>
