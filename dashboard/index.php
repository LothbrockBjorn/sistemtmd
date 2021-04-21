<?php
include_once('../_header.php');
?>
  
  	<div class="row">
        <div class="col-lg-12">
        	<div class="pull-right">
                <!-- <?php 
            if ($_SESSION['level']== 3 ){?>
            <a href="tambahprodi.php" class="btn btn-warning"><i class="glyphicon glyphicon-plus"></i> Tambah Prodi</a>
                <?php } ?> -->
            <a href="user.php" class="btn btn-default"><i class="glyphicon glyphicon-user"></i></a>
        	</div>
            <h1>Dashboard</h1>
        	
            <p>Selamat datang <mark><?=$_SESSION['user'];?></mark>di Aplikasi sistem TMD ( Tatapmuka dosen )</p>
            <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
        </div>
    </div>
    
<?php
include_once('../_footer.php');
?>