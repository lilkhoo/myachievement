<?php
require "require/functions.php";

if (isset($_SESSION["login"])) {
   header("Location: app");
   exit;
}



if (isset($_POST["login"])) {


   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");


   // Cek Username 
   if (mysqli_num_rows($result) === 1) {

      // Cek password
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
         $_SESSION["login"] = true;
         $_SESSION["username"] = $username;
         echo "<script>
				alert('Login Berhasil'); document.location.href = 'app';
			</script>";
      }
   }

   $error = true;
}
?>

<!DOCTYPE html>
<html>

<head>
   <title>My Achieve | Login</title>
</head>

<body>


   <h1>Halaman Login</h1>

   <?php if (isset($error)) : ?>
      <p style="color: red; font-style: italic;">Username/Password Salah</p>
   <?php endif; ?>


   <a href="registrasi.php">Registrasi</a>
   <form action="" method="post">

      <ul>
         <li>
            <label for="username">Username</label>
            <input type="text" name="username">
         </li>
         <li>
            <label for="password">Password</label>
            <input type="password" name="password">
         </li>
      </ul>

      <button type="submit" name="login">Login</button>

   </form>


</body>

</html>