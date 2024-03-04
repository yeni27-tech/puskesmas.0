<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    $_SESSION['faktur1'] = $_POST['faktur'];
    ?>
    <html>
    <head>
        <title>Rekam Medis Application System</title>
    </head>
    <body>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
            <tr>
                <td valign="top">
                    <?php
                    include "koneksi.php";
                    echo "<table border=\"0\" cellpadding=\"3\" cellspacing=\"5\">";
                    echo "<form method=\"post\" action=\"$SELF_PHP\">";
                    echo "<tr><td colspan=\"9\"><b>Penerimaan Obat</b></td></tr>";
                    echo "<tr><td colspan=\"9\"><br></td></tr>";
                    echo "<tr><td width=\"20%\">Faktur</td><td>:</td><td colspan=\"7\"><input type=\"text\" name=\"faktur\" value=\"{$_SESSION['faktur1']}\"></td></tr>";
                    echo "<tr><td>Obat</td><td>:</td><td><select name=\"id_obat\" onchange=\"this.form.submit()\">";
                    echo "<option value=\"kosong\">:::Description:::</option>";
                    $query_obat = mysql_query("select * from pskm_mst_obat_t where id_obat not in (select id_obat from pskm_trans_det3_t where faktur = '{$_SESSION['faktur1']}') order by descp asc") or die(mysql_error());
                    while ($data_obat = mysql_fetch_array($query_obat)) {
                        $selected = ($_POST['id_obat'] == $data_obat[0]) ? "selected" : "";
                        echo "<option value=\"$data_obat[0]\" $selected>{$data_obat[1]}</option>";
                    }
                    echo "</select></td>";
                    $query_det = mysql_query("select * from pskm_mst_obat_t where id_obat = '{$_POST['id_obat']}'");
                    $data_det = mysql_fetch_array($query_det);
                    echo "<tr><td>On Hand</td><td>:</td><td colspan=\"7\">{$data_det[4]}</td></tr>";
                    echo "<tr><td>Satuan</td><td>:</td><td colspan=\"7\">{$data_det[2]}</td></tr>";
                    echo "<tr><td>Quantity</td><td>:</td><td colspan=\"7\"><input type=\"text\" name=\"qty\"><input type=\"submit\" value=\"Simpan\" name=\"simpan\"></td></tr>";
                    echo "<tr><td colspan=\"9\"></td></tr>";
                    echo "<tr bgcolor=\"#93CDF5\" align=\"center\">
                        <td height=\"30\">ID</td><td colspan=\"4\">Description</td><td>Satuan</td>
                        <td>Quantity</td><td>Tools</td>
                    </tr>";

                    // Display existing records
                    $data_faktur = mysql_query("SELECT a.id_obat, b.descp, b.satuan, a.qty FROM pskm_trans_det3_t a, pskm_mst_obat_t b, pskm_trans_head_t c WHERE a.faktur = '{$_POST['faktur']}' AND a.id_obat = b.id_obat AND a.faktur = c.faktur AND c.flag_trans = '4'");
                    while ($hasil_faktur = mysql_fetch_array($data_faktur)) {
                        echo "<tr>
                            <td align=\"center\">{$hasil_faktur[0]}</td>
                            <td colspan=\"4\">{$hasil_faktur[1]}</td>
                            <td>{$hasil_faktur[2]}</td>
                            <td>{$hasil_faktur[3]}</td>
                            <td>[<a href=\"hapus_penerimaan_obat.php?id={$hasil_faktur[0]}&faktur={$_SESSION['faktur1']}\">Hapus</a>]</td>
                        </tr>";
                    }
                    
                    // Check if form is submitted
                    if (isset($_POST['simpan'])) {
                        // Handle form submission and database operations
                        // ...

                        // Example: 
                        // $query_insert = mysql_query("INSERT INTO your_table VALUES ...") or die(mysql_error());
                    }

                    // Additional form elements
                    echo "<tr bgcolor=\"#dedede\"><td colspan=\"9\"></td></tr>";
                    echo "<tr><td colspan=\"9\">
                        <input type=\"checkbox\" name=\"valid\" value=\"ya\" />
                        Anda yakin faktur <b>{$_SESSION['faktur1']}</b> sudah selesai di receipt ?
                    </td></tr>";
                    echo "<tr><td colspan=\"9\">
                        <input type=\"submit\" value=\"Kirim\" name=\"kirim\">
                        <input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\" />
                    </td></tr>";

                    // Check if form is submitted
                    if (isset($_POST['kirim'])) {
                        // Handle form submission and database operations
                        // ...

                        // Example: 
                        // $query_update = mysql_query("UPDATE your_table SET ...") or die(mysql_error());
                    }
                    echo "</table>";
                    echo "</form>";
                    ?>
                </td>
            </tr>
        </table>
    </body>
    </html>
    <?php
} else {
    header("location:../html./index.html");
}
?>
