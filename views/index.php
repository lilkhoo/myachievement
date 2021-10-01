<?php require 'functions/functions.php'; ?>

<?php

$dataSertifikat = query("SELECT * FROM tb_sertifikat ORDER BY id DESC");

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
            <div>
               <select class="select" name="" id="">
                  <option value="desc" selected>Terbaru</option>
                  <option value="asc">Terlama</option>
               </select>
            </div>
            <div class="main__certificates">
               <?php if (count($dataSertifikat) > 0) { ?>
                  <?php foreach ($dataSertifikat as $row) { ?>
                     <div class="main__certificate">
                        <img class="main__certificate-img" src="assets/img/<?= $row['gambar']; ?>" alt="<?= $row['course']; ?>">
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