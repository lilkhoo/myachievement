<?php

require 'functions/functions.php';

$username = $_SESSION['username'];

$id = $_POST['id'];

$query = "DELETE FROM `tb_sertifikat` WHERE id = $id";
mysqli_query($conn, $query);

if (mysqli_affected_rows($conn) > 0) { ?>
   <?php $dataSertifikat = query("SELECT * FROM tb_sertifikat WHERE username = '$username'"); ?>
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
               <div>
                  <button onclick="editData(this);" data-id="<?= $row['id']; ?>" class="btn-edit">Edit</button>
                  <button class="btn-delete" data-id="<?= $row['id']; ?>" onclick="hapusData(this);">Hapus</button>
               </div>
            </div>
         </div>
      <?php } ?>
   <?php } else { ?>
      <h1 class="header">Data Kosong!!</h1>
   <?php } ?>
<?php } else {
   echo "<script>
			   alert('GAGAL menghapus sertifikat!!');
         </script>"; ?>
   <?php $dataSertifikat = query("SELECT * FROM tb_sertifikat WHERE username = '$username'"); ?>
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
               <div>
                  <button onclick="editData(this);" data-id="<?= $row['id']; ?>" class="btn-edit">Edit</button>
                  <button class="btn-delete" onclick="modalClose();">Hapus</button>
               </div>
            </div>
         </div>
      <?php } ?>
   <?php } else { ?>
      <h1 class="header">Data Kosong!!</h1>
   <?php } ?>
<?php } ?>