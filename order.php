<?php include "koneksi.php"; ?>
<?php include "template.php"; ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">


            <!-- Content Row -->
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-6">

                        <!-- Default Card Example -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h1 style="text-align: center;">KASIR</h1>
                            </div>
                            <div class="card-body">
                                <form method="POST">

                                    <div class="form-group row mb-0">
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Tgl. Transaksi</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="text" class="form-control form-control-sm" name="tgl" value="<?php echo  date("j F Y"); ?>" readonly>
                                        </div>

                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Customer</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="text" class="form-control form-control-sm" name="cust" id="nama_barang">
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Nama Barang</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="text" class="form-control form-control-sm" name="barang" id="nama_barang">
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Ukuran</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="text" class="form-control form-control-sm" id="ukuran" name="ukuran">
                                        </div>
                                        <input type="text" class="form-control form-control-sm" id="status" name="status" value="belum bayar" hidden>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Harga</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" name="harga" id="harga" onchange="total()">
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Quantity</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" id="quantity" name="qty" onchange="total()" placeholder="0" required>
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Sub-Total</b></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <input type="number" class="form-control form-control-sm" id="subtotal" onchange="total()" name="subtotal" readonly>
                                                <div class="input-group-append">
                                                    <button class="btn btn-info btn-icon-split btn-sm" name="save" value="simpan" type="submit">
                                                        <span class="icon text-white-50"> <i class="fa fa-plus mr-2"></i></span><span class="text">Tambah</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>

                                <?php
                                if (isset($_POST['save'])) {
                                    $cust = $_POST['cust'];
                                    $barang = $_POST['barang'];
                                    $ukuran = $_POST['ukuran'];
                                    $harga = $_POST['harga'];
                                    $qty = $_POST['qty'];
                                    $subtotal = $_POST['subtotal'];
                                    $tgl = $_POST['tgl'];
                                    $status = $_POST['status'];

                                    $sql = "INSERT INTO keranjang (nama_customer, nama_barang, ukuran, harga, jumlah, subtotal, tanggal, status)
                                                VALUES ('$cust', '$barang','$ukuran','$harga','$qty','$subtotal','$tgl','$status')";

                                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

                                    if ($query) {
                                        echo '<script>window.location=""</script>';
                                    } else {
                                        echo "Error :" . $sql . "<br>" . mysqli_error($conn);
                                    }

                                    mysqli_close($conn);
                                }
                                ?>

                                <div class="col-12">
                                    <hr class="mt-2">
                                </div>

                                <?php
                                function format_ribuan($nilai)
                                {
                                    return number_format($nilai, 0, ',', '.');
                                }
                                ?>

                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM keranjang");
                                $total = 0;
                                $tot_bayar = 0;
                                $no = 1;
                                while ($r = $query->fetch_assoc()) {
                                    $total = $r['harga'] * $r['jumlah'];
                                    $tot_bayar += $total;
                                    $bayar = $r['bayar'];
                                    $kembalian = $r['kembalian'];
                                }
                                error_reporting(0);
                                ?>

                                <form method="POST">
                                    <div class="form-group row mb-0">
                                        <input type="hidden" class="form-control" value="<?php echo $tot_bayar; ?>" id="hargatotal" readonly>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Bayar</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" name="bayar" id="bayarnya" onchange="totalnya()">
                                        </div>
                                        <label class="col-sm-4 col-form-label col-form-label-sm"><b>Kembali</b></label>
                                        <div class="col-sm-8 mb-2">
                                            <input type="number" class="form-control form-control-sm" name="kembalian" id="total1" readonly>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button class="btn btn-info btn-sm" name="save1" value="simpan" type="submit">
                                            <span class="icon text-white-50"><i class="fa fa-shopping-cart mr-2"></i></span><span class="text">Bayar</span></button>
                                    </div>
                                </form>

                                <?php
                                if (isset($_POST['save1'])) {
                                    $bayar = $_POST['bayar'];
                                    $kembalian = $_POST['kembalian'];

                                    $sql = "UPDATE keranjang SET bayar='$bayar',kembalian='$kembalian' ";
                                    $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                    echo '<script>window.location="order.php"</script>';
                                } ?>

                            </div>
                        </div>


                    </div>

                    <div class="col-lg-6">

                        <!-- Default Card Example -->
                        <div class="card mb-4" id="print">

                            <div class="card-header bg-white">
                                <h1 style="text-align: center;">NOTA</h1>
                                <hr class="mt-0">
                                <div class="row">
                                    <div class="col-8 col-sm-9 pr-0">

                                        <ul class="pl-0 small" style="list-style: none;text-transform: uppercase;">
                                            <li>CUSTOMER :
                                                <?php
                                                $cust = mysqli_query($conn, "SELECT * FROM keranjang ORDER BY nama_customer ASC LIMIT 1");
                                                while ($dat2 = mysqli_fetch_array($cust)) {
                                                    $namacust = $dat2['nama_customer'];
                                                    echo "$namacust";
                                                }
                                                ?>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-4 col-sm-3 pl-0">
                                        <ul class="pl-0 small" style="list-style: none;">
                                            <li>TGL : <?php echo  date("j-m-Y"); ?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-body small pt-0">
                                    <hr class="mt-0">
                                    <div class="row">
                                        <div class="col-3 pr-0">
                                            <span><b>Nama Barang</b></span>
                                        </div>
                                        <div class="col-3 px-0 text-center">
                                            <span><b>Ukuran</b></span>
                                        </div>
                                        <div class="col-1 px-1 text-center">
                                            <span><b>Qty</b></span>
                                        </div>
                                        <div class="col-2 px-0 text-right">
                                            <span><b>Harga</b></span>
                                        </div>
                                        <div class="col-3 pl-0 text-right">
                                            <span><b>Subtotal</b></span>
                                        </div>
                                        <div class="col-12">
                                            <hr class="mt-2">
                                        </div>

                                        <?php
                                        $pesanan = mysqli_query($conn, "SELECT * FROM keranjang");
                                        while ($d = mysqli_fetch_array($pesanan)) {
                                        ?>


                                            <div class="col-3 pr-0">
                                                <a href="?id=<?php echo $d['id_keranjang']; ?>" onclick="javascript:return confirm('Hapus Data Barang ?');" style="text-decoration:none;">
                                                    <i class="fa fa-times fa-xs text-danger mr-1"></i>
                                                    <span class="text-dark"><?php echo $d['nama_barang']; ?></span>
                                                </a>
                                            </div>
                                            <div class="col-3 px-0 text-center">
                                                <span><?php echo $d['ukuran']; ?></span>
                                            </div>
                                            <div class="col-1 px-0 text-center">
                                                <span><?php echo $d['jumlah']; ?></span>
                                            </div>
                                            <div class="col-2 px-0 text-right">
                                                <span><?php echo format_ribuan($d['harga']); ?></span>
                                            </div>
                                            <div class="col-3 pl-0 text-right">
                                                <span><?php echo format_ribuan($d['subtotal']); ?></span>
                                            </div>

                                        <?php } ?>

                                        <div class="col-12">
                                            <hr class="mt-2">
                                            <ul class="list-group border-0">
                                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                                    <b>Total</b>
                                                    <span><b><?php echo format_ribuan($tot_bayar); ?></b></span>
                                                </li>
                                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                                    <b>Bayar</b>
                                                    <span><b><?php echo format_ribuan($bayar); ?></b></span>
                                                </li>
                                                <li class="list-group-item p-0 border-0 d-flex justify-content-between align-items-center">
                                                    <b>Kembalian</b>
                                                    <span><b><?php echo format_ribuan($kembalian); ?></b></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-12 mt-3 text-center">
                                            <p>* TERIMA KASIH TELAH BERBELANJA*</p>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="text-right mt-3">
                            <form method="POST">
                                <button class="btn btn-primary btn-icon-split" onclick="printContent('print')"><span class="icon text-white-50"><i class="fa fa-print mr-1"></i></span> <span class="text">Print</span></button>
                                <button class="btn btn-success btn-icon-split" name="selesai" type="submit"><span class="icon text-white-50"><i class="fa fa-check mr-1"></i></span><span class="text">Selesai</span> </button>
                            </form>
                        </div>

                        <?php
                        if (isset($_POST['selesai'])) {
                            $ambildata = mysqli_query($conn, "INSERT INTO laporan (bayar,kembalian,nama_customer, nama_barang, harga, jumlah, subtotal, tanggal, ukuran, status)
                                                                    SELECT bayar,kembalian, nama_customer, nama_barang, harga, jumlah, subtotal, tanggal, ukuran, status
                                                                    FROM keranjang ") or die(mysqli_connect_error());
                            $hapusdata = mysqli_query($conn, "DELETE FROM keranjang");
                            echo '<script>window.location="order.php"</script>';
                        }
                        ?>
                    </div>
                    <?php
                    include 'koneksi.php';
                    if (!empty($_GET['id'])) {
                        $id = $_GET['id'];
                        $hapus_data = mysqli_query($conn, "DELETE FROM keranjang WHERE id_keranjang ='$id'");
                        echo '<script>window.location="order.php"</script>';
                    }

                    ?>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->


</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="assets/js/sb-admin-2.min.js"></script>


<script type="text/javascript">
    <?php echo $jsArray; ?>
    <?php echo $jsArray1; ?>

    function total() {
        var harga = parseInt(document.getElementById('harga').value);
        var jumlah_beli = parseInt(document.getElementById('quantity').value);
        var jumlah_harga = harga * jumlah_beli;
        document.getElementById('subtotal').value = jumlah_harga;
    }

    function totalnya() {
        var harga = parseInt(document.getElementById('hargatotal').value);
        var pembayaran = parseInt(document.getElementById('bayarnya').value);
        var kembali = pembayaran - harga;
        document.getElementById('total1').value = kembali;
    }

    function printContent(print) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(print).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>

</body>

</html>