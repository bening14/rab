<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">

        <div class="callout callout-success">
            <h4 style="text-decoration: underline;">CATATAN</h4>
            <p>! -</p>
            <p>! -</p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div style="text-align: center;color: white;background-color: orange;"><h2>-- FORM MEMBUAT RAB --</h2></div>
                    <div class="box-header">
                        <h3 class="box-title" style="font-weight: bold;font-size: 28px;"><?= $_GET['so_number'] . ' - <small style="background-color: yellow;font-weight:bold;">' . $kota . '</small>' ?></h3>
                        <h3><?= $customer ?></h3>
                        <h4><?= $alamat.'<br>'.$hp ?></h4>
                        <div id="harga_final">
                            <h4 style="color: red;font-weight: bold;"> <color style="color: black;">Harga Final</color><br><?= $harga_total ?></h4>
                        </div>
                        <button class="btn bg-blue pull-right" onclick="tambah_pekerjaan()"><i class="fa fa-gavel"></i> Tambah Pekerjaan</button>
                        <a href="<?= base_url('user') ?>" class="btn bg-red pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableRabDetail" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">NO</th>
                                    <th style="width: 15%">Pekerjaan</th>
                                    <th>Nilai Origin</th>
                                    <th>QTY</th>
                                    <th>Nilai Konversi</th>
                                    <th>Margin</th>
                                    <th>Faktor Resiko</th>
                                    <th>Nilai Final</th>
                                    <th>Profit</th>
                                    <th>Register Date</th>
                                    <th style="width: 10%">AKSI</th>
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

<div class="modal fade" id="modal-tambah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" style="background-color: blue;color: white;padding: 10px 10px">TAMBAH PEKERJAAN</h4><br>
            </div>
            <form id="form_tambah_pekerjaan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                        <div class="form-group">
                        <label for="barang">PILIH PEKERJAAN</label><br>
                        <select name="pekerjaan-barang" id="pekerjaan-barang" style="width: 100%" class="js-example-basic-multiple">
                            <?php
                            foreach ($detail_pekerjaan as $key => $val) {
                                echo '<option value=' . $val["kode_pekerjaan"] . '>' . $val["uraian_pekerjaan"] . '</option>';
                            }

                            ?>
                            <input type="hidden" value="<?= $_GET['kota'] ?>" class="form-control" id="kab_kota">
                            <input type="hidden" value="<?= $_GET['so_number'] ?>" class="form-control" id="so_number">
                        </select>
                        </div>
                        <div class="form-group" style="margin-top: 10px;">
                            <label for="harga">QTY</label>
                            <input type="text" class="form-control" id="qty">
                            <label style="font-weight: normal; color: blue;">Jika koma maka gunakan titik, ini merupakah Pekerjaan yang dilaksanakan</label>
                        </div>
                        <div class="form-group">
                            <label for="margin_persen">Margin (Persen)</label>
                            <input type="text" class="form-control" id="margin_persen">
                            <label style="font-weight: normal; color: blue;">Jika koma maka gunakan titik, ini merupakah persentase keuntungan yang diinginkan</label>
                        </div>
                        <div class="form-group">
                            <label for="resiko_persen">Faktor Resiko (Persen)</label>
                            <input type="text" class="form-control" id="resiko_persen">
                            <label style="font-weight: normal; color: blue;">Jika koma maka gunakan titik, tidak semua pekerjaan harus memiliki cost faktor resiko</label>
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
        $('#pekerjaan-barang').select2();
        $("#tableRabDetail").DataTable({
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
                'url': '<?= base_url('user/ajax_table_rab_detail') ?>',
                'type': 'post',
                'data': {
                    'so_number': '<?= $_GET["so_number"] ?>'
                },
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
                    return data.uraian_pekerjaan + `<br><h5 style="padding-top:0px;margin-top:0px;font-weight:bold;">` + data.kode_pekerjaan + `</h5>`
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.harga_final",
            },{
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.qty",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.harga_konversi",
            },{
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data",
                "render": function(data) {
                    return data.margin_amount + `<br><h5 style="padding-top:0px;margin-top:0px;font-weight:bold;">` + data.margin_persen + ` %</h5>`
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                 "data": "data",
                "render": function(data) {
                    return data.resiko_amount + `<br><h5 style="padding-top:0px;margin-top:0px;font-weight:bold;">` + data.resiko_persen + ` %</h5>`
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.harga_final",
            },  {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.profit",
            },{
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return `<button class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `','` + data.so_number + `')"><i class="fa fa-trash"></i> Hapus</button>`
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })

    });

    function reload_table() {
        $('#tableRabDetail').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit").hide()
        $("#btn-process").show()
    }

    function default_submit() {
        $("#btn-submit").show()
        $("#btn-process").hide()
    }

    function delete_data(id, so_number) {
        var nama
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
                    url: '<?= base_url() ?>user/delete_detail_rab',
                    data: {
                        table: 'tbl_rab_detail',
                        so_number: so_number,
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
                            nama= '<h4 style="color: red;font-weight: bold;"> <color style="color: black;">Harga Final</color><br>Rp. ' + result.nilai_final + '</h4>'
                            $('#harga_final').html(nama)
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })

    }

    function tambah_pekerjaan() {
        $('#modal-tambah-data').modal('show')
    }

    $("#form_tambah_pekerjaan").submit(function(e) {
        e.preventDefault()

        if ($('#qty').val() == '' || $('#margin_persen').val() == '' || $('#resiko_persen').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_rab_detail'

        var kode_pekerjaan = $('#pekerjaan-barang').val();
        var kab_kota = $('#kab_kota').val();
        var qty = $('#qty').val();
        var margin_persen = $('#margin_persen').val();
        var resiko_persen = $('#resiko_persen').val();
        var so_number = $('#so_number').val();
        var form_data = new FormData();
        form_data.append('table', 'tbl_rab_detail');
        form_data.append('kode_pekerjaan', kode_pekerjaan);
        form_data.append('kab_kota', kab_kota);
        form_data.append('qty', qty);
        form_data.append('margin_persen', margin_persen);
        form_data.append('resiko_persen', resiko_persen);
        form_data.append('so_number', so_number);

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
                    $('#qty').val('');
                    $('#margin_persen').val('');
                    $('#resiko_persen').val('');
                    // close_edit()
                    nama= '<h4 style="color: red;font-weight: bold;"> <color style="color: black;">Harga Final</color><br>Rp. ' + result.nilai_final + '</h4>'
                    $('#harga_final').html(nama)
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