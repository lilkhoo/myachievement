<?php

require "../require/functions.php";

$serti = query("SELECT * FROM tb_abi");

?>

<!DOCTYPE html>
<html>

<head>
   <title>My Achieve | Sertifikat</title>
</head>

<body>

   <h1>Abi Noval Fauzi</h1>
   <a href="tambahSerti.php">+Sertifikat</a>

   <br>
   <br>

   <table border="1" cellpadding="10" cellspacing="10">

      <tr>
         <td>ID</td>
         <td>Course</td>
         <td>Penyelenggara</td>
         <td>Gambar</td>
      </tr>

      <?php
      $i = 1;
      ?>

      <?php
      foreach ($serti as $row) : ?>
         <tr>
            <td><?= $i; ?></td>
            <td><img src="../img/sertifikat/abi/<?= $row["gambar"]; ?>" alt=""></td>
            <td><?= $row["course"]; ?></td>
            <td><?= $row["penyelenggara"]; ?></td>
         </tr>
         <?php $i++ ?>
      <?php endforeach; ?>



   </table>



</body>

</html>