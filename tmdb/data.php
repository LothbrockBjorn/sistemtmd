<?php include_once('../_header.php');?>

<div class="box">
	<h1>Data tatap muka dosen</h1>
	<h4>
		<small>Data tatap muka dosen</small>
		<div class="pull-right">
			<a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
			<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
			<a href="generate.php" class="btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
		<?php } ?>
		</div>
	</h4>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="tmdb" >
			<thead>
				<tr>
					<th>Matakuliah</th>
					<th>Nama Dosen</th>
					<th>Tanggal</th>
					<th>Prodi</th>
					<th>Tahun ajar</th>
					<?php if ($_SESSION['level'] == 2 || $_SESSION['level'] == 3) { ?>
					<th><center><i class="glyphicon glyphicon-cog"></i></center></th>
				<?php } ?>
				</tr>
			</thead>
		</table>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
   		$('#tmdb').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "tmdb.php"
        // scrollY : '250px',
    } );
} );
	</script>
</div>

<?php include_once('../_footer.php');?>