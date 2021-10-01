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
            <div class="peringkat__top">
               <h1 class="header">Peringkat MyAchievement</h1>
               <div>
                  <select name="" id="" class="select">
                     <option value="">Teratas</option>
                     <option value="">Terbawah</option>
                  </select>
                  <select name="" id="" class="select">
                     <option value="">1 - 10</option>
                     <option value="">1 - 50</option>
                     <option value="">1 - 100</option>
                     <option value="">Semua</option>
                  </select>
               </div>
            </div>
            <div class="user__container">
               <div class="user__card">
                  <div class="user__img">
                     <img class="user__pic" src="https://source.unsplash.com/random" alt="">
                     <div class="user__peringkat">
                        <p class="user__peringkat-detail">1</p>
                     </div>
                  </div>
                  <div class="user__detail">
                     <div>
                        <h2 class="user__nama">Abi Noval Fauzi</h2>
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
      </section>
   </div>
</body>

</html>