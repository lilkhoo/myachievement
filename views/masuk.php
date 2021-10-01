<?php 
require 'functions/functions.php';

if (isset($_SESSION['login'])) {
   header("Location: index");
   exit;
}

if (isset($_POST["login"])) {
   $username = $_POST["username"];
   $password = $_POST["password"];

   $result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

   if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row["password"])) {
         $_SESSION["login"] = true;
         $_SESSION["username"] = $username;
         header("Location: ../my-archieve");
         exit;
      } else {
         echo "<script>
                  alert('Username/password tidak valid!');
               </script>";
      }
   } else {
      echo "<script>
               alert('Username/password tidak valid!');
            </script>";
   }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
   <?php require 'templates/meta.php'; ?>
   <title>Masuk</title>
</head>

<body class="bg-sign">
   <div class="sign__container">
      <div class="sign__logo">
         <i class="bx bx-award sign__logo-icon"></i>
      </div>
      <form class="sign__form" method="POST" action="">
         <div class="input-field">
            <label class="sign__label" for="username">Username :</label>
            <input class="input" type="text" name="username" id="username" autocomplete="off">
         </div>
         <div class="input-field">
            <label class="sign__label" for="password">Password</label>
            <input class="input" type="password" name="password" id="password" autocomplete="off">
         </div>
         <div class="sign__remember-me">
            <div class="sign__remember-me-container">
               <input class="cursor-pointer" type="checkbox" name="remember-me" id="remember-me">
               <label class="cursor-pointer" for="remember-me">Ingat saya</label>
            </div>
            <a class="sign__redirect" href="#">Lupa password?</a>
         </div>
         <div class="sign__btn">
            <button type="submit" name="login" class="btn">Masuk</button>
            <a class="sign__redirect" href="daftar">Buat akun baru</a>
         </div>
      </form>
   </div>
</body>

</html>