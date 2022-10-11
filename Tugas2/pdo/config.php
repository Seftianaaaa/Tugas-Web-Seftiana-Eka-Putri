<?php
require_once 'define_cons.php';

try {
    $conn = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";",USERNAME,PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo 'konek';
} catch (PDOException $e) {
    $e->getMessage();
}