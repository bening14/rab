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
            <h4 style="text-decoration: underline;">CATATAN</h4>
            <p>! Input uraian pekerjaan yang jelas beserta satuannya</p>
            <p>! Setelah input uraian, silahkan isi detail bahan baku atau jasa yang dibutuhkan</p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Pekerjaan</h3>
                        <button class="btn bg-navy pull-right" onclick="tambah_pekerjaan()"><i class="fa fa-plus"></i> Tambah Pekerjaan</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tablePekerjaan" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">NO</th>
                                    <th style="width: 10%">Kode Pekerjaan</th>
                                    <th style="width: 25%">Uraian</th>
                                    <th>Harga Dasar</th>
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
                <h4 class="modal-title">Ubah Pekerjaan</h4><br>
            </div>
            <form id="form_update_pekerjaan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uraian_pekerjaan">Nama Pekerjaan</label>
                        <input type="hidden" class="form-control" id="id_pekerjaan">
                        <input type="text" class="form-control" id="edit_uraian_pekerjaan">
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
                <h4 class="modal-title">TAMBAH PEKERJAAN</h4><br>
            </div>
            <form id="form_tambah_pekerjaan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="uraian_pekerjaan">URAIAN PEKERJAAN</label>
                        <input type="text" class="form-control" id="uraian_pekerjaan">
                        <label style="font-weight: normal; color: blue;">Isi detail pekerjaan yang jelas beserta satuannya, misal : Plester Dinding 1 M3</label>
                    </div>
                    <div class="form-group">
                        <label for="kab_kota">AREA/WILAYAH</label>
                        <select name="kab_kota" id="kab_kota" class="form-control">
                            <?php
                            foreach ($kab_kota as $key => $value) {
                                echo '<option value=' . $value["id"] . '>' . $value["kab_kota"] . '</option>';
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
        $("#tablePekerjaan").DataTable({
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
                'url': '<?= base_url('user/ajax_table_pekerjaan') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data.kode_pekerjaan",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.uraian_pekerjaan",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.harga_dasar",
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
                    return `<button class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>&nbsp;<button class="btn btn-sm btn-warning" onclick="ubah_data('` + data.id + `','` + data.uraian_pekerjaan + `')"><i class="fa fa-edit"></i> Ubah</button>&nbsp;<a href="<?= base_url('user/pekerjaan_detail?kode_pekerjaan=') ?>${data.kode_pekerjaan}&uraian=${data.uraian_pekerjaan}&id=${data.id}" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>`
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })

    });

    function reload_table() {
        $('#tablePekerjaan').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit").hide()
        $("#btn-process").show()
    }

    function default_submit() {
        $("#btn-submit").show()
        $("#btn-process").hide()
    }

    function ubah_data(id, item) {

        $('#modal-ubah-data').modal('show')

        $('#id_pekerjaan').val(id)
        $('#edit_uraian_pekerjaan').val(item)
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
                        table: 'tbl_pekerjaan_header',
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

    $("#form_update_pekerjaan").submit(function(e) {
        e.preventDefault()

        if ($('#id_pekerjaan').val() == '' || $('#edit_uraian_pekerjaan').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/ubah'
        var id = $('#id_pekerjaan').val();
        var uraian_pekerjaan = $('#edit_uraian_pekerjaan').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_pekerjaan_header');
        form_data.append('id', id);
        form_data.append('uraian_pekerjaan', uraian_pekerjaan);

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
                    $('#edit_uraian_pekerjaan').val('');
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

    function tambah_pekerjaan() {
        $('#modal-tambah-data').modal('show')
    }

    $("#form_tambah_pekerjaan").submit(function(e) {
        e.preventDefault()

        if ($('#uraian_pekerjaan').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_pekerjaan'

        var kab_kota = $('#kab_kota').val();
        var item = $('#uraian_pekerjaan').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_pekerjaan_header');
        form_data.append('kab_kota', kab_kota);
        form_data.append('uraian_pekerjaan', item);

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
                    $('#uraian_pekerjaan').val('');
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