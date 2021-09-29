<?php
require "../require/functions.php";

$id = $_GET['id'];

mysqli_query($koneksi, "delete from tb_sertifikat where id='$id'");

if (hapus($id) > 0) {
   echo "
		<script>
			alert('data gagal dihapus');
			document.location.href = '../app/index.php';
		</script>
		";
} else {
   echo "
		<script>
			alert('Data Dihapus');
			document.location.href = '../app/index.php';
		</script>
		";
}
