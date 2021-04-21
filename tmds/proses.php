<?php
	require_once"../_config/config.php";
	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

	if (isset($_POST['add'])) {
		$uuid = Uuid::uuid4()->toString();
		$matkul = trim(mysqli_real_escape_string($con, $_POST['matkul']));
		$ta = trim(mysqli_real_escape_string($con, $_POST['ta']));
		$select=mysqli_query($con, "SELECT * from pengampu_matkul where id_matkul='$matkul' AND ta ='$ta'");
        	if (mysqli_num_rows( $select) > 0) { 
       			while($row=mysqli_fetch_array($select))
        			{
        			$id_pengampu= $row['id_pengampu'];
        			$kd_prodi = $row['kd_prodi'];
        	}

        	// memanggil data sks untuk menetukan jitm di tabel matkul
        	$sql_get_jitm = mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul WHERE id_pengampu = '$id_pengampu'");
        	$get_jitm = mysqli_fetch_assoc($sql_get_jitm);
        	$sks = $get_jitm['sks'];
        	// penentuan seleksi jitm berdasarkan sks
        	if ($sks == 2) {
        		$jtmi = 8;
        	}else if ($sks == 3) {
        		$jtmi = 9;
        	}

        	//count jumlah capai tatap muka dosen
        $select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_pengampu = '$id_pengampu'");
        $count_data=mysqli_fetch_assoc($select_count);
        $data= $count_data['id_pengampu'];

		$ta = trim(mysqli_real_escape_string($con, $_POST['ta']));

		// cek data
		$sql_cek = mysqli_query($con, "SELECT * FROM tmds WHERE id_pengampu = '$id_pengampu' AND ta ='$ta'")or die(mysqli_error($con));
		if (mysqli_num_rows($sql_cek) > 0 ) {
			echo "<script>alert('Data rekap tatap muka sudah ada!');window.location='data.php';</script>";
		}else{
		mysqli_query($con, "INSERT INTO tmds (id_tmds, id_pengampu, jtmi, jctm, kd_prodi, ta) VALUES ('$uuid','$id_pengampu','$jtmi','$data','$kd_prodi','$ta')")or die(mysqli_error($con));
		echo "<script>alert('Data berhasil di inputkan');window.location='data.php';</script>";
		}
        }else{
        	echo "<script>alert('Data tatap muka yang ingin di rekap tidak ada!!');window.location='add.php';</script>";
        }

	// } elseif (isset($_POST['edit'])) {
	// 	$id = $_POST['id'];
	// 	$select=mysqli_query($con, "SELECT * from tmds where id_tmds='$id'");
 //        			while($row=mysqli_fetch_array($select))
 //        			{
 //        				$id_pengampu=$row['id_pengampu'];
 //        				$jtmi = $row['jtmi'];
 //        				$ta = $row['ta'];	
 //        			}
 //        $select_count=mysqli_query($con, "SELECT COUNT(*) as id_pengampu FROM tmdb WHERE id_pengampu='$id_pengampu'");
 //        $count_data=mysqli_fetch_assoc($select_count);
 //        $data= $count_data['id_pengampu'];
	// 	mysqli_query($con, "UPDATE tmds SET jctm = '$data' WHERE id_tmds = '$id'") or die(mysqli_error($con));
	// 	echo "<script>window.location='data.php';</script>";
	}
?> 