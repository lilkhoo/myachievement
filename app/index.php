<?php

require "../require/functions.php";

$serti = query("SELECT * FROM tb_sertifikat");

?>

<!DOCTYPE html>
<html>

<head>
   <title>My Achieve | Sertifikat</title>
</head>

<body>

   <h1>EKO PUNYA</h1>
   <a href="tambahSerti.php">+Sertifikat</a>

   <br>
   <br>
   <a href="../logout.php">Logout</a>
   <table border="1" cellpadding="10" cellspacing="5">

      <tr>
         <td>ID</td>
         <td>Course</td>
         <td>Penyelenggara</td>
         <td>Gambar</td>
         <td>Aksi</td>
      </tr>

      <?php
      $i = 1;
      ?>

      <?php
      foreach ($serti as $row) : ?>
         <tr>
            <td><?= $i; ?></td>
            <td><?= $row["course"]; ?></td>
            <td><?= $row["penyelenggara"]; ?></td>
            <td><img src="../img/sertifikat/<?= $row["gambar"]; ?>" width="100"></td>
            <td>
               <a href="../action/ubah.php?id=<?= $row["id"]; ?>">Ubah</a> ||
               <a href="../action/hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('Yakin Kamu Akan Menghapus Data?');">Hapus</a>
            </td>
         </tr>
         <?php $i++ ?>
      <?php endforeach; ?>



   </table>



</body>

</html>