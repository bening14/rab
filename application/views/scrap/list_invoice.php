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
                <a href="<?= base_url('user') ?>" class="btn bg-navy"><i class="fa fa-home"></i> Dashboard</a>&nbsp;
                <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
                <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a>
                <a href="<?= base_url('user/listapproval') ?>" class="btn bg-navy"><i class="fa fa-pencil-square-o"></i> Pengajuan Scrap NO BC</a>

                <?php
                if ($this->session->userdata['section'] == 'FATP') {
                ?>
                    <a href="<?= base_url('user') ?>" type="button" class="btn bg-red pull-right"><i class="fa fa-arrow-circle-left"></i> &nbsp;Kembali</a>&nbsp;
                <?php
                }
                ?>
            </div>


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">List Invoice <strong>SCRAP</strong></h3>
                        <button class="btn btn-lg bg-navy pull-right" onclick="generate_inv()"><i class="fa fa-google-wallet"></i> Create</button>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableScrap" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR INVOICE</th>
                                    <th>GENERATE DATE</th>
                                    <th>KATEGORI</th>
                                    <th>TIKET</th>
                                    <th>TIPE</th>
                                    <th>DESKRIPSI</th>
                                    <th>REASON<br>(IF CANCEL)</th>
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

<div class="modal fade" id="modal-generate-invoice">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CREATE INVOICE</h4><br>
                <!-- <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! Pilih TIKET scrap untuk generate invoice</p>
                </div> -->
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nomor_invoice">PILIH TIPE</label>
                    <div class="form-group" style="border-bottom : 1px solid #e5e5e5;">
                        <div class="radio">
                            <label>
                                <input type="radio" name="tipe" id="tipe1" value="PROFORMA" checked="">
                                PROFORMA
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="tipe" id="tipe2" value="INVOICE">
                                INVOICE
                            </label>
                        </div>
                    </div>
                    <!-- <label for="nomor_invoice"># Masukan NOMOR INVOICE</label>
                        <input type="text" class="form-control" id="nomor_invoice" onkeyup="this.value = this.value.toUpperCase()"> -->
                </div>
                <div class="form-group">
                    <label for="nomor_invoice">PILIH TANGGAL</label>
                    <div class="form-group" style="border-bottom : 1px solid #e5e5e5;margin-bottom: 40px;">
                        <input type="date" class="form-control" id="tanggal_invoice" value="<?= date('Y-m-d') ?>">
                    </div>
                    <!-- <label for="nomor_invoice"># Masukan NOMOR INVOICE</label>
                        <input type="text" class="form-control" id="nomor_invoice" onkeyup="this.value = this.value.toUpperCase()"> -->
                </div>
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
                <button type="button" id="btn-generate-invoice" class="btn btn-primary" onclick="open_generate()"><i class="fa fa-google-wallet"></i> Generate</button>
                <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-update-tipe">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">UPDATE PROFORMA TO INVOICE</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nomor_invoice">INPUT TANGGAL</label>
                    <div class="form-group" style="border-bottom : 1px solid #e5e5e5;margin-bottom: 40px;">
                        <input type="date" class="form-control" id="tanggal_invoice_update" value="<?= date('Y-m-d') ?>">
                    </div>
                    <input type="hidden" class="form-control" id="nomor_inv" onkeyup="this.value = this.value.toUpperCase()">
                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="btn-generate-invoice" class="btn btn-primary" onclick="update_tipe_action()"><i class="fa fa-save"></i> Update</button>
                <button type="button" id="btn-process-invoice" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
            </div>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-cancel-inv">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CANCEL INVOICE</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nomor_invoice">REASON CANCEL</label>
                    <div class="form-group" style="border-bottom : 1px solid #e5e5e5;margin-bottom: 40px;">
                        <input type="text" class="form-control" id="remark_inv">
                    </div>
                    <input type="hidden" class="form-control" id="nomor_inv_cancel" onkeyup="this.value = this.value.toUpperCase()">
                </div>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" id="btn-generate-invoice" class="btn btn-primary" onclick="update_cancel()"><i class="fa fa-save"></i> Confirm</button>
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
                'url': '<?= base_url('user/ajax_table_invoice') ?>',
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
                    if (data.status_inv == 'AKTIF') {
                        return data.nomor_invoice + `<br><span class="label label-success">` + data.status_inv + `</span>`
                    } else {
                        return data.nomor_invoice + `<br><span class="label label-danger">` + data.status_inv + `</span>`
                    }
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    if (data.kategori == 'NON B3') {
                        return `<i class="fa fa-circle-o text-light-blue"></i> NON B3`
                    } else {
                        return `<i class="fa fa-circle-o text-red"></i> B3`
                    }
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data.jml_tiket",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.tipe == 'PROFORMA') {
                        return `<span class="label label-warning">PROFORMA</span>`
                    } else {
                        return `<span class="label label-success">INVOICE</span>`
                    }
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {

                    return `<label>
                                <input type="radio" name="deskripsi${data.id}" onchange="change_deskripsi('WASTE', '${data.id}')" value="WASTE" ${data.deskripsi == "WASTE"? "checked" : ""}>
                                WASTE
                            </label>
                            <br>
                            <label>
                                <input type="radio" name="deskripsi${data.id}" onchange="change_deskripsi('BROKEN', '${data.id}')" value="BROKEN" ${data.deskripsi == "BROKEN"? "checked" : ""}>
                                BROKEN
                            </label>`
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.reason_inv",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-left py-1',
                "data": "data",
                "render": function(data) {
                    if (data.status_inv == 'AKTIF') {
                        if (data.tipe == 'PROFORMA') {
                            return `<a href="<?= base_url('user/listinvoicedetail?nomor_invoice=') ?>` + data.nomor_invoice + `" target="_blank" type="button" class="btn btn-primary btn-xs"><i class="fa fa-info-circle"></i> Detail</a>&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick=cancel_inv("` + data.nomor_invoice + `")><i class="fa fa-ban"></i> Cancel</button>&nbsp;<button type="button" class="btn btn-success btn-xs" onclick=update_tipe("` + data.nomor_invoice + `")><i class="fa fa-clipboard"></i> GenInvoice</button>&nbsp;<a href="<?= base_url('user/invoice?inv=') ?>` + data.nomor_invoice + `" target="_blank" type="button" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Cetak</a>`
                        } else {
                            return `<a href="<?= base_url('user/listinvoicedetail?nomor_invoice=') ?>` + data.nomor_invoice + `" target="_blank" type="button" class="btn btn-primary btn-xs"><i class="fa fa-info-circle"></i> Detail</a>&nbsp;<button type="button" class="btn btn-danger btn-xs" onclick=cancel_inv("` + data.nomor_invoice + `")><i class="fa fa-ban"></i> Cancel</button>&nbsp;<a href="<?= base_url('user/invoice?inv=') ?>` + data.nomor_invoice + `" target="_blank" type="button" class="btn btn-default btn-xs"><i class="fa fa-print"></i> Cetak</a>`
                        }
                    } else {
                        return `<a href="<?= base_url('user/listinvoicedetail?nomor_invoice=') ?>` + data.nomor_invoice + `" target="_blank" type="button" class="btn btn-primary btn-xs"><i class="fa fa-info-circle"></i> Detail</a>`
                    }
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })
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

    function generate_inv(tiket, section) {
        reset_selected_tiket()
        $('#modal-generate-invoice').modal('show')

        $("#tableTiket").DataTable({
            "responsive": true,
            "info": false,
            "lengthChange": true,
            "autoWidth": false,
            'serverSide': true,
            'processing': true,
            'pagingType': 'simple',
            'iDisplayLength': 10,
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
        if ($('#tanggal_invoice').val() == "") return toast("error", "Mohon pastikan tanggal Invoice telah diupdate!")
        if (global_pilih_tiket.length == 0) return toast("error", "Mohon pastikan memilih Tiket untuk pembuatan Invoice!")

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan melakukan generate invoice baru!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Generate!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/create_invoice',
                    data: {
                        tipe: $("input[type='radio'][name='tipe']:checked").val(),
                        data_tiket: global_pilih_tiket,
                        tanggal_invoice: $('#tanggal_invoice').val()
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        toast(result.status, result.message)
                        if (result.status !== "success") return
                        reload_table()
                        $('#modal-generate-invoice').modal('hide')
                    },
                    error: function(err, text, errorThrown) {
                        toast('error', text)
                    }
                })
            }
        })
    }

    function update_tipe(nomor_invoice) {
        $('#modal-update-tipe').modal('show')
        $('#nomor_inv').val(nomor_invoice)
    }

    function update_tipe_action() {
        if ($('#tanggal_invoice_update').val() == "") return toast("error", "Mohon pastikan tanggal Invoice telah diupdate!")

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan melakukan update invoice!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Update!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/update_invoice',
                    data: {
                        tanggal_invoice: $('#tanggal_invoice_update').val(),
                        nomor_invoice: $('#nomor_inv').val()
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        toast(result.status, result.message)
                        if (result.status !== "success") return
                        reload_table()
                        $('#modal-update-tipe').modal('hide')
                    },
                    error: function(err, text, errorThrown) {
                        toast('error', text)
                    }
                })
            }
        })
    }

    if ($("input[name='radio'].radioBtnClass").is(':checked')) {
        var card_type = $("input[type='radio'].radioBtnClass:checked").val();
        alert(card_type);
    }

    function change_deskripsi(data, id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan melakukan update deskripsi invoice!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Update!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/update_deskripsi',
                    data: {
                        data: data,
                        id: id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        toast(result.status, result.message)
                        if (result.status !== "success") return
                        reload_table()
                    },
                    error: function(err, text, errorThrown) {
                        toast('error', text)
                    }
                })
            }
        })
    }

    function cancel_inv(nomor_invoice) {
        $('#modal-cancel-inv').modal('show')
        $('#nomor_inv_cancel').val(nomor_invoice)
    }

    function update_cancel() {
        if ($('#remark_inv').val() == "") return toast("error", "Mohon isi reason cancel invoice!")

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan melakukan cancel invoice!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Cancel!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/update_cancel',
                    data: {
                        reason_inv: $('#remark_inv').val(),
                        nomor_invoice: $('#nomor_inv_cancel').val()
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        toast(result.status, result.message)
                        if (result.status !== "success") return
                        reload_table()
                        $('#modal-cancel-inv').modal('hide')
                    },
                    error: function(err, text, errorThrown) {
                        toast('error', text)
                    }
                })
            }
        })
    }
</script>