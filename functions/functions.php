<?php 
session_start();

require 'database.php';

function query($query)
{
   global $conn;

   $result = mysqli_query($conn, $query);
   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}

function uploadGambar($type)
{
   $namafile = $_FILES['gambar']['name'];
   $ukuranfile = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmpname = $_FILES['gambar']['tmp_name'];

   if ($error === 4) {
      echo "<script>
               alert('Eh Kamu Belum Upload Gambar Tuh');
				</script>";
      return false;
   }

   $ekstensigambarvalid = ['jpg', 'jpeg', 'png', 'webp'];
   $ekstensigambar = explode('.', $namafile);
   $ekstensigambar = strtolower(end($ekstensigambar));
   if (!in_array($ekstensigambar, $ekstensigambarvalid)) {
      echo "<script>
               alert('Coba cek deh, Yang Kamu Upload Gambar atau bukan');
				</script>";
      return false;
   }

   if ($ukuranfile > 10000000) {
      echo "<script>
               alert('Kegedean Mas');
				</script>";
      return false;
   }

   $namafilebaru = uniqid();
   $namafilebaru .= '.';
   $namafilebaru .= $ekstensigambar;
   if ($type == "sertifikat")
      move_uploaded_file($tmpname, 'assets/certificates/' . $namafilebaru);
   else
      move_uploaded_file($tmpname, 'assets/profile/' . $namafilebaru);
   return $namafilebaru;
}

function registrasi($data)
{
   global $conn;

   $username = strtolower(stripslashes($data["username"]));
   $nama = htmlspecialchars($data["nama"]);
   $password = mysqli_real_escape_string($conn, $data["password"]);
   $password2 = mysqli_real_escape_string($conn, $data["password2"]);

   $result = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

   if (mysqli_fetch_assoc($result)) {
      echo "<script>
				alert('Geus aya ajg');
			</script>";
      return false;
   }

   if ($password !== $password2) {
      echo "<script>
				alert('Teu sesuai kehed');
			</script>";

      return false;
   }

   $password = password_hash($password, PASSWORD_DEFAULT);

   mysqli_query($conn, "INSERT INTO tb_user VALUES('', '$nama', '$username', '$password', '')");

   return mysqli_affected_rows($conn);
}
