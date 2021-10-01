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
   <script>
      const btnTambah = document.querySelector('#btn-tambah');
      const btnBatal = document.querySelectorAll('.btn-batal');
      const modalTambah = document.querySelector('#modal-tambah');
      const modalEdit = document.querySelector('#modal-edit');
      const modalContainerTambah = modalTambah.querySelector('.modal__container');
      const modalContainerEdit = modalEdit.querySelector('.modal__container');
      const modalFormEdit = modalEdit.querySelector('.modal__form');
      const modalContainer = document.querySelectorAll('.modal__container');
      const sertifikat = document.querySelectorAll('.sertifikat');
      const dataSertifikat = document.querySelectorAll('[data-sertifikat]');
      const formTambah = document.querySelector('#form-tambah');
      const loaderWrapper = document.querySelector('.loader-wrapper');
      const errorMessage = document.querySelectorAll('.error-message');
      const allInput = document.querySelectorAll('.input');
      const mainCertificates = document.querySelector('.main__certificates');
      const btnEdit = document.querySelectorAll('.btn-edit');

      sertifikat.forEach(el => {
         el.addEventListener('change', () => {
            const [file] = el.files;
            if (file) {
               dataSertifikat.forEach(element => {
                  element.src = URL.createObjectURL(file);
               });
            }
         });
      });

      btnTambah.addEventListener('click', () => {
         modalTambah.classList.add('show');
         modalContainerTambah.classList.add('show');
      });

      function editBtn(el) {
         modalEdit.classList.add('show');
         modalContainerEdit.classList.add('show');

         const id = $(el).data('id');
         $('.loader-wrapper').addClass('show');

         $.ajax({
            url: 'http://localhost:8080/MyProject/2021/comunity-project/my-archieve/views/ajax/dataEdit.php',
            data: {
               id: id
            },
            method: 'post',
            dataType: 'json',
            success: function(data) {
               $('[data-sertifikat-edit]').attr('src', `assets/certificates/${data.gambar}`);
               $('#idEdit').val(data.id);
               $('#courseEdit').val(data.course);
               $('#penyelenggaraEdit').val(data.penyelenggara);
               $('#gambarLama').val(data.gambar);
               $('.loader-wrapper').removeClass('show');
            }
         });
      }

      function modalClose(el) {
         modalTambah.classList.remove('show');
         modalEdit.classList.remove('show');
         modalContainer.forEach(element => {
            element.classList.remove('show');
         });
         dataSertifikat.forEach(element => {
            element.src = '';
         });
         errorMessage.forEach(element => {
            element.classList.remove('show');
         });
         allInput.forEach(element => {
            element.classList.remove('error');
            element.classList.remove('success');
         });
      }

      formTambah.addEventListener('submit', (e) => {
         e.preventDefault();

         const sertifikat = document.querySelector('[data-form-tambah="sertifikat"]');
         const course = document.querySelector('[data-form-tambah="course"]');
         const penyelenggara = document.querySelector('[data-form-tambah="penyelenggara"]');

         if (checkFormReg(sertifikat, course, penyelenggara)) {
            loaderWrapper.classList.add('show');
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "tambahData", true);
            xhr.onload = () => {
               if (xhr.readyState === 4 && xhr.status === 200) {
                  let data = xhr.response;
                  mainCertificates.innerHTML = data;
                  loaderWrapper.classList.remove('show');
                  modalTambah.classList.remove('show');
               }
            }
            let formData = new FormData(formTambah);
            xhr.send(formData);
         }
      });

      modalFormEdit.addEventListener('submit', (e) => {
         e.preventDefault();

         const sertifikat = document.querySelector('[data-form-edit="sertifikat"]');
         const course = document.querySelector('[data-form-edit="course"]');
         const penyelenggara = document.querySelector('[data-form-edit="penyelenggara"]');

         if (checkFormEdit(sertifikat, course, penyelenggara)) {
            loaderWrapper.classList.add('show');
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "editData", true);
            xhr.onload = () => {
               if (xhr.readyState === 4 && xhr.status === 200) {
                  let data = xhr.response;
                  mainCertificates.innerHTML = data;
                  loaderWrapper.classList.remove('show');
                  modalEdit.classList.remove('show');
                  modalFormEdit.querySelectorAll('input').forEach(el => {
                     el.classList.remove('success');
                     el.classList.remove('error');
                  });
               }
            }
            let formData = new FormData(modalFormEdit);
            xhr.send(formData);
         }
      });

      function checkFormReg(sertifikat, course, penyelenggara) {
         const sertifikatValue = sertifikat.value.trim();
         const courseValue = course.value.trim();
         const penyelenggaraValue = penyelenggara.value.trim();

         let numberValid = 0;

         if (sertifikatValue === "") {
            setError(sertifikat, "Wajib memilih gambar!");
         } else {
            setSuccess(sertifikat);
            numberValid += 1;
         }

         if (courseValue === "") {
            setError(course, "Course wajib diisi");
         } else if (courseValue.length < 3) {
            setError(course, "Course minimal 3 karakter");
         } else if (courseValue.length > 100) {
            setError(course, "Course maksimal 100 karakter");
         } else {
            setSuccess(course);
            numberValid += 1;
         }

         if (penyelenggaraValue === "") {
            setError(penyelenggara, "Penyelenggara wajib diisi");
         } else if (penyelenggaraValue.length < 3) {
            setError(penyelenggara, "Penyelenggara minimal 3 karakter");
         } else if (penyelenggaraValue.length > 50) {
            setError(penyelenggara, "Penyelenggara maksimal 50 karakter");
         } else {
            setSuccess(penyelenggara);
            numberValid += 1;
         }

         if (numberValid == 3) {
            return true;
         } else {
            return false;
         }
      }

      function checkFormEdit(sertifikat, course, penyelenggara) {
         const sertifikatValue = sertifikat.value.trim();
         const courseValue = course.value.trim();
         const penyelenggaraValue = penyelenggara.value.trim();

         let numberValid = 0;

         if (sertifikatValue !== "") {
            setSuccess(sertifikat);
            numberValid += 1;
         } else {
            setSuccess(sertifikat);
            numberValid += 1;
         }

         if (courseValue === "") {
            setError(course, "Course wajib diisi");
         } else if (courseValue.length < 3) {
            setError(course, "Course minimal 3 karakter");
         } else if (courseValue.length > 100) {
            setError(course, "Course maksimal 100 karakter");
         } else {
            setSuccess(course);
            numberValid += 1;
         }

         if (penyelenggaraValue === "") {
            setError(penyelenggara, "Penyelenggara wajib diisi");
         } else if (penyelenggaraValue.length < 3) {
            setError(penyelenggara, "Penyelenggara minimal 3 karakter");
         } else if (penyelenggaraValue.length > 50) {
            setError(penyelenggara, "Penyelenggara maksimal 50 karakter");
         } else {
            setSuccess(penyelenggara);
            numberValid += 1;
         }

         if (numberValid == 3) {
            return true;
         } else {
            return false;
         }
      }

      function hapusData(el) {
         const confirmData = confirm("Yakin?");
         if (confirmData) {
            loaderWrapper.classList.add('show');
            const id = el.getAttribute('data-id');
            const newForm = document.createElement('form');
            const newInput = document.createElement('input');
            newForm.setAttribute('class', 'absolute opacity-0 pointer-event-none form-hapus');
            newInput.setAttribute('value', id);
            newInput.setAttribute('name', 'id');
            el.parentElement.appendChild(newForm);
            const formHapus = document.querySelector('.form-hapus');
            formHapus.appendChild(newInput);
            console.log(id);
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "hapusData", true);
            xhr.onload = () => {
               if (xhr.readyState === 4 && xhr.status === 200) {
                  let data = xhr.response;
                  mainCertificates.innerHTML = data;
                  loaderWrapper.classList.remove('show');
               }
            }
            let formData = new FormData(formHapus);
            xhr.send(formData);
         }
      }

      function setError(input, message) {
         const formControl = input.parentElement;
         const small = formControl.querySelector('small');
         small.innerHTML = message;
         small.classList.add('show');
         input.classList.add('error');
         input.classList.remove('success');
      }

      function setSuccess(input) {
         const formControl = input.parentElement;
         const small = formControl.querySelector('small');
         input.classList.remove('error');
         input.classList.add('success');
         small.classList.remove('show');
      }
   </script>
</body>

</html>