<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="callout callout-success">
            <h4 style="text-decoration: underline;">CATATAN</h4>
            <p>! Input harga berdasarkan standard harga perusahaan</p>
            <p>! Review harga selalu dilakukan setiap 3 bulan sekali</p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Harga Jasa</h3>
                        <button class="btn bg-navy pull-right" onclick="tambah_harga()"><i class="fa fa-plus"></i> Tambah Harga</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableHarga" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">NO</th>
                                    <th style="width: 40%">Nama Jasa</th>
                                    <th>Area/Wilayah</th>
                                    <th>Harga</th>
                                    <th>Register Date</th>
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


<div class="modal fade" id="modal-ubah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Ubah Harga</h4><br>
            </div>
            <form id="form_update_harga" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="hidden" class="form-control" id="id_harga">
                        <input type="text" class="form-control" id="edit_harga" onkeyup="this.value = this.value.toUpperCase()">
                        <label style="font-weight: normal; color: blue;">Hapus dulu, isikan dengan angka saja, contoh 5000</label>
                    </div>
                    <div class="form-group">
                        <label for="edit_kab_kota">AREA/WILAYAH</label>
                        <input type="text" class="form-control" id="edit_kab_kota" readonly>
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
                <h4 class="modal-title">TAMBAH HARGA</h4><br>
            </div>
            <form id="form_tambah_harga" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_mst_jasa">NAMA JASA</label>
                        <select name="id_mst_jasa" id="id_mst_jasa" class="form-control">
                            <?php
                            foreach ($jasa as $key1 => $value1) {
                                echo '<option value=' . $value1['id'] . '>' . $value1['nama_jasa'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="harga">HARGA</label>
                        <input type="text" class="form-control" id="harga">
                        <label style="font-weight: normal; color: blue;">Isikan dengan angka saja, contoh 5000</label>
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
        $("#tableHarga").DataTable({
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
                'url': '<?= base_url('user/ajax_table_harga_jasa') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return data.nama_jasa + `<br><h5 style="padding-top:0px;margin-top:0px;font-weight:bold;">` + data.kode_jasa + `</h5>`
                }
                // "data": "data.nama_jasa",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.kab_kota",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.harga",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return `<button class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>&nbsp;<button class="btn btn-sm btn-warning" onclick="ubah_data('` + data.id + `','` + data.kab_kota + `','` + data.harga + `')"><i class="fa fa-edit"></i> Ubah</button>`
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })

    });

    function reload_table() {
        $('#tableHarga').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit").hide()
        $("#btn-process").show()
    }

    function default_submit() {
        $("#btn-submit").show()
        $("#btn-process").hide()
    }

    function ubah_data(id, item, harga) {

        $('#modal-ubah-data').modal('show')

        $('#id_harga').val(id)
        $('#edit_harga').val(harga)
        $('#edit_kab_kota').val(item)
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
                        table: 'tbl_harga_jasa',
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

    $("#form_update_harga").submit(function(e) {
        e.preventDefault()

        if ($('#id_harga').val() == '' || $('#edit_harga').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/ubah'
        var id = $('#id_harga').val();
        var harga = $('#edit_harga').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_harga_jasa');
        form_data.append('id', id);
        form_data.append('harga', harga);

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
                    $('#edit_harga').val('');
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

    $("#form_tambah_harga").submit(function(e) {
        e.preventDefault()

        if ($('#kode_jasa').val() == '' || $('#harga').val() == '' || $('#kab_kota').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_harga_jasa'

        var id_mst_jasa = $('#id_mst_jasa').val();
        var harga = $('#harga').val();
        var id_mst_lokasi = $('#id_mst_lokasi').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_harga_jasa');
        form_data.append('id_mst_jasa', id_mst_jasa);
        form_data.append('harga', harga);
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
                    $('#harga').val('');
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