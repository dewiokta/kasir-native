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
            <h1 class="h3 mb-2 text-gray-800">Tabel Pendapatan</h1>
            <?php

            function format_ribuan($nilai)
            {
                return number_format($nilai, 0, ',', '.');
            }

            $total = 0;
            $jumlah = 0;
            // $kembalian = 0;
            // $subtotal =0;
            $date = date("d-F-Y");
            $query = mysqli_query($conn, "SELECT * FROM pendapatan");
            while ($d = $query->fetch_assoc()) {
                // echo $date;
                if ($d['tanggal'] == $date) {
                    // $kembalian = $d['kembalian'];
                    // $total = $d['bayar'];
                    $total = $d['jumlah'];
                    $jumlah += $total;
                }
            }
            ?>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Pendapatan (Harian)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp<?php echo format_ribuan($jumlah) ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pendapatan</h6>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalTambah">
                        Tambah Pendapatan
                    </button>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nominal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                $data_kredit = mysqli_query($conn, "SELECT * FROM pendapatan ORDER BY id_pendapatan DESC");
                                while ($d = mysqli_fetch_array($data_kredit)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['tanggal']; ?></td>
                                        <td><?php echo $d['jumlah']; ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalEdit<?php echo $d['id_pendapatan']; ?>">
                                                Edit
                                            </button>
                                            <a class="btn btn-danger btn-sm" href="?id=<?php echo $d['id_pendapatan']; ?>" onclick="javascript:return confirm('Hapus Data Barang ?');">
                                                Hapus</a>
                                        </td>
                                    </tr>
                                    <?php
                                    include 'koneksi.php';
                                    if (!empty($_GET['id'])) {
                                        $id = $_GET['id'];
                                        $hapus_data = mysqli_query($conn, "DELETE FROM pendapatan WHERE id_pendapatan ='$id'");
                                        echo '<script>window.location="debit.php"</script>';
                                    }

                                    ?>
                                    <div class="modal fade" id="ModalEdit<?php echo $d['id_pendapatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit pendapatan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                        <div class="form-group row mb-0">
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tanggal</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="tgl" value="<?php echo $d['tanggal']; ?>" readonly>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>nominal</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="nominal" id="nominal" value="<?php echo $d['jumlah']; ?>">
                                                            </div>


                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id" value="<?php echo $d['id_pendapatan']; ?>">
                                                                <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            </div>
                                                    </form>
                                                    <?php
                                                    if (isset($_POST['update'])) {
                                                        $id = $_POST['id'];
                                                        $tgl = $_POST['tgl'];
                                                        $jml = $_POST['nominal'];


                                                        $sql = "UPDATE pendapatan SET jumlah='$jml'
                                                                    WHERE id_pendapatan='$id' ";
                                                        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                                        if ($query) {
                                                            echo '<script>window.location="debit.php"</script>';
                                                        } else {
                                                            echo "Error :" . $sql . "<br>" . mysqli_error($conn);
                                                        }

                                                        mysqli_close($conn);
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </tbody>
                        </table>
                        <!-- modal tambah data -->
                        <div class="modal fade" id="ModalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pendapatan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST">
                                            <div class="form-group row mb-0">
                                                <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tanggal</b></label>
                                                <div class="col-sm-8 mb-2">
                                                    <input type="text" class="form-control form-control-sm" name="tanggal" id="tanggal" value="<?php echo date("d-F-Y") ?>" readonly>
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
                                            $nominal = $_POST['nominal'];


                                            $sql = "INSERT INTO pendapatan ( tanggal, jumlah ) VALUES ( '$tanggal','$nominal')";
                                            $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                            if ($query) {
                                                echo '<script>window.location="debit.php"</script>';
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


</body>

</html>