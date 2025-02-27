<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ILS | FWR</title>
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
        width: 297mm;
        min-height: 210mm;
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
        size: landscape;
    }

    @media print {

        html,
        body {
            width: 297mm;
            height: 210mm;
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
        font-size: 10px;
        margin-bottom: 2px;
    }

    small {
        font-size: 10px;
    }

    i {
        font-size: 14px;
    }

    th,
    td {
        font-size: 10px;
        padding-top: 2px !important;
        padding-bottom: 2px !important;
        padding-right: 5px !important;
        padding-left: 5px;
        border-right: 1px solid black !important;
        border-left: 1px solid black !important;
        /* border-top: 1pt solid black !important; */

    }

    h4,
    h3 {
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .lembar {
        margin-bottom: 20px;
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
            <div class="row">
                <div class="col-xs-8">
                    <h4 style="margin-bottom: 0px; font-weight: bold;">PT. JATIM AUTOCOMP INDONESIA</h4>
                    <i>Wiring Harness Manufacturer</i>
                </div>
                <!-- <div class="col-xs-4">
                        <h4 style="margin-bottom: 0px;margin-top: -5px; font-weight: bold;padding: 5px;border: 5px solid red;color:red;text-align:center;">SECRET</h4>
                    </div> -->
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <h5 class="text-center" style="font-weight: normal; text-decoration: underline;margin-left: 39%;font-size: 20px;">FIXED ASSET WRITE OFF REQUISITION<br>FWR</h5>
                    <div class="row">
                        <div class="col-xs-3">
                            <h6 style="border: 1px solid black;padding: 5px;text-align: center;font-size: 12px;">FA Form 07</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-2">
                            <p>NO</p>
                            <p>DATE</p>
                            <p>DEPT/SECTION</p>
                        </div>
                        <div class="col-xs-10">
                            <?php
                            echo '<p>: ' . $no['no_sr'] . '</p>';
                            echo '<p>: ' . date('d-M-Y', strtotime(date('Y-m-d'))) . '</p>';
                            echo '<p>: ' . $this->session->userdata("section") . '</p>';
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <table border="1" style="width: 100%;" class="text-center">
                        <tr>
                            <!-- <td style="width: 16%; border: 1px solid white"></td> -->
                            <td style="width: 16%; border-left: 2px solid black;">APPROVED</td>
                            <td style="width: 16%;">VERIFIED 2</td>
                            <td style="width: 16%;">VERIFIED 1</td>
                            <td style="width: 16%;">CHECKED</td>
                            <td style="width: 16%;">PREPARED</td>
                        </tr>
                        <tr style="height: 50px;">
                            <!-- <td style="border: 1px solid white"></td> -->
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <!-- <td style="border: 1px solid white">&nbsp;</td> -->
                            <td style="text-align: center;">President Director</td>
                            <td style="text-align: center;">Exim SPV</td>
                            <td style="text-align: center;">FA SPV</td>
                            <td style="text-align: center;">Dept Head PIC</td>
                            <td style="text-align: center;">SPV PIC Asset</td>
                        </tr>
                        <tr>
                            <!-- <td style="border: 1px solid white">&nbsp;</td> -->
                            <td style="text-align: left;">Date :</td>
                            <td style="text-align: left;">Date :</td>
                            <td style="text-align: left;">Date :</td>
                            <td style="text-align: left;">Date :</td>
                            <td style="text-align: left;">Date :</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <table border="1" style="width: 100%; margin-top: 20px;">
                        <thead>
                            <tr>
                                <td class="text-center" colspan="5" style="background-color:#00FFFF;">INISIATOR</td>
                                <td class="text-center" colspan="3" style="background-color:#ADD8E6;">FA</td>
                                <td class="text-center" colspan="2" style="background-color:#FFA500;">EXIM</td>
                                <td class="text-center" style="background-color:#FF00FF;">GA GS</td>
                                <td class="text-center" style="background-color:#00FFFF;">PIC ASSET</td>
                            </tr>
                            <tr>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">NO</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">ASSET NAME (USER)</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">ASSET NAME (FA)</td>
                                <td class="text-center" colspan="2" style="font-weight: bold;">ASSET IDENTITY</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">QTY</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">INVOICE NUMBER</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">ACQUISITION DATE</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">BOOK VALUE</td>
                                <td class="text-center" colspan="2" style="font-weight: bold;">KETERSEDIAAN DOK IN</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">KLASIFIKASI B3</td>
                                <td class="text-center" rowspan="2" style="font-weight: bold;">REMARKS</td>
                            </tr>
                            <tr>
                                <td class="text-center" style="font-weight: bold;">ASSET NUMBER</td>
                                <td class="text-center" style="font-weight: bold;">ASSET ID</td>
                                <td class="text-center" style="font-weight: bold;">BC IN</td>
                                <td class="text-center" style="font-weight: bold;">TGL BC</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $r = 1;
                            foreach ($scrap as $key) {
                            ?>
                                <tr>
                                    <td class="text-center"><?= $r ?></td>
                                    <td class="text-center"><?= $key->nama_barang ?></td>
                                    <td class="text-center"><?= $key->nama_barang_fa ?></td>
                                    <td class="text-center"><?= $key->asset_number ?></td>
                                    <td class="text-center"><?= $key->id_asset ?></td>
                                    <td class="text-center"><?= $key->qty ?></td>
                                    <td class="text-center"><?= $key->invoice_po_invoice ?></td>
                                    <td class="text-center"><?= $key->acquisition_date ?></td>
                                    <td class="text-center"><?= $key->book_value ?></td>
                                    <td class="text-center"><?= $key->nomor_aju ?></td>
                                    <td class="text-center"><?= $key->tanggal_daftar ?></td>
                                    <td class="text-center"><?= $key->b3 ?></td>
                                    <td class="text-center"><?= $key->reason ?></td>
                                </tr>
                            <?php
                                $r++;
                            }

                            ?>


                            <tr>
                                <td>TOTAL</td>
                                <td class="text-center" colspan="11"><?= $count ?></td>
                            </tr>
                        </tbody>

                    </table>

                    <table border="1" style="width: 100%; margin-top: 20px;">
                        <tr>
                            <td>Note :<br>
                                1. Original to FA <br>
                                2. Copy to EXIM & PIC
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


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