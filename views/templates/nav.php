<?php

if (!isset($_SESSION['login'])) {
   header("Location: masuk");
   exit;
}

?>

<nav class="nav">
   <div class="nav__container">
      <a href="../myachievement" class="nav__logo">
         <i class='bx bx-award'></i>
      </a>
      <div class="nav__links-container">
         <div class="nav__links">
            <div>
               <a class="nav__link" href="user">User</a>
            </div>
            <div>
               <a class="nav__link" href="peringkat">Peringkat</a>
            </div>
         </div>
         <div class="nav__profile-container">
            <img class="nav__profile-img" src="https://source.unsplash.com/random" alt="Foto Profile">
            <div class="nav__profile-links">
               <a class="nav__profile-link" href="profil">
                  <i class='bx bx-user nav__profile-link-icon'></i>
                  <span>Profil</span>
               </a>
               <a class="nav__profile-link" href="sertifikat">
                  <i class='bx bx-award nav__profile-link-icon'></i>
                  <span>Sertifikat</span>
               </a>
               <a class="nav__profile-link" href="akun">
                  <i class='bx bx-user-circle nav__profile-link-icon'></i>
                  <span>Akun</span>
               </a>
               <hr>
               <a class="nav__profile-link" href="keluar">
                  <i class='bx bx-log-out-circle nav__profile-link-icon'></i>
                  <span>Keluar</span>
               </a>
            </div>
         </div>
      </div>
   </div>
</nav>