<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ILS - Scrap Requisition</title>
    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?= base_url('assets/adminlte/dist/img/money.png') ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url('assets/adminlte/dist/img/money.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/adminlte/dist/img/money.png') ?>">
    <!-- END Icons -->

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>dist/css/skins/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>




<style type="text/css">
    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 10pt "Tahoma";
    }

    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 10mm;
        padding-top: 3mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
        padding: 0cm;
        /* border: 5px red solid; */
        height: 297mm;
        /* outline: 2cm #FFEAEA solid; */

    }

    .clear {
        clear: both;
    }

    table {
        border-collapse: collapse;
    }

    table thead tr th {
        font-weight: normal;
    }

    .table-data,
    th,
    td {
        border: 1.5px solid black;
    }

    th,
    td {
        padding: 5px;
    }

    th {
        /* background-color: #4CAF50; */
        color: black;
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
            /* page-break-after: auto; */
        }

        .page:last-child {
            page-break-after: auto;
        }
    }

    p {
        margin: 0;
    }

    .text-center {
        text-align: center;
    }

    .text-right {
        text-align: right;
    }

    .total {
        vertical-align: top;
    }

    .total>td {
        border: 1px solid white;
    }
</style>

<body>

    <div class="book" style="font-size: 10px;">
        <div class="page">
            <div class="row">

                <div class="col-md-12">
                    <p><strong>PT. JATIM AUTOCOMP INDONESIA</strong></p>
                </div>
            </div>
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-12 text-center">
                    <h4>SCRAP REQUISITION</h4>
                </div>
            </div>

            <div class="row" style="margin-top: 30px;">
                <div class="col-md-6">
                    <div class="col-md-4">
                        <p>NO</p>
                        <p>DATE</p>
                    </div>
                    <div class="col-md-8">
                        <p>: JAI/MTC/WTS/VI/22/01-6</p>
                        <p>: 22-JUN-2023</p>
                    </div>
                </div>
                <!-- <div class="col-md-6">
                    <table>
                        <tr style="text-align: center;">
                            <td>APPROVED</td>
                            <td>CHECKED 1</td>
                            <td>CHECKED 2</td>
                            <td>PREPARED</td>
                        </tr>
                        <tr>
                            <td style="height: 60px; width: 80px;"></td>
                            <td style="height: 60px; width: 80px;"></td>
                            <td style="height: 60px; width: 80px;"></td>
                            <td style="height: 60px; width: 80px;"></td>
                        </tr>
                        <tr>
                            <td style="height: 20px;"></td>
                            <td style="height: 20px;"></td>
                            <td style="height: 20px;"></td>
                            <td style="height: 20px;"></td>
                        </tr>
                    </table>
                </div> -->
            </div>

            <div class="row" style="margin-top: 20px;">
                <div class="col-12 text-center">
                    <table border="1" style="width: 100%;">

                        <tr style="height: 30px;">
                            <td style="border: solid black 1px; width: 5%;"><strong>NO</strong></td>
                            <td style="border: solid black 1px;"><strong>KODE BARANG</strong></td>
                            <td style="border: solid black 1px;"><strong>NAMA BARANG</strong></td>
                            <td style="border: solid black 1px;"><strong>SUPPLIER</strong></td>
                            <td style="border: solid black 1px;"><strong>QTY</strong></td>
                            <td style="border: solid black 1px;"><strong>WEIGHT</strong></td>
                            <td style="border: solid black 1px;"><strong>UOM</strong></td>
                            <td style="border: solid black 1px;"><strong>INVOICE / PO</strong></td>
                            <td style="border: solid black 1px;"><strong>DATE</strong></td>
                            <td style="border: solid black 1px;"><strong>REASON</strong></td>
                            <td style="border: solid black 1px;"><strong>PHOTO</strong></td>
                        </tr>
                        <?php
                        $r = 1;
                        foreach ($scrap as $key) {
                        ?>
                            <tr style="height: 20px;">
                                <td style="border: solid black 1px;"><?= $r ?></td>
                                <td style="border: solid black 1px;text-align: left;padding-left: 10px;"><?= $key->kode_barang ?></td>
                                <td style="border: solid black 1px;"><?= $key->nama_barang ?></td>
                                <td style="border: solid black 1px;"><?= $key->supplier ?></td>
                                <td style="border: solid black 1px;"><?= $key->qty ?></td>
                                <td style="border: solid black 1px;"><?= $key->weight ?></td>
                                <td style="border: solid black 1px;"><?= $key->uom ?></td>
                                <td style="border: solid black 1px;"><?= $key->invoice_po ?></td>
                                <td style="border: solid black 1px;"><?= $key->date_inv_po ?></td>
                                <td style="border: solid black 1px;"><?= $key->reason ?></td>
                                <td style="border: solid black 1px;"><img src="<?= base_url('assets/photo_scrap/' . $key->photo) ?>" alt="<?= $key->photo ?>" class="img-responsive" style="width: 40%;"></td>
                            </tr>
                        <?php
                            $r++;
                        }
                        ?>


                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>