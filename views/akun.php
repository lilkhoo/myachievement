<?php require 'functions/functions.php'; ?>

<!DOCTYPE html>
<html lang="id">

<head>
   <?php require 'templates/meta.php'; ?>
   <title>MyAchievement</title>
</head>

<body>
   <div id="container">
      <?php require 'templates/nav.php'; ?>

      <section class="main">
         <div class="akun">
            <h1 class="header">Pengaturan Akun</h1>
            <form class="akun__form" method="" action="">
               <div class="akun__form-img">
                  <h1 class="akun__form-label">Foto Profil</h1>
                  <div class="akun__img-container">
                     <img class="akun__img" src="https://source.unsplash.com/random" data-foto="https://source.unsplash.com/random" alt="">
                     <div>
                        <label class="btn" for="foto">Ganti</label>
                        <input type="file" name="foto" id="foto" accept="image/*" class="input-file">
                     </div>
                  </div>
               </div>
               <div>
                  <label class="akun__form-label" for="nama">Nama :</label>
                  <input class="input" type="text" name="nama" id="nama">
               </div>
               <div>
                  <label class="akun__form-label" for="email">Email :</label>
                  <input class="input" type="text" name="email" id="email" disabled>
               </div>
               <div>
                  <label class="akun__form-label" for="username">Username :</label>
                  <input class="input" type="text" name="username" id="username">
               </div>
               <div>
                  <label class="akun__form-label" for="password">Password :</label>
                  <div class="akun__pass">
                     <input class="input" type="text" name="password" id="password">
                     <button class="btn">Ganti</button>
                  </div>
               </div>
               <button class="btn">Simpan Perubahan</button>
            </form>
         </div>
      </section>
   </div>
   <script>
      const foto = document.querySelector('#foto');
      const dataFoto = document.querySelector('[data-foto]');
      foto.addEventListener('change', () => {
         const [file] = foto.files;
         if (file) {
            dataFoto.src = URL.createObjectURL(file);
         }

         dataFoto.addEventListener('error', () => {
            dataFoto.src = dataFoto.getAttribute('data-foto');
            alert("Maaf, sepertinya yang ada upload bukan gambar!");
         });
      });
   </script>
</body>

</html>