<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url('user/status') ?>" type="button" class="btn bg-navy btn-lg"><i class="fa fa-book"></i> Apa itu status ?</a>
            </div>
            <div class="col-md-5" style="text-align: right;">
                <button type="button" class="btn bg-orange btn-lg" id="btn-update"><i class="fa fa-refresh"></i> Get Jumlah</button>
            </div>
            <div class="col-md-1">
                <input type="text" id="info-jumlah" placeholder="-" style="width: 65px;height: 50px;font-size: 32px;text-align: center;">
            </div>
        </div>

    </section>
    <section class="content-header">

        <div class="callout callout-success">
            <h4>Pengumuman</h4>

            <p>! Untuk kelancaran proses scrap yang merata ke semua section, register scrap diterima maksimal 100 jenis barang dalam satu kali pengajuan.</p>
            <!-- <p>! </p> -->
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Detail Invoice <strong>JSI-871122</strong></h3>

                        </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <button type="button" class="btn bg-red" onclick="tutup_tab()"><i class="fa fa-times"></i> Tutup</button>
                        <button type="button" class="btn bg-blue" onclick="generate()"> &nbsp;Generate &nbsp;<i class="fa fa-exclamation"></i></button>

                        <table id="tableScrapd" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PHOTO</th>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>QTY</th>
                                    <th>ID ASSET</th>
                                    <th>ASSET NUMBER</th>
                                    <th>WEIGHT<br>(KG)</th>
                                    <th>PRICE</th>
                                    <th>AMOUNT<br>(IDR)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="<?= base_url('assets/photo_scrap/2_edit.jpg') ?>" class="" alt="Scrap Image" style="max-width:100px;"></td>
                                    <td>W1436-7868</td>
                                    <td>Laptop HP</td>
                                    <td>1</td>
                                    <td>104.07.00033</td>
                                    <td>46530</td>
                                    <td>10</td>
                                    <td>10,000</td>
                                    <td>100,000</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="<?= base_url('assets/photo_scrap/2_edit.jpg') ?>" class="" alt="Scrap Image" style="max-width:100px;"></td>
                                    <td>W1436-7868</td>
                                    <td>Laptop HP</td>
                                    <td>1</td>
                                    <td>104.07.00033</td>
                                    <td>46530</td>
                                    <td>10</td>
                                    <td>10,000</td>
                                    <td>100,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->


            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body-gambar" style="display: flex; width: 100%; justify-content:center">
                    <img src="<?= base_url('assets/photo_scrap/') ?>" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ganti Password</h4><br>
                <!-- <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-block btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a> -->
            </div>
            <form id="form_password" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="hidden" id="id_user" name="id_user" class="form-control">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Isikan password baru Anda">
                    </div>
                    <div class="form-group" id="jenis_brg">
                        <label>Password Baru (Lagi)</label>
                        <input type="password" id="password_lagi" name="password_lagi" class="form-control" placeholder="Isikan password baru Anda">
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                    <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Submit</button>
                    <!-- <button type="button" id="btn-process" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button> -->
                </div>
            </form>
        </div>

    </div>

</div>
</div>


<!-- page script -->
<script>
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
    var jumlah_data = 0

    function detil_data(photo, kode_barang) {
        var html
        var nama
        $('#exampleModalCenter').modal('show')
        nama = '<h5 class="modal-title" id="exampleModalLongTitle">' + kode_barang + '</h5>'
        html = '<img src="<?= base_url('assets/photo_scrap/') ?>' + photo + '" class="img-responsive" alt="detil_barang">'
        $('.modal-body-gambar').html(html)
        $('.modal-title').html(nama)
    }

    function tutup_tab() {
        window.close()
    }
</script>