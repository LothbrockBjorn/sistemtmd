<?php
require_once "../_config/config.php";

$chk = $_POST['checked'];

if(!isset($chk)) {
	echo "<script>alert('Tidak ada data yang di pilih'); window.location='data.php';</script>";
} else {
	foreach ($chk as $id) {
		$sql = mysqli_query($con,"DELETE FROM pengampu_matkul WHERE id_pengampu ='$id'") or die (mysqli_error($con));
	}
	if ($sql){
			echo "<script>alert('".count($chk)." Data berhasil di hapus'); window.location='data.php';</script>";
		}else{
			echo "<script>alert('Gagal hapus data coba lagi!');</script>";	
	}
}
?>