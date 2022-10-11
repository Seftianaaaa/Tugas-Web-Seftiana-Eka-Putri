<?php
function test_input($data)
{
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}

$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
if (empty($_POST['nama_pelanggan'])) {
    $nampelErr = "Isi nama pelanggannya!";
} else {
    $nampel = filter_var(test_input($_POST['nama_pelanggan']), FILTER_SANITIZE_STRING);
    if (strlen($nampel) > 30) {
        $nampelErr = "Batas nama adalah 30";
    }
}
if (isset($_POST['alamat'])) {
    $alamat = filter_var(test_input($_POST['alamat'], FILTER_SANITIZE_STRING));
} else {
    $alamat = '';
}
if (empty($_POST['jenkam'])) {
    $jenkamErr = 'Pilih jenis kamarnya!';
} else {
    $jenkam = filter_var(test_input($_POST['jenkam']), FILTER_SANITIZE_NUMBER_INT);
}
if (empty($_POST['no_kamar'])) {
    $nokamErr = 'Isi nomor kamarnya!';
} else {
    $nokam = filter_var(test_input($_POST['no_kamar']), FILTER_SANITIZE_STRING);
}
if (empty($_POST['lama_inap'])) {
    $lanapErr = 'Isi lama inapnya!';
} else {
    $lanap = filter_var(test_input($_POST['lama_inap']), FILTER_SANITIZE_NUMBER_INT);
}

if (!empty($nampelErr) || !empty($jenkamErr) || !empty($nokamErr) || !empty($lanapErr)) {
    header('location: ../index.php?id=' . $id . '&action=edt&nampelErr=' . $nampelErr . '&jenkamErr=' . $jenkamErr . '&nokamErr=' . $nokamErr . '&lanapErr=' . $lanapErr);
    exit;
}

require 'config.php';
try {
    $sql = "update book_detail set nama_pelanggan = :nampel, alamat = :alamat, id_jenkam = :jenkam, no_kamar = :nokam, lama_inap = :lanap where id_bodet = :id;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id',$id);
    $stmt->bindParam(':nampel',$nampel);
    $stmt->bindParam(':alamat',$alamat);
    $stmt->bindParam(':jenkam',$jenkam);
    $stmt->bindParam(':nokam',$nokam);
    $stmt->bindParam(':lanap',$lanap);
    $stmt->execute();

    $info = 'Data berhasil diedit';
    header('location: ../index.php?info=' . $info);
    exit;
} catch (PDOException $e) {
    echo 'Error saat mengedit data : ' . $e->getMessage();
}
