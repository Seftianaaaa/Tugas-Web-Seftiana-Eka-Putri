<?php session_start(); 
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

include_once("connection.php");
$id = $_GET['nim'];
	
if(mysqli_query($mysqli, "DELETE FROM tab_peserta WHERE nim= $id ")){
	echo "<script language=javascript>
			alert('Hapus Berhasil');
			window.location='peserta.php';
			</script>";
} else {
	echo "<script language=javascript>
			alert('Hapus Gagal');
			window.location='peserta.php';
			</script>";
}