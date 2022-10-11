<?php
// fungsi bersihin data input
function test_input($data)
{
    $data = htmlspecialchars(stripslashes(trim($data)));
    return $data;
}

// Ambil Data yang ingin diedit
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edt') {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    require 'pdo/config.php';
    try {
        $sql = 'select * from book_detail where id_bodet = :id;';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $erow = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Hapus data 
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'del') {
    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    require 'pdo/config.php';
    try {
        $sql = "delete from book_detail where id_bodet = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $stmt->closeCursor();

        $info = 'Data berhasil dihapus';
        header('location: index.php?info=' . $info);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        header('location: index.php?nampelErr=' . $nampelErr . '&jenkamErr=' . $jenkamErr . '&nokamErr=' . $nokamErr . '&lanapErr=' . $lanapErr);
        exit;
    }

    require 'pdo/config.php';
    try {
        $sql = 'insert into book_detail (nama_pelanggan,alamat,id_jenkam,no_kamar,lama_inap) values (:nampel, :alamat, :jenkam, :nokam, :lanap);';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nampel', $nampel);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':jenkam', $jenkam);
        $stmt->bindParam(':nokam', $nokam);
        $stmt->bindParam(':lanap', $lanap);
        $stmt->execute();

        $info = 'Data berhasil ditambahkan';
        header('location: index.php?info=' . $info);
        exit;
    } catch (PDOException $e) {
        echo 'Error saat memasukkan data : ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" href="assets/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="assets/jquery.min.js"></script>
    <script src="assets/jquery.dataTables.min.js"></script>
    <script src="assets/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light bg-gradient">
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-primary">
                    <h1 class="display-2 text-primary text-center">Aplikasi Booking Hotel</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="post" action="<?= isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edt' ? 'pdo/edt.php' : 'index.php'; ?>">
                            <input type="hidden" name="id" value="<?= $id ?? ''; ?>">
                            <div class="row gx-3">
                                <div class="col-lg-6 mb-3">
                                    <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                                    <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="<?= $erow['nama_pelanggan'] ?? ''; ?>">
                                    <?= isset($_GET['nampelErr']) ? '<small class="text-danger">' . $_GET['nampelErr'] . '</small>' : ''; ?>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" id="alamat" rows="1" class="form-control"><?= $erow['alamat'] ?? ''; ?></textarea>
                                </div>
                            </div>
                            <div class="row gx-3">
                                <div class="col-lg-4 mb-3">
                                    <label for="jenkam" class="form-label">Jenis Kamar</label>
                                    <select name="jenkam" id="jenkam" class="form-select">
                                        <option selected disabled>-Pilih-</option>
                                        <?php
                                        require 'pdo/config.php';
                                        try {
                                            $sql = "SELECT * FROM jenis_kamar";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->execute();
                                            while ($row = $stmt->fetch()) {
                                                $selected = isset($erow) ? ($erow['id_jenkam'] == $row['id_jenkam'] ? 'selected' : '') : '';
                                        ?>
                                                <option value=<?= '"' . $row['id_jenkam'] . '" ' . $selected; ?>><?= ucfirst($row['jenkam']) . ' - Rp. ' . number_format($row['biaya'], 2) ?></option>
                                        <?php
                                            }
                                            $stmt->closeCursor();
                                        } catch (PDOException $e) {
                                            echo '<option>' . $e->getMessage() . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <?= isset($_GET['jenkamErr']) ? '<small class="text-danger">' . $_GET['jenkamErr'] . '</small>' : ''; ?>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="no_kamar" class="form-label">Nomor Kamar</label>
                                    <input type="number" name="no_kamar" id="no_kamar" class="form-control" max="999" value="<?= $erow['no_kamar'] ?? ''; ?>">
                                    <?= isset($_GET['nokamErr']) ? '<small class="text-danger">' . $_GET['nokamErr'] . '</small>' : ''; ?>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="lama_inap" class="form-label">Lama Inap</label>
                                    <div class="input-group">
                                        <input type="number" name="lama_inap" id="lama_inap" class="form-control" value="<?= $erow['lama_inap'] ?? '' ?>">
                                        <label for="" class="input-group-text"> Hari </label>
                                    </div>
                                    <?= isset($_GET['lanapErr']) ? '<small class="text-danger">' . $_GET['lanapErr'] . '</small>' : ''; ?>
                                </div>
                            </div>
                            <div class="row mt-2 gx-2">
                                <div class="col-lg-1">
                                    <button type="submit" class="btn btn-primary w-100">
                                        Save <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
                                            <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="col-lg-1">
                                    <a href='index.php' class="btn btn-outline-secondary w-100">Cancel <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                        </svg></a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <?= isset($_GET['info']) ?
                    '<div class="alert alert-info text-info"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
  <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
</svg> ' . $_GET['info'] . '</div>' : ''; ?>
            </div>
            <div class="col-12">
                <div class="card py-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-light table-hover table-striped dtabel text-center">
                                <thead>
                                    <tr class="table-primary text-primary">
                                        <th>No</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Jenis Kamar</th>
                                        <th>Nomor Kamar</th>
                                        <th>Biaya</th>
                                        <th>Lama Inap</th>
                                        <th>Total Bayar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require 'pdo/config.php';
                                    try {
                                        $sql = "select b.id_bodet, b.nama_pelanggan, b.alamat, date(b.tanggal_masuk) tanggal_masuk, j.jenkam, b.no_kamar, j.biaya, b.lama_inap, j.biaya * b.lama_inap total_bayar from book_detail b join jenis_kamar j on b.id_jenkam = j.id_jenkam";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();
                                        $total = 0;
                                        $no = 1;
                                        while ($row = $stmt->fetch()) {
                                            $total += $row['total_bayar'];
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td><?= $row['nama_pelanggan'] ?></td>
                                                <td><?= $row['alamat'] ?></td>
                                                <td><?= $row['tanggal_masuk'] ?></td>
                                                <td><?= ucfirst($row['jenkam']) ?></td>
                                                <td><?= $row['no_kamar'] ?></td>
                                                <td><?= 'Rp. ' . number_format($row['biaya']) ?></td>
                                                <td><?= $row['lama_inap'] ?></td>
                                                <td><?= 'Rp. ' . number_format($row['total_bayar']) ?></td>
                                                <td>
                                                    <a class="btn btn-primary" href="index.php?action=edt&id=<?= $row['id_bodet'] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                        </svg></a>
                                                    <a href="index.php?action=del&id=<?= $row['id_bodet'] ?>" class="btn btn-outline-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
</svg></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                        $stmt->closeCursor();
                                    } catch (PDOException $e) {
                                        echo '<tr><td colspan="8">' . $e->getMessage() . '</td></tr>';
                                    }
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8" class="text-start">Total Seluruh</th>
                                        <th colspan="2" class="text-start"><?= 'Rp. ' . number_format($total) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('.dtabel').DataTable();
        })
    </script>
</body>

</html>
