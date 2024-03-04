<?php
session_start();
if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php"; // Include the database connection file at the beginning
?>

<html>
<head>
    <title>Rekam Medis Application System</title>
</head>
<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- Your HTML form here -->
        <!-- ... -->
    </form>

    <?php
    if ($_SESSION['sudah_login'] && isset($_POST['simpan'])) {
        // Implement your PHP logic here
        // ...

        if ($_POST['kirim']) {
            // Implement logic for submitting the form
            // ...

            if ($_POST['valid'] == "ya") {
                // Handle the case when the prescription is valid
                // ...
            } else {
                echo '<script language="javascript">alert("Data tidak terkirim, silahkan checklist validasi obat yang diberikan!");self.close()</script>';
            }
        }
    }
    ?>

</body>
</html>

<?php
} else {
    header("location:index.html");
}
?>
