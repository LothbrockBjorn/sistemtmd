<?php

	require_once"../_config/config.php";
	require "../assets/libs/vendor/autoload.php";

	use Ramsey\Uuid\Uuid;
	use Ramsey\Uuid\Exception\UnstatisfiedDependencyException;

// modal data
	if(isset($_POST['getCloning'])) {
    $ta = $_POST['getCloning'];
    ?>
    <p>Apakah anda ingin menyalin  data pengampu matakuliah tahun ajaran <b>( <?=$ta?> )</b>  <br> ke tahun ajaran</p>
		<div class="input-group">
			<input type="hidden" name="talama" value="<?=$ta?>">
			<input type="text" name="tahun_ajaran" class="form-control" placeholder="Tahun Ajaran" required>
		</div>

    <!-- add data tahun ajaran -->
<?php }elseif (isset($_POST['add'])) {
  $uuid = Uuid::uuid4()->toString();
  $ta = $_POST['ta'];
  $sql_cek = mysqli_query($con, "SELECT * from ta where ta = '$ta'")or die(mysqli_error($con));
  if (mysqli_num_rows($sql_cek) > 0){
      echo "<script>alert('Data tahun ajaran sudah di input!');window.location='add.php';</script>";
    }else{
  $sql = mysqli_query($con, "INSERT INTO ta (id_ta, ta) VALUES ('$uuid', '$ta')")or die(mysqli_error($con));
   echo "<script>alert('Data berhasil di tambahkan');window.location='data.php';</script>";
 }

  // cloning data pengampu matakuliah ke tahun ajaran baru
}elseif (isset($_POST['simpan'])) {
	if (isset($_SESSION['lvl_prodi']) != '') {
          $ta = $_POST['talama'];
          $tabaru = $_POST['tahun_ajaran'];
          //maengambil data prodi
          $lvl_prodi=$_SESSION['lvl_prodi'];
          $sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
          $datasesi= mysqli_fetch_array($sqlsesi);
          $kd_prodi= $datasesi['kd_prodi'];
          //mengambil data pengampu
            $sql = mysqli_query($con, "SELECT * from pengampu_matkul where kd_prodi ='$kd_prodi' AND ta ='$ta'");
          }else{
          	$sql = mysqli_query($con, "SELECT * from pengampu_matkul where ta ='$ta'");
          }
            while ($row = mysqli_fetch_array($sql)){ 
            	$uuid = Uuid::uuid4()->toString();
            	$idpengampu1 = $row['id_dosen1'];
            	$idpengampu2 = $row['id_dosen2'];
            	$kelas = $row['kelas'];
            	$id_matkul = $row['id_matkul'];
			
            	mysqli_query($con, "INSERT INTO pengampu_matkul (id_pengampu, id_dosen1, id_dosen2, kelas, id_matkul, kd_prodi, ta) VALUES ('$uuid','$idpengampu1','$idpengampu2','$kelas','$id_matkul','$kd_prodi','$tabaru')")or die(mysqli_error($con));
            } 
            echo "<script>alert('Pengampu matakuliah berhasil di salin ke tahun ajaran $tabaru');window.location='data.php';</script>";
} ?>