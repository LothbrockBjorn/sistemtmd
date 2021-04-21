 <?php include_once('../_header.php');?>

<div class="box">
	<h1>Rekap TMD</h1>
	<h4>
		<small>Data Rekap TM</small>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="add.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Rekap data</a>
		<?php } ?>
		</div>
	</h4>
<!-- 	<div style="margin-bottom: 20px;">
		<form class="form-inline" action="" method="post">
			<div class="form-group">
				<input type="text" name="pencarian" class="form-control" placeholder="Pencarian">	
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" 
					aria-hidden="true"></span></button>
			</div>
		</form>
	</div>
 -->	<div class="table-responsive">
		<table id="table" class="table table-striped table-bordered table-hover">
			<thead>
				<tr>
					<th>No.</th>
					<th>Matakuliah/TA</th>
					<th>Smt/Kelas</th>
					<th>Sks</th>
					<th>Nama Dosen Pengampu</th>
					<th>Jumlah Tatap Muka ideal</th>
					<th>Jumlah Capai Tatap Muka</th>
					<th>Sisa Tatap Muka</th>
					<th>Last Updated</th>
					<th><i class="glyphicon glyphicon-cog"></i></th>
				
				</tr>
			</thead>
			<tbody>
				<?php 
				$no = 1;
				if (isset($_SESSION['lvl_prodi']) != '') {
					$lvl_prodi=$_SESSION['lvl_prodi'];
					$sqlsesi= mysqli_query($con, "SELECT * FROM prodi WHERE lvl_prodi = '$lvl_prodi'");
					$datasesi= mysqli_fetch_array($sqlsesi);
					$kd_prodi= $datasesi['kd_prodi'];
					$query = "SELECT * FROM tmds WHERE tmds.kd_prodi = '$kd_prodi'";
					$sql_rm = mysqli_query($con, $query) or die (mysqli_error($con));
				}else{
					$query = "SELECT * FROM tmds ";
					$sql_rm = mysqli_query($con, $query) or die (mysqli_error($con));
					}
				while($data = mysqli_fetch_array($sql_rm)){
						$jtmi = $data['jtmi']; 
						$jctm=$data['jctm']; 
						$stm =$jtmi - $jctm; 
						$ta = $data['ta'];
						$id_pengampu =$data['id_pengampu'];
						$sql = mysqli_query($con, "SELECT * FROM pengampu_matkul JOIN matkul ON pengampu_matkul.id_matkul = matkul.id_matkul join dosen on pengampu_matkul.id_dosen2 = dosen.id_dosen WHERE id_pengampu = '$id_pengampu' ")or die(mysqli_error($con));
						$peng = mysqli_fetch_assoc($sql);
						// $id_matkul = $peng['id_matkul'];
						$idpengampu1 = $peng['id_dosen1'];
						$idpengampu2 = $peng['id_dosen2'];
						$nama_matkul = $peng['nama_matkul'];
						$nama_dosen2 = $peng['nama_dosen'];
						$sks = $peng['sks'];
						$kelas = $peng['kelas'];


						$sqlnd1 = mysqli_query($con, "SELECT nama_dosen FROM dosen WHERE id_dosen =
							'$idpengampu1'")or die(mysqli_error($con));
						$datand1 = mysqli_fetch_array($sqlnd1);
						$nama_dosen1 = $datand1['nama_dosen'];

				?>
				<tr>
					<td><?=$no++?>.</td>
					<td><?php
							echo $nama_matkul."<br>".$ta;
						?>
					</td>
					<td><?=$kelas?></td>
					<td><?=$sks?></td>
					<td><?=$nama_dosen1."<br>".$nama_dosen2?></td>
					<td><?=$jtmi?></td>
					<td><?=$jctm?></td>
					<td><?=$stm;?></td>
					<td><?=$data['updated']?></td>
					
					<td align="center">
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
						<a href="del.php?id=<?=$data['id_tmds']?>" class="btn btn-danger btn-xs" style="margin-top: 5px;"><i class="glyphicon glyphicon-trash"></i>Delete</a>
					<?php } ?>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#table').DataTable({
				columnDefs: [
				{
					"searchable" : false,
					"orderable" : false,
					"targets" : 8
				}
				]
			});
		});
	</script>
</div>


<?php include_once('../_footer.php');?>