<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
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
                $tanggal = date('d');
                $bulan = date('m');
                $tahun = date('Y');
                $tgl = $tahun . '-' . $bulan . '-' . $tanggal;

                echo "<form method = \"post\" action = \"$SELF_PHP\">";
                echo "<table width=\"100%\" border=\"0\" cellpadding=\"3\" cellspacing=\"5\" width=\"90%\">";
                echo "<tr><td colspan = \"10\" align=\"center\"><b>Diagnosa Pasien</b></td></tr>";
                // ... (rest of your code)
                echo "<tr><td colspan = \"10\" align = \"center\"><input type = \"submit\" value = \"Simpan\"><input type=\"button\" value=\"Batal\" onclick=\"self.history.back()\" /></td></tr>";
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
    header("location:index1.html");
}
?>
