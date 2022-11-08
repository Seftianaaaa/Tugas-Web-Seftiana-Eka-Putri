<?php include('header.php'); ?>
<?php include('sidemenu.php'); ?>


<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">peserta</h1>
    <p class="mb-4"> </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah peserta</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <form method="POST" action="peserta_pro_add.php">
                    <table>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>NIM</label>
                                <input type="number" class="form-control form-control-user" placeholder="NIM" name="nim">
                            </div>
                            <div class="col-sm-6">
                                <label>Nama</label>
                                <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Nama Lengkap" name="nama">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Tempat Lahir</label>
                                <input type="text" class="form-control form-control-user" placeholder="Tempat Lahir" name="tempat_lahir">
                            </div>
                            <div class="col-sm-6">
                                <label>Tanggal Lahir</label>
                                <input type="date" class="form-control form-control-user" placeholder="Tanggal Lahir" name="tanggal_lahir">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Program Studi</label>
                                <select class="form-control form-control-user" Placeholder="Program Studi" name="prodi">
                                    <option value="0">--Pilih--</option>
                                    <option value="TI">Teknik Informatika</option>
                                    <option value="SI">Sistem Informasi</option>
                                </select>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Semester</label>
                                <select class="form-control form-control-user" Placeholder="Semester" name="semester">
                                    <option value="0">--Pilih--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label>Kelas</label>
                                <select class="form-control form-control-user" data-placeholder="Kelas" name="kelas">
                                    <option value="0">--Pilih--</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Malam">Malam</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>No. HP</label>
                                <input type="number" class="form-control form-control-user" placeholder="No. HP" name="no_hp">
                            </div>
                            <div class="col-sm-6">
                                <label>Email</label>
                                <input type="email" class="form-control form-control-user" placeholder="Email" name="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Jenis Kelamin</label>
                                <select class="form-control form-control-user" Placeholder="Jenis Kelamin" name="jenis_kelamin">
                                    <option value="0">--Pilih--</option>
                                    <option value="1">Laki-Laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label>Agama</label>
                                <select class="form-control form-control-user" data-placeholder="Agama" name="agama">
                                    <option value="0">--Pilih--</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Protestan">Protestan</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" placeholder="Alamat" name="alamat">
                        </div>

                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" placeholder="Foto" name="foto">
                        </div>
                    </table>
                    <br>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="peserta.php" class="btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php include('footer.php'); ?>