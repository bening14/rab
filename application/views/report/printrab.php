<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>STI | CETAK RAB</title>
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
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/logo.png') ?>">

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
        margin-bottom: 4px;
    }

    small {
        font-size: 9px;
    }

    i {
        font-size: 14px;
    }

    th,
    td {
        font-size: 11px;
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
            <div class="row" style='margin-left:0px;margin-right:0px;'>
                <div class="col-xs-6">
                    <!-- <h4 style="margin-bottom: 0px;margin-top: -5px; font-weight: bold;padding: 5px;border: 5px solid red;color:red;text-align:center;">CONFIDENTIAL</h4> -->
                <h4 style="margin-bottom: 10px;">PT. SOLUSI TUKANG INDONESIA</h4>
                <p><strong>Kantor :</strong> Jl. Subali Raya Blok 15B/8C, Kec. Sekarpuro,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kab. Malang Jawa Timur 65154</p>
                <p><strong>Phone :</strong> +62-815-5590-9650</p>
                <p><strong>Email :</strong> info@solusitukang.id</p>
                <p><strong>Website :</strong> https://solusitukang.id</p>
                </div>
                <div class="col-xs-6" style="text-align: right;">
                    <img src="<?= base_url('assets/logo_sti.png') ?>" alt="KOP" style="width: 100px;">
                </div>
            </div>



            <div class="row" style="margin-top: 40px;">
                <div class="col-xs-12">
                    <h3 class="text-center" style="font-weight: bold;">Rencana Anggaran Biaya</h3>
                    <!-- <h4 class="text-center">PT. Solusi Tukang Indonesia</h4> -->
                </div>
            </div>

            <div class="row" style="margin-top: 20px;margin-left:10px;margin-right:10px;border: 1px solid black;padding-top: 10px;padding-bottom: 10px;">

                <div class="col-xs-12">
                    <div class="row" style="text-align: right;">
                        <div class="col-xs-12">
                            <p><?=  date("d-M-Y", strtotime($header['date_created'])) ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-3">
                            <p>Nama Customer</p>
                            <p>Alamat</p>
                            <p>SO Number</p>
                            <p>Kegiatan Pekerjaan</p>
                            <p>Luas Area</p>
                        </div>
                        <div class="col-xs-9">

                            <p>: <?= $header['customer'] ?></p>
                            <p>: <?= $header['alamat'] ?></p>
                            <p>: <?= $header['so_number'] ?></p>
                            <p>: <?= $header['kegiatan_pekerjaan'] ?></p>
                            <p>: <?= $header['luas_area'] ?></p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row" style="padding-top: 10px;margin-left:0px;margin-right:0px;padding-top: 10px;padding-top: 10px;padding-bottom: 10px;">

                <div class="col-xs-12" style="padding-left: 10px;padding-right: 10px;">

                <table border="1" style="width: 100%">
                    <tr>
                        <th style="font-size: 11px;text-align: center;height: 40px;">NO</th>
                        <th style="font-size: 11px;text-align: center;">Uraian Pekerjaan</th>
                        <th style="font-size: 11px;text-align: center;">Banyaknya<br>(Vol. Pekerjaan)</th>
                        <th style="font-size: 11px;text-align: center;">Satuan</th>
                        <th style="font-size: 11px;text-align: center;">Analisa Harga Satuan</th>
                        <th style="font-size: 11px;text-align: center;">Jumlah</th>
                    </tr>
                        <?php
                        $no=1;
                        foreach ($detail as $key => $val) {
                          ?>
                    <tr>
                        <td style="font-size: 11px;text-align: center;height: 30px;"><?= $no ?></td>
                        <td style="font-size: 11px;text-align: center;"><?= $val['uraian_pekerjaan'] ?></td>
                        <td style="font-size: 11px;text-align: center;"><?= number_format($val['qty'] , 2) ?></td>
                        <td style="font-size: 11px;text-align: center;">M2</td>
                        <td style="font-size: 11px;text-align: center;"><?php

                                                                        $harga = ($val['harga_final'] / $val['qty']);
                                                                        echo 'Rp. ' . number_format($harga, 2);                                                                      
                                                                        
                                                                        ?></td>
                        <td style="font-size: 11px;text-align: center;"><?= 'Rp. ' . number_format($val['harga_final'] , 2) ?></td>
                    </tr>
                          <?php
                          $no++;
                        }
                          ?>
                    <tr>
                        <td colspan="5" style="text-align: center;font-weight: bold;height: 30px;">TOTAL</td>
                        <td style="text-align: center;font-weight: bold;height: 30px;"><?= 'Rp. ' . number_format($header['nilai_final'],2) ?></td>
                    </tr>
                </table>
                  
                </div>
            </div>

            <div class="row" style="padding-left: 10px;padding-right: 10px;padding-top:60px;">

                <div class="col-xs-12">

                    

                    <div class='row pull-right'>
                        <div class="col-xs-12">
                            <table border="1" style="width: 100%;" class="text-center">
                                <tr>
                                    <td style="width: 33%;">APPROVED</td>
                                    <td style="width: 33%;">CHECKED</td>
                                    <td style="width: 33%;">PREPARED</td>
                                </tr>
                                <tr style="height: 50px;">
                                    <td style="width: 100px;"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: solid black 1pt;">DIR/MGR</td>
                                    <td style="border-bottom: solid black 1pt;">SPV</td>
                                    <td style="border-bottom: solid black 1pt;">FRM</td>
                            </table>
                        </div>
                    </div>

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