<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ILS | SCRAP REQUISITION</title>
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

    .subpage {
        padding: 1cm;
        border: 5px red solid;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }

    @page {
        size: A4;
        margin: 0;
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
        font-size: 9px;
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

    }


    .b-bottom {
        border-bottom: 1pt solid black;
    }

    .b-top {
        border-top: 1pt solid black;
    }

    .confidential {
        font-weight: bold;
        color: red !important;
        border-style: solid;
        border-color: red;
        border-width: 4px;
        margin-left: 40px;
        margin-top: 0px;
        margin-bottom: 0px;
        padding-top: 8px;
        padding-bottom: 8px;
    }

    .purchase-order {
        margin-top: 0px;
        margin-bottom: 0px;
        margin-left: -100px;
        font-weight: bold;
        ;
        font-style: italic;
    }

    h4,
    h3 {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .lembar {
        margin-bottom: 10px;
    }

    .kategori tr td {
        font-size: 7px;
    }
</style>

<body>

    <div class="wrapper">
        <!-- Main content -->
        <section class="page">

            <div class="lembar">
                <div class="row">
                    <div class="col-xs-8">
                        <h4 style="margin-bottom: 0px; font-weight: bold;">PT. JATIM AUTOCOMP INDONESIA</h4>
                        <i>Wiring Harness Manufacturer</i>
                    </div>
                    <div class="col-xs-4">
                        <h4 style="margin-bottom: 0px;margin-top: -5px; font-weight: bold;padding: 5px;border: 5px solid red;color:red;text-align:center;">SECRET</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-5">
                        <h3 class="text-center" style="font-weight: normal; text-decoration: underline">SCRAP REQUISITION</h3>
                        <div class="row">
                            <div class="col-xs-2">
                                <p>NO</p>
                                <p>DATE.</p>
                            </div>
                            <div class="col-xs-10">
                                <?php
                                echo '<p>: ' . $no['no_sr'] . '</p>';
                                echo '<p>: ' . date('d-M-Y', strtotime(date('Y-m-d'))) . '</p>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <table border="1" style="width: 100%; border-left: 2px solid white" class="text-center">
                            <tr>
                                <td style="border: 1px solid white"></td>
                                <td style="width: 20%;">APPROVED</td>
                                <td style="width: 20%;">VERIFIED</td>
                                <td style="width: 20%;">CHECKED 2</td>
                                <td style="width: 20%;">CHECKED 1</td>
                                <td style="width: 20%;">PREPARED</td>
                            </tr>
                            <tr style="height: 50px;">
                                <td style="border: 1px solid white"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid white">&nbsp;</td>
                                <td>President</td>
                                <td>EXIM SPV</td>
                                <td>DFM</td>
                                <td>Head Dept</td>
                                <td>SPV</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <table border="1" style="width: 100%; margin-top: 8px;">
                            <tr>
                                <td class="text-center" style="width: 20px;">NO</td>
                                <td class="text-center" style="width: 60px;">KODE BARANG.</td>
                                <td class="text-center">NAMA BARANG</td>
                                <td class="text-center" style="width: 40px;">SUPPLIER</td>
                                <td class="text-center" style="width: 70px;">QTY</td>
                                <td class="text-center" style="width: 100px;">WEIGHT</td>
                                <td class="text-center" style="width: 80px;">UOM</td>
                                <td class="text-center" style="width: 1%;">INVOICE PO</td>
                                <td class="text-center" style="width: 1%;">DATE</td>
                                <td class="text-center" style="width: 1%;">REASON</td>
                                <td class="text-center" style="width: 6%;">PHOTO</td>
                            </tr>
                            <?php
                            $r = 1;
                            foreach ($scrap as $key) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $r ?></td>
                                    <td class="text-center"><?= $key->kode_barang ?></td>
                                    <td class="text-center"><?= $key->nama_barang ?></td>
                                    <td class="text-center"><?= $key->supplier ?></td>
                                    <td class="text-center"><?= $key->qty ?></td>
                                    <td class="text-center"><?= $key->weight ?></td>
                                    <td class="text-center"><?= $key->uom ?></td>
                                    <td class="text-center"><?= $key->invoice_po ?></td>
                                    <td class="text-center"><?= $key->date_inv_po ?></td>
                                    <td class="text-center"><?= $key->reason ?></td>
                                    <td class="text-center"><img src="<?= base_url('assets/photo_scrap/' . $key->photo) ?>" alt="" style="max-width: 100px;"></td>
                                </tr>
                            <?php
                                $r++;
                            }
                            ?>

                        </table>
                    </div>
                </div>


            </div>




        </section>
        <!-- /.content -->
    </div>
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