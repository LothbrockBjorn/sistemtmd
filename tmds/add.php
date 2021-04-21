<?php include_once('../_header.php'); ?>

<div class="box">
	<h1>Rekam tatap muka</h1>
	<h4>
		<small>Tambah Data Rekam tatap muka</small>
		<div class="pull-right">
			<a href="data.php" class="btn btn-warning btn-xs"><i class="glyphicon glyphicon-chevron-left"></i> Kembali</a>
		</div>
	</h4>
	<div class="row">
		<div class="col-lg-6 col-lg-offset-3">
			<form action="proses.php" method="post">
				<div class="form-group">
					<label for="matkul">Matakuliah</label>
					<select name="matkul" id="matkul" class="form-control" required>
						<option value="">- Pilih -</option>
						<!-- membuat seleksi matkul per prodi session otoritas user -->
						<?php
						if (isset($_SESSION['lvl_prodi']) != '') {
						$lvl_prodi=$_SESSION['lvl_prodi'];
						$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
						$datasesi= mysqli_fetch_array($sqlsesi);
						$kd_prodi= $datasesi['kd_prodi'];
						$sql = mysqli_query($con, "SELECT * FROM matkul WHERE kd_prodi = '$kd_prodi'") or die (mysqli_error($con));
					}else{
						$sql = mysqli_query($con, "SELECT * FROM matkul") or die (mysqli_error($con));
					}	
						while ($data_matkul = mysqli_fetch_array($sql)){
							echo '<option value="'.$data_matkul['id_matkul'].'">'.$data_matkul['nama_matkul'].'</option>';
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="ta">Tahun Ajaran</label>
					<select class="form-control" id="ta" name="ta">
                    	<option>Pilih Tahun Ajaran</option>
                    	<?php
						$sqlsesi= mysqli_query($con, "SELECT * FROM ta");
                            while($row=mysqli_fetch_array($sqlsesi))
                            {
                            echo "<option>".$row['ta']."</option>";
                            }
                         ?>
                    </select>
				</div>
				<div class="form-group pull-right">
					<input type="submit" name="add" value="Simpan" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div 	

<?php/ 
include_once('../_footer.php')
?>