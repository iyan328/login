<?php
session_start();
mysql_connect("localhost","root","") or die("gagal memuat database");
mysql_select_db("tes_ta");//sesuaikan dengan nama database anda

$username = $_POST['username'];
$password = $_POST['password'];
$op = $_GET['op'];

if($op=="in"){
$cek = mysql_query("SELECT * FROM akun WHERE username='$username' AND password='$password'");
if(mysql_num_rows($cek)==1){//jika berhasil akan bernilai 1
$c = mysql_fetch_array($cek);
$_SESSION['username'] = $c['username'];
$_SESSION['password'] = $c['password'];
$_SESSION['hak_akses'] = $c['hak_akses'];
if($c['hak_akses']=="perusahaan"){
header("location:../perusahaan/perusahaan.php");
}else{
	?>
	<script type="text/javascript">
alert("username/password salah");document.location='../perusahaan/index.html'</script>
<?php
}
}
else{
	?>
	<script type="text/javascript">
alert("username/password salah");document.location='../perusahaan/index.html'</script>
<?php
}
?>
<?php

}else if($op=="out"){
unset($_SESSION['username']);
unset($_SESSION['password']);
header("location:index.php");
}
?>