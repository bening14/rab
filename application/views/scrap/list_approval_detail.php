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
                <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
                <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a>
                <a href="<?= base_url('user/listapproval') ?>" class="btn bg-navy"><i class="fa fa-pencil-square-o"></i> Pengajuan Scrap NO BC</a>
            </div>


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="d-flex justify-content-center">
                            <h3 class="box-title">Daftar Pengajuan Scrap</h3>
                            <?php
                            if (!isset($st['no_sr'])) {
                            ?>
                                <button type="button" class="btn btn-sm bg-orange pull-right" onclick="createsr()"><i class="fa fa-pencil"></i> Create SR</button>
                                <button type="button" class="btn btn-sm bg-blue pull-right" onclick="modaltambah()"><i class="fa fa-plus"></i> Tambah Barang</button>
                            <?php
                            }
                            ?>
                            <a href="<?= base_url('user/listapproval') ?>" class="btn btn-sm bg-maroon pull-right"><i class="fa fa-arrow-left"></i> Kembali</a>
                        </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableScrap" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA BARANG</th>
                                    <th>NOMOR TIKET</th>
                                    <th>PHOTO</th>
                                    <th>BERAT (KG)</th>
                                    <th>HARGA/KGS</th>
                                    <th>TOTAL AMOUNT</th>
                                    <th>BC</th>
                                    <th>B3</th>
                                    <th>EVIDENCE BC</th>
                                    <th>REMARK PGA</th>
                                    <th>REMARK EXIM</th>
                                    <th>ACTION</th>
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

<div class="modal fade" id="showbarang" tabindex="-1" role="dialog" aria-labelledby="showbarangTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detil Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body-gambar" style="display: flex; width: 100%; justify-content:center">
                    <img src="<?= base_url('assets/nobc/barang/') ?>" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-upload-photo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Photo Barang</h4><br>

            </div>
            <form id="form_upload_photo" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_list_scrap">
                        <label for="file"># Pilih File (PNG, JPG, JPEG)</label>
                        <input type="file" class="custom-file-input" id="file" name="file" data-toggle="custom-file-input">
                        <!-- <label class="custom-file-label" for="file">Pilih Photo Scrap</label> -->
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
                        <input type="hidden" id="id_barang" name="id_barang" class="form-control">
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

</div>

<div class="modal fade" id="modaltambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Barang</h4><br>
            </div>
            <form id="form_insert_data" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="callout callout-info">
                        <h4>Perhatian!</h4>
                        <p>Apabila harga tidak tersedia untuk barang yang akan di scrap, silahkan hubungi PGA!</p>
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_barang" class="col-sm-3 control-label">Nama Barang</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_barang" onkeyup="this.value = this.value.toUpperCase()">
                                <input type="hidden" class="form-control" id="tiket">
                                <input type="hidden" class="form-control" id="section">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="invoice_po" class="col-sm-3 control-label">Invoice/PO</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="invoice_po" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_inv_po" class="col-sm-3 control-label">Tanggal Invoice</label>

                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="date_inv_po">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="harga" class="col-sm-3 control-label">Harga/Kg</label>
                            <div class="col-sm-9">
                                <select name="harga" id="harga" class="form-control">
                                    <?php
                                    foreach ($harga as $key => $value) {
                                    ?>
                                        <option value="<?= $value['harga'] ?>"><?= $value['item'] . ' - ' . $value['harga'] ?></option>
                                    <?php
                                    }
                                    ?>
                                    <!-- <option value="28325">Wire dengan insulation - RP. 28,325</option>
                                    <option value="48000">Wire core - RP. 48,000</option>
                                    <option value="2500">Alumunium wire - RP. 2,500</option>
                                    <option value="100">Insulation - RP. 100</option>
                                    <option value="28000">Battery cable - RP. 28,000</option>
                                    <option value="3100">Besi bekas - RP. 3,100</option>
                                    <option value="1600">Accesoris / plastik - RP. 1,600</option>
                                    <option value="1100">Ducting - RP. 1,100</option>
                                    <option value="500">Kertas scrap - RP. 500</option>
                                    <option value="1200">Sparepart bekas (tercampur kerasan) - RP. 1,200</option>
                                    <option value="2750">Crimping dies - RP. 2,750</option> -->
                                </select>
                            </div>

                            <!-- <div class="col-sm-9">
                                <input type="int" class="form-control" id="harga">
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="weight" class="col-sm-3 control-label">Total (Kg)</label>

                            <div class="col-sm-9">
                                <input type="int" class="form-control" id="weight">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label">Amount (Rp)</label>

                            <div class="col-sm-9">
                                <input type="int" class="form-control" id="amount" readonly>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <label for="uom" class="col-sm-3 control-label">UOM</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uom" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="file_photo" class="col-sm-3 control-label">Photo Barang</label>
                            <div class="col-sm-9">
                                <input type="file" id="file_photo">
                                <p class="help-block">Upload Photo barang.</p>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="remark_user" class="col-sm-3 control-label">Keterangan</label>

                            <div class="col-sm-9">
                                <textarea name="remark_user" id="remark_user" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- /.box-footer -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-upload-b3">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Manifest B3</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! Upload file Manifest B3, Tujuannya sebagai lampiran user ketika mengajukan PR biaya pengelolaan limbah B3.</p>
                </div>
            </div>
            <form id="form_upload_pdf_b3" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="tiket_b3">
                        <label for="fileb3"># Pilih File Manifest (PDF)</label>
                        <input type="file" class="custom-file-input" id="fileb3" name="fileb3" data-toggle="custom-file-input">
                        <!-- <label class="custom-file-label" for="file">Pilih Photo Scrap</label> -->
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

<div class="modal fade" id="modal-upload-evidence">
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
                        <label for="file_evidence"># Pilih File EVIDENCE/BUKTI (PDF)</label>
                        <input type="file" class="custom-file-input" id="file_evidence" name="file_evidence" data-toggle="custom-file-input">
                        <!-- <label class="custom-file-label" for="file">Pilih Photo Scrap</label> -->
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
    let nf = new Intl.NumberFormat('en-US');
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
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
                'url': '<?= base_url('user/ajax_table_pengajuan_detail') ?>',
                'type': 'post',
                'data': {
                    'tiket': '<?= $_GET["tiket"] ?>'
                },
            },
            'columns': [{
                "target": [<?= $target ?>],
                "className": 'text-center py-1',
                "data": "data.no",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.nama_barang",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return `<strong>` + data.nomor_tiket + `</strong><br>` + data.section
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.photo != '') {
                        return `<img src="<?= base_url('assets/nobc/barang/') ?>${data.photo}" class="" alt="Scrap Image" style="max-width:100px;"><br>
                    <button type="button" class="btn btn-primary btn-xs" onclick="detil_data('` + data.photo + `')"><i class="fa fa-eye"></i> Detail</button><br>
                        <button type="button" class="btn btn-danger btn-xs" onclick="remove_data('` + data.id + `')"><i class="fa fa-trash"></i> Remove</button>`
                    } else {
                        return `<button type="button" class="btn bg-black btn-xs" onclick="upload_photo(${data.id})"><i class="fa fa-picture-o"></i> Upload Photo</button>`
                    }
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.weight",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return nf.format(data.harga)
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    return nf.format(data.amount)
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (user == 'EXIM') {
                        if (data.bc == '') {
                            return `<button class="btn btn-sm btn-info" onclick="modalapproval('nobc','` + data.id + `')"><i class="fa fa-thumbs-up"></i> NO BC</button>&nbsp;<button class="btn btn-sm btn-danger" onclick="modalapproval('bc','` + data.id + `')"><i class="fa fa-thumbs-down"></i> BC</button>`
                        } else {
                            if (data.bc == 'NOBC') {
                                return `<small class="label label-info">` + data.bc + `</small>`
                            } else {
                                return `<small class="label label-danger">` + data.bc + `</small>`
                            }
                        }
                    } else {
                        if (data.bc == '') {
                            return `<small class="label label-warning">BELUM DIPUTUSKAN</small>`
                        } else {
                            if (data.bc == 'NOBC') {
                                return `<small class="label label-info">` + data.bc + `</small>`
                            } else {
                                return `<small class="label label-danger">` + data.bc + `</small>`
                            }
                        }
                    }
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (user == 'PGA-ADM') {
                        if (data.b3 == '') {
                            return `<button class="btn btn-sm btn-info" onclick="modalapproval('nonb3','` + data.id + `')"><i class="fa fa-thumbs-up"></i> NO B3</button>&nbsp;<button class="btn btn-sm btn-danger" onclick="modalapproval('b3','` + data.id + `')"><i class="fa fa-thumbs-down"></i> B3</button>`
                        } else {
                            if (data.b3 == 'NON B3') {
                                return `<small class="label label-info">` + data.b3 + `</small>`
                            } else {
                                if (data.file_manifest == '') {
                                    return `<small class="label label-danger">` + data.b3 + `</small><br><br><ul style="padding-left: 20px;">
                                    <li>Dokumen Manifest B3<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadb3('` + data.id + `')"> Upload</button></li>
                                    </ul>`
                                } else {
                                    return `<small class="label label-danger">` + data.b3 + `</small><br><br><ul style="padding-left: 20px;">
                                    <li>Dokumen Manifest B3<br><a href="<?= base_url('user/dunlud_b3/') ?>` + data.file_manifest + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a> <button class="label pull-right bg-red" onclick="hapus_evidence('` + data.id + `','manifest')"><i class="fa fa-trash"></i></button></li>
                                    </ul>`
                                }
                            }
                        }
                    } else {
                        if (data.b3 == '') {
                            return `<small class="label label-warning">BELUM DIPUTUSKAN</small>`
                        } else {
                            if (data.b3 == 'NON B3') {
                                return `<small class="label label-info">` + data.b3 + `</small>`
                            } else {
                                if (data.file_manifest == '') {
                                    return `<small class="label label-danger">` + data.b3 + `</small><br><br>Dokumen Manifest B3<br><small class="label label-warning">BELUM UPLOAD PGA</small>`
                                } else {
                                    return `<small class="label label-danger">` + data.b3 + `</small><br><br>Dokumen Manifest B3<br><a href="<?= base_url('user/dunlud_b3/') ?>` + data.file_manifest + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a>`
                                }
                            }
                        }
                    }
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.evidence_bc == '') {
                        if (user == 'EXIM' || user == 'PGA-ADM') {
                            button_doc = `-`
                        } else {
                            button_doc = `<ul style="padding-left: 20px;">
                                                <li>Dokumen Evidence<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadevidence('` + data.id + `')"> Upload</button></li>
                                        </ul>`
                        }
                    } else {
                        button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen Evidence<br><a href="<?= base_url('user/dunlud_evidence/') ?>` + data.evidence_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a> <button class="label pull-right bg-red" onclick="hapus_evidence('` + data.id + `','jenis')"><i class="fa fa-trash"></i></button></li>
                                    </ul>`
                    }

                    return button_doc
                }
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.remark_pga",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data.remark_exim",
            }, {
                "target": [<?= $target++ ?>],
                "className": 'text-center py-1',
                "data": "data",
                "render": function(data) {
                    if (data.no_sr == '') {
                        return `<button class="btn btn-sm bg-red" onclick="delete_data(` + data.id + `)"> Hapus</button>`
                    } else {
                        return `-`
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
                    url: '<?= base_url() ?>user/hapus_id',
                    data: {
                        table: 'detail_pengajuan',
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

    function detil_data(photo) {
        var html
        $('#showbarang').modal('show')
        html = '<img src="<?= base_url('assets/nobc/barang/') ?>' + photo + '" class="img-responsive" alt="detil_barang">'
        $('.modal-body-gambar').html(html)
    }

    function remove_data(id) {
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
                    url: '<?= base_url() ?>user/remove_data',
                    data: {
                        id: id,
                        table: 'detail_pengajuan'
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
                            jumlah_data = 0
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })
    }

    function upload_photo(id) {
        $('#modal-upload-photo').modal('show')
        $('#id_list_scrap').val(id)
    }

    $("#form_upload_photo").submit(function(e) {
        e.preventDefault()

        if ($('#file').val() == '') {
            Swal.fire(
                'error!',
                'Pilih photo terlebih dahulu!',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'detail_pengajuan');
        form_data.append('id_list_scrap', $("#id_list_scrap").val());
        form_data.append('jenis', 'approval');

        if ($('#file').val() !== "") {
            var file_data = $('#file').prop('files')[0];
            form_data.append('file', file_data);
        }

        var url_ajax = '<?= base_url() ?>user/import_photo'

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
                    $('#modal-upload-photo').modal("hide");
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

    function hapus_evidence(id, jenis) {

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
                    url: '<?= base_url() ?>user/hapus_evidence',
                    data: {
                        id: id,
                        jenis: jenis
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

    function uploadevidence(no) {
        $('#modal-upload-evidence').modal('show')
        $('#no_tiket').val(no)
    }

    $("#form_upload_pdf_evidence").submit(function(e) {
        e.preventDefault()

        if ($('#file_evidence').val() == '') {
            Swal.fire(
                'error!',
                'Pilih file evidence terlebih dahulu!',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'detail_pengajuan');
        form_data.append('nomor_tiket', $("#no_tiket").val());
        form_data.append('jenis', 'evidence');

        if ($('#file_evidence').val() !== "") {
            var file_data = $('#file_evidence').prop('files')[0];
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
                    $('#modal-upload-evidence').modal("hide");
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



    function modalapproval(status, id) {
        $('#modalapproval').modal('show')
        $('#status_approval').val(status)
        $('#id_barang').val(id)
    }

    $("#form_approval").submit(function(e) {
        e.preventDefault()

        if ($('#remark').val() == '') {
            Swal.fire(
                'error!',
                'Isikan Keterangan',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'detail_pengajuan');
        form_data.append('status', $("#status_approval").val());
        form_data.append('remark', $("#remark").val());
        form_data.append('id', $("#id_barang").val());


        var url_ajax = '<?= base_url() ?>user/approval_pengajuan'

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
                    $('#modalapproval').modal("hide");
                    $('#remark').val('')
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

    function modaltambah() {
        $('#modaltambah').modal('show')
        $('#tiket').val(`<?= $_GET['tiket'] ?>`)
        $('#section').val(`<?= $this->session->userdata('section') ?>`)
    }

    $("#form_insert_data").submit(function(e) {
        e.preventDefault()

        if ($('#file_photo').val() == '' || $('#nama_barang').val() == '' || $('#invoice_po').val() == '' || $('#date_inv_po').val() == '' || $('#harga').val() == '' || $('#weight').val() == '' || $('#remark_user').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_data_barang_nobc'

        var file_data = $('#file_photo').prop('files')[0];
        var nomor_tiket = $('#tiket').val();
        var section = $('#section').val();
        var nama_barang = $('#nama_barang').val();
        var invoice_po = $('#invoice_po').val();
        var date_inv_po = $('#date_inv_po').val();
        var harga = $('#harga').val();
        var weight = $('#weight').val();
        var uom = 'KG';
        var amount = $('#amount').val();
        var remark_user = $('#remark_user').val();
        var form_data = new FormData();
        form_data.append('table', 'detail_pengajuan');
        form_data.append('photo', file_data);
        form_data.append('nama_barang', nama_barang);
        form_data.append('invoice_po', invoice_po);
        form_data.append('nomor_tiket', nomor_tiket);
        form_data.append('nama_barang', nama_barang);
        form_data.append('invoice_po', invoice_po);
        form_data.append('date_inv_po', date_inv_po);
        form_data.append('harga', harga);
        form_data.append('weight', weight);
        form_data.append('amount', amount);
        form_data.append('uom', uom);
        form_data.append('section', section);
        form_data.append('remark_user', remark_user);

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
                    $('#modaltambah').modal("hide");
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

    function uploadb3(no) {
        $('#modal-upload-b3').modal('show')
        $('#tiket_b3').val(no)
    }

    $("#form_upload_pdf_b3").submit(function(e) {
        e.preventDefault()

        if ($('#fileb3').val() == '') {
            Swal.fire(
                'error!',
                'Pilih file pdf Manifest B3 terlebih dahulu!',
                'error'
            )
            return
        }



        var form_data = new FormData();
        form_data.append('table', 'detail_pengajuan');
        form_data.append('nomor_tiket', $("#tiket_b3").val());
        form_data.append('jenis', 'b3');

        if ($('#fileb3').val() !== "") {
            var file_data = $('#fileb3').prop('files')[0];
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
                    $('#modal-upload-b3').modal("hide");
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

    function createsr() {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Pastikan data yang akan diajukan sudah benar dan sudah dilakukan cek!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, buat SR!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/generate_sr',
                    data: {
                        nomor_tiket: '<?= $_GET["tiket"] ?>'
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Sukses!',
                                'Berhasil generate SR!',
                                'success'
                            )
                            window.location.href = "<?= base_url('user/listapproval') ?>";
                        } else if (result.status == 'bc') {
                            Swal.fire(
                                'Error!',
                                result.message,
                                'error'
                            )
                        } else {
                            toast('error', result.message)
                        }
                    }
                })
            }
        })
    }

    $('#weight').on('keyup', function() {
        var a = $('#weight').val() * $('#harga').val()

        $('#amount').val(a)
    })
</script>