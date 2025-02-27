<!-- Content Wrapper. Contains page content -->
<!-- Main content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Klasifikasi Status
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <a href="<?= base_url('user') ?>" type="button" class="btn bg-green btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
        <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Simple</li>
        </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Apa itu status dalam pengajuan scrap ?</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Uraian Proses Kerja</th>
                                <th style="width: 200px;">Progress</th>
                                <th style="width: 40px;">Persen</th>
                                <th style="width: 120px;">Status</th>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Section sudah melakukan upload list scrap dan sudah mendapatkan nomor tiket</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 10%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-red">10%</span></td>
                                <td><span class="badge bg-red">LIST SCRAP</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Pengajuan menunggu antrian pencarian dokumen, karena EXIM masih mencari dokumen untuk tiket lain.</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 10%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-red">10%</span></td>
                                <td><span class="badge bg-red">MENUNGGU ANTRIAN DOC ASAL</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>EXIM memulai proses pencarian dokumen asal berdasarkan list scrap yang di register</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 20%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-maroon">20%</span></td>
                                <td><span class="badge bg-maroon">CARI DOKUMEN ASAL</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Pencarian dokumen asal telah <strong>selesai</strong> dilakukan, mungkin ada beberapa dokumen asal yang tidak ditemukan</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-purple">30%</span></td>
                                <td><span class="badge bg-purple">SELESAI DOKUMEN ASAL</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Pencarian dokumen asal telah <strong>selesai</strong> dilakukan, mungkin ada beberapa dokumen asal yang tidak ditemukan</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-maroon">30%</span></td>
                                <td><span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Dilakukan klasifikasi atas barang yang akan discrap apakah mengandung B3 atau tidak mengandung B3 (NONB3)</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 30%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-maroon">40%</span></td>
                                <td><span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Section memberikan HARDCOPY Scrap Requisition (SR), Invoice / PO yang sudah di Marking kepada EXIM (Bu Fita)</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 40%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-navy">40%</span></td>
                                <td><span class="badge bg-navy">SCRAP REQUISITION</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Jika barang yang di ajukan scrap berusia <strong>kurang dari sampai dengan 4 tahun</strong>, maka akan di ajukan proses perusakan oleh EXIM ke Bea Cukai, terkecuali Raw Material dan Finish Good berapapun usianya <strong>WAJIB</strong> melalui proses perusakan<br><br><strong>NOTE :</strong> Untuk barang yang sulit untuk dirusak, harap mengajukan scrap menunggu umur barang lebih dari 4 tahun</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-orange">50%</span></td>
                                <td><span class="badge bg-orange">PENGAJUAN PERUSAKAN</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Bea Cukai telah merespon Pengajuan Perusakan dengan SKEP PERSETUJUAN PERUSAKAN</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 60%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-gray">60%</span></td>
                                <td><span class="badge bg-gray">SKEP PERUSAKAN</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Proses perusakan dilakukan dengan dihadiri oleh pihak EXIM-GA-FA dan diawasi oleh pihak Bea Cukai</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-maroon">70%</span></td>
                                <td><span class="badge bg-maroon">PERUSAKAN</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Proses timbang barang dilakukan bersamaan dengan proses perusakan (Jika diperlukan) atau tanpa proses perusakan oleh PGA & dilakukan input berat kotor & input jenis packing </td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 70%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-maroon">70%</span></td>
                                <td><span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>FA membuat invoice berdasarkan data timbang berat barang yang telah dirusak</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 80%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-magenta">80%</span></td>
                                <td><span class="badge bg-gold">PROSES INVOICE FA</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>EXIM Proses pembuatan dokumen BC. 25 atau BC. 41</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-teal">90%</span></td>
                                <td><span class="badge bg-teal">PROSES BC.25/41</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Tempat scrap overload belum bisa proses timbang</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-teal">90%</span></td>
                                <td><span class="badge bg-teal">AREA TPS OVERLOAD</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Proses scrap telah selesai dilaksanakan</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-green">100%</span></td>
                                <td><span class="badge bg-green">SELESAI/CLOSED</span></td>
                            </tr>
                            <tr>
                                <td>#</td>
                                <td>Proses scrap ditolak oleh EXIM</td>
                                <td>
                                    <div class="progress progress-xs progress-striped active">
                                        <div class="progress-bar progress-bar-success" style="width: 100%"></div>
                                    </div>
                                </td>
                                <td><span class="badge bg-red">100%</span></td>
                                <td><span class="badge bg-red">REJECT</span></td>
                            </tr>
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
<!-- /.content -->

<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Scrap</h4><br>
                <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-block btn-success">Download Template Form Pengajuan Scrap</a>
            </div>
            <form id="form_upload_excel" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile">Pilih File (Xlsx)</label>
                        <input type="file" name="file_excel" id="file_excel" required="">
                        <!-- <p class="help-block">Example block-level help text here.</p> -->
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
                'url': '<?= base_url('user/ajax_table_scrap') ?>',
                'type': 'post',
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.tiket_no",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.status_dokumen",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.date_created",
            }, {
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return `<div class="d-flex justify-content-center">
                        
                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" onclick="cancel_scrap('${data.tiket_no}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Scrap"><i class="fa fa-trash"></i></button>
                        <button type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" onclick="detail_data('${data.tiket_no}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-edit"></i></button>
                        
                    </div>
                    `
                }
            }, ],
            "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
            fnDrawCallback: function(oSettings) {
                $('[data-bs-toggle="tooltip"]').tooltip()

            },
        })

        $(".toolbar").html(`
            <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Register Scrap</button>&nbsp;
            <button class="btn bg-purple"><i class="fa fa-cloud-download"></i> Download Form Scrap Requisition</button>
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



    $("#form_upload_excel").submit(function(e) {
        e.preventDefault()
        if ($('#file_excel').val() == "") {
            toast_confirm('error', "File Upload tidak boleh kosong!")
            return
        }

        process_submit()
        var url_ajax = '<?= base_url() ?>user/import_excel'

        var file_data = $('#file_excel').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file_excel', file_data);

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