<?php
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$gender = $_POST['gender'];
$status = $_POST['status'];
$telp = $_POST['tlpn'];
$alamat = $_POST['alamat'];

echo 'NIM yang anda masukkan adalah : ' . $nim . '<br>'; 
echo 'Nama yang anda masukkan adalah : ' . $nama . '<br>';
echo 'Gender yang anda masukkan adalah : ' . $gender . '<br>';
echo 'Status yang anda masukkan adalah : ' . $status . '<br>';
echo 'No HP yang anda masukkan adalah : ' . $telp . '<br>';
echo 'Alamat yang anda masukkan adalah : ' . $alamat . '<br>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>
<body>
    <table border="1">
        <thead>
            <tr>
                <th colspan='6'>Tabel Biodata</th>
            </tr>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Status</th>
                <th>No. Telp</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require 'pdo/config.php';
            $sql = 'SELECT * FROM data_mahasiswa;';
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while($row = $stmt->fetch()){
            ?>
            <tr>
                <td><?= $row['nim'];?></td>
                <td><?= $row['nama'];?></td>
                <td><?= $row['gender'];?></td>
                <td><?= $row['status'];?></td>
                <td><?= $row['telp'];?></td>
                <td><?= $row['alamat'];?></td>
            </tr>
            <?php
            } $stmt->closeCursor();
            ?>
        </tbody>
    </table>
</body>
</html>