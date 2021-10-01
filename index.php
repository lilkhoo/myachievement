<?php 

if (isset($_GET['url'])) {
   if (file_exists('views/' . $_GET["url"] . '.php')) {
      require 'views/' . $_GET["url"] . '.php';
   } else {
      if (file_exists('views/ajax/' . $_GET['url'] . '.php')) {
         require 'views/ajax/' . $_GET['url'] . '.php';
      } else {
         echo "Halaman tidak ditemukan";
      }
   }
} else { 
   require 'views/index.php';
}

?>