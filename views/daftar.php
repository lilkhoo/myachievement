<?php 
require 'functions/functions.php';

if (isset($_SESSION['login'])) {
   header("Location: index");
   exit;
}

if (isset($_POST["register"])) {
   if (registrasi($_POST) > 0) {
      $_SESSION["login"] = true;
      $_SESSION["username"] = $_POST["username"];
      echo "<script>
               alert('Anda berhasil registrasi!!'); 
               document.location.href = '../my-archieve';
            </script>";
   } else {
      echo "<script>
               alert('Gagal registrasi, silakan hudungi administrator!');
            </script>";
   }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
   <?php require 'templates/meta.php'; ?>
   <title>Daftar</title>
</head>

<body class="bg-sign">
   <div class="sign__container">
      <form class="sign__form" method="POST" action="">
         <div class="input-field">
            <label class="sign__label" for="nama">Nama :</label>
            <input class="input" type="text" name="nama" id="nama" autocomplete="off">
            <small class="error-message">Error Message</small>
         </div>
         <div class="input-field">
            <label class="sign__label" for="username">Username :</label>
            <input class="input" type="text" name="username" id="username" autocomplete="off">
            <small class="error-message">Error Message</small>
         </div>
         <div class="input-field">
            <label class="sign__label" for="password">Password</label>
            <input class="input" type="password" name="password" id="password" autocomplete="off">
            <small class="error-message">Error Message</small>
         </div>
         <div class="input-field">
            <label class="sign__label" for="password2">Konfirmasi Password</label>
            <input class="input" type="password" name="password2" id="password2" autocomplete="off">
            <small class="error-message">Error Message</small>
         </div>
         <div class="sign__remember-me">
            <div class="sign__remember-me-container">
               <input class="cursor-pointer" type="checkbox" name="remember-me" id="remember-me">
               <label class="cursor-pointer" for="remember-me">Ingat saya</label>
            </div>
         </div>
         <div class="sign__btn">
            <button type="submit" name="register" class="btn">Daftar</button>
            <a class="sign__redirect" href="masuk">Sudah terdaftar?</a>
         </div>
      </form>
   </div>
   <script>
      const nama = document.querySelector('[name="nama"]');
      const username = document.querySelector('[name="username"]');
      const password = document.querySelector('[name="password"]');
      const password2 = document.querySelector('[name="password2"]');
      const signForm = document.querySelector('.sign__form');

      signForm.addEventListener('submit', (e) => {
         if (!checkInputs()) {
            e.preventDefault();
         }

         checkInputs();
      });

      function checkInputs() {
         const namaValue = nama.value.trim();
         const usernameValue = username.value.trim();
         const passwordValue = password.value.trim();
         const password2Value = password2.value.trim();
         let numberValid = 0;

         if (namaValue === "") {
            setError(nama, "Nama wajib diisi");
         } else if (namaValue.length < 3) {
            setError(nama, "Nama minimal 3 karakter");
         } else if (!/^[a-zA-Z ]+$/.test(namaValue)) {
            setError(nama, "Nama hanya diperbolehkan menggunakan huruf");
         } else if (namaValue.length > 50) {
            setError(nama, "Nama maksimal 50 karakter");
         } else {
            setSuccess(nama);
            numberValid += 1;
         }

         if (usernameValue === "") {
            setError(username, "Username wajib diisi");
         } else if (usernameValue.length < 5) {
            setError(username, "Username minimal 5 karakter");
         } else if (!/^[a-zA-Z0-9]+$/.test(usernameValue)) {
            setError(username, "Username hanya diperbolehkan menggunakan huruf/angka");
         } else if (usernameValue.length > 12) {
            setError(username, "Username maksimal 12 karakter");
         } else {
            setSuccess(username);
            numberValid += 1;
         }

         if (passwordValue === "") {
            setError(password, "Password wajib diisi");
         } else if (passwordValue.length < 6) {
            setError(password, "Password terlalu pendek");
         } else {
            setSuccess(password);
            numberValid += 1;
         }

         if (password2Value === "") {
            setError(password2, "Password wajib diisi");
         } else if (password2Value !== passwordValue) {
            setError(password2, "Password tidak sama");
         } else {
            setSuccess(password2);
            numberValid += 1;
         }

         if (numberValid == 4) {
            return true;
         } else {
            return false;
         }
      }

      function setError(input, message) {
         const formControl = input.parentElement;
         const small = formControl.querySelector('small');
         small.innerHTML = message;
         small.classList.add('show');
         input.classList.add('error');
         input.classList.remove('success');
      }

      function setSuccess(input) {
         const formControl = input.parentElement;
         const small = formControl.querySelector('small');
         input.classList.remove('error');
         input.classList.add('success');
         small.classList.remove('show');
      }
   </script>
</body>

</html>