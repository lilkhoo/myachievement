<?php
require "../require/functions.php";

// Cek Apakah Tombol Submit Sudah Ditekan Atau Belum
if (isset($_POST["submit"])) {


   // Cek apakah data berhasil ditambahkan atau tidak
   if (tambahkeun($_POST) > 0) {
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

   <form action="" method="post" enctype="multipart/form-data">
      <ul>
         <li>
            <label for="course">Course : </label>
            <input type="text" name="course" id="course">
         </li>

         <li>
            <label for="penyelenggara">Penyelenggara : </label>
            <input type="text" name="penyelenggara" id="penyelenggara">
         </li>

         <li>
            <label for="gambar">Gambar : </label>
            <input type="file" name="gambar" id="gambar">
         </li>
      </ul>

      <button type="submit" name="submit">Tambah</button>

   </form>


</body>

</html>