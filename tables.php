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
            <h1 class="h3 mb-2 text-gray-800">Tabel Rekap</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Order Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Customer</th>
                                    <th>Barang</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Kembalian</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                $data_rekap = mysqli_query($conn, "SELECT * FROM laporan");
                                while ($d = mysqli_fetch_array($data_rekap)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['nama_customer']; ?></td>
                                        <td><?php echo $d['nama_barang']; ?></td>
                                        <td><?php echo $d['ukuran']; ?></td>
                                        <td><?php echo $d['harga']; ?></td>
                                        <td><?php echo $d['jumlah']; ?></td>
                                        <td><?php echo $d['subtotal']; ?></td>
                                        <td><?php echo $d['kembalian']; ?></td>
                                        <td><?php echo $d['tanggal']; ?></td>
                                        <td><?php echo $d['status']; ?></td>
                                        <td>
                                            <!-- <a href="" class="btn btn-primary btn-sm">Update</a> -->
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalEdit<?php echo $d['id_laporan']; ?>">
                                                Update
                                            </button>

                                        </td>
                                    </tr>

                                    <!-- modal edit data -->
                                    <div class="modal fade" id="ModalEdit<?php echo $d['id_laporan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                        <div class="form-group row mb-0">
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Transaksi</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="tgl" value="<?php echo $d['tanggal']; ?>" readonly>
                                                            </div>

                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Customer</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="cust" id="customer" value="<?php echo $d['nama_customer']; ?>">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Barang</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="barang" id="nama_barang" value="<?php echo $d['nama_barang']; ?>">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Sub-Total</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="number" class="form-control form-control-sm" name="subtotal" id="hargatotal" value="<?php echo $d['subtotal']; ?>" readonly>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Bayar</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="number" class="form-control form-control-sm" name="bayar" id="bayarnya" value="<?php echo $d['bayar']; ?>" onchange="totalnya()">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kembali</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="number" class="form-control form-control-sm" name="kembalian" id="total1" value="<?php echo $d['kembalian']; ?>" readonly>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Status</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <select class="custom-select" name="status" id="inputGroupSelect01">
                                                                    <option selected value="<?php echo $d['status']; ?>"><?php echo $d['status']; ?></option>
                                                                    <option value="Belum Bayar">Belum Bayar</option>
                                                                    <option value="Bayar">Bayar</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?php echo $d['id_laporan']; ?>">
                                                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                    <?php
                                                    if (isset($_POST['update'])) {
                                                        $id = $_POST['id'];
                                                        $tgl = $_POST['tgl'];
                                                        $nama = $_POST['cust'];
                                                        $barang = $_POST['barang'];
                                                        $subtotal = $_POST['subtotal'];
                                                        $bayar = $_POST['bayar'];
                                                        $kembalian = $_POST['kembalian'];
                                                        $status = $_POST['status'];


                                                        $sql = "UPDATE laporan SET nama_customer='$nama', nama_barang='$barang', 
                                                                    subtotal='$subtotal', bayar='$bayar',kembalian='$kembalian', tanggal='$tgl', status='$status' 
                                                                    WHERE id_laporan='$id' ";
                                                        $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                                        if ($query) {
                                                            echo '<script>window.location="tables.php"</script>';
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