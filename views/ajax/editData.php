<?php

require 'functions/functions.php';

$username = $_SESSION['username'];

$id = $_POST['id'];

$dataLama = query("SELECT * FROM tb_sertifikat WHERE id = $id")[0];

$courseLama = $dataLama['course'];
$penyelenggaraLama = $dataLama['penyelenggara'];
$gambarLama = $dataLama['gambar'];

$course = htmlspecialchars($_POST["course"]);
$penyelenggara = htmlspecialchars($_POST["penyelenggara"]);

if ($_FILES['gambar']['error'] === 4) {
   $gambar = $gambarLama;
} else {
   $gambar = uploadGambar("sertifikat");
}

if ($course != $courseLama || $penyelenggara != $penyelenggaraLama) {
   $query = "UPDATE tb_sertifikat SET course = '$course', penyelenggara = '$penyelenggara', gambar='$gambar' WHERE id = $id;";
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
                     <button onclick="editBtn(this);" data-id="<?= $row['id']; ?>" class="btn-edit">Edit</button>
                     <button class="btn-delete" onclick="modalClose();">Hapus</button>
                  </div>
               </div>
            </div>
         <?php } ?>
      <?php } else { ?>
         <h1 class="header">Data Kosong!!</h1>
      <?php } ?>
   <?php } else {
      echo "<script>
			   alert('GAGAL mengedit sertifikat!!'); document.location.href='sertifikat';
         </script>";
   }
} else { ?>
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
                  <button onclick="editBtn(this);" data-id="<?= $row['id']; ?>" class="btn-edit">Edit</button>
                  <button class="btn-delete" onclick="modalClose();">Hapus</button>
               </div>
            </div>
         </div>
      <?php } ?>
   <?php } else { ?>
      <h1 class="header">Data Kosong!!</h1>
   <?php } ?>
<?php }

?>