<?php require 'functions/functions.php'; ?>

<?php

$username = $_SESSION['username'];
$dataSertifikat = query("SELECT * FROM tb_sertifikat WHERE username = '$username'");

if (isset($_POST["tambah"])) {
   if (tambahSertifikat($_POST) > 0) {
      echo "<script>
               alert('Hebat'); 
               document.location.href='sertifikat';
            </script>";
   } else {
      echo "<script>
               alert('Coba Cek Lagi Deh');
            </script>";
   }
}

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
            <div class="sertifikat__top">
               <h1 class="header">Sertifikat Saya</h1>
               <button class="btn" id="btn-tambah">Tambah</button>
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
                        <img class="main__certificate-img" src="assets/certificates/<?= html_entity_decode($row['gambar']); ?>" alt="<?= html_entity_decode($row['course']); ?>">
                        <div class="main__certificate-detail">
                           <div class="main__certificate-header">
                              <h3 class="main__certificate-course"><?= html_entity_decode($row['course']); ?></h3>
                              <small class="main__certificate-user"><a href="#">@<?= html_entity_decode($row['username']); ?></a></small>
                           </div>
                           <div>
                              <strong>From:</strong>
                              <a class="main__certificate-from" href="#" target="_blank" rel="noopener noreferrer"><?= html_entity_decode($row['penyelenggara']); ?></a>
                           </div>
                           <div>
                              <button data-id="<?= $row['id']; ?>" onclick="editBtn(this);" class="btn-edit modal-edit-open">Edit</button>
                              <button class="btn-delete" data-id="<?= $row['id']; ?>" onclick="hapusData(this);">Hapus</button>
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
      <div class="modal" id="modal-tambah">
         <div class="modal__container">
            <form class="modal__form" id="form-tambah" method="POST" action="" enctype="multipart/form-data">
               <div class="grid">
                  <label class="btn" for="sertifikat">Klik Untuk Pilih Sertifikat</label>
                  <input type="file" name="gambar" id="sertifikat" data-form-tambah="sertifikat" accept="image/*" class="input-file sertifikat">
                  <small class="error-message">Error Message</small>
               </div>
               <img class="modal__up-img" data-sertifikat src="" alt="">
               <div>
                  <label class="akun__form-label" for="course">Course :</label>
                  <input class="input" type="text" name="course" data-form-tambah="course" id="course">
                  <small class="error-message">Error Message</small>
               </div>
               <div>
                  <label class="akun__form-label" for="penyelenggara">Penyelenggara :</label>
                  <input class="input" type="text" name="penyelenggara" data-form-tambah="penyelenggara" id="penyelenggara">
                  <small class="error-message">Error Message</small>
               </div>
               <div class="flex gap-2">
                  <button type="submit" name="tambah" class="btn">Tambah</button>
                  <button type="reset" class="btn-ghost btn-batal" onclick="modalClose();">Batal</button>
               </div>
            </form>
         </div>
      </div>
      <div class="modal" id="modal-edit">
         <div class="modal__container">
            <form class="modal__form" id="form-edit" method="POST" action="" enctype="multipart/form-data">
               <div class="grid">
                  <label class="btn-edit" for="sertifikatEdit">Klik Untuk Ganti Sertifikat</label>
                  <input type="file" name="gambar" id="sertifikatEdit" data-form-edit="sertifikat" accept="image/*" class="input-file sertifikat">
                  <small class="error-message">Error Message</small>
               </div>
               <img class="modal__up-img" data-sertifikat data-sertifikat-edit alt="">
               <div>
                  <label class="akun__form-label" for="courseEdit">Course :</label>
                  <input class="input" type="text" name="course" data-form-edit="course" value="" id="courseEdit">
                  <small class="error-message">Error Message</small>
               </div>
               <div>
                  <label class="akun__form-label" for="penyelenggaraEdit">Penyelenggara :</label>
                  <input class="input" type="text" name="penyelenggara" data-form-edit="penyelenggara" value="" id="penyelenggaraEdit">
                  <small class="error-message">Error Message</small>
               </div>
               <input type="hidden" name="id" id="idEdit">
               <div class="flex gap-2">
                  <button type="submit" name="edit" class="btn-edit">Edit</button>
                  <button type="reset" class="btn-ghost btn-batal" onclick="modalClose();">Batal</button>
               </div>
            </form>
         </div>
      </div>
   </div>
   <div class="loader-wrapper">
      <div class="lds-ellipsis">
         <div></div>
         <div></div>
         <div></div>
         <div></div>
      </div>
   </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="dist/js/sertifikat.js"></script>
</body>

</html>