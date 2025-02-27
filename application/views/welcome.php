    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>ILS | EXIM</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>bower_components/font-awesome/css/font-awesome.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?= base_url('assets/adminlte/') ?>dist/css/skins/_all-skins.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/adminlte/dist/img/money.png') ?>">

        <!-- Google Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    </head>

    <!-- jQuery 3 -->
    <script src="<?= base_url('assets/adminlte/') ?>bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?= base_url('assets/adminlte/') ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/adminlte/') ?>dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url('assets/adminlte/') ?>dist/js/demo.js"></script>



    <body>

    </body>

    </html>


    <div class="modal fade" id="modal-notice">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button> -->
                    <h4 class="modal-title">Informasi</h4>
                </div>
                <div class="modal-body">
                    <p><strong>Note :</strong></p>
                    <p>Scrap jenis <strong>ASSET FABRIKASI</strong>, FWR belum di dukung sistem, harus dibuat secara terpisah dengan manual (Excel).</p>
                </div>
                <div class="modal-footer">
                    <a href="<?= base_url('user') ?>" type="submit" class="btn btn-primary">Lanjutkan <i class="fa fa-sign-in"></i></a>
                </div>
            </div>

        </div>

    </div>

    <script>
        $(function() {
            $('#modal-notice').modal('show')
        });

        setTimeout(function() {
            window.location.href = "<?= base_url('user') ?>";
        }, 10000);
    </script>