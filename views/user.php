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
         <div class="user">
            <div class="user__search">
               <input class="input" type="text" name="" id="" placeholder="Masukkan username/nama...">
               <button class="btn">Cari</button>
            </div>
            <div class="user__recomendation">
               <h1 class="header">Rekomendasi</h1>
               <div class="user__container">
                  <div class="user__card">
                     <div class="user__img">
                        <img class="user__pic" src="https://source.unsplash.com/random" alt="">
                     </div>
                     <div class="user__detail">
                        <div>
                           <h2 class="user__name">Abi Noval Fauzi</h2>
                           <a class="user__username" href="#">@abinoval</a>
                        </div>
                        <hr>
                        <div>
                           <div class="flex">
                              <strong class="w-24">Peringkat</strong>
                              <p>1</p>
                           </div>
                           <div class="flex">
                              <strong class="w-24">Sertifikat</strong>
                              <p>26</p>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr>
               </div>
            </div>
         </div>
      </section>
   </div>
</body>

</html>