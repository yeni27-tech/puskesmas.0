<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";

    $id_poli = $_REQUEST['id'];
    $query_poli = "SELECT * FROM pskm_mst_jenis_poli_t WHERE id_jns_poli = '$id_poli'";
    $result_poli = mysqli_query($koneksi, $query_poli);

    if ($result_poli) {
        $data_poli = mysqli_fetch_array($result_poli);
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
                            <form method="post" action="cek_edit_jenis_poli.php">
                                <tr>
                                    <td colspan="3" align="center"><strong>Edit Jenis Poliklinik</strong></td>
                                </tr>
                                <tr>
                                    <td colspan="3" align="center"><br /></td>
                                </tr>
                                <?php
                                echo "<tr><td>ID Poliklinik</td><td>:</td><td><input type=\"text\" value=\"$data_poli[0]\" readonly name=\"id_poli\" size=\"15\"/>";
                                echo "<tr><td>Description</td><td>:</td><td><input type=\"text\" value=\"$data_poli[1]\" size=\"35\" name=\"description\"/>";
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><input type="submit" value="Update" />
                                        <input type="button" value="Batal" onclick="self.history.back()" />
                                <tr>
                                    <td colspan="3" align="center"><br /></td>
                            </form>
                        </table>
                    </td>
                </tr>
            </table>
        </body>

        </html>
    <?php
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
    mysqli_close($koneksi);
} else {
    header("location:index1.html");
}
?>
