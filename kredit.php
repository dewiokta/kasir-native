<?php include "koneksi.php"; ?>
<?php include "template.php"; ?>


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </form>


            <!-- Topbar Navbar -->

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Tabel Pengeluaran</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Data</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Data
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                $data_kredit = mysqli_query($conn, "SELECT * FROM pengeluaran");
                                while ($d = mysqli_fetch_array($data_kredit)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['tanggal']; ?></td>
                                        <td><?php echo $d['keterangan']; ?></td>
                                        <td><?php echo $d['jumlah']; ?></td>
                                    </tr>


                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- modal tambah data -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengeluaran</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tanggal</b></label>
                                                <div class="col-sm-8 mb-2">
                                                    <input type="text" class="form-control form-control-sm" readonly name="tanggal" id="tanggal" value="<?php echo date("j F Y");?>">
                                                </div>
                                                <label class="col-sm-4 col-form-label col-form-label-sm"><b>Keterangan</b></label>
                                                <div class="col-sm-8 mb-2">
                                                    <input type="text" class="form-control form-control-sm" name="ket" id="ket">
                                                </div>
                                                <label class="col-sm-4 col-form-label col-form-label-sm"><b>nominal</b></label>
                                                <div class="col-sm-8 mb-2">
                                                    <input type="text" class="form-control form-control-sm" name="nominal" id="nominal">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                        <?php
                                        if (isset($_POST['simpan'])) {
                                            $tanggal = $_POST['tanggal'];
                                            $keterangan = $_POST['ket'];
                                            $nominal = $_POST['nominal'];


                                            $sql = "INSERT INTO pengeluaran ( tanggal, keterangan, jumlah ) VALUES ( '$tanggal','$keterangan','$nominal')";
                                            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                            if ($query) {
                                                echo '<script>window.location="kredit.php"</script>';
                                            } else {
                                                echo "Error :" . $sql . "<br>" . mysqli_error($conn);
                                            }

                                            mysqli_close($conn);
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="assets/js/demo/datatables-demo.js"></script>

<script type="text/javascript">
    <?php echo $jsArray; ?>
    <?php echo $jsArray1; ?>


    function totalnya() {
        var harga = parseInt(document.getElementById('hargatotal').value);
        var pembayaran = parseInt(document.getElementById('bayarnya').value);
        var kembali = pembayaran - harga;
        document.getElementById('total1').value = kembali;
    }
</script>


</body>

</html>