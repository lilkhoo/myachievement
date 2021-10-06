<?php

require '../../functions/functions.php';

$username = $_SESSION['username'];

$keyword = htmlspecialchars($_POST['keyword']);
$waktu = htmlspecialchars($_POST['waktu']);

if ($keyword != '') {
   $dataSertifikat = query("SELECT * FROM `tb_sertifikat` WHERE MATCH(course) AGAINST('$keyword' IN NATURAL LANGUAGE MODE) AND username = '$username'");
} else {
   $dataSertifikat = query("SELECT * FROM `tb_sertifikat` WHERE username = '$username' ORDER BY id $waktu");
}

?>

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
   <h1 class="header col-span-3" style="font-size: 18px;">@<?= $username; ?> tidak memiliki course tentang <?= $keyword; ?></h1>
<?php } ?>
<div class="loader-wrapper-2">
   <div class="lds-ellipsis">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
   </div>
</div>