<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php";
    $akses = mysql_query("select * from pskm_emply_t where nik = '$_SESSION[nik]'") or die(mysql_error());
    $data_akses = mysql_fetch_array($akses);
    ?>
    <html>
    <head>
        <title>Untitled Document</title>
        <link href="CssStyle/stylequ.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="tampilan">
    <div id="container">
        <div id="header"><!-- end #header --></div>
        <div id="menu"><?php include "menu.php"; ?> <!-- end #header --></div>
        <div id="mainContent">
            <?php
            $utama = $_GET['utama'];
            if (isset($utama)) {
                echo "<br />";
                include "$utama.php";
            } else {
                ?>
                <tr>
                    <div align="center"><br/><img src="image/body.png" width="700" height="385"/><br></div>
                    <!-- end #mainContent -->
                <?php } ?>
        </div>
        <br/><br class="clearfloat"/>
        <div id="footer"><?php include "bawah.php"; ?> <!-- end #footer --></div>
        <!-- end #container -->
    </div>
    </body>
    </html>
    <?php
} else {
    header("location:index1.html");
}
?>
