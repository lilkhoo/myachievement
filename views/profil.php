<?php require 'functions/functions.php'; ?>

<?php 

$username = $_SESSION['username'];
$dataUser = query("SELECT * FROM tb_user WHERE username = '$username'")[0];
$dataSertifikat = query("SELECT * FROM tb_sertifikat WHERE username = '$username'");

?>

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
         <div class="main__container">
            <div class="profile__top">
               <div class="profile__container">
                  <img class="profile__img" src="https://source.unsplash.com/random" alt="">
                  <div>
                     <h1 class="profile__name"><?= $dataUser['nama']; ?></h1>
                     <p class="profile__username">@<?= $dataUser['username']; ?></p>
                  </div>
               </div>
               <div class="profile__filter">
                  <div>
                     <select class="select" name="" id="">
                        <option value="">Terbaru</option>
                        <option value="">Terlama</option>
                     </select>
                  </div>
                  <div class="profile__search">
                     <input class="input" type="text" name="" id="" placeholder="Cari sertifikat...">
                     <button class="btn">Cari</button>
                  </div>
               </div>
            </div>
            <div class="main__certificates">
               <?php if (count($dataSertifikat) > 0) { ?>
                  <?php foreach ($dataSertifikat as $row) { ?>
                     <div class="main__certificate">
                        <img class="main__certificate-img" src="assets/certificates/<?= $row['gambar']; ?>" alt="<?= $row['course']; ?>">
                        <div class="main__certificate-detail">
                           <div class="main__certificate-header">
                              <h3 class="main__certificate-course"><?= $row['course']; ?></h3>
                              <small class="main__certificate-user"><a href="#">@<?= $row['username']; ?></a></small>
                           </div>
                           <div>
                              <strong>From:</strong>
                              <a class="main__certificate-from" href="#" target="_blank" rel="noopener noreferrer"><?= $row['penyelenggara']; ?></a>
                           </div>
                        </div>
                     </div>
                  <?php } ?>
               <?php } else { ?>
                  <h1 class="header">Data Kosong!!</h1>
               <?php } ?>
            </div>
         </div>
      </section>
   </div>
</body>

</html>