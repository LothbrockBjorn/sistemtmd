<?php
	require_once"../_config/config.php";
	require "assets/libs/vendor/autoload.php";
	if(!isset($_SESSION['user'])){
    echo "<script>window.location='".base_url('auth/login.php')."';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Sistem TM dosen</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?=base_url('/assets/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('/assets/css/simple-sidebar.css');?>" rel="stylesheet">
    <link href="<?=base_url('/assets/css/jquery-ui.css');?>" rel="stylesheet">
    <link href="<?=base_url('/assets/libs/dataTables/datatables.min.css');?>" rel="stylesheet">
    <link href="<?=base_url('/assets/css/select2.min.css');?>" rel="stylesheet">
    <link rel="icon" href="<? base_url('assets/icon.png')?>">

</head>
<body>
	<script src="<?=base_url('assets/js/jquery.js')?>"></script>
	<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-1.10.2.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-ui.js')?>"></script>
    <script src="<?=base_url('assets/libs/dataTables/datatables.min.js')?>"></script>
    <script src="<?=base_url('assets/js/select2.min.js')?>"></script>
	<div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href=""><span class="text-warning"><b>Aplikasi Sistem TMD</b></span></a>
                </li>
                <li>
                    <a href="<?=base_url('dashboard');?>">Dashboard</a>
                </li>
            <?php   
                if ($_SESSION['level']== 2 || $_SESSION['level']== 3){?>
                <li>
                    <a href="<?=base_url('bukata/data.php');?>">Tahun Ajaran</a>
                </li>
            <?php } ?>
                <?php 
            if ($_SESSION['level']== 3 ){?>
                <li>
                    <a href="<?=base_url('prodi/tambahprodi.php');?>">Tambah Data Prodi</a>
                </li>
            <?php } ?>
                <li>
                    <a href="<?=base_url('dosen/data.php');?>">Data Dosen</a>
                </li>
                <li>
                    <a href="<?=base_url('matkul/data.php');?>">Data Matakuliah</a>
                </li>
                <li>
                    <a href="<?=base_url('pengampumatkul/data.php');?>">Data Pengampu Matakuliah</a>
                </li>
                <li>
                    <a href="<?=base_url('tmdb/data.php');?>">Data TMD</a>
                </li>
                <li>
                    <a href="<?=base_url('tmds/data.php');?>">Rekam TMD per matakuliah</a>
                </li>
                <li>
                    <a href="<?=base_url('report/data.php');?>">Laporan TMD</a>
                </li>
                <li>
                    <a href="<?=base_url('auth/logout.php');?>"><span class="text-danger">Logout</span></a>
                </li>
            </ul>
        </div>
        <div id="page-content-wrapper">
            <div class="container-fluid">
