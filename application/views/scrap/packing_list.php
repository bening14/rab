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
            <h4>Informasi</h4>
            <p>! Invoice dibuat berdasarkan Tiket dari departement</p>
            <p>! Scrap Reguler atau NON-TIKET belum bisa di create di sistem ini</p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12" style="margin-bottom: 20px;">
                <?php
                if ($this->session->userdata('section') != 'PGA-ADM') {
                ?>
                    <a href="<?= base_url('user') ?>" class="btn bg-navy"><i class="fa fa-home"></i> Dashboard</a>&nbsp;
                    <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
                    <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a>
                <?php
                }
                ?>
                <a href="<?= base_url('user') ?>" class="btn bg-blue"><i class="fa fa-home"></i></a>
                <a href="<?= base_url('user/listapproval') ?>" class="btn bg-navy"><i class="fa fa-pencil-square-o"></i> Pengajuan Scrap NO BC</a>

                <?php
                if ($this->session->userdata['section'] == 'FATP') {
                ?>
                    <a href="<?= base_url('user') ?>" type="button" class="btn bg-red pull-right"><i class="fa fa-arrow-circle-left"></i> &nbsp;Kembali</a>&nbsp;
                <?php
                }
                if ($this->session->userdata['section'] == 'PGA-ADM') {
                ?>
                    <a href="<?= base_url('user/masterharga') ?>" type="button" class="btn bg-green"><i class="fa fa-dollar"></i> Master Harga </a>
                    <a href="<?= base_url('user/packinglist') ?>" type="button" class="btn bg-orange"><i class="fa fa-dropbox"></i> Input Packing </a>
                <?php
                }
                ?>
            </div>


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List PACKING <strong>SCRAP</strong></h3>
                        <button class="btn bg-navy pull-right" onclick="generate_inv()"><i class="fa fa-plus"></i> Tambah Packing</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableScrapB" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 5%">NO</th>
                                    <th style="width: 15%">ID PACKING</th>
                                    <th>TANGGAL REGISTER</th>
                                    <th style="width:20%">AKSI</th>
                                </tr>
                            </thead>
                            <!-- <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TIKET-1001</td>
                                    <td>MTC</td>
                                    <td><button type="button" class="btn btn-danger btn-xs" onclick="remove_data()"><i class="fa fa-trash"></i> Hapus</button>
                                        <a href="<?= base_url('user/invoicedetil') ?>" target="_blank" type="button" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i> Detail</a>
                                        <a href="<?= base_url('user/invoice') ?>" target="_blank" type="button" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Cetak</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>TIKET-1000</td>
                                    <td>MTC</td>
                                    <td>
                                        <a herf="<?= base_url('user/invoicedetil') ?>" target="_blank" type="button" class="btn btn-info btn-xs"><i class="fa fa-info-circle"></i> Detail</a>
                                        <a href="<?= base_url('user/invoice') ?>" target="_blank" type="button" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Cetak</a>
                                    </td>
                                </tr>
                            </tbody> -->
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

<div class="modal fade" id="modal-ubah-data">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">WASTE CRIMPING DIES</h4><br>
            </div>
            <form id="form_update_harga" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomor_invoice">HARGA LAMA</label>
                        <input type="text" class="form-control" id="harga_lama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nomor_invoice">HARGA BARU</label>
                        <input type="hidden" class="form-control" id="id_harga">
                        <input type="text" class="form-control" id="harga">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-generate-invoice" class="btn btn-primary"><i class="fa fa-google-wallet"></i> Generate</button>
                    <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-tambah-data-SAMPLE">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">TAMBAH KOMPONEN</h4><br>
            </div>
            <form id="form_tambah_harga" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomor_invoice">NAMA WASTE</label>
                        <input type="text" class="form-control" id="item_waste" onkeyup="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="nomor_invoice">HARGA</label>
                        <input type="text" class="form-control" id="harga_waste">
                    </div>
                </div>
                <div class=" modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-generate-invoice" class="btn btn-primary"><i class="fa fa-google-wallet"></i> Generate</button>
                    <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-tambah-data">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">INPUT PACKING</h4><br>
                <!-- <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! Pilih TIKET scrap untuk generate invoice</p>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <!-- <label for="nomor_invoice">PILIH TIPE</label> -->
                    <div class="form-group">
                        <label for="nomor_invoice">PILIH PACKING</label>
                        <select class="form-control" id="jenis_packing">
                            <option value="BOX">BOX</option>
                            <option value="SAK">SAK</option>
                            <option value="PLASTIK">PLASTIK</option>
                            <option value="UNPACKAGE">UNPACKAGE</option>
                        </select>
                    </div>
                    <!-- <label for="nomor_invoice"># Masukan NOMOR INVOICE</label>
                        <input type="text" class="form-control" id="nomor_invoice" onkeyup="this.value = this.value.toUpperCase()"> -->
                </div>
                <div class="form-group">
                    <label for="jumlah_packing">JUMLAH PACKING</label>
                    <input type="text" class="form-control" id="jumlah_packing" onkeyup="this.value = this.value.toUpperCase()">
                </div>
                <div class="form-group">
                    <label for="berat_timbang">BERAT TIMBANG (KG)</label>
                    <input type="text" class="form-control" id="berat_timbang" onkeyup="this.value = this.value.toUpperCase()">
                </div>
                <hr>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="nomor_invoice">PILIH TIKET</label>
                            <table id="tableTiket" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NOMOR TIKET</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6" style="padding-left: 50px;">
                            <div style="display: flex; justify-content: space-between;">
                                <label for="nomor_invoice">TIKET TERPILIH</label>
                                <button type="button" class="btn btn-sm bg-blue" onclick="reset_selected_tiket()"><i class="fa fa-refresh"></i> Reset</button>
                            </div>
                            <div class="selected_tiket" style="display: flex; flex-direction: column; gap: 10px;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="btn-generate-invoice" class="btn btn-danger" onclick="open_generate()"><i class="fa fa-save"></i> Simpan</button>
                <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
            </div>
        </div>

    </div>

</div>

<!-- page script -->
<script>
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
    var global_pilih_tiket = []
    $(function() {

        $("#tableScrapB").DataTable({
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
                'url': '<?= base_url('user/ajax_table_packing_header') ?>',
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
                    return `PAK-` + data.no_packing
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-right py-1',
                "data": "data",
                "render": function(data) {
                    return `<a href="<?= base_url('user/packinglistdetail?no_packing=') ?>` + data.no_packing + `" class="btn btn-sm btn-primary"><i class="fa fa-info"></i> Detail</a>&nbsp;<button class="btn btn-sm btn-danger" onclick="delete_data('` + data.id + `')"><i class="fa fa-trash"></i> Hapus</button>`

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
        $('#tableScrapA').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit").hide()
        $("#btn-process").show()
    }

    function default_submit() {
        $("#btn-submit").show()
        $("#btn-process").hide()
    }

    function generate_inv(tiket, section) {
        reset_selected_tiket()
        $('#modal-tambah-data').modal('show')

        $("#tableTiket").DataTable({
            "responsive": true,
            "info": false,
            "lengthChange": true,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            'pagingType': 'simple',
            'iDisplayLength': 3,
            'destroy': true,
            "order": [
                [0, "desc"]
            ],

            'ajax': {
                'dataType': 'json',
                'url': '<?= base_url('user/ajax_table_tiket') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no"
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.nomor_tiket",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    return `<button type="button" class="btn btn-xs btn-success" onclick="pilih_tiket('` + data.nomor_tiket + `')"> Pilih</button>`

                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })
    }

    function reset_selected_tiket() {
        $(".selected_tiket").html('')
        global_pilih_tiket = [];
    }

    function pilih_tiket(tiket) {
        if (!inArray(tiket, global_pilih_tiket)) {
            global_pilih_tiket.push(tiket)
        }
        fetch_tiket()
    }

    function fetch_tiket() {
        $(".selected_tiket").html('')
        global_pilih_tiket.map(d => {
            $(".selected_tiket").append(`<div class="row-tiket-${d}"><span class="badge bg-red">${d}</span> <button type="button" class="btn btn-xs bg-red" onclick="delete_selected_tiket('${d}')"><i class="fa fa-trash"></i></button></div>`)
        })
    }

    function delete_selected_tiket(tiket) {
        index = global_pilih_tiket.indexOf(tiket);
        if (index > -1) { // only splice array when item is found
            global_pilih_tiket.splice(index, 1); // 2nd parameter means remove one item only
            $(`.row-tiket-${tiket}`).remove()
        }
    }

    function reset_selected_tiket() {
        $(".selected_tiket").html('')
        global_pilih_tiket = [];
    }

    function inArray(needle, haystack) {
        var length = haystack.length;
        for (var i = 0; i < length; i++) {
            if (haystack[i] == needle) return true;
        }
        return false;
    }

    function open_generate() {
        if ($('#jenis_packing').val() == "") return toast("error", "Mohon pastikan jenis packing sudah di isi!")
        if ($('#jumlah_packing').val() == "") return toast("error", "Mohon pastikan jumlah packing sudah di isi!")
        if ($('#berat_timbang').val() == "") return toast("error", "Mohon pastikan berat timbang sudah di isi!")
        if (global_pilih_tiket.length == 0) return toast("error", "Mohon pastikan memilih Tiket!")

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Data packing akan disimpan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Simpan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/simpan_timbang',
                    data: {
                        tipe: $("input[type='radio'][name='tipe']:checked").val(),
                        data_tiket: global_pilih_tiket,
                        jenis_packing: $('#jenis_packing').val(),
                        jumlah_packing: $('#jumlah_packing').val(),
                        berat_timbang: $('#berat_timbang').val()
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        toast(result.status, result.message)
                        if (result.status !== "success") return
                        reload_table()
                        $('#modal-tambah-data').modal('hide')
                    },
                    error: function(err, text, errorThrown) {
                        toast('error', text)
                    }
                })
            }
        })
    }








    function ubah_data(id, item, harga) {
        var nama
        $('#modal-ubah-data').modal('show')
        nama = '<h4 class="modal-title">' + item + '</h4>'
        $('.modal-title').html(nama)
        $('#harga_lama').val(harga)
        $('#id_harga').val(id)
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
                    url: '<?= base_url() ?>user/delete_harga',
                    data: {
                        table: 'mst_harga_scrap',
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

    $("#form_update_harga").submit(function(e) {
        e.preventDefault()

        if ($('#id_harga').val() == '' || $('#harga').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/ubah_harga'

        var id = $('#id_harga').val();
        var harga = $('#harga').val();
        var form_data = new FormData();
        form_data.append('table', 'mst_harga_scrap');
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

    function tambah_harga() {
        $('#modal-tambah-data').modal('show')
    }

    $("#form_tambah_harga").submit(function(e) {
        e.preventDefault()

        if ($('#item_waste').val() == '' || $('#harga_waste').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_harga'

        var item = $('#item_waste').val();
        var harga = $('#harga_waste').val();
        var form_data = new FormData();
        form_data.append('table', 'mst_harga_scrap');
        form_data.append('item', item);
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
                    $('#modal-tambah-data').modal("hide");
                    $('#item_waste').val('');
                    $('#harga_waste').val('');
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