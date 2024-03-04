<?php
session_start();

if ($_SESSION['sudah_login'] == true) {
    include "koneksi.php"; // Make sure koneksi.php contains the necessary database connection logic

    // Function to sanitize user input
    function sanitize($input)
    {
        return htmlspecialchars(trim($input));
    }

    // Pagination setup
    $limit = 10;
    $halaman = isset($_GET['halaman']) ? intval($_GET['halaman']) : 1;
    $offset = ($halaman - 1) * $limit;

    // Query to retrieve user data with pagination
    $query = "SELECT a.nik, c.nama, a.id_jns_poli, a.akses
              FROM pskm_emply_t a
              INNER JOIN pskm_mst_pegawai_t c ON a.nik = c.nik
              ORDER BY nik ASC
              LIMIT $offset, $limit";

    $result = mysqli_query($koneksi, $query);

    // Display HTML
    ?>
    <html>
    <head>
        <title>Rekam Medis Application System</title>
    </head>
    <body>
    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="3">
        <tr>
            <td valign="top">
                <table border="0" cellpadding="3" cellspacing="3">
                    <tr>
                        <td colspan="6" align="center"><b>Data User</b></td>
                    </tr>
                    <tr>
                        <td colspan="6" align="center"><br></td>
                    </tr>
                    <tr bgcolor="#93CDF5">
                        <td height="30" align="center">No</td>
                        <td align="center">NIK</td>
                        <td align="center">Nama</td>
                        <td align="center">Jenis Poli</td>
                        <td align="center">Akses</td>
                        <td align="center">Tool</td>
                    </tr>

                    <?php
                    $no = 1;
                    while ($data_user = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td><?php echo sanitize($data_user[0]); ?></td>
                            <td><?php echo sanitize($data_user[1]); ?></td>
                            <td><?php echo sanitize($data_user[2]); ?></td>
                            <td><?php echo sanitize($data_user[3]); ?></td>
                            <td>[<a href="index.php?utama=frm_edit_user&id=<?php echo $data_user[0]; ?>">Edit</a>]
                                [<a href="delete_user.php?id=<?php echo $data_user[0]; ?>">Delete</a>]
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                    <tr bgcolor="#93CDF5">
                        <td colspan="6"></td>
                    </tr>
                </table>
                <?php
                // Pagination links
                $queryTotal = "SELECT COUNT(*) AS total FROM pskm_emply_t";
                $resultTotal = mysqli_query($koneksi, $queryTotal);
                $rowTotal = mysqli_fetch_assoc($resultTotal);
                $total_halaman = ceil($rowTotal['total'] / $limit);

                if (!empty($halaman) && $halaman != 1) {
                    $sebelumnya = $halaman - 1;
                    echo "<A HREF=index.php?utama=frm_view_user&halaman=$sebelumnya>Sebelumnya</A> - ";
                } else {
                    echo "Sebelumnya - ";
                }

                for ($i = 1; $i <= $total_halaman; $i++) {
                    if ($i != $halaman) {
                        echo "<a HREF=index.php?utama=frm_view_user&halaman=$i>$i</A> - ";
                    } else {
                        echo "$i - ";
                    }
                }

                if ($halaman < $total_halaman) {
                    $berikutnya = $halaman + 1;
                    echo "<A HREF=index.php?utama=frm_view_user&halaman=$berikutnya>Berikutnya</A>";
                } else {
                    echo "Berikutnya";
                }
                ?>
            </td>
        </tr>
        <tr>
            <td><br></td>
        </tr>
    </table>
    </body>
    </html>
    <?php
} else {
    header("location:index.html");
}
?>
