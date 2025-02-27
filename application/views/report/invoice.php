<?php
date_default_timezone_set('Asia/Jakarta');
$today = date('d-M-Y');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ILS | INVOICE SCRAP</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>dist/css/skins/_all-skins.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/adminlte/dist/img/money.png') ?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<style type="text/css">
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 7mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    @page {
        size: A4;
        margin: 0;
        /* margin: 3.5rem; */
    }

    @media print {

        html,
        body {
            width: 210mm;
            height: 297mm;
        }

        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }

        a[href]:after {
            content: none !important;
        }
    }

    p {
        font-size: 11px;
        margin-bottom: 2px;
    }

    small {
        font-size: 9px;
    }

    i {
        font-size: 14px;
    }

    th,
    td {
        font-size: 9px;
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        padding-right: 5px !important;
        padding-left: 5px;
        border-right: 1pt solid black !important;
        border-left: 1pt solid black !important;
        border-top: 1pt solid black !important;

    }

    h4,
    h3 {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .lembar {
        margin-bottom: 20px;
        /* margin-top: 100px; */
    }

    .kategori tr td {
        font-size: 7px;
    }
</style>

<body>

    <!-- <div class="wrapper"> -->
    <!-- Main content -->
    <section class="page">

        <div class="lembar">
            <!-- <div class="row">
                <div class="col-xs-8">
                    <h4 style="margin-bottom: 0px; font-weight: bold;">PT. JATIM AUTOCOMP INDONESIA</h4>
                    <i>Wiring Harness Manufacturer</i>
                </div>
                <div class="col-xs-4">
                    <h4 style="margin-bottom: 0px;margin-top: -5px; font-weight: bold;padding: 5px;border: 5px solid red;color:red;text-align:center;">SECRET</h4>
                </div>
            </div> -->
            <div class="row">
                <div class="col-xs-12" style="text-align: right;">
                    <img src="<?= base_url('assets/kop.png') ?>" alt="kop" style="width: 35%;">
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <h3 class="text-center" style="font-weight: bold;margin-top: 20px;margin-bottom: 30px;"><?= $inv_header['tipe'] ?></h3>
                    <div class="row">
                        <div class="col-xs-7">
                            <div class="col-xs-3">
                                <p>TO</p>
                                <p>ADDRESS</p>
                            </div>
                            <div class="col-xs-9">
                                <p>: PT. AL RASHEED</p>
                                <p>: Manduro Manggung Gajah Ngoro - Kab Mojokerto</p>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="col-xs-5">
                                <p>INVOICE NO</p>
                                <p>INVOICE DATE</p>
                            </div>
                            <div class="col-xs-7">
                                <p>: <?= $inv_header['nomor_invoice'] ?></p>
                                <p>: <?= date('d-M-Y', strtotime($inv_header['invoice_date'])); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <table border="1" style="width: 100%; margin-top: 20px;">
                        <thead>
                            <tr>
                                <td class="text-center text-bold" rowspan="2">NO</td>
                                <td class="text-center text-bold" rowspan="2">DESKRIPSI</td>
                                <td class="text-center text-bold" rowspan="2">KODE BARANG</td>
                                <td class="text-center text-bold" rowspan="2">QUANTITY</td>
                                <td class="text-center text-bold" colspan="2">ASSET</td>
                                <td class="text-center text-bold" rowspan="2">BERAT</td>
                                <td class="text-center text-bold" rowspan="2">HARGA</td>
                                <td class="text-center text-bold" rowspan="2">AMOUNT (IDR)</td>
                            </tr>
                            <tr>
                                <td class="text-center text-bold">ID</td>
                                <td class="text-center text-bold">NUMBER</td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            // for ($i = 1; $i < 31; $i++) {
                            $i = 1;
                            foreach ($inv_detil as $key => $val) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td class="text-left"><?= $inv_header['deskripsi'] . $val['nama_barang'] ?></td>
                                    <td class="text-left"><?= $val['kode_barang'] ?></td>
                                    <td class="text-center"><?= $val['qty'] ?> PCE</td>
                                    <td class="text-center"><?= $val['id_asset'] ?></td>
                                    <td class="text-center"><?= $val['number_asset'] ?></td>
                                    <td class="text-center"><?= $val['berat'] ?> KG</td>
                                    <td class="text-center"><?= $val['harga'] ?></td>
                                    <td class="text-right">Rp. <?= $val['amount'] ?></td>
                                </tr>

                            <?php
                                $i++;
                            }
                            ?>

                            <!-- ini footer -->
                            <tr>
                                <td class="text-bold" colspan="3">TOTAL</td>
                                <td class="text-center text-bold"><?= $inv_header['total_qty'] ?> PCE</td>
                                <td></td>
                                <td></td>
                                <td class="text-center text-bold"><?= $inv_header['total_berat'] ?> KG</td>
                                <td></td>
                                <td class="text-right text-bold">Rp. <?= $inv_header['amount'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="8">PPN 11%</td>
                                <td class="text-right">Rp. <?= $ppn ?></td>
                            </tr>
                            <tr>
                                <td class="text-bold" colspan="8">TOTAL AMOUNT</td>
                                <td class="text-right text-bold">Rp. <?= $nilai ?></td>
                            </tr>

                        </tbody>

                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12" style="border: 1px solid black;margin-top: 20px;padding: 10px;margin-left: 15px;width: 96%;">
                    <p><strong>TERBILANG :</strong> <small style="font-style: italic;font-size: 11px;"><?= ucwords($terbilang) ?></small></p>
                </div>
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-9">
                    <p class="text-bold">JATUH TEMPO :</p>
                    <p>30 DAYS AFTER INVOICE DATE</p>

                    <p class="text-bold" style="margin-top: 20px;">PAYMENT TRANSFER :</p>
                    <p>MANDIRI CABANG MOJOKERTO</p>
                    <p>PT. JATIM AUTOCOMP INDONESIA</p>
                    <p>IDR ACCOUNT : 142-00-0980180-3</p>

                    <!-- <p class="text-bold" style="margin-top: 20px;">REMARKS :</p>
                    <p>DEPT &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: PD</p>
                    <p>REFF &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: JAI/PD/FWR/X/2022</p> -->
                </div>
                <div class="col-xs-3">
                    <p>Pasuruan, <?= date('d-M-Y', strtotime($inv_header['invoice_date'])); ?></p>
                    <p style="margin-top: 80px;text-decoration:underline">Dedi Hariawan</p>
                    <p>J.MGR FATP</p>
                </div>
            </div>

            <!-- ini batas invoice -->


        </div>




    </section>
    <!-- /.content -->
    <!-- </div> -->
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/adminlte/') ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // if (<?php echo $count; ?> > 9) {
            //   window.open('lampiran-pr.php')
            // }
            window.print();
        })
    </script>
</body>

</html>