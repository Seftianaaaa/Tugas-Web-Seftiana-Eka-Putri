<?php session_start(); 
if(!isset($_SESSION['valid'])) {
	header('Location: login.php');
}

include_once("connection.php");
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$prodi = $_POST['prodi'];
$kelas = $_POST['kelas'];
$semester = $_POST['semester'];
$email = $_POST['email'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$foto = $_POST['foto'];
$agama = $_POST['agama'];
$tempat_lahir = $_POST['tempat_lahir'];
$tanggal_lahir = $_POST['tanggal_lahir'];

if(mysqli_query($mysqli, "INSERT INTO tab_peserta (nim, nama, prodi, kelas, semester, email, no_hp, alamat, jenis_kelamin, foto, agama, tempat_lahir, tanggal_lahir) VALUES($nim, '$nama', '$prodi', '$kelas', $semester, '$email', '$no_hp', '$alamat', $jenis_kelamin, '$foto', '$agama', '$tempat_lahir', '$tanggal_lahir')")){   
	echo "<script language=javascript>
			alert('Simpan Berhasil');
			window.location='peserta.php';
			</script>";
} else {
	echo mysqli_error($mysqli);
}