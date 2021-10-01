<?php 

require '../../functions/functions.php';

$id = $_POST['id'];
$data = query("SELECT * FROM tb_sertifikat WHERE id = $id")[0];

echo json_encode($data);

?>