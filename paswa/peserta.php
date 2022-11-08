<?php include('header.php'); ?>
<?php include('sidemenu.php'); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Peserta</h1>
    <p class="mb-4"> </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row justify-content-between align-items-center px-3">
                <h6 class="m-0 font-weight-bold text-primary d-inline">Data peserta</h6>
                <a href="peserta_add.php" class="btn btn-primary">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>NIM</td>
                            <td>NAMA</td>
                            <td>PRODI</td>
                            <td>KELAS</td>
                            <td>SEMESTER</td>
                            <td>EMAIL</td>
                            <td>NO_HP</td>
                            <td>ALAMAT</td>
                            <td>JENIS KELAMIN</td>
                            <td>FOTO</td>
                            <td>AGAMA</td>
                            <td>TEMPAT LAHIR</td>
                            <td>TANGGAL LAHIR</td>
                            <td>AKSI</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include_once("connection.php");
                        $no = 0;
                        $result = mysqli_query($mysqli, "SELECT * FROM tab_peserta order by nama");
                        while ($row = mysqli_fetch_array($result)) {
                            $no++;
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['nim'] . "</td>";
                            echo "<td>" . $row['nama'] . "</td>";
                            echo "<td>" . $row['prodi'] . "</td>";
                            echo "<td>" . $row['kelas'] . "</td>";
                            echo "<td>" . $row['semester'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['no_hp'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td>";
                            if($row['jenis_kelamin'] == 1 ){
                                echo "Laki-laki";
                            } elseif ($row['jenis_kelamin'] == 2){
                                echo "Perempuan";
                            } else {
                                echo "Tak teridentifikasi";
                            };
                            echo "</td>";
                            echo "<td>" . $row['foto'] . "</td>";
                            echo "<td>" . $row['agama'] . "</td>";
                            echo "<td>" . $row['tempat_lahir'] . "</td>";
                            echo "<td>" . $row['tanggal_lahir'] . "</td>";
                            echo "<td><a href=\"peserta_edit.php?nim=$row[nim]\">Edit</a> | 
                        <a href=\"peserta_pro_delete.php?nim=$row[nim]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include('footer.php'); ?>