<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $q_obat = mysqli_query($koneksi, "SELECT * FROM pskm_mst_obat_t WHERE id_obat = '" . $_REQUEST['id'] . "'") or die(mysqli_error($koneksi));
    $data_obat = mysqli_fetch_array($q_obat);
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
                        <form method="post" action="cek_edit_obat.php">
                            <tr>
                                <td colspan="2" align="left"><strong>Edit Master Obat</strong></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><br /></td>
                            </tr>
                            <tr>
                                <td>ID Obat</td>
                                <td><input type="text" value="<?php echo $data_obat[0]; ?>" readonly name="id_obat" /></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><input type="text" value="<?php echo $data_obat[1]; ?>" size="60" name="description" /></td>
                            </tr>
                            <tr>
                                <td>Satuan</td>
                                <td>
                                    <select name="satuan">
                                        <?php
                                        $options = array("Botol", "Kapsul", "Tablet", "Kaplet", "Tube");
                                        foreach ($options as $option) {
                                            echo "<option value=\"$option\"";
                                            if ($data_obat[2] == $option) echo " selected";
                                            echo ">$option</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td><input type="text" value="<?php echo $data_obat[3]; ?>" size="10" name="harga" /></td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center">
                                    <input type="submit" value="Update" />
                                    <input type="button" value="Batal" onclick="self.history.back()" />
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
}
else {
    header("location:../html./index1.html");
    exit;
}
?>
