<?php
require '../require/functions.php';

$id = $_GET['id'];
if (isset($_POST["submit"])) {

    $course = $_POST['course'];
    $penyelenggara = $_POST['penyelenggara'];

    if (editdata($_POST) > 0) {
        mysqli_query($koneksi, "INSERT INTO `tb_sertifikat`(`id`, `course`, `penyelenggara`) VALUES ('', '$course', '$penyelenggara')");
        echo "
                <script>
                    alert('simpan data sukses!');
                    document.location='../app/index.php';
                </script>";
    } else {
        echo "
                <script>
                    alert('simpan data gagal!');
                    document.location='ubah.php';
                </script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Data</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no ">
</head>

<body>
    <header>
        <h3>Edit Data</h3>
    </header>
    <br><br><br><br><br>
    <article>
        <a href="../app/index.php">&#8656;Kembali</a>
        <div>
            <?php

            $data = mysqli_query($koneksi, "SELECT * FROM tb_sertifikat WHERE id='$id'");
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <form action="" method="post">
                    <table>
                        <tr>
                            <th colspan="3" class="judul2">Edit Data ucup</th>
                        </tr>
                        <tr>
                            <td>course</td>
                            <td>:</td>
                            <td>
                                <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                                <input type="text" name="course" value="<?php echo $d['course']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>penyelenggara</td>
                            <td>:</td>
                            <td><input type="text" name="penyelenggara" value="<?php echo $d['penyelenggara']; ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center"><button name="submit">Edit Data</button></td>
                        </tr>
                    </table>
                </form>
            <?php
            }
            ?>
        </div>
    </article>
</body>

</html>