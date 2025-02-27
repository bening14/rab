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
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Barang tidak bisa scrap</h3>
                        </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table-reject" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KODE BARANG</th>
                                    <th>NAMA BARANG</th>
                                    <th>INVOICE / PO</th>
                                    <th>SECTION</th>
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
        $("#table-reject").DataTable({
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
                'url': '<?= base_url('user/ajax_table_reject') ?>',
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
                "data": "data.invoice_po",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.section",
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })


        $(".toolbar").html(`
            <a href="<?= base_url('user') ?>" type="button" class="btn bg-maroon"><i class="fa fa-home"></i> Dashboard</a>&nbsp;
            
            
            `)


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

    $('#jenis').on('change', function() {
        if ($('#jenis').val() == 'INVENTORY') {
            $('#kategori_id').show()
            console.log($('#kategori').val())
        } else if ($('#jenis').val() == 'ASSET NON FABRIKASI') {
            $('#kategori_id').show()
            console.log($('#kategori').val())
        } else if ($('#jenis').val() == 'RAW MATERIAL') {
            $('#kategori_id').hide()
            $('#kategori').val('PERUSAKAN')

            console.log($('#kategori').val())
        } else if ($('#jenis').val() == 'FINISH GOOD') {
            $('#kategori_id').hide()
            $('#kategori').val('PERUSAKAN')

            console.log($('#kategori').val())
        }
    });



    $("#form_upload_excel").submit(function(e) {
        e.preventDefault()
        if ($('#file_excel').val() == "") {
            toast_confirm('error', "File Upload tidak boleh kosong!")
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/import_excel'

        var file_data = $('#file_excel').prop('files')[0];
        var kategori = $('#kategori').val();
        var jenis = $('#jenis').val();
        var asal = $('#asal').val();
        var form_data = new FormData();
        form_data.append('file_excel', file_data);
        form_data.append('kategori', kategori);
        form_data.append('jenis', jenis);
        form_data.append('asal', asal);

        $.ajax({
            url: url_ajax,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: result.message,
                    })
                    $('#modal-default').modal("hide");
                    // close_edit()
                    reload_table()
                    // default_submit()
                } else {
                    // default_submit()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message
                    })
                    $('#modal-default').modal("hide");
                    // toast_confirm('error', result.message)
                }
            },
            error: function(err) {
                default_submit()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: err.responseText
                })
                $('#modal-default').modal("hide");
                // toast_confirm('error', err.responseText)
            }
        });
    })

    function uploadsr(no) {
        $('#modal-upload-sr').modal('show')
        $('#id_list_scrap').val(no)
    }

    function uploadbc(no) {
        $('#modal-upload-bc').modal('show')
        $('#id_list_scrap2').val(no)
    }

    $("#form_upload_pdf_sr").submit(function(e) {
        e.preventDefault()

        if ($('#file').val() == '') {
            Swal.fire(
                'error!',
                'Pilih file pdf SR/FWR terlebih dahulu!',
                'error'
            )
            return
        }



        var form_data = new FormData();
        form_data.append('table', 'header_list_scrap');
        form_data.append('nomor_tiket', $("#id_list_scrap").val());
        form_data.append('jenis', 'sr');

        if ($('#file').val() !== "") {
            var file_data = $('#file').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>user/import_file_sr'

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
                    $('#modal-upload-sr').modal("hide");
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

    $("#form_upload_pdf_bc").submit(function(e) {
        e.preventDefault()

        if ($('#file2').val() == '') {
            Swal.fire(
                'error!',
                'Pilih file BC 25/41 terlebih dahulu!',
                'error'
            )
            return
        }



        var form_data = new FormData();
        form_data.append('table', 'header_list_scrap');
        form_data.append('nomor_tiket', $("#id_list_scrap2").val());
        form_data.append('jenis', 'bc');

        if ($('#file2').val() !== "") {
            var file_data = $('#file2').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>user/import_file_sr'

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
                    $('#modal-upload-bc').modal("hide");
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



    function cancel_scrap(nomor_tiket) {

        // var url_ajax = '<?= base_url() ?>user/cancel_scrap'

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
                    url: '<?= base_url() ?>user/cancel_scrap',
                    data: {
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
</script>