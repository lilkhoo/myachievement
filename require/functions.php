<?php
session_start();
// Koneksi Ke Databases
$koneksi = mysqli_connect("localhost", "root", "", "db_achieve");




function query($query)
{
   global $koneksi;

   $result = mysqli_query($koneksi, $query);
   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}


function tambahkeun($data)
{
   global $koneksi;
   // Ambil data dari tiap elemen dalam form
   $course = htmlspecialchars($data["course"]);
   $penyelenggara = htmlspecialchars($data["penyelenggara"]);
   $user = $_SESSION["username"];

   // Upload gambar
   $gambar = upload("sertifikat");
   if (!$gambar) {
      return false;
   }


   // query insert data
   $query = "INSERT INTO tb_sertifikat
				VALUES
				('', '$user', '$course', '$penyelenggara', '$gambar')
				";
   mysqli_query($koneksi, $query);

   return mysqli_affected_rows($koneksi);
}

function upload($type)
{

   $namafile = $_FILES['gambar']['name'];
   $ukuranfile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpname = $_FILES['gambar']['tmp_name'];

   // cek apakah tidak ada gambar yang di upload
   if ($error === 4) {
      echo "<script>
				alert('Eh Kamu Belum Upload Gambar Tuh');
				</script>";
      return false;
   }

   // Cek Yang diupload adalah gambar
   $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'webp'];
   $ekstensigambar = explode('.', $namafile);
   $ekstensigambar = strtolower(end($ekstensigambar));
   if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
      echo "<script>
				alert('Coba cek deh, Yang Kamu Upload Gambar atau bukan');
				</script>";
      return false;
   }

   // Cek jika ukuran nya terlalu besar
   if ($ukuranfile > 10000000) {
      echo "<script>
				alert('Kegedean Mas');
				</script>";
      return false;
   }

   // Lolos pengecekan gambar siap diUpload
   // generate nama gambar baru
   $namafilebaru = uniqid();
   $namafilebaru .= '.';
   $namafilebaru .= $ekstensigambar;
   if ($type == "sertifikat")
      move_uploaded_file($tmpname, '../img/sertifikat/' . $namafilebaru);
   else
      move_uploaded_file($tmpname, '../img/profil/' . $namafilebaru);
   return $namafilebaru;
}


function hapus($id)
{
   global $koneksi;
   mysqli_query($koneksi, "DELETE FROM tb_sertifikat WHERE id = $id");
   return mysqli_affected_rows($koneksi);
}







function ubah($data)
{
   global $koneksi;

   $id = $data["id"];
   $course = htmlspecialchars($data["course"]);
   $penyelenggara = htmlspecialchars($data["penyelenggara"]);
   $gambarlama = htmlspecialchars($data["gambarlama"]);

   // Cek apakah user pilih gambar baru atau tidak
   if ($_FILES['gambar']['error'] === 4) {
      $gambar = $gambarlama;
   } else {
      $gambar = upload("sertifikat");
   }




   // query insert data
   $query = "UPDATE tb_sertifikat SET course = '$course', gambar = '$gambar' WHERE id = $id";
   mysqli_query($koneksi, $query);

   return mysqli_affected_rows($koneksi);
}

function registrasi($data)
{
   global $koneksi;

   $username = strtolower(stripslashes($data["username"]));
   $nama = htmlspecialchars($data["nama"]);
   $password = mysqli_real_escape_string($koneksi, $data["password"]);
   $password2 = mysqli_real_escape_string($koneksi, $data["password2"]);



   // Cek username sudah ada atau belum
   $result = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username = '$username'");

   if (mysqli_fetch_assoc($result)) {
      echo "<script>
				alert('Geus aya ajg');
			</script>";
      return false;
   }



   // Cek Konfirmasi password
   if ($password !== $password2) {
      echo "<script>
				alert('Teu sesuai kehed');
			</script>";

      return false;
   }

   // enkripsi password
   $password = password_hash($password, PASSWORD_DEFAULT);


   // Tambahkan user baru ke database
   mysqli_query($koneksi, "INSERT INTO tb_user VALUES('', '$nama', '$username', '$password', '')");

   return mysqli_affected_rows($koneksi);
}
