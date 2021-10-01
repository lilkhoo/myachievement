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
      url: 'http://localhost:8080/MyProject/2021/comunity-project/myachievement/views/ajax/dataEdit.php',
      data: {
         id: id
      },
      method: 'post',
      dataType: 'json',
      success: function (data) {
         $('[data-sertifikat-edit]').attr('src', `assets/certificates/${htmlDecode(data.gambar)}`);
         $('#idEdit').val(htmlDecode(data.id));
         $('#courseEdit').val(htmlDecode(data.course));
         $('#penyelenggaraEdit').val(htmlDecode(data.penyelenggara));
         $('#gambarLama').val(htmlDecode(data.gambar));
         $('.loader-wrapper').removeClass('show');
      }
   });
}

function modalClose() {
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
            dataSertifikat.forEach(gambarSertif => {
               gambarSertif.src = '';
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

function htmlDecode(str) {
   let txt = document.createElement('textarea');
   txt.innerHTML = str;
   return txt.value;
 }