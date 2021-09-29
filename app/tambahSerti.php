<?php

require "../require/functions.php";


if (isset($_POST["submit"])) {

   // $course = $_POST['course'];
   // $penyelenggara = $_POST['penyelenggara'];
   // Cek apakah data berhasil ditambahkan atau tidak
   if (tambahkeun($_POST) > 0) {
      // mysqli_query($koneksi, "INSERT INTO `tb_sertifikat`(`id`, `course`, `penyelenggara`) VALUES ('', '$course', '$penyelenggara')");
      echo "
		<script>
			alert('Hebat'); document.location.href='index.php';
		</script>
		";
   } else {
      echo "
		<script>
			alert('Coba Cek Lagi Deh');
		</script>
		";
   }
}


?>

<!DOCTYPE html>
<html>

<head>
   <title>My Achievement | Tambah</title>
</head>

<body>

   <h1>Tambah Kuy</h1>
   <!-- <form method="post" action="" enctype="multipart/form-data">

      <table>

         <tr>
            <td><b>Gambar</b></td>
            <td>:</td>
            <td class="pilih"><input type="file" name="gambar"></td>
         </tr>
         <tr>
            <td><b>Course </b></td>
            <td>:</td>
            <td><input required type="text" name="course"></td>
         </tr>
         <tr>
            <td><b>penyelenggara </b></td>
            <td>:</td>
            <td><input required type="text" name="penyelenggara"></td>
         </tr> -->

   <form action="" method="post" enctype="multipart/form-data">
      <ul>
         <li>
            <label for="gambar">Gambar : </label>
            <input type="file" name="gambar">
         </li>

         <li>
            <label for="course">Course : </label>
            <input type="text" name="course">
         </li>

         <li>
            <label for="penyelenggara">Penyelenggara : </label>
            <input type="text" name="penyelenggara" id="penyelenggara">
         </li>


      </ul>

      <button type="submit" name="submit">Tambah</button>

   </form>
   <!-- <tr>
            <td colspan="3" align="center"><button name="submit">Tambah Data</button></td>
         </tr>
      </table>
   </form>


</body>

</html>