<?php
date_default_timezone_set('Asia/Jakarta');
$server = "localhost";
// $username = "draf3117_root";
// $password = "Ekskul123";
// $database = "draf3117_ekskul_db";


$username = "root";
$password = "";
$database = "db_tebe";


$koneksi = mysqli_connect($server, $username, $password, $database);
mysqli_connect($server, $username, $password, $database);

if (mysqli_connect_errno()) {
	echo "<h1>Koneksi database gagal : " . mysqli_connect_error() . "</h1>";
	exit();
}
function anti_injection($data)
{
	global $koneksi;
	$filter = mysqli_real_escape_string($koneksi, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
	return $filter;
}

function average($arr)
{
	if (!is_array($arr)) return false;
	return array_sum($arr) / count($arr);
}

function cek_session_admin()
{
	$level = $_SESSION[level];
	if ($level != 'superuser' and $level != 'kepala') {
		echo "<script>document.location='index.php';</script>";
	}
}

function cek_session_guru()
{
	$level = $_SESSION[level];
	if ($level != 'guru' and $level != 'superuser' and $level != 'kepala') {
		echo "<script>document.location='index.php';</script>";
	}
}

function cek_session_siswa()
{
	$level = $_SESSION[level];
	if ($level == '') {
		echo "<script>document.location='index.php';</script>";
	}
}
