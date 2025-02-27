<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-md-6">
                <a href="<?= base_url('user/status') ?>" type="button" class="btn bg-navy btn-lg"><i class="fa fa-book"></i> Apa itu status ?</a>
            </div>
            <div class="col-md-5" style="text-align: right;">
                <button type="button" class="btn bg-orange btn-lg" id="btn-update"><i class="fa fa-refresh"></i> Get Jumlah</button>
            </div>
            <div class="col-md-1">
                <input type="text" id="info-jumlah" placeholder="-" style="width: 65px;height: 50px;font-size: 32px;text-align: center;">
            </div>
        </div>

    </section>
    <section class="content-header">

        <div class="callout callout-success">
            <h2><strong>MOHON PERHATIAN</strong></h2>

            <p style="font-size: 32px">Satu baris <strong>WAJIB</strong> hanya untuk satu seri barang, kolom NO SERI DOC BC tidak boleh lebih dari satu data (Tidak boleh: 1,2,3 dst atau 5-12)</p>
            <!-- <p>! </p> -->
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Detail Scrap <strong><?= $_GET['tiket'] ?></strong></h3>

                        </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="tableScrap" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>PHOTO</th>
                                    <th>KODE BARANG</th>
                                    <th>YBM CODE</th>
                                    <th>NAMA BARANG</th>
                                    <?php
                                    if ($this->session->userdata('section') != 'PGA-ADM' && $this->session->userdata('section') != 'FATP') {
                                        echo '<th>NOMOR SERI DOC BC</th>';
                                    }
                                    if ($this->session->userdata('section') == 'EXIM') {
                                        echo '<th>KLASIFIKASI HARGA</th>';
                                    }
                                    ?>
                                    <th>SUPPLIER</th>

                                    <th>DATE INV PO</th>
                                    <th>QTY</th>
                                    <th>UOM</th>
                                    <th>WEIGHT<br>(KG)</th>
                                    <th>REASON</th>
                                    <th>STATUS DOKUMEN</th>
                                    <?php
                                    if ($this->session->userdata('section') != 'PGA-ADM') {
                                        echo '<th>KLASIFIKASI B3</th>';
                                    }
                                    echo '<th>INVOICE PO</th>';

                                    if ($this->session->userdata('section') != 'PGA-ADM') {
                                        echo '<th>NOMOR AJU ASAL</th>';
                                        echo '<th>JENIS DOK ASAL</th>';
                                        echo '<th>NOMOR DAFTAR</th>';
                                        echo '<th>TANGGAL DAFTAR</th>';
                                    } else {
                                        echo '<th>KLASIFIKASI B3</th>'; // INI TEMPORARY SAMPAI IJIN LIMBAH B3 SELESAI DIPERPANJANG
                                        echo '<th>KLASIFIKASI HARGA</th>';
                                    }

                                    if ($this->session->userdata('section') == 'EXIM') {
                                        echo '<th>HSCODE DOC ASAL</th>';
                                        echo '<th>BM ASAL<br>(%)</th>';
                                        echo '<th>PPN ASAL<br>(%)</th>';
                                        echo '<th>PPH ASAL<br>(%)</th>';
                                    }


                                    if ($this->session->userdata('section') != 'PGA-ADM' && $this->session->userdata('section') != 'FATP') {
                                    ?>
                                        <th>AKSI</th>
                                    <?php
                                    }
                                    ?>

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
<div class="modal fade" id="modal-status">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Histori Status Pengajuan Scrap</h4><br>

            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="tableDoc" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>STATUS</th>
                                    <th>WAKTU UPDATE</th>
                                </tr>
                            </thead>
                            <tbody id="tampil_status">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modal-list">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Status Scrap</h4><br>

            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id_scrap_2">
                    <input type="hidden" class="form-control" id="tiket">
                    <input type="hidden" class="form-control" id="kode_barang_e">
                    <input type="hidden" class="form-control" id="nama_barang_e">
                    <input type="hidden" class="form-control" id="invoice_po_e">
                    <input type="hidden" class="form-control" id="section_e">
                    <div class="row">
                        <div class="col-md-10">
                            <select name="status_scrap" id="status_scrap" class="form-control" onchange="reject_action()">
                                <!-- <option value="LIST SCRAP">LIST SCRAP - Section Start Upload Data</option> -->
                                <option value="CARI DOKUMEN ASAL">CARI DOKUMEN ASAL - Dilakukan Pencarian Dok</option>
                                <option value="DOKUMEN ASAL TIDAK DITEMUKAN">DOKUMEN ASAL TIDAK DITEMUKAN - Dok Asal Tidak Ditemukan</option>
                                <option value="SELESAI DOKUMEN ASAL">SELESAI DOKUMEN ASAL - Dok Asal Ditemukan</option>
                                <option value="KLASIFIKASI B3 OLEH PGA">KLASIFIKASI B3 OLEH PGA - Dilakukan klasifikasi B3 atau NON B3</option>
                                <option value="SCRAP REQUISITION">SCRAP REQUISITION - Section Sudah Menyerahkan Pengajuan Scrap ke EXIM</option>
                                <option value="PENGAJUAN PERUSAKAN">PENGAJUAN PERUSAKAN - EXIM Mengajukan Perusakan ke Bea Cukai</option>
                                <option value="SKEP PERUSAKAN">SKEP PERUSAKAN - Persetujuan Dari Bea Cukai</option>
                                <option value="PERUSAKAN">PERUSAKAN - Dilakukan Proses Perusakan</option>
                                <option value="PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING - Dilakukan Proses Penimbangan & Input berat TOTAL & input jenis packing oleh PGA</option>
                                <option value="PROSES INVOICE FA">PROSES INVOICE FA - Dibuatkan Invoice Scrap</option>
                                <option value="PROSES BC.25/41">PROSES BC.25/41 - Pembuatan Dokumen BC Keluar JAI</option>
                                <!-- <option value="AREA TPS OVERLOAD">AREA TPS OVERLOAD - Tempat scrap overload belum bisa proses timbang</option> -->
                                <option value="SELESAI">SELESAI</option>
                                <option value="REJECT">REJECT</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info" id="btn_update_status"><i class="fa fa-cloud-upload"></i> Submit</button>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: none;" id="text_reject_reason">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" id="reject_reason" placeholder="Isikan dengan alasan kenapa di reject">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modal-dokumen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cari Dokumen Asal</h4><br>

            </div>
            <!-- <form id="form_upload_photo" method="post" enctype="multipart/form-data"> -->
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id_scrap">
                    <div class="row">
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="doc_scrap" id="doc_scrap" placeholder="Ketik Nomor Invoice atau PO disini..">
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info" id="btn_search_doc"><i class="fa fa-search"></i> Search</button>
                            <button type="button" class="btn btn-danger" id="btn_search_proses" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Proses</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table id="tableDoc" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>INVOICE</th>
                                    <th>NOMOR AJU</th>
                                    <th>JENIS DOC</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody id="tampil_cari">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- </form> -->
        </div>

    </div>

</div>

<div class="modal fade" id="modal-default">
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

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-body-gambar" style="display: flex; width: 100%; justify-content:center">
                    <img src="<?= base_url('assets/photo_scrap/') ?>" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
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
                    <p>! Upload dokumen manifest B3. <br>! Tujuannya untuk digunakan oleh departement mengajukan PR biaya pengelolaan limbah</p>
                </div>
            </div>
            <form id="form_upload_pdf_b3" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_b3">
                        <label for="file"># Pilih File Manifest B3 (PDF)</label>
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

<!-- <div class="modal fade" id="modal-default-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Barang</h4><br>
            </div>
            <form id="form_insert_data" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kode_barang" class="col-sm-3 control-label">Kode Barang</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kode_barang" onkeyup="this.value = this.value.toUpperCase()">
                                <input type="hidden" class="form-control" id="status_dokumen" value="LIST SCRAP">
                                <input type="hidden" class="form-control" id="tiket">
                                <input type="hidden" class="form-control" id="jenis">
                                <input type="hidden" class="form-control" id="kategori">
                                <input type="hidden" class="form-control" id="batch">
                                <input type="hidden" class="form-control" id="section">
                                <input type="hidden" class="form-control" id="asal">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ybm_code" class="col-sm-3 control-label">YBM Code</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ybm_code" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_barang" class="col-sm-3 control-label">Nama Barang</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_barang" onkeyup="this.value = this.value.toUpperCase()">
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="invoice_po" class="col-sm-3 control-label">Invoice / PO</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="invoice_po" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="supplier" class="col-sm-3 control-label">Supplier</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="supplier" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-3 control-label">Quantity</label>

                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="qty">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uom" class="col-sm-3 control-label">UOM</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="uom" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="weight" class="col-sm-3 control-label">Weight</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="weight">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_inv_po" class="col-sm-3 control-label">Date Invoice / PO</label>

                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="date_inv_po">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason" class="col-sm-3 control-label">Reason</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="reason" onkeyup="this.value = this.value.toUpperCase()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="file_photo" class="col-sm-3 control-label">Photo Barang</label>
                            <div class="col-sm-9">
                                <input type="file" id="file_photo">
                                <p class="help-block">Upload Photo barang.</p>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
            </form>
        </div>

    </div>

</div> -->


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
                    <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
                    <button type="submit" id="btn-submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Submit</button>
                    <!-- <button type="button" id="btn-process" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button> -->
                </div>
            </form>
        </div>

    </div>

</div>

</div>



<!-- page script -->
<script>
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
    var jumlah_data = 0

    $(function() {

        if (user == 'EXIM') {
            $("#tableScrap").DataTable({
                "responsive": true,
                "iDisplayLength": 100,
                "lengthChange": false,
                "autoWidth": false,
                'serverSide': true,
                'processing': true,
                "order": [
                    [0, "desc"]
                ],

                'ajax': {
                    'dataType': 'json',
                    'url': '<?= base_url('user/ajax_table_scrap_detail') ?>',
                    'type': 'post',
                    'data': {
                        'tiket': '<?= $_GET["tiket"] ?>'
                    },
                },
                "createdRow": function(row, data, dataIndex) {
                    // $("#info-jumlah").val(jumlah_data + 1)
                    jumlah_data++
                },
                'columns': [{
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.no",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.photo != '') {
                                return `<img src="<?= base_url('assets/photo_scrap/') ?>${data.photo}" class="" alt="Scrap Image" style="max-width:100px;"><br>
                        <button type="button" class="btn btn-primary btn-xs" onclick="detil_data('` + data.photo + `','` + data.kode_barang + `')"><i class="fa fa-eye"></i> Detail</button><br>
                        <button type="button" class="btn btn-danger btn-xs" onclick="remove_data('` + data.id + `')"><i class="fa fa-trash"></i> Remove</button>`
                            } else {
                                return `<button type="button" class="btn bg-black btn-xs" onclick="upload_photo(${data.id})"><i class="fa fa-picture-o"></i> Upload Photo</button>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.kode_barang",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.ybm_code",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nama_barang",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="nomor_seri" id="nomor_seri${data.id}" placeholder="NOMOR SERI" style="width: 100px;" value="${data.nomor_seri}" onfocusout="update_kolom('${data.id}','nomor_seri','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return data.kategori_harga + `<br><button class="btn btn-sm btn-danger waves-effect waves-float waves-light ms-3px" onclick="reset_harga('` + data.id + `')"><i class="fa fa-refresh"></i> Reset</button>`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.supplier",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.date_inv_po",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.qty",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.uom",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.weight",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.reason",
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (user == 'EXIM') {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                            } else {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-left py-1',
                        // "data": "data.file_bc",
                        "data": "data",
                        "render": function(data) {

                            if (data.b3 == '') {
                                var button_doc = `<span class="badge btn-warning">BELUM DIPUTUSKAN</span>`
                            } else {
                                if (data.b3 == 'b3') {
                                    var button_doc = `<span class="badge bg-red text-uppercase">` + data.b3 + `</span><br>
                                    <button class="pull-left" onclick="reset_b3('` + data.id + `')"><i class="fa fa-refresh"></i> Reset</button><hr>`

                                    if (data.file_manifest == '') {
                                        button_doc += `<ul style="padding-left: 20px;">
                                            <li>Dokumen Manifest<br><span class="badge btn-red">PGA BELUM UPLOAD</span></li>
                                    </ul>`
                                    } else {
                                        button_doc += `
                                    <ul style="padding-left: 20px;">
                                            <li>Dokumen manifest<br><a href="<?= base_url('user/dunlud_b3/') ?>` + data.file_manifest + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`

                                    }

                                } else {
                                    var button_doc = `<span class="badge bg-info text-uppercase">` + data.b3 + `</span><br>
                                    <button class="pull-left" onclick="reset_b3('` + data.id + `')"><i class="fa fa-refresh"></i> Reset</button>`
                                }
                            }



                            return button_doc
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            var html = data.invoice_po
                            // var html = `<input type="text" class="form-control" style="width: 500px;" name="invoice_po" id="invoice_po${data.id}" placeholder="INVOICE PO" style="width: 100px;" value="${data.invoice_po}" onfocusout="update_kolom('${data.id}','invoice_po','${data.tiket_no}')">`
                            if (user == 'EXIM') {
                                if (data.file_location == '') {
                                    html += '<br><button type="button" class="btn btn-primary btn-xs" onclick="cari_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-search"></i> Cari Doc Asal</button>'
                                } else {
                                    html += '<br style="margin-bottom: 8px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32"></a><br style="margin-bottom: 15px;"><button type="button" class="btn btn-danger btn-xs" onclick="hapus_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-trash"></i> Hapus Doc Asal</button>'
                                }
                            } else if (user != 'EXIM') {
                                if (data.file_location != '') {
                                    html += '<br style="margin-bottom: 8px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32">Download</a>'
                                }
                            }
                            return html
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nomor_aju",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.jenis_doc",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.nomor_daftar",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="nomor_daftar" id="nomor_daftar${data.id}" placeholder="NOMOR DAFTAR" style="width: 100px;" value="${data.nomor_daftar}" onfocusout="update_kolom('${data.id}','nomor_daftar','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.tanggal_daftar",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="date" class="form-control" name="tanggal_daftar" id="tanggal_daftar${data.id}" placeholder="TANGGAL DAFTAR" style="width: 150px;" value="${data.tanggal_daftar}" onfocusout="update_kolom('${data.id}','tanggal_daftar','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="hscode_masuk" id="hscode_masuk${data.id}" placeholder="HSCODE IN" style="width: 100px;" value="${data.hscode_masuk}" onfocusout="update_kolom('${data.id}','hscode_masuk','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="bm_masuk" id="bm_masuk${data.id}" placeholder="BM IN" style="width: 100px;" value="${data.bm_masuk}" onfocusout="update_kolom('${data.id}','bm_masuk','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="ppn_masuk" id="ppn_masuk${data.id}" placeholder="PPN IN" style="width: 100px;" value="${data.ppn_masuk}" onfocusout="update_kolom('${data.id}','ppn_masuk','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="pph_masuk" id="pph_masuk${data.id}" placeholder="PPH IN" style="width: 100px;" value="${data.pph_masuk}" onfocusout="update_kolom('${data.id}','pph_masuk','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.status_dokumen == 'SCRAP REQUISITION' || data.status_dokumen == 'PENGAJUAN PERUSAKAN' || data.status_dokumen == 'SKEP PERUSAKAN' || data.status_dokumen == 'PERUSAKAN' || data.status_dokumen == 'PROSES TIMBANG PGA' || data.status_dokumen == 'PROSES INVOICE FA' || data.status_dokumen == 'PROSES BC.25/41' || data.status_dokumen == 'SELESAI') {
                                return ``
                            } else {
                                return `<div class="d-flex justify-content-center">
                        
                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" onclick="remove_barang('${data.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove Barang"><i class="fa fa-trash"></i> Remove</button>
                    
                        
                    </div>
                    `
                            }
                        }
                    },
                ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()
                    $("#info-jumlah").val(jumlah_data)
                    jumlah_data = 0
                },
            })
        } else if (user == 'FATP') {
            $("#tableScrap").DataTable({
                "responsive": true,
                "iDisplayLength": 100,
                "lengthChange": false,
                "autoWidth": false,
                'serverSide': true,
                'processing': true,
                "order": [
                    [0, "desc"]
                ],

                'ajax': {
                    'dataType': 'json',
                    'url': '<?= base_url('user/ajax_table_scrap_detail') ?>',
                    'type': 'post',
                    'data': {
                        'tiket': '<?= $_GET["tiket"] ?>'
                    },
                },
                "createdRow": function(row, data, dataIndex) {
                    // $("#info-jumlah").val(jumlah_data + 1)
                    jumlah_data++
                },
                'columns': [{
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.no",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.photo != '') {
                                return `<img src="<?= base_url('assets/photo_scrap/') ?>${data.photo}" class="" alt="Scrap Image" style="max-width:100px;"><br>
                        <button type="button" class="btn btn-primary btn-xs" onclick="detil_data('` + data.photo + `','` + data.kode_barang + `')"><i class="fa fa-eye"></i> Detail</button><br>
                        `
                            } else {
                                return `<small class="label label-warning">Belum Upload</small>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.kode_barang",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.ybm_code",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nama_barang",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.supplier",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.date_inv_po",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.qty",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.uom",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.weight",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.reason",
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (user == 'EXIM') {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                            } else {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-left py-1',
                        // "data": "data.file_bc",
                        "data": "data",
                        "render": function(data) {

                            if (data.b3 == '') {
                                // var button_doc = '-'
                                var button_doc = `<span class="badge btn-warning">BELUM DIPUTUSKAN</span>`
                            } else {
                                if (data.b3 == 'b3') {
                                    var button_doc = `<span class="badge bg-red text-uppercase">` + data.b3 + `</span><hr>`

                                    if (data.file_manifest == '') {
                                        button_doc += `<ul style="padding-left: 20px;">
                                            <li>Dokumen Manifest<br>-</li>
                                    </ul>`
                                    } else {
                                        button_doc += `
                                    <ul style="padding-left: 20px;">
                                            <li>Dokumen manifest<br><a href="<?= base_url('user/dunlud_b3/') ?>` + data.file_manifest + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`

                                    }

                                } else {
                                    var button_doc = `<span class="badge bg-info text-uppercase">` + data.b3 + `</span>`
                                }
                            }



                            return button_doc
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            var html = data.invoice_po

                            if (user == 'EXIM') {
                                if (data.file_location == '') {
                                    html += '<br><button type="button" class="btn btn-primary btn-xs" onclick="cari_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-search"></i> Cari Doc Asal</button>'
                                } else {
                                    html += '<br style="margin-bottom: 8px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32"></a><br style="margin-bottom: 15px;"><button type="button" class="btn btn-danger btn-xs" onclick="hapus_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-trash"></i> Hapus Doc Asal</button>'
                                }
                            } else if (user != 'EXIM') {
                                if (data.file_location != '') {
                                    html += '<br style="margin-bottom: 8px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32">Download</a>'
                                }
                            }
                            return html
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nomor_aju",
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.jenis_doc",
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nomor_daftar",
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.tanggal_daftar",
                    },
                ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()
                    $("#info-jumlah").val(jumlah_data)
                    jumlah_data = 0
                },
            })
        } else if (user == 'PGA-ADM') {
            $("#tableScrap").DataTable({
                "responsive": true,
                "iDisplayLength": 100,
                "lengthChange": false,
                "autoWidth": false,
                'serverSide': true,
                'processing': true,
                "order": [
                    [0, "desc"]
                ],

                'ajax': {
                    'dataType': 'json',
                    'url': '<?= base_url('user/ajax_table_scrap_detail') ?>',
                    'type': 'post',
                    'data': {
                        'tiket': '<?= $_GET["tiket"] ?>'
                    },
                },
                "createdRow": function(row, data, dataIndex) {
                    // $("#info-jumlah").val(jumlah_data + 1)
                    jumlah_data++
                },
                'columns': [{
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.no",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.photo != '') {
                                return `<img src="<?= base_url('assets/photo_scrap/') ?>${data.photo}" class="" alt="Scrap Image" style="max-width:100px;"><br>
                        <button type="button" class="btn btn-primary btn-xs" onclick="detil_data('` + data.photo + `','` + data.kode_barang + `')"><i class="fa fa-eye"></i> Detail</button><br>
                        <button type="button" class="btn btn-danger btn-xs" onclick="remove_data('` + data.id + `')"><i class="fa fa-trash"></i> Remove</button>`
                            } else {
                                return `<button type="button" class="btn bg-black btn-xs" onclick="upload_photo(${data.id})"><i class="fa fa-picture-o"></i> Upload Photo</button>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.kode_barang",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.ybm_code",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nama_barang",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.supplier",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.date_inv_po",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.qty",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.uom",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.weight",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.reason",
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (user == 'EXIM') {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                            } else {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            var html = data.invoice_po

                            if (user == 'EXIM') {
                                if (data.file_location == '') {
                                    html += '<br><button type="button" class="btn btn-primary btn-xs" onclick="cari_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-search"></i> Cari Doc Asal</button>'
                                } else {
                                    html += '<br style="margin-bottom: 8px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32"></a><br style="margin-bottom: 15px;"><button type="button" class="btn btn-danger btn-xs" onclick="hapus_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-trash"></i> Hapus Doc Asal</button>'
                                }
                            } else if (user != 'EXIM') {
                                if (data.file_location != '') {
                                    html += '<br style="margin-bottom: 8px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32">Download</a>'
                                }
                            }
                            return html
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-left py-1',
                        // "data": "data.file_bc",
                        "data": "data",
                        "render": function(data) {

                            if (data.b3 == '') {
                                // var button_doc = '-'
                                var button_doc = `<button class="btn btn-sm btn-danger waves-effect waves-float waves-light ms-3px" onclick="jenis_b3('b3','` + data.id + `')"><i class="fa fa-thumbs-down"></i> B3</button>&nbsp;<button class="btn btn-sm btn-info waves-effect waves-float waves-light ms-3px" onclick="jenis_b3('NON B3','` + data.id + `')"><i class="fa fa-thumbs-up"></i> NON B3</button>`
                            } else {
                                if (data.b3 == 'b3') {
                                    var button_doc = `<span class="badge bg-red text-uppercase">` + data.b3 + `</span><br><span style="font-style: italic;color: red;">Jika ingin ubah hub.EXIM</span><hr>`
                                    // var button_doc = `<span class="badge bg-red text-uppercase">` + data.b3 + `</span><button class="pull-right" onclick="reset_b3('` + data.id + `')"><i class="fa fa-refresh"></i> Reset</button><hr>`

                                    if (data.file_manifest == '') {
                                        button_doc += `<ul style="padding-left: 20px;">
                                            <li>Dokumen Manifest<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadb3('` + data.id + `')"> Upload</button></li>
                                    </ul>`
                                    } else {
                                        button_doc += `
                                    <ul style="padding-left: 20px;">
                                            <li>Dokumen manifest<br><a href="<?= base_url('user/dunlud_b3/') ?>` + data.file_manifest + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`

                                    }

                                } else {
                                    // var button_doc = `<span class="badge bg-info text-uppercase">` + data.b3 + `</span><br><br><button onclick="reset_b3('` + data.id + `')"><i class="fa fa-refresh"></i> Reset</button>`
                                    var button_doc = `<span class="badge bg-info text-uppercase">` + data.b3 + `</span><br><span style="font-style: italic;color: red;">Jika ingin ubah hub.EXIM</span>`
                                }
                            }
                            return button_doc
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.kategori_harga == '') {
                                return `<select class="form-control" id="data_harga${data.id}" onchange="ubah_kategori('` + data.id + `')">
                                <option value="">--PILIH HARGA--</option>
                                    <?php foreach ($getitem as $key => $value) {
                                        echo '<option value="' . $value["item"] . '">' . $value["item"] . '</option>';
                                    } ?>
                                </select>`
                            } else {
                                return data.kategori_harga + `<br><span style="font-style: italic;color: red;">Jika ingin ubah hub.EXIM</span>`
                                // return data.kategori_harga + `<br><br><button class="btn btn-sm btn-danger waves-effect waves-float waves-light ms-3px" onclick="reset_harga('` + data.id + `')"><i class="fa fa-refresh"></i> Reset</button>`
                            }
                        }
                    },
                ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()
                    $("#info-jumlah").val(jumlah_data)
                    jumlah_data = 0
                },
            })
        } else {
            $("#tableScrap").DataTable({
                "responsive": true,
                "iDisplayLength": 100,
                "lengthChange": false,
                "autoWidth": false,
                'serverSide': true,
                'processing': true,
                "order": [
                    [0, "desc"]
                ],

                'ajax': {
                    'dataType': 'json',
                    'url': '<?= base_url('user/ajax_table_scrap_detail') ?>',
                    'type': 'post',
                    'data': {
                        'tiket': '<?= $_GET["tiket"] ?>'
                    },
                },
                "createdRow": function(row, data, dataIndex) {
                    // $("#info-jumlah").val(jumlah_data + 1)
                    jumlah_data++
                },
                'columns': [{
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.no",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.photo != '') {
                                return `<img src="<?= base_url('assets/photo_scrap/') ?>${data.photo}" class="" alt="Scrap Image" style="max-width:100px;"><br>
                        <button type="button" class="btn btn-primary btn-xs" onclick="detil_data('` + data.photo + `','` + data.kode_barang + `')"><i class="fa fa-eye"></i> Detail</button><br>
                        <button type="button" class="btn btn-danger btn-xs" onclick="remove_data('` + data.id + `')"><i class="fa fa-trash"></i> Remove</button>`
                            } else {
                                return `<button type="button" class="btn bg-black btn-xs" onclick="upload_photo(${data.id})"><i class="fa fa-picture-o"></i> Upload Photo</button>`
                            }
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.kode_barang",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="kode_barang" id="kode_barang${data.id}" placeholder="Kode Barang" style="width: 100px;" value="${data.kode_barang}" onfocusout="update_kolom('${data.id}','kode_barang','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.ybm_code",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="ybm_code" id="ybm_code${data.id}" placeholder="YBM Code" style="width: 100px;" value="${data.ybm_code}" onfocusout="update_kolom('${data.id}','ybm_code','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.nama_barang",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="nama_barang" id="nama_barang${data.id}" placeholder="Nama Barang" style="width: 300px;" value="${data.nama_barang}" onfocusout="update_kolom('${data.id}','nama_barang','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="nomor_seri" id="nomor_seri${data.id}" placeholder="NOMOR SERI" style="width: 100px;" value="${data.nomor_seri}" onfocusout="update_kolom(${data.id},'nomor_seri')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.supplier",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="supplier" id="supplier${data.id}" placeholder="supplier" style="width: 100px;" value="${data.supplier}" onfocusout="update_kolom('${data.id}','supplier','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            // return `<input type="date" class="form-control" name="date_inv_po" id="date_inv_po${data.id}" placeholder="tanggal INV PO" style="width: 150px;" value="${data.date_inv_po}" onfocusout="update_kolom('${data.id}','date_inv_po','${data.tiket_no}')">`
                            return `<input type="text" class="form-control" name="date_inv_po" id="date_inv_po${data.id}" placeholder="TANGGAL INV PO" style="width: 150px;" value="${data.date_inv_po}" onfocusout="update_kolom('${data.id}','date_inv_po','${data.tiket_no}')">`
                        }

                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.qty",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="qty" id="qty${data.id}" placeholder="qty" style="width: 50px;" value="${data.qty}" onfocusout="update_kolom('${data.id}','qty','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.uom",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="uom" id="uom${data.id}" placeholder="uom" style="width: 50px;" value="${data.uom}" onfocusout="update_kolom('${data.id}','uom','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.weight",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="weight" id="weight${data.id}" placeholder="weight" style="width: 50px;" value="${data.weight}" onfocusout="update_kolom('${data.id}','weight','${data.tiket_no}')">`
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        // "data": "data.reason",
                        "data": "data",
                        "render": function(data) {
                            return `<input type="text" class="form-control" name="reason" id="reason${data.id}" placeholder="reason" style="width: 200px;" value="${data.reason}" onfocusout="update_kolom('${data.id}','reason','${data.tiket_no}')">`
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (user == 'EXIM') {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br style="margin-bottom: 20px;"><button type="button" onclick="ganti_status('${data.id}','${data.kode_barang}','${data.nama_barang}','${data.invoice_po}','${data.section}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                            } else {
                                if (data.status_dokumen == 'LIST SCRAP') return `<span class="badge bg-red">LIST SCRAP</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'CARI DOKUMEN ASAL') return `<span class="badge bg-maroon">CARI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI DOKUMEN ASAL') return `<span class="badge bg-purple">SELESAI DOKUMEN ASAL</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'DOKUMEN ASAL TIDAK DITEMUKAN') return `<span class="badge bg-maroon">DOKUMEN ASAL TIDAK DITEMUKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'KLASIFIKASI B3 OLEH PGA') return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SCRAP REQUISITION') return `<span class="badge bg-navy">SCRAP REQUISITION</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PENGAJUAN PERUSAKAN') return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SKEP PERUSAKAN') return `<span class="badge bg-gray">SKEP PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PERUSAKAN') return `<span class="badge bg-maroon">PERUSAKAN</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') return `<span class="badge bg-maroon">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES TIMBANG PGA') return `<span class="badge bg-red">PROSES TIMBANG PGA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES INVOICE FA') return `<span class="badge bg-gold">PROSES INVOICE FA</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'PROSES BC.25/41') return `<span class="badge bg-teal">PROSES BC.25/41</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'SELESAI') return `<span class="badge bg-green">SELESAI</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'REJECT') return `<span class="badge bg-red">REJECT</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                                else if (data.status_dokumen == 'AREA TPS OVERLOAD') return `<span class="badge bg-red">AREA TPS OVERLOAD</span><br style="margin-bottom: 20px;"><button type="button" onclick="histori_status('${data.id}','${data.tiket_no}','${data.date_created}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                            }
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-left py-1',
                        // "data": "data.file_bc",
                        "data": "data",
                        "render": function(data) {

                            if (data.b3 == '') {
                                var button_doc = `<span class="badge btn-warning">BELUM DIPUTUSKAN</span>`
                            } else {
                                if (data.b3 == 'b3') {
                                    var button_doc = `<span class="badge bg-red text-uppercase">` + data.b3 + `</span><hr>`

                                    if (data.file_manifest == '') {
                                        button_doc += `<ul style="padding-left: 20px;">
                                            <li>Dokumen Manifest<br><span class="badge btn-red">PGA BELUM UPLOAD</span></li>
                                    </ul>`
                                    } else {
                                        button_doc += `
                                    <ul style="padding-left: 20px;">
                                            <li>Dokumen manifest<br><a href="<?= base_url('user/dunlud_b3/') ?>` + data.file_manifest + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`

                                    }

                                } else {
                                    var button_doc = `<span class="badge bg-info text-uppercase">` + data.b3 + `</span>`
                                }
                            }



                            return button_doc
                        }
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-left py-1',
                        "data": "data",
                        "render": function(data) {
                            // var html = data.invoice_po
                            var html = `<input type="text" class="form-control" name="invoice_po" id="invoice_po${data.id}" placeholder="invoice_po" style="width: 200px;" value="${data.invoice_po}" onfocusout="update_kolom('${data.id}','invoice_po','${data.tiket_no}')">`
                            if (user == 'EXIM') {
                                if (data.file_location == '') {
                                    html += '<br><button type="button" class="btn btn-primary btn-xs" onclick="cari_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-search"></i> Cari Doc Asal</button>'
                                } else {
                                    html += '<br style="margin-bottom: 18px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32"></a><br style="margin-bottom: 15px;"><button type="button" class="btn btn-danger btn-xs" onclick="hapus_doc(`' + data.id + '`,`' + data.invoice_po + '`)"><i class="fa fa-trash"></i> Hapus Doc Asal</button>'
                                }
                            } else if (user != 'EXIM') {
                                if (data.file_location != '') {
                                    html += '<br style="margin-bottom: 18px;"><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>' + data.file_location + '"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32">Download Dok BC</a>'
                                }
                            }
                            return html
                        }
                    },
                    {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nomor_aju",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.jenis_doc",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.nomor_daftar",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data.tanggal_daftar",
                    }, {
                        "target": [<?= $target ?>],
                        "className": 'text-center py-1',
                        "data": "data",
                        "render": function(data) {
                            if (data.status_dokumen == 'SCRAP REQUISITION' || data.status_dokumen == 'PENGAJUAN PERUSAKAN' || data.status_dokumen == 'SKEP PERUSAKAN' || data.status_dokumen == 'PERUSAKAN' || data.status_dokumen == 'PROSES TIMBANG PGA' || data.status_dokumen == 'PROSES INVOICE FA' || data.status_dokumen == 'PROSES BC.25/41' || data.status_dokumen == 'SELESAI') {
                                return ``
                            } else {
                                return `<div class="d-flex justify-content-center">
                        
                        <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" onclick="remove_barang('${data.id}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove Barang"><i class="fa fa-trash"></i> Remove</button>
                    
                        
                    </div>
                    `
                            }
                        }
                    },
                ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()
                    $("#info-jumlah").val(jumlah_data)
                    jumlah_data = 0

                },
            })
        }

        if (user == 'EXIM') {
            $(".toolbar").html(`
        <button type="button" class="btn bg-red" onclick="tutup_tab()"><i class="fa fa-times"></i> Tutup</button>
        <button type="button" class="btn bg-purple" id="all_search" onclick="search_all('<?= $_GET['tiket'] ?>')"><i class="fa fa-search"></i> Cari Dokumen All</button>
        <button type="button" class="btn bg-purple" id="all_proses" style="display: none;"><i class="fa fa-spinner fa-spin"></i> Proses pencarian dokumen by sistem</button>
        `)
        } else {
            $(".toolbar").html(`
        <button type="button" class="btn bg-red" onclick="tutup_tab()"><i class="fa fa-times"></i> Tutup</button>
        <a href="<?= base_url('user/downloadsruser?tiket=' . $_GET["tiket"]) ?>" type="button" class="btn bg-green"><i class="fa fa-file-excel-o"></i> Download Excel</a>
        `)
        }
        // <button type="button" class="btn bg-purple" onclick="tambah_barang_manual()"><i class="fa fa-plus"></i> Tambah Barang</button>


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

    $('#btn-update').on('click', function() {
        console.log("<?= $_GET['tiket'] ?>")

        $.ajax({
            url: '<?= base_url() ?>user/get_calculate',
            data: {
                tiket: '<?= $_GET['tiket'] ?>'
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    $('#info-jumlah').val(result.jumlah)
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    });

    function upload_photo(id) {
        $('#modal-default').modal('show')
        $('#id_list_scrap').val(id)
    }

    function detil_data(photo, kode_barang) {
        var html
        var nama
        $('#exampleModalCenter').modal('show')
        nama = '<h5 class="modal-title" id="exampleModalLongTitle">' + kode_barang + '</h5>'
        html = '<img src="<?= base_url('assets/photo_scrap/') ?>' + photo + '" class="img-responsive" alt="detil_barang">'
        $('.modal-body-gambar').html(html)
        $('.modal-title').html(nama)
    }

    function cari_doc(id, inv) {
        $('#modal-dokumen').modal('show')
        $('#id_scrap').val(id)
        $('#doc_scrap').val(inv)
        clear_modal()
    }

    function ganti_status(id, kode_barang, nama_barang, invoice_po, section) {
        // alert(id, kode_barang, nama_barang, invoice_po, section)

        $('#modal-list').modal('show')
        $('#id_scrap_2').val(id)
        $('#tiket').val('<?= $_GET['tiket'] ?>')
        $('#kode_barang_e').val(kode_barang)
        $('#nama_barang_e').val(nama_barang)
        $('#invoice_po_e').val(invoice_po)
        $('#section_e').val(section)
    }

    function histori_status(id, tiket, date_created) {
        $('#modal-status').modal('show')

        var html = ""

        $.ajax({
            url: '<?= base_url() ?>user/get_status',
            data: {
                id_list_scrap: id,
                tiket: tiket
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                var no = 1
                html += `<tr>
                            <td>${no++}</td>
                            <td>LIST SCRAP</td>
                            <td>${date_created}</td>
                            <td>-</td>
                        </tr>`
                result.forEach(d => {
                    html += `<tr>
                                <td>${no++}</td>
                                <td>${d.status_dokumen}</td>
                                <td>${d.time_change}</td>
                                <td>${d.reject}</td>
                            </tr>`
                })
                $('#tampil_status').html(html)
            }
        })

    }

    function update_kolom(id, kolom, tiket) {
        var t = '#' + kolom + id
        //note : biar simple, bawa identifikasi id melalui function data
        $.ajax({
            url: '<?= base_url() ?>user/update_kolom',
            data: {
                id: id,
                nilai: $(t).val(),
                kolom: kolom,
                tiket: tiket
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == 'success') {
                    toast('success', result.message)
                } else {
                    toast('error', result.message)
                }
                // reload_table()
            }
        })
    }

    function submit() {
        $('#btn_search_doc').hide()
        $('#btn_search_proses').show()
    }

    function selesai() {
        $('#btn_search_doc').show()
        $('#btn_search_proses').hide()
    }

    function clear_modal() {
        var html = `<td colspan="5" style="text-align: center;"></td>`
        $('#tampil_cari').html(html)
    }

    function modal_proses() {
        var html = `<td colspan="5" style="text-align: center;">... PROSES ...</td>`
        $('#tampil_cari').html(html)
    }

    function modal_notfound() {
        var html = `<td colspan="5" style="text-align: center;">... DOKUMEN ASAL TIDAK DITEMUKAN ...</td>`
        $('#tampil_cari').html(html)
    }

    $('#btn_search_doc').on('click', function() {
        submit()
        modal_proses()

        var html

        $.ajax({
            url: '<?= base_url() ?>user/get_dokumen',
            data: {
                inv_po: $("#doc_scrap").val()
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == 'ada') {
                    var no = 1
                    result.data.forEach(d => {
                        var data_invoice = d.invoice.split(",")
                        var html_invoice = ``
                        data_invoice.forEach(e => {
                            html_invoice += `${e}<br>`
                        });
                        html += `<tr>
                        <td>${no++}</td>
                        <td>${html_invoice}</td>
                        <td>${d.nomor} <br><a href="<?= base_url('user/dunlud_pdf?file_path=') ?>${d.location_file}"><img src='<?= base_url('assets/adminlte/dist/img/pdf.png') ?>' alt='pdf' width='32' height='32'></a></td>
                        <td>${d.jenis}</td>
                        <td><button type="button" class="btn btn-sm btn-flat btn-danger" onclick="aksi_pilih('` + d.id + `','` + d.nomor + `','` + d.jenis + `','` + d.location_file + `')"> Pilih</button></td>
                    </tr>`
                        $('#tampil_cari').html(html)

                    });
                    selesai()
                } else {
                    selesai()
                    modal_notfound()
                }
            }
        })
    });

    $('#btn_update_status').on('click', function() {
        var html

        $.ajax({
            url: '<?= base_url() ?>user/update_status',
            data: {
                id: $("#id_scrap_2").val(),
                status_dokumen: $("#status_scrap").val(),
                tiket: $("#tiket").val(),
                reject: $("#reject_reason").val(),
                kode_barang: $("#kode_barang_e").val(),
                nama_barang: $("#nama_barang_e").val(),
                invoice_po: $("#invoice_po_e").val(),
                section: $("#section_e").val(),
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $('#modal-list').modal('hide')

                if (result.status == "success") {
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    });

    function search_all(tiket) {
        $('#all_search').hide()
        $('#all_proses').show()
        $.ajax({
            url: '<?= base_url() ?>user/get_dokumen_all',
            data: {
                tiket: tiket
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                console.log('selesai')
                $('#all_search').show()
                $('#all_proses').hide()
                reload_table()

            }
        })
    }

    function aksi_pilih(id, nomor, jenis, location_file) {
        $.ajax({
            url: '<?= base_url() ?>user/insert_dokumen',
            data: {
                id_arsip: id,
                id: $("#id_scrap").val(),
                nomor_aju: nomor,
                jenis_doc: jenis
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {

                $('#modal-dokumen').modal('hide')

                if (result.status == "success") {
                    reload_table()
                    // console.log('OK')
                } else
                    toast('error', result.message)
            }
        })
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
                        table: 'list_scrap'
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

    function remove_barang(id) {
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
                    url: '<?= base_url() ?>user/remove_barang',
                    data: {
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

    function hapus_doc(id, invoice_po) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan diminta untuk melakukan pencarian dokumen lagi!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/hapus_doc',
                    data: {
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
        form_data.append('table', 'list_scrap');
        form_data.append('id_list_scrap', $("#id_list_scrap").val());
        form_data.append('jenis', 'detail');

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
                    $('#modal-default').modal("hide");
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

    $("#form_insert_data").submit(function(e) {
        e.preventDefault()

        if ($('#file_photo').val() == '' || $('#kode_barang').val() == '' || $('#nama_barang').val() == '' || $('#invoice_po').val() == '' || $('#supplier').val() == '' || $('#qty').val() == '' || $('#uom').val() == '' || $('#weight').val() == '' || $('#date_inv_po').val() == '' || $('#reason').val() == '') {
            Swal.fire(
                'error!',
                'tidak boleh ada kolom kosong!',
                'error'
            )
            return
        }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/tambah_data_barang'

        var file_data = $('#file_photo').prop('files')[0];
        var kode_barang = $('#kode_barang').val();
        var status_dokumen = $('#status_dokumen').val();
        var tiket_no = $('#tiket').val();
        var jenis = $('#jenis').val();
        var kategori = $('#kategori').val();
        var batch = $('#batch').val();
        var section = $('#section').val();
        var asal = $('#asal').val();
        var ybm_code = $('#ybm_code').val();
        var nama_barang = $('#nama_barang').val();
        var invoice_po = $('#invoice_po').val();
        var supplier = $('#supplier').val();
        var qty = $('#qty').val();
        var uom = $('#uom').val();
        var weight = $('#weight').val();
        var date_inv_po = $('#date_inv_po').val();
        var reason = $('#reason').val();
        var form_data = new FormData();
        form_data.append('table', 'list_scrap');
        form_data.append('file', file_data);
        form_data.append('kode_barang', kode_barang);
        form_data.append('status_dokumen', status_dokumen);
        form_data.append('tiket_no', tiket_no);
        form_data.append('jenis', jenis);
        form_data.append('kategori', kategori);
        form_data.append('batch', batch);
        form_data.append('section', section);
        form_data.append('asal', asal);
        form_data.append('ybm_code', ybm_code);
        form_data.append('nama_barang', nama_barang);
        form_data.append('invoice_po', invoice_po);
        form_data.append('supplier', supplier);
        form_data.append('qty', qty);
        form_data.append('uom', uom);
        form_data.append('weight', weight);
        form_data.append('date_inv_po', date_inv_po);
        form_data.append('reason', reason);

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
                    $('#modal-default-tambah').modal("hide");
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

    function tambah_barang_manual() {

        $.ajax({
            url: '<?= base_url() ?>user/get_detail_tiket',
            data: {
                tiket: '<?= $_GET['tiket'] ?>'
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result) {
                    $('#tiket').val('<?= $_GET['tiket'] ?>')
                    $('#jenis').val(result.jenis)
                    $('#kategori').val(result.kategori)
                    $('#batch').val(result.batch)
                    $('#section').val(result.section)
                    $('#asal').val(result.asal)

                } else
                    toast('error', 'Gagal ambil data')
            }
        })

        $('#modal-default-tambah').modal('show')
        // nama = '<h5 class="modal-title" id="exampleModalLongTitle">' + kode_barang + '</h5>'
        // html = '<img src="<?= base_url('assets/photo_scrap/') ?>' + photo + '" class="img-responsive" alt="detil_barang">'
        // $('.modal-body').html(html)
        // $('.modal-title').html(nama)
    }

    function reject_action() {
        if ($('#status_scrap').val() == 'REJECT') {
            $('#text_reject_reason').show()
        } else {
            $('#text_reject_reason').hide()
            $('#reject_reason').val('')
        }
    }

    function uploadb3(no) {
        $('#modal-upload-b3').modal('show')
        $('#id_b3').val(no)
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
        form_data.append('table', 'list_scrap');
        form_data.append('nomor_tiket', $("#id_b3").val());
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

    function jenis_b3(jenis, id) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Kategori = " + jenis.toUpperCase(),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/kategori_b3',
                    data: {
                        table: 'list_scrap',
                        id: id,
                        jenis: jenis
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Berhasil menentukan kategori B3!",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })

    }

    function tutup_tab() {
        window.close()
    }

    function ubah_kategori(id) {
        var kategori = $(`#data_harga${id}`).val()
        // alert(kategori)

        $.ajax({
            url: '<?= base_url() ?>user/ubah_kategori',
            data: {
                id: id,
                table: 'list_scrap',
                item: kategori
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Berhasil klasifikasikan harga!",
                        showConfirmButton: false,
                        timer: 1000
                    });
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    }

    function reset_harga(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Setelah reset Anda akan diminta mengkategorikan kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, reset saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/reset_harga',
                    data: {
                        id: id,
                        table: 'list_scrap'
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Data berhasil di reset!",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })
    }

    function reset_b3(id) {
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Setelah reset Anda akan diminta mengkategorikan kembali!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, reset saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/reset_b3',
                    data: {
                        id: id,
                        table: 'list_scrap'
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Data berhasil di reset!",
                                showConfirmButton: false,
                                timer: 1000
                            });
                            reload_table()
                        } else
                            toast('error', result.message)
                    }
                })
            }
        })
    }
</script>