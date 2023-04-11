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
            $query = mysqli_query($conn, "SELECT * FROM laporan GROUP BY no_transaksi");
            while ($d = $query->fetch_assoc()) {
                // echo $date;
                if ($d['tanggal_bayar'] == $date) {
                    // $kembalian = $d['kembalian'];
                    // $total = $d['bayar'];
                    $total = (int)$d['bayar'] - (int) $d['kembalian'];
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
                                    Pemasukan (Harian)</div>
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
                    <h6 class="m-0 font-weight-bold text-primary">Order Data</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Transaksi</th>
                                    <th>Customer</th>
                                    <th>Barang</th>
                                    <th>Ukuran</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Bayar</th>
                                    <th>Kurangan</th>
                                    <th>Kembalian</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $no = 1;
                                $data_rekap = mysqli_query($conn, "SELECT * FROM laporan ORDER BY id_laporan DESC");
                                while ($d = mysqli_fetch_array($data_rekap)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $d['no_transaksi']; ?></td>
                                        <td><?php echo $d['nama_customer']; ?></td>
                                        <td><?php echo $d['nama_barang']; ?></td>
                                        <td><?php echo $d['ukuran']; ?></td>
                                        <td><?php echo $d['harga']; ?></td>
                                        <td><?php echo $d['jumlah']; ?></td>
                                        <td><?php echo $d['subtotal']; ?></td>
                                        <td><?php echo $d['bayar']; ?></td>
                                        <td><?php echo $d['kurangan']; ?></td>
                                        <td><?php echo $d['kembalian']; ?></td>
                                        <td><?php echo $d['tanggal']; ?></td>
                                        <td><?php echo $d['tanggal_bayar']; ?></td>
                                        <td><?php echo $d['status']; ?></td>
                                        <td>

                                            <?php
                                            if ($d['status'] == 'Lunas') {
                                            ?>
                                                <button type="button" class="btn btn-success btn-sm">
                                                    Selesai
                                                </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalEdit<?php echo $d['no_transaksi']; ?>">
                                                    Pelunasan
                                                </button>

                                            <?php } ?>

                                        </td>
                                    </tr>

                                    <!-- modal edit data -->
                                    <div class="modal fade" id="ModalEdit<?php echo $d['no_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Pelunasan Pesanan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">
                                                        <div class="form-group row mb-0">
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Pesan</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="tgl" value="<?php echo $d['tanggal']; ?>" readonly>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>No Transaksi</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="notrans" id="notrans" value="<?php echo $d['no_transaksi']; ?>" readonly>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Customer</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="cust" id="customer" value="<?php echo $d['nama_customer']; ?>">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Bayar</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="number" class="form-control form-control-sm" name="bayar" id="bayar" onchange="">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kurangan</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="number" class="form-control form-control-sm" name="kurangan" id="kurangan" value="<?php echo $d['kurangan']; ?>" onchange="statusOtomatis()">
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Bayar</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="tgl_bayar" value="<?php echo date("d-F-Y") ?>" readonly>
                                                            </div>
                                                            <label class="col-sm-4 col-form-label col-form-label-sm"><b>Status</b></label>
                                                            <div class="col-sm-8 mb-2">
                                                                <input type="text" class="form-control form-control-sm" name="status" id="status" value="" >
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?php echo $d['id_laporan']; ?>">
                                                            <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                    <?php
                                                    if (isset($_POST['update'])) {
                                                        $id = $_POST['id'];
                                                        $notrans = $_POST['notrans'];
                                                        $tgl = $_POST['tgl'];
                                                        $tgl_bayar = $_POST['tgl_bayar'];
                                                        $nama = $_POST['cust'];
                                                        $subtotal = $_POST['subtotal'];
                                                        $kurangan = $_POST['kurangan'];
                                                        $bayar = $_POST['bayar'];
                                                        $kembalian = $_POST['kembalian'];
                                                        $status = $_POST['status'];


                                                        $sql = "UPDATE laporan SET kurangan = '$kurangan',bayar='$bayar',
                                                                    kembalian='$kembalian', tanggal_bayar='$tgl_bayar', status='$status' 
                                                                    WHERE no_transaksi='$notrans' ";
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
    function statusOtomatis() {
        // var pembayaran = parseInt(document.getElementById('bayar').value);
        // console.log(pembayaran);
        let kurangan = parseInt(document.getElementById('kurangan').value);
        console.log(kurangan);
        // console.log(total);
        if (kurangan == 0) {
            // document.getElementById('kurangan').value = '0';
            document.getElementById('status').value = 'Lunas';
        }

    }
</script>



</body>

</html>