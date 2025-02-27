<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="<?= base_url('user/status') ?>" type="button" class="btn bg-navy btn-lg"><i class="fa fa-book"></i> Apa itu status ?</a>
        <a href="<?= base_url('user/reject') ?>" type="button" class="btn bg-orange btn-lg"><i class="fa fa-clipboard"></i> Histori barang tidak bisa scrap</a>
        <button type="button" class="btn bg-red btn-lg" onclick="changepsw('<?= $this->session->userdata('id') ?>')"><i class="fa fa-key"></i> Ganti Password</button>

        <!-- <button type="button" class="btn bg-orange btn-lg"><i class="fa fa-map-signs"></i> Posisi scrap saya dimana ?</button> -->

    </section>
    <section class="content-header">

        <div class="callout callout-success">
            <h4>Pengumuman</h4>
            <p>! Untuk kelancaran proses scrap yang merata ke semua section, register scrap diterima maksimal 100 jenis barang dalam satu kali pengajuan.</p>
            <p>! Jika kode barang tidak ada di master Barang ILS, silahkan daftarkan terlebih dahulu dibawah ini.</p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12" style="margin-bottom: 20px;">
                <a href="<?= base_url('user') ?>" class="btn bg-blue"><i class="fa fa-home"></i></a>
                <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
                <button type="button" onclick="registerbarang()" class="btn bg-navy"><i class="fa fa-inbox"></i> Register Kode Barang Disini</button>
                <a href="<?= base_url('user/listapproval') ?>" class="btn bg-navy"><i class="fa fa-pencil-square-o"></i> Pengajuan Scrap NO BC</a>

                <?php
                if ($this->session->userdata['section'] == 'FATP') {
                ?>
                    <a href="<?= base_url('user/listinvoice') ?>" type="button" class="btn bg-navy pull-right"><i class="fa fa-file-text"></i> &nbsp;Invoice Scrap &nbsp;<i class="fa fa-arrow-circle-right"></i></a>&nbsp;
                <?php
                }
                ?>
            </div>


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Daftar Aktivitas Scrap</h3>
                        </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableScrap" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>REGISTER DATE</th>
                                </tr>
                            </thead>
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
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Submit</button>
                    <button type="button" id="btn-process" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="modalregister">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Barang</h4><br>
            </div>
            <form id="form_register" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="callout callout-warning">
                        <h4>Perhatian</h4>
                        <p><i class="fa fa-pencil"></i> Nama barang harus sesuai dengan invoice asal atau dokumen pemasukan asal</p>
                        <p><i class="fa fa-pencil"></i> Setelah sukses mendaftarkan kode barang scrap, bisa langsung melakukan upload pengajuan scrap</p>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control">
                    </div>
                    <div class="form-group" id="jenis_brg">
                        <label>Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="PCE">PCE - PIECE</option>
                            <option value="MTR">MTR - METRE</option>
                            <option value="SET">SET - SET</option>
                            <option value="PKG">PKG - PACKAGE</option>
                            <option value="BO">BO - BOTTLE</option>
                            <option value="BX">BX - BOX</option>
                            <option value="CA">CA - CAN</option>
                            <option value="CT">CT - CARTON</option>
                            <option value="E39">E39 - DOTS PER INCH</option>
                            <option value="GN">GN - GROSS GALLON</option>
                            <option value="KGM">KGM - KILOGRAM</option>
                            <option value="LO">LO - UNIT OF PROCUREMENT</option>
                            <option value="LTR">LTR - LITRE (1 DM3)</option>
                            <option value="NIU">NIU - NUMBER OF INTERNATIONAL UNIT</option>
                            <option value="PL">PL - PAIL</option>
                            <option value="NRL">NRL - ROLL</option>
                            <option value="PR">PR - PAIR</option>
                            <option value="PK">PK - PACK</option>
                            <option value="TN">TN - TIN</option>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Submit</button>
                    <button type="button" id="btn-process" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- page script -->
<script>
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
    $(function() {
        //pesan 
        // Swal.fire({
        //     icon: 'info',
        //     title: 'Informasi',
        //     text: 'Scrap jenis ASSET FABRIKASI, perlakuan sama seperti inventory. FWR dibuat secara terpisah dengan manual.',
        // })
        $("#tableScrap").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            "order": [
                [0, "desc"]
            ],

            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url('user/ajax_table_barang') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.kode_barang",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.nama_barang",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })

        // if (user == 'EXIM') {
        //     $(".toolbar").html(`
        //     <a href="<?= base_url('user') ?>" class="btn bg-maroon"><i class="fa fa-home"></i> Dashboard</a>&nbsp;
        //     <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
        //     <button type="button" onclick="registerbarang()" class="btn btn-info"><i class="fa fa-inbox"></i> Register Kode Barang Disini</button>
        //     <a href="<?= base_url('user/listapproval') ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Approval</a>
        //     `)
        // } else {
        //     $(".toolbar").html(`
        //     <a href="<?= base_url('user') ?>" class="btn bg-maroon"><i class="fa fa-home"></i> Dashboard</a>&nbsp;
        //     <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
        //     <button type="button" onclick="registerbarang()" class="btn btn-info"><i class="fa fa-inbox"></i> Register Kode Barang Disini</button>
        //     `)
        // }


    });

    function reload_table() {
        $('#tableScrap').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit").hide()
        $("#btn-process").show()
    }

    function default_submit() {
        $("#btn-submit").show()
        $("#btn-process").hide()
    }

    // $('#asal').on('change', function() {
    //     $('#jenis_brg').show()
    //     if ($('#asal').val() == 'IMPORT') {
    //         $('#jenis_brg').show()
    //         console.log($('#asal').val())
    //     } else if ($('#asal').val() == 'LOKAL') {
    //         $('#jenis_brg').hide()
    //         console.log($('#asal').val())
    //     }
    // });


    function changepsw(id) {
        $('#modal-password').modal('show')
        $('#id_user').val(id)
    }

    $("#form_password").submit(function(e) {
        e.preventDefault()

        if ($('#password').val() == '' || $('#password_lagi').val() == '') {
            Swal.fire(
                'error!',
                'Isikan password',
                'error'
            )
            return
        }

        if ($('#password').val() != $('#password_lagi').val()) {
            Swal.fire(
                'error!',
                'Password tidak sama',
                'error'
            )
            return
        }



        var form_data = new FormData();
        form_data.append('table', 'mst_user');
        form_data.append('id', $("#id_user").val());
        form_data.append('password', $("#password").val());


        var url_ajax = '<?= base_url() ?>user/ubah_password'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire(
                        'Success!',
                        result.message,
                        'success'
                    )
                    $('#modal-password').modal("hide");
                    $('#password').val('')
                    $('#password_lagi').val('')
                    reload_table()
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    $("#form_register").submit(function(e) {
        e.preventDefault()

        if ($('#nama_barang').val() == '') {
            Swal.fire(
                'error!',
                'Isikan Nama Barang',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'mst_barang');
        form_data.append('nama_barang', $("#nama_barang").val());
        form_data.append('unit', $("#unit").val());
        form_data.append('flag_ils', '0');
        form_data.append('fasilitas_bc', '1');
        form_data.append('dokumen_bc', 'YES');


        var url_ajax = '<?= base_url() ?>user/register_barang'

        $.ajax({
            url: url_ajax,
            type: "post",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            dataType: "json",
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire(
                        'Success!',
                        result.message,
                        'success'
                    )
                    $('#modalregister').modal("hide");
                    $('#nama_barang').val('')
                    reload_table()
                } else {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                }
            },
            error: function(err) {
                Swal.fire(
                    'error!',
                    err.responseText,
                    'error'
                )
            }
        })
    })

    function registerbarang() {
        $('#modalregister').modal('show')
    }
</script>