<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'mahasiswa');

try {
    $conn = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME . ';', USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo 'konek';
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
