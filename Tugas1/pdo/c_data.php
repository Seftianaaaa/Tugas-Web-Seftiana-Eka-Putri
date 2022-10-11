<?php
require 'config.php';
try{
    $sql = 'INSERT INTO data_mahasiswa VALUES (:nim, :nama, :gender, :status, :telp, :alamat);';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nim',$nim);
    $stmt->bindParam(':nama',$nama);
    $stmt->bindParam(':gender',$gender);
    $stmt->bindParam(':status',$status);
    $stmt->bindParam(':telp',$telp);
    $stmt->bindParam(':alamat',$alamat);
    $stmt->execute();
    $stmt->closeCursor();
    header('location: ../data.php');
    exit;
} catch(PDOException $e){
    echo 'Error input data : '.$e->getMessage();
}