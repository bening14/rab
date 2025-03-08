<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="callout callout-success">
            <h4 style="text-decoration: underline;">CATATAN</h4>
            <p>! Pastikan Pekerjaan yang akan menjadi bagian RAB sudah dibuat di Master Pekerjaan</p>
            <p>! -</p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><strong>LIST RAB CUSTOMER</strong></h3>
                        <button class="btn bg-navy pull-right" onclick="tambah_harga()"><i class="fa fa-plus"></i> Tambah RAB</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableRab" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">NO</th>
                                    <th style="width: 8%">SO Number</th>
                                    <th style="width: 20%">Customer</th>
                                    <th>Nilai Origin</th>
                                    <th>Nilai Final</th>
                                    <th>Profit</th>
                                    <th>Area/Wilayah</th>
                                    <th>Register Date</th>
                                    <th style="width: 20%">AKSI</th>
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


<div class="modal fade" id="modal-ubah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah RAB</h4><br>
            </div>
            <form id="form_update_rab" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_so_number">SO Number</label>
                        <input type="text" class="form-control" id="edit_so_number" onkeyup="this.value = this.value.toUpperCase()">
                        <input type="hidden" class="form-control" id="id_rab">
                    </div>
                    <div class="form-group">
                        <label for="edit_kegiatan_pekerjaan">Uraian Kegiatan / Kegiatan Pekerjaan</label>
                        <input type="text" class="form-control" id="edit_kegiatan_pekerjaan">
                    </div>
                    <div class="form-group">
                        <label for="edit_luas_area">Luas Area</label>
                        <input type="text" class="form-control" id="edit_luas_area">
                    </div>
                    <div class="form-group">
                        <label for="edit_customer">Customer</label>
                        <input type="text" class="form-control" id="edit_customer" onkeyup="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <input type="text" class="form-control" id="edit_alamat">
                    </div>
                    <div class="form-group">
                        <label for="edit_hp">Nomor HP</label>
                        <input type="text" class="form-control" id="edit_hp">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-generate-invoice" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-tambah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">TAMBAH RAB</h4><br>
            </div>
            <form id="form_tambah_rab" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="so_number">SO Number</label>
                        <input type="text" class="form-control" id="so_number" onkeyup="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="kegiatan_pekerjaan">Uraian Pekerjaan / Kegiatan Pekerjaan</label>
                        <input type="text" class="form-control" id="kegiatan_pekerjaan">
                    </div>
                    <div class="form-group">
                        <label for="luas_area">Luas Area</label>
                        <input type="text" class="form-control" id="luas_area">
                    </div>
                    <div class="form-group">
                        <label for="customer">Customer</label>
                        <input type="text" class="form-control" id="customer" onkeyup="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat">
                    </div>
                    <div class="form-group">
                        <label for="hp">Nomor HP</label>
                        <input type="text" class="form-control" id="hp">
                    </div>
                    <div class="form-group">
                        <label for="id_mst_lokasi">AREA/WILAYAH</label>
                        <select name="id_mst_lokasi" id="id_mst_lokasi" class="form-control">
                            <?php
                            foreach ($kab_kota as $key => $value) {
                                echo '<option value=' . $value['id'] . '>' . $value['kab_kota'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-generate-invoice" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- page script -->
<script>
    <?php $target = 0; ?>
    $(function() {
        $("#tableRab").DataTable({
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
                'url': '<?= base_url('user/ajax_table_rab') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data.so_number",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return `<strong>` + data.customer + `</strong><br>` + data.alamat + `<br>` + data.hp
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.nilai_origin",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.nilai_final",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.profit",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.kab_kota",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return `<a href="<?= base_url('user/print_rab?so_number=') ?>${data.so_number}" target="_blank" type="button" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="RAB"><i class="fa fa-print"></i> RAB</a>&nbsp;<a href="<?= base_url('user/print_rm?so_number=') ?>${data.so_number}" target="_blank" type="button" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="MATERIAL"><i class="fa fa-cart-plus"></i> MATERIAL</a>&nbsp;<button class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>&nbsp;<a href="<?= base_url('user/rab_detail?so_number=') ?>${data.so_number}&customer=${data.customer}&kota=${data.kab_kota}&alamat=${data.alamat}&hp=${data.hp}" type="button" class="btn btn-primary btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>`
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })

    });

    function reload_table() {
        $('#tableRab').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit").hide()
        $("#btn-process").show()
    }

    function default_submit() {
        $("#btn-submit").show()
        $("#btn-process").hide()
    }

    function ubah_data(id) {

        $('#modal-ubah-data').modal('show')

        $('#id_rab').val(id)
    }

    function delete_data(id) {

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
                    url: '<?= base_url() ?>user/delete',
                    data: {
                        table: 'tbl_rab_header',
                        id: id
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

    $("#form_update_rab").submit(function(e) {
        e.preventDefault()

        if ($('#edit_so_number').val() == '' || $('#edit_customer').val() == '' || $('#edit_alamat').val() == '' || $('#edit_hp').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/ubah'
        var id = $('#id_rab').val();
        var so_number = $('#edit_so_number').val();
        var customer = $('#edit_customer').val();
        var alamat = $('#edit_alamat').val();
        var hp = $('#edit_hp').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_rab_header');
        form_data.append('id', id);
        form_data.append('so_number', so_number);
        form_data.append('customer', customer);
        form_data.append('alamat', alamat);
        form_data.append('hp', hp);

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
                    $('#modal-ubah-data').modal("hide");
                    $('#edit_so_number').val('');
                    $('#edit_customer').val('');
                    $('#edit_alamat').val('');
                    $('#edit_hp').val('');
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
                // toast_confirm('error', err.responseText)
            }
        });
    })

    function tambah_harga() {
        $('#modal-tambah-data').modal('show')
    }

    $("#form_tambah_rab").submit(function(e) {
        e.preventDefault()

        if ($('#so_number').val() == '' || $('#kegiatan_pekerjaan').val() == '' || $('#luas_area').val() == '' || $('#customer').val() == '' || $('#alamat').val() == '' || $('#hp').val() == '' || $('#kab_kota').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_hitung_rab'

        var so_number = $('#so_number').val();
        var kegiatan_pekerjaan = $('#kegiatan_pekerjaan').val();
        var luas_area = $('#luas_area').val();
        var customer = $('#customer').val();
        var alamat = $('#alamat').val();
        var hp = $('#hp').val();
        var id_mst_lokasi = $('#id_mst_lokasi').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_rab_header');
        form_data.append('so_number', so_number);
        form_data.append('customer', customer);
        form_data.append('alamat', alamat);
        form_data.append('hp', hp);
        form_data.append('kegiatan_pekerjaan', kegiatan_pekerjaan);
        form_data.append('luas_area', luas_area);
        form_data.append('id_mst_lokasi', id_mst_lokasi);

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
                    $('#modal-tambah-data').modal("hide");
                    $('#so_number').val('');
                    $('#customer').val('');
                    $('#alamat').val('');
                    $('#hp').val('');
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
                // toast_confirm('error', err.responseText)
            }
        });
    })
</script>