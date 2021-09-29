<?php
require "require/functions.php";

if (isset($_SESSION["login"])) {
   header("Location: app");
   exit;
}

if (isset($_POST["register"])) {

   if (registrasi($_POST) > 0) {
      $_SESSION["login"] = true;
      $_SESSION["username"] = $_POST["username"];
      echo "<script>
				alert('Mantap'); document.location.href = 'app';
			</script>";
   } else {
      echo "<script>
				alert('user baru gagal ditambahkan!');
			</script>";
   }
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>My Achievement | Registrasi </title>
   <style>
      label {
         display: block;
      }
   </style>
</head>

<body>

   <h1>Halaman Registrasi</h1>


   <form action="" method="post">

      <ul>
         <li>
            <label for="nama">Nama : </label>
            <input type="text" name="nama" id="nama">
         </li>
         <li>
            <label for="username">username :</label>
            <input type="text" name="username" id="username">
         </li>
         <li>
            <label for="password">password :</label>
            <input type="password" name="password" id="password">
         </li>
         <li>
            <label for="password2">konfirmasi password :</label>
            <input type="password" name="password2" id="password2">
         </li>
      </ul>
      <button type="submit" name="register">Register!</button>


   </form>


</body>

</html>