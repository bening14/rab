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
            <p>! Upload file <strong>BUKTI/EVIDENCE</strong> yang menyatakan bahwa barang yang diajukan adalah <strong>NO BC</strong>, agar proses pengajuan diterima oleh section <strong>EXIM</strong></p>
            <p>! Pengajuan yang telah diterima sebagai barang <strong>NO BC</strong>, maka proses scrap bisa dilanjutkan ke section <strong>PGA</strong></p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12" style="margin-bottom: 20px;">
                <a href="<?= base_url('user') ?>" class="btn bg-blue"><i class="fa fa-home"></i></a>
                <?php
                if ($this->session->userdata('section') != 'PGA-ADM') {
                ?>
                    <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
                    <!-- <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a> -->
                <?php
                }
                ?>
                <a href="<?= base_url('user/listapproval') ?>" class="btn bg-navy"><i class="fa fa-pencil-square-o"></i> Pengajuan Scrap NO BC</a>

                <?php

                if ($this->session->userdata['section'] == 'PGA-ADM') {
                ?>
                    <a href="<?= base_url('user/masterharga') ?>" type="button" class="btn bg-green"><i class="fa fa-dollar"></i> Master Harga </a>
                <?php
                }
                ?>
            </div>


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Pengajuan Scrap <strong>NO BC</strong></h3>
                        <button class="btn btn-lg bg-navy pull-right" id="btn-pengajuan"><i class="fa fa-plus"></i> Pengajuan</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableScrap" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR TIKET</th>
                                    <th>SECTION</th>
                                    <th>NOMOR SR</th>
                                    <th>DATE REGISTRASI</th>
                                    <th>AKSI</th>
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

<!-- <div class="modal fade" id="modalregister">
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

</div> -->

<!-- <div class="modal fade" id="modal-upload-evidence">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Evidence/Bukti</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! File Evidence merupakan file yang membuktikan bahwa barang masuk kategori NOBC <br>&nbsp;&nbsp;&nbsp;biasanya Evidence/Bukti berupa Faktur Pajak pembelian.</p>
                </div>
            </div>
            <form id="form_upload_pdf_evidence" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="no_tiket">
                        <label for="file"># Pilih File EVIDENCE/BUKTI (PDF)</label>
                        <input type="file" class="custom-file-input" id="file" name="file" data-toggle="custom-file-input">
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

<div class="modal fade" id="modalapproval">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Klasifikasi BC, NO BC atau B3 , NON B3</h4><br>
            </div>
            <form id="form_approval" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="callout callout-warning">
                        <h4>Perhatian</h4>
                        <p><i class="fa fa-pencil"></i> Sebelum memutuskan, baiknya pelajari secara detail <strong>BERKAS PENGAJUAN</strong> dan <strong>EVIDENCE</strong> (Bila ada) dari user </p>
                    </div>
                    <div class="form-group">
                        <label>Status </label>
                        <input type="text" id="status_approval" name="status_approval" class="form-control" readonly>
                        <input type="hidden" id="nomor_tiket" name="nomor_tiket" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Keterangan untuk user</label>
                        <textarea name="remark" id="remark" class="form-control" cols="30" rows="3"></textarea>
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

</div> -->

<!-- page script -->
<script>
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
    $(function() {
        //pesan
        Swal.fire({
            icon: 'info',
            title: 'Informasi',
            text: 'Silahkan klik tombol PENGAJUAN untuk mengajukan scrap NO BC, Sistem akan men-generate Tiket baru untuk Anda. Kemudian klik tombol EDIT untuk menambahkan barang.',
        })
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
                'url': '<?= base_url('user/ajax_table_pengajuan') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.nomor_tiket",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.section",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.no_sr",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    if (data.no_sr == '') {
                        return `<button class="btn btn-sm btn-danger" onclick="delete_data('` + data.nomor_tiket + `')">Hapus</button>&nbsp;<a href="<?= base_url('user/listapprovaldetail?tiket=') ?>` + data.nomor_tiket + `" class="btn btn-sm bg-purple"> Edit</a>`
                    } else {
                        return `<a href="<?= base_url('user/listapprovaldetail?tiket=') ?>` + data.nomor_tiket + `" class="btn btn-sm btn-info"> Detail</a>&nbsp;<a href="<?= base_url('user/printnobc?tiket=') ?>` + data.nomor_tiket + `" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-print"></i> SR</a>`
                    }
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })


        // $(".toolbar").html(`
        //     <a href="<?= base_url('user') ?>" class="btn bg-maroon"><i class="fa fa-home"></i> Dashboard</a>&nbsp;
        //     <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
        //     <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn btn-info"><i class="fa fa-inbox"></i> Kode Barang Scrap</button>

        //     `)


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

    function delete_data(nomor_tiket) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/delete_data',
                    data: {
                        table: 'header_pengajuan',
                        nomor_tiket: nomor_tiket
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Deleted!',
                                'Data berhasil di hapus.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })

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

    // $("#form_register").submit(function(e) {
    //     e.preventDefault()

    //     if ($('#nama_barang').val() == '') {
    //         Swal.fire(
    //             'error!',
    //             'Isikan Nama Barang',
    //             'error'
    //         )
    //         return
    //     }

    //     var form_data = new FormData();
    //     form_data.append('table', 'mst_barang');
    //     form_data.append('nama_barang', $("#nama_barang").val());
    //     form_data.append('unit', $("#unit").val());
    //     form_data.append('flag_ils', '0');
    //     form_data.append('fasilitas_bc', '1');
    //     form_data.append('dokumen_bc', 'YES');


    //     var url_ajax = '<?= base_url() ?>user/register_barang'

    //     $.ajax({
    //         url: url_ajax,
    //         type: "post",
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: form_data,
    //         dataType: "json",
    //         success: function(result) {
    //             if (result.status == "success") {
    //                 Swal.fire(
    //                     'Success!',
    //                     result.message,
    //                     'success'
    //                 )
    //                 $('#modalregister').modal("hide");
    //                 $('#nama_barang').val('')
    //                 reload_table()
    //             } else {
    //                 Swal.fire(
    //                     'error!',
    //                     result.message,
    //                     'error'
    //                 )
    //             }
    //         },
    //         error: function(err) {
    //             Swal.fire(
    //                 'error!',
    //                 err.responseText,
    //                 'error'
    //             )
    //         }
    //     })
    // })

    // function registerbarang() {
    //     $('#modalregister').modal('show')
    // }

    // function uploadevidence(no) {
    //     $('#modal-upload-evidence').modal('show')
    //     $('#no_tiket').val(no)
    // }

    // $("#form_upload_pdf_evidence").submit(function(e) {
    //     e.preventDefault()

    //     if ($('#file').val() == '') {
    //         Swal.fire(
    //             'error!',
    //             'Pilih file evidence terlebih dahulu!',
    //             'error'
    //         )
    //         return
    //     }

    //     var form_data = new FormData();
    //     form_data.append('table', 'tbl_pengajuan_scrap');
    //     form_data.append('nomor_tiket', $("#no_tiket").val());
    //     form_data.append('jenis', 'evidence');

    //     if ($('#file').val() !== "") {
    //         var file_data = $('#file').prop('files')[0];
    //         form_data.append('file', file_data);
    //     }

    //     var url_ajax = '<?= base_url() ?>user/import_file_sr'

    //     $.ajax({
    //         url: url_ajax,
    //         type: "post",
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: form_data,
    //         dataType: "json",
    //         success: function(result) {
    //             if (result.status == "success") {
    //                 Swal.fire(
    //                     'Success!',
    //                     result.message,
    //                     'success'
    //                 )
    //                 $('#modal-upload-evidence').modal("hide");
    //                 reload_table()
    //             } else {
    //                 Swal.fire(
    //                     'error!',
    //                     result.message,
    //                     'error'
    //                 )
    //             }
    //         },
    //         error: function(err) {
    //             Swal.fire(
    //                 'error!',
    //                 err.responseText,
    //                 'error'
    //             )
    //         }
    //     })
    // })

    // function hapus_evidence(nomor_tiket) {

    //     Swal.fire({
    //         title: 'Apakah Anda Yakin ?',
    //         text: "Data yang dihapus tidak bisa dikembalikan!",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Ya, hapus saja!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             $.ajax({
    //                 url: '<?= base_url() ?>user/hapus_evidence',
    //                 data: {
    //                     nomor_tiket: nomor_tiket
    //                 },
    //                 type: 'post',
    //                 dataType: 'json',
    //                 success: function(result) {
    //                     if (result.status == "success") {
    //                         Swal.fire(
    //                             'Deleted!',
    //                             'Data berhasil di hapus.',
    //                             'success'
    //                         )
    //                         reload_table()
    //                     } else
    //                         toast('error', result.message)
    //                 }
    //             })
    //         }
    //     })

    // }

    // function modalapproval(status, no) {
    //     $('#modalapproval').modal('show')
    //     $('#status_approval').val(status)
    //     $('#nomor_tiket').val(no)
    // }

    // $("#form_approval").submit(function(e) {
    //     e.preventDefault()

    //     if ($('#remark').val() == '') {
    //         Swal.fire(
    //             'error!',
    //             'Isikan Keterangan',
    //             'error'
    //         )
    //         return
    //     }

    //     var form_data = new FormData();
    //     form_data.append('table', 'tbl_pengajuan_scrap');
    //     form_data.append('status', $("#status_approval").val());
    //     form_data.append('remark', $("#remark").val());
    //     form_data.append('nomor_tiket', $("#nomor_tiket").val());


    //     var url_ajax = '<?= base_url() ?>user/approval_pengajuan'

    //     $.ajax({
    //         url: url_ajax,
    //         type: "post",
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         data: form_data,
    //         dataType: "json",
    //         success: function(result) {
    //             if (result.status == "success") {
    //                 Swal.fire(
    //                     'Success!',
    //                     result.message,
    //                     'success'
    //                 )
    //                 $('#modalapproval').modal("hide");
    //                 $('#remark').val('')
    //                 reload_table()
    //             } else {
    //                 Swal.fire(
    //                     'error!',
    //                     result.message,
    //                     'error'
    //                 )
    //             }
    //         },
    //         error: function(err) {
    //             Swal.fire(
    //                 'error!',
    //                 err.responseText,
    //                 'error'
    //             )
    //         }
    //     })
    // })

    $('#btn-pengajuan').on('click', function() {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan membuat pengajuan scrap NO BC!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, ajukan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/generatenobc',
                    data: {
                        table: 'header_pengajuan'
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {

                        console.log(result.status);

                        if (result.status == "success") {
                            Swal.fire(
                                'Sukses!',
                                'Tiket baru telah ter-generate untuk Anda, silahkan lakukan edit data.',
                                'success'
                            )
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })
    })
</script>