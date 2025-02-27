<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <a href="<?= base_url('user/status') ?>" type="button" class="btn bg-navy btn-lg"><i class="fa fa-book"></i> Apa itu status ?</a>
        <a href="<?= base_url('user/reject') ?>" type="button" class="btn bg-orange btn-lg"><i class="fa fa-clipboard"></i> Histori barang tidak bisa scrap</a>
        <button type="button" class="btn bg-red btn-lg" onclick="changepsw('<?= $this->session->userdata('id') ?>')"><i class="fa fa-key"></i> Ganti Password</button>
        <a href="<?= base_url('tutorial_portal_scrap2.pdf') ?>" target="_blank" type="button" class="btn bg-purple btn-lg pull-right"><i class="fa fa-book"></i> Tutorial</a>

        <!-- <button type="button" class="btn bg-orange btn-lg"><i class="fa fa-map-signs"></i> Posisi scrap saya dimana ?</button> -->

    </section>
    <section class="content-header">

        <div class="callout callout-success">
            <h4><strong>PENTING</strong></h4>
            <p>
            <h2>Ada perubahan template excel untuk upload Form Scrap, silahkan download ulang</h2>
            </p>
        </div>

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-xs-12" style="margin-bottom: 20px;">
                <a href="<?= base_url('user') ?>" class="btn bg-blue"><i class="fa fa-home"></i></a>
                <?php
                if ($this->session->userdata('section') != 'PGA-ADM' && $this->session->userdata('section') != 'MPC' && $this->session->userdata('section') != 'MTC') {
                ?>
                    <button type="button" class="btn bg-navy" data-toggle="modal" data-target="#modal-mau-scrap"><i class="fa fa-plus"></i> Register Scrap </button>&nbsp;
                    <a href="<?= base_url('user/dunlud/ListScrapAsset_new.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Scrap Asset</a>
                    <!-- <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a> -->
                <?php
                }

                if ($this->session->userdata('section') == 'MTC') {
                ?>
                    <button type="button" class="btn bg-navy" data-toggle="modal" data-target="#modal-mau-scrap"><i class="fa fa-plus"></i> Register Scrap </button>&nbsp;
                    <a href="<?= base_url('user/dunlud/ListScrapAsset_new.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Scrap Asset</a>
                    <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Scrap Inventory</a>
                    <!-- <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a> -->
                <?php
                }

                if ($this->session->userdata('section') == 'MPC') {
                ?>
                    <button type="button" class="btn bg-navy" data-toggle="modal" data-target="#modal-mau-scrap"><i class="fa fa-plus"></i> Register Scrap </button>&nbsp;
                    <a href="<?= base_url('user/dunlud/ListScrapAsset_new.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Scrap Asset</a>
                    <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn bg-navy"><i class="fa fa-file-excel-o"></i> Download Template Scrap Raw Material</a>
                    <!-- <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn bg-navy"><i class="fa fa-inbox"></i> Kode Barang Scrap</a> -->
                <?php
                }
                ?>


                <a href="<?= base_url('user/listapproval') ?>" class="btn bg-navy"><i class="fa fa-pencil-square-o"></i> Pengajuan Scrap NO BC</a>
                <?php
                if ($this->session->userdata['section'] == 'EXIM') {
                ?>
                    <button type="button" class="btn bg-red pull-right" data-toggle="modal" data-target="#modal-download-sr"><i class="fa fa-warning"></i> Tampilkan Download SR </button>&nbsp;
                <?php
                }
                if ($this->session->userdata['section'] == 'PGA-ADM' || $this->session->userdata['section'] == 'EXIM') {
                ?>
                    <a href="<?= base_url('user/masterharga') ?>" type="button" class="btn bg-green"><i class="fa fa-dollar"></i> Master Harga </a>
                <?php
                }
                ?>
            </div>

            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div>
                            <h3 class="box-title">Daftar Aktivitas Scrap <strong>BC</strong></h3>
                        </div>

                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="tableScrap" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR TIKET</th>
                                    <th>STATUS</th>
                                    <th>KATEGORI</th>
                                    <!-- <th>KATEGORI B3</th> -->
                                    <th>ASAL</th>
                                    <th>TANGGAL REGISTRASI</th>
                                    <th>SECTION</th>
                                    <th>DOKUMEN</th>
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

<div class="modal fade" id="modal-mau-scrap">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Scrap</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <ul>
                        <li>Silahkan pilih kategori scrap terlebih dahulu </li>
                        <li>Anda harus melakukan identifikasi awal terhadap barang yang akan Anda scrap </li>
                        <li> Barang NO BC pada umumnya adalah barang yang tidak digunakan untuk menunjang proses produksi</li>
                    </ul>
                </div>
            </div>
            <form id="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <h5 style="text-align: center;margin-bottom: 20px;"><strong>-- PILIH KATEGORI --</strong></h5>
                    <div class=" form-group" style="margin-bottom: 60px;">
                        <button type="button" class="btn btn-danger pull-left" style="margin-left: 80px;" id="btn_bc">BARANG BC</button>
                        <a href="<?= base_url('user/listapproval') ?>" type="button" class="btn btn-info pull-right" style="margin-right: 80px;">BARANG NO BC</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-download-sr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tampilkan Tombol Cetak SR</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <ul>
                        <li>Silahkan Pilih Tiket, kemudian klik tombol Show Tombol Cetak SR </li>
                    </ul>
                </div>
            </div>
            <form id="form_update_tiket_cetak" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <h5 style="text-align: center;margin-bottom: 20px;"><strong>-- TIKET --</strong></h5>
                    <div class="form-group">
                        <label># Pilih TIKET</label>
                        <select class="form-control" id="tiket_cetak" name="tiket_cetak">
                            <?php
                            foreach ($tiket as $key) {
                            ?>
                                <option value="<?= $key->nomor_tiket ?>"><?= $key->nomor_tiket ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit-cetak" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="modal-scrap-nobc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Scrap NO BC</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <ul>
                        <li>Upload DRAFT SR barang yang akan di scrap </li>
                        <li>EXIM akan melakukan verifikasi dan approval atas pengajuan </li>
                    </ul>
                </div>
            </div>
            <form id="form_upload_excel_nobc" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputFile"># Pilih File</label>
                        <input type="file" name="file_excel_nobc" id="file_excel_nobc" required="">
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
</div> -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Scrap</h4><br>
                <!-- <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-block btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a> -->
            </div>
            <form id="form_upload_excel" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label># Asal Barang</label>
                        <select class="form-control" id="asal" name="asal">
                            <option value="LOKAL">LOKAL</option>
                            <option value="IMPORT">IMPORT</option>
                            <option value="AFFILIATE">AFFILIATE</option>
                        </select>
                    </div>
                    <div class="form-group" id="jenis_brg">
                        <label># Pilih Jenis</label>
                        <select class="form-control" id="jenis" name="jenis">
                            <?php
                            if ($this->session->userdata('section') == 'PE') {

                                echo '<option value="FABRIKASI">ASSET FABRIKASI</option>';
                                echo '<option value="ASSET NON FABRIKASI">ASSET - NON FABRIKASI</option>';
                            } else if ($this->session->userdata('section') == 'MTC') {

                                echo '<option value="INVENTORY">SPAREPART INVENTORY</option>';
                                echo '<option value="ASSET NON FABRIKASI">ASSET - NON FABRIKASI</option>';
                            } else if ($this->session->userdata('section') == 'EXIM') {

                                echo '<option value="RAW MATERIAL">RAW MATERIAL</option>';
                                echo '<option value="INVENTORY">SPAREPART INVENTORY</option>';
                                echo '<option value="FABRIKASI">ASSET FABRIKASI</option>';
                                echo '<option value="ASSET NON FABRIKASI">ASSET - NON FABRIKASI</option>';
                            } else if ($this->session->userdata('section') == 'MPC') {
                                echo '<option value="RAW MATERIAL">RAW MATERIAL</option>';
                                echo '<option value="ASSET NON FABRIKASI">Asset - NON FABRIKASI</option>';
                            } else {
                                echo '<option value="ASSET NON FABRIKASI">Asset - NON FABRIKASI</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" id="kategori_id">
                        <label># Umur Barang di Perusahaan (Kategori)</label>
                        <select class="form-control" id="kategori" name="kategori">
                            <option value="PERUSAKAN"> Kurang dari atau sama dengan 4 tahun (PERUSAKAN)</option>
                            <option value="TANPA PERUSAKAN"> Lebih dari 4 tahun (TIDAK PERUSAKAN)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile"># Pilih File (Xlsx)</label>
                        <input type="file" name="file_excel" id="file_excel" required="">
                        <!-- <p class="help-block">Example block-level help text here.</p> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" id="btn-submit-upload" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Submit</button>
                    <button type="button" id="btn-process-upload" class="btn btn-danger" style="display: none;"><i class="fa fa-spinner fa-spin"></i><span> Processing...</span></button>
                </div>
            </form>
        </div>

    </div>

</div>

<div class="modal fade" id="modal-upload-sr">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload SR/FWR</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! Upload file SR/FWR yang sudah di approval. <br>! Tujuannya sebagai dokumentasi satu pintu ketika ada Audit akan lebih mudah <br>&nbsp;&nbsp;&nbsp;menunjukan data.</p>
                </div>
            </div>
            <form id="form_upload_pdf_sr" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_list_scrap">
                        <label for="file"># Pilih File SR/FWR (PDF)</label>
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
                        <label for="file"># Pilih File Manifest (PDF)</label>
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

<div class="modal fade" id="modal-upload-bc">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload DOC BC 25/41</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! Upload file BC.25/41. <br>! Tujuannya sebagai dokumentasi satu pintu ketika ada Audit akan lebih mudah <br>&nbsp;&nbsp;&nbsp;menunjukan data.</p>
                </div>
            </div>
            <form id="form_upload_pdf_bc" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="hidden" id="id_list_scrap2">
                        <label for="file"># Pilih File DOC BC 25/41 (PDF)</label>
                        <input type="file" class="custom-file-input" id="file2" name="file2" data-toggle="custom-file-input">
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

<div class="modal fade" id="modalregister">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Register Barang</h4><br>
            </div>
            <form id="form_register" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="callout callout-warning">
                        <h4>Perhatian</h4>
                        <p><i class="fa fa-pencil"></i> Nama barang harus sesuai dengan invoice asal atau dokumen pemasukan asal</p>
                        <p><i class="fa fa-pencil"></i> Setelah sukses mendaftarkan kode barang scrap, bisa langsung melakukan upload pengajuan scrap</p>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="nama_barang" name="nama_barang" class="form-control">
                    </div>
                    <div class="form-group" id="jenis_brg">
                        <label>Unit</label>
                        <select name="unit" id="unit" class="form-control">
                            <option value="PCE">PCE - PIECE</option>
                            <option value="MTR">MTR - METRE</option>
                            <option value="SET">SET - SET</option>
                            <option value="PKG">PKG - PACKAGE</option>
                            <option value="BO">BO - BOTTLE</option>
                            <option value="BX">BX - BOX</option>
                            <option value="CA">CA - CAN</option>
                            <option value="CT">CT - CARTON</option>
                            <option value="E39">E39 - DOTS PER INCH</option>
                            <option value="GN">GN - GROSS GALLON</option>
                            <option value="KGM">KGM - KILOGRAM</option>
                            <option value="LO">LO - UNIT OF PROCUREMENT</option>
                            <option value="LTR">LTR - LITRE (1 DM3)</option>
                            <option value="NIU">NIU - NUMBER OF INTERNATIONAL UNIT</option>
                            <option value="PL">PL - PAIL</option>
                            <option value="NRL">NRL - ROLL</option>
                            <option value="PR">PR - PAIR</option>
                            <option value="PK">PK - PACK</option>
                            <option value="TN">TN - TIN</option>

                        </select>
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
                    <input type="hidden" class="form-control" id="id_scrap_2" readonly>
                    <input type="hidden" class="form-control" id="tiket" readonly>
                    <div class="row">
                        <div class="col-md-10">
                            <select name="status_scrap" id="status_scrap" class="form-control" onchange="reject_action()">
                                <option value="DOKUMEN ASAL TIDAK DITEMUKAN">DOKUMEN ASAL TIDAK DITEMUKAN - Dok Asal Tidak Ditemukan</option>
                                <option value="SELESAI DOKUMEN ASAL">SELESAI DOKUMEN ASAL - Pencarian dokumen telah selesai dilakukan </option>
                                <option value="KLASIFIKASI B3 OLEH PGA">KLASIFIKASI B3 OLEH PGA - Dilakukan klasifikasi B3 atau NON B3</option>
                                <option value="SCRAP REQUISITION">SCRAP REQUISITION - Section Sudah Menyerahkan Pengajuan Scrap ke EXIM</option>
                                <option value="PENGAJUAN PERUSAKAN">PENGAJUAN PERUSAKAN - EXIM Mengajukan Perusakan ke Bea Cukai</option>
                                <option value="SKEP PERUSAKAN">SKEP PERUSAKAN - Persetujuan Dari Bea Cukai</option>
                                <option value="PERUSAKAN">PERUSAKAN - Dilakukan Proses Perusakan</option>
                                <option value="PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING - Dilakukan Proses Penimbangan & Input berat TOTAL & input jenis packing oleh PGA</option>
                                <!-- <option value="PROSES INVOICE FA">PROSES INVOICE FA - Dibuatkan Invoice Scrap</option> -->
                                <option value="PROSES BC.25/41">PROSES BC.25/41 - Pembuatan Dokumen BC Keluar JAI</option>
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

<div class="modal fade" id="modal-list-ga">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Status Scrap</h4><br>

            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id_scrap_2ga">
                    <input type="hidden" class="form-control" id="tiketga">
                    <div class="row">
                        <div class="col-md-10">
                            <select name="status_scrap" id="status_scrapga" class="form-control">
                                <option value="AREA TPS OVERLOAD">AREA TPS OVERLOAD - Tempat scrap overload belum bisa proses timbang</option>
                                <option value="PROSES INVOICE FA">PROSES INVOICE FA - Dibuatkan Invoice Scrap</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info" id="btn_update_status_ga"><i class="fa fa-cloud-upload"></i> Submit</button>
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

<div class="modal fade" id="modal-list-fa">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Status Scrap</h4><br>

            </div>

            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="id_scrap_2fa">
                    <input type="hidden" class="form-control" id="tiketfa">
                    <div class="row">
                        <div class="col-md-10">
                            <select name="status_scrapfa" id="status_scrapfa" class="form-control">
                                <option value="PROSES BC.25/41">PROSES BC.25/41 - Pembuatan Dokumen BC Keluar JAI</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-info" id="btn_update_status_fa"><i class="fa fa-cloud-upload"></i> Submit</button>
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

<div class="modal fade" id="modal-generate-invoice">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Generate Invoice</h4><br>
                <div class="callout callout-success">
                    <h4>Note</h4>
                    <p>! Pilih TIKET scrap untuk generate invoice</p>
                </div>
            </div>
            <form id="form_generate_invoice" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomor_invoice"># TIKET</label>
                        <input type="text" class="form-control" id="tiket_scrap" readonly>
                        <input type="hidden" class="form-control" id="section_scrap" readonly>
                        <!-- <label for="nomor_invoice"># Masukan NOMOR INVOICE</label>
                        <input type="text" class="form-control" id="nomor_invoice" onkeyup="this.value = this.value.toUpperCase()"> -->
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

<div class="modal fade" id="modal_packing">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tentukan Jenis Packing</h4><br>

            </div>
            <form id="form_submit_packing" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="Jenis Packing">JENIS PACKING</label>
                                <select name="jenis_packing" id="jenis_packing" class="form-control">
                                    <option value="BOX">BOX</option>
                                    <option value="SAK">SAK</option>
                                    <option value="PLASTIK">PLASTIK</option>
                                    <option value="UNPACKAGE">UNPACKAGE</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="jumlah_packing">JUMLAH PACKING</label>
                                <input type="hidden" class="form-control" id="tiket_packing">
                                <input type="text" class="form-control" id="jumlah_packing" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>

</div>

<!-- page script -->
<script>
    $('#btn_bc').on('click', function() {
        $('#modal-mau-scrap').modal('hide')
        $('#modal-default').modal('show')
    });

    // $('#btn_nobc').on('click', function() {
    //     $('#modal-mau-scrap').modal('hide')
    //     $('#modal-scrap-nobc').modal('show')
    // });
    <?php $target = 0; ?>
    var user = "<?= $this->session->userdata('section') ?>"
    $(function() {
        //pesan 
        // Swal.fire({
        //     icon: 'info',
        //     title: 'Informasi',
        //     text: 'Untuk Scrap ASSET baik FABRIKASI maupun NON FABRIKASI ada UPDATE form baru, silahkan download terlebih dahulu!',
        // })
        if (user == 'PGA-ADM') {
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
                    "data": "data.nomor_tiket",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (user == 'EXIM') {
                            btn = `<br><button type="button" style="margin-top: 5px;" onclick="histori_status('${data.id}','${data.nomor_tiket}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br><button type="button" style="margin-top: 5px;" onclick="ganti_status('${data.id}','${data.nomor_tiket}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                        } else {
                            btn = `<br><button type="button" style="margin-top: 5px;" onclick="histori_status('${data.id}','${data.nomor_tiket}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br><button type="button" style="margin-top: 5px;" onclick="ganti_status_ga('${data.id}','${data.nomor_tiket}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                        }

                        if (data.status == 'OPEN') {
                            return `<span class="badge bg-red">MENUNGGU ANTRIAN</span>`
                        } else if (data.status == 'PROSES') {
                            return `<span class="badge bg-orange">CARI DOKUMEN ASAL</span>` + btn
                        } else if (data.status == 'DOKUMEN ASAL TIDAK DITEMUKAN') {
                            return `<span class="badge bg-red">DOKUMEN ASAL TIDAK DITEMUKAN</span>` + btn
                        } else if (data.status == 'SELESAI DOKUMEN ASAL') {
                            return `<span class="badge bg-maroon">SELESAI DOKUMEN ASAL</span>` + btn
                        } else if (data.status == 'KLASIFIKASI B3 OLEH PGA') {
                            return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span>` + btn
                        } else if (data.status == 'CLOSED') {
                            return `<span class="badge bg-green">CLOSED</span>` + btn
                        } else if (data.status == 'SCRAP REQUISITION') {
                            return `<span class="badge bg-navy">SCRAP REQUISITION</span>` + btn
                        } else if (data.status == 'PENGAJUAN PERUSAKAN') {
                            return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span>` + btn
                        } else if (data.status == 'SKEP PERUSAKAN') {
                            return `<span class="badge bg-gray">SKEP PERUSAKAN</span>` + btn
                        } else if (data.status == 'PERUSAKAN') {
                            return `<span class="badge bg-maroon">PERUSAKAN</span>` + btn
                        } else if (data.status == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') {
                            return `<span class="badge bg-red">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span>` + btn
                        } else if (data.status == 'PROSES INVOICE FA') {
                            return `<span class="badge bg-gold">PROSES INVOICE FA</span>` + btn
                        } else if (data.status == 'PROSES BC.25/41') {
                            return `<span class="badge bg-teal">PROSES BC.25/41</span>` + btn
                        } else if (data.status == 'AREA TPS OVERLOAD') {
                            return `<span class="badge bg-teal">AREA TPS OVERLOAD</span>` + btn
                        } else if (data.status == 'SELESAI') {
                            return `<span class="badge bg-green">SELESAI</span>` + btn
                        } else if (data.status == 'REJECT') {
                            return `<span class="badge bg-danger">REJECT</span>` + btn
                        }
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<span><strong>` + data.jenis + `</strong></span><br>
                            <span style="font-size: 10px;"><i>` + data.kategori + `</i></span>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.asal",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.date_created",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.section",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    // "data": "data.file_bc",
                    "data": "data",
                    "render": function(data) {
                        if (user == 'EXIM') {
                            if (data.file_sr == '') {
                                button_doc = `<ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadsr('` + data.nomor_tiket + `')"> Upload</button></li>
                                    </ul>`
                            } else {
                                button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            }

                            if (data.file_bc == '') {
                                button_doc += `<ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadbc('` + data.nomor_tiket + `')"> Upload</button></li>
                                    </ul>`
                            } else {
                                button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            }


                        } else if (user == 'FATP') {
                            if (data.file_sr == '') {
                                button_doc = `<ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br>-</li>
                                    </ul>`
                            } else {
                                button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            }

                            if (data.file_bc != '') {
                                button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            } else {
                                button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br>-</li>
                                    </ul>`
                            }


                        } else {
                            if (data.file_sr == '') {
                                button_doc = `<ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadsr('` + data.nomor_tiket + `')"> Upload</button></li>
                                    </ul>`
                            } else {
                                button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            }

                            if (data.file_bc != '') {
                                button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`

                            }


                        }

                        return button_doc
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    "data": "data",
                    "render": function(data) {
                        var html = `<div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" onclick="cancel_scrap('${data.nomor_tiket}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Scrap"><i class="fa fa-trash"></i> Cancel</button>
                                    <a href="<?= base_url('user/detail_scrap?tiket=') ?>${data.nomor_tiket}&jenis=${data.jenis}" target="_blank" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>
                                </div>`

                        // if (data.status == 'CLOSED' || data.status == 'PROSES') {
                        var html_button_invoice = ""
                        var html_button_tpb = ""
                        var html_button_print = ""

                        if (user == 'FATP') {
                            if (data.invoice_flag == "") {
                                html_button_invoice = `<button class="btn bg-maroon btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Proforma B3" onclick="proforma_b3('${data.nomor_tiket}','${data.section}')"><i class="fa fa-file"></i> Proforma B3</button>`
                            } else {
                                html_button_invoice = `<a href="<?= base_url('user/invoice?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice"><i class="fa fa-print"></i> Invoice</a>`
                            }
                        }

                        if (user == 'EXIM') {
                            html_button_tpb = `<a href="<?= base_url('user/downloadsr?tiket=') ?>${data.nomor_tiket}" class="btn btn-success btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Excel"><i class="fa fa-file-excel-o"></i> Excel</a>
                        `
                        }

                        if (user != 'FATP') {
                            if (data.cetak_pdf == "OK") {
                                if (data.jenis == 'ASSET NON FABRIKASI') {
                                    html_button_print = `
                            <a href="<?= base_url('user/fwr?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak FWR"><i class="fa fa-print"></i> FWR</a>
                            <a href="<?= base_url('user/lampiran?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Lampiran"><i class="fa fa-print"></i> Lampiran</a>
                            `
                                } else if (data.jenis == 'ASSET FABRIKASI') {
                                    html_button_print = `
                            <a href="<?= base_url('user/fabrikasi?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                } else {
                                    html_button_print = `
                            <a href="<?= base_url('user/print?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                }
                            }
                        }

                        html = `<div class="d-flex justify-content-center">
                                    ${html_button_print}
                                    ${html_button_invoice}
                                    ${html_button_tpb}
                                    <a href="<?= base_url('user/detail_scrap?tiket=') ?>${data.nomor_tiket}&jenis=${data.jenis}" target="_blank" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>
                                    
                                </div>`
                        // }

                        return html
                    }
                }, ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()

                },
            })
        } else if (user == 'FATP') {
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
                    "data": "data.nomor_tiket",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (user == 'EXIM') {
                            btn = `<br><button type="button" style="margin-top: 5px;" onclick="histori_status('${data.id}','${data.nomor_tiket}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br><button type="button" style="margin-top: 5px;" onclick="ganti_status('${data.id}','${data.nomor_tiket}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                        } else {
                            btn = `<br><button type="button" style="margin-top: 5px;" onclick="histori_status('${data.id}','${data.nomor_tiket}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br><button type="button" style="margin-top: 5px;" onclick="ganti_status_ga('${data.id}','${data.nomor_tiket}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                        }

                        if (data.status == 'OPEN') {
                            return `<span class="badge bg-red">MENUNGGU ANTRIAN</span>`
                        } else if (data.status == 'PROSES') {
                            return `<span class="badge bg-orange">CARI DOKUMEN ASAL</span>` + btn
                        } else if (data.status == 'DOKUMEN ASAL TIDAK DITEMUKAN') {
                            return `<span class="badge bg-red">DOKUMEN ASAL TIDAK DITEMUKAN</span>` + btn
                        } else if (data.status == 'SELESAI DOKUMEN ASAL') {
                            return `<span class="badge bg-maroon">SELESAI DOKUMEN ASAL</span>` + btn
                        } else if (data.status == 'KLASIFIKASI B3 OLEH PGA') {
                            return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span>` + btn
                        } else if (data.status == 'CLOSED') {
                            return `<span class="badge bg-green">CLOSED</span>` + btn
                        } else if (data.status == 'SCRAP REQUISITION') {
                            return `<span class="badge bg-navy">SCRAP REQUISITION</span>` + btn
                        } else if (data.status == 'PENGAJUAN PERUSAKAN') {
                            return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span>` + btn
                        } else if (data.status == 'SKEP PERUSAKAN') {
                            return `<span class="badge bg-gray">SKEP PERUSAKAN</span>` + btn
                        } else if (data.status == 'PERUSAKAN') {
                            return `<span class="badge bg-maroon">PERUSAKAN</span>` + btn
                        } else if (data.status == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') {
                            return `<span class="badge bg-red">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span>` + btn
                        } else if (data.status == 'PROSES INVOICE FA') {
                            return `<span class="badge bg-gold">PROSES INVOICE FA</span>` + btn
                        } else if (data.status == 'PROSES BC.25/41') {
                            return `<span class="badge bg-teal">PROSES BC.25/41</span>` + btn
                        } else if (data.status == 'AREA TPS OVERLOAD') {
                            return `<span class="badge bg-teal">AREA TPS OVERLOAD</span>` + btn
                        } else if (data.status == 'SELESAI') {
                            return `<span class="badge bg-green">SELESAI</span>` + btn
                        } else if (data.status == 'REJECT') {
                            return `<span class="badge bg-danger">REJECT</span>` + btn
                        }
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<span><strong>` + data.jenis + `</strong></span><br>
                            <span style="font-size: 10px;"><i>` + data.kategori + `</i></span>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.asal",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.date_created",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.section",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    // "data": "data.file_bc",
                    "data": "data",
                    "render": function(data) {

                        if (data.file_sr == '') {
                            button_doc = `<ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br>-</li>
                                    </ul>`
                        } else {
                            button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                        }

                        if (data.file_bc != '') {
                            button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                        } else {
                            button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br>-</li>
                                    </ul>`
                        }


                        return button_doc
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    "data": "data",
                    "render": function(data) {
                        var html = `<div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" onclick="cancel_scrap('${data.nomor_tiket}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Scrap"><i class="fa fa-trash"></i> Cancel</button>
                                    <a href="<?= base_url('user/detail_scrap?tiket=') ?>${data.nomor_tiket}&jenis=${data.jenis}" target="_blank" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>
                                </div>`

                        // if (data.status == 'CLOSED' || data.status == 'PROSES') {
                        var html_button_invoice = ""
                        var html_button_tpb = ""
                        var html_button_print = ""



                        if (user == 'EXIM') {
                            html_button_tpb = `<a href="<?= base_url('user/downloadsr?tiket=') ?>${data.nomor_tiket}" class="btn btn-success btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Excel"><i class="fa fa-file-excel-o"></i> Excel</a>
                        `
                        }

                        if (user != 'FATP') {
                            if (data.cetak_pdf == "OK") {
                                if (data.jenis == 'ASSET NON FABRIKASI') {
                                    html_button_print = `
                            <a href="<?= base_url('user/fwr?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak FWR"><i class="fa fa-print"></i> FWR</a>
                            <a href="<?= base_url('user/lampiran?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Lampiran"><i class="fa fa-print"></i> Lampiran</a>
                            `
                                } else if (data.jenis == 'ASSET FABRIKASI') {
                                    html_button_print = `
                            <a href="<?= base_url('user/fabrikasi?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                } else {
                                    html_button_print = `
                            <a href="<?= base_url('user/print?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                }
                            }
                        }

                        html = `<div class="d-flex justify-content-center">
                                    ${html_button_print}
                                    ${html_button_invoice}
                                    ${html_button_tpb}
                                    <a href="<?= base_url('user/detail_scrap?tiket=') ?>${data.nomor_tiket}&jenis=${data.jenis}" target="_blank" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>
                                    
                                </div>`
                        // }

                        return html
                    }
                }, ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()

                },
            })
        } else {
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
                    "data": "data.nomor_tiket",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        if (user == 'EXIM') {
                            btn = `<br><button type="button" style="margin-top: 5px;" onclick="histori_status('${data.id}','${data.nomor_tiket}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button><br><button type="button" style="margin-top: 5px;" onclick="ganti_status('${data.id}','${data.nomor_tiket}')">Ganti Status <i class="fa fa-arrow-circle-right"></i></button>`
                        } else {
                            btn = `<br><button type="button" style="margin-top: 5px;" onclick="histori_status('${data.id}','${data.nomor_tiket}')">Lihat Histori <i class="fa fa-arrow-circle-right"></i></button>`
                        }

                        if (data.status == 'OPEN') {
                            return `<span class="badge bg-red">MENUNGGU ANTRIAN</span>`
                        } else if (data.status == 'PROSES') {
                            return `<span class="badge bg-orange">CARI DOKUMEN ASAL</span>` + btn
                        } else if (data.status == 'DOKUMEN ASAL TIDAK DITEMUKAN') {
                            return `<span class="badge bg-red">DOKUMEN ASAL TIDAK DITEMUKAN</span>` + btn
                        } else if (data.status == 'SELESAI DOKUMEN ASAL') {
                            return `<span class="badge bg-maroon">SELESAI DOKUMEN ASAL</span>` + btn
                        } else if (data.status == 'KLASIFIKASI B3 OLEH PGA') {
                            return `<span class="badge bg-maroon">KLASIFIKASI B3 OLEH PGA</span>` + btn
                        } else if (data.status == 'CLOSED') {
                            return `<span class="badge bg-green">CLOSED</span>` + btn
                        } else if (data.status == 'SCRAP REQUISITION') {
                            return `<span class="badge bg-navy">SCRAP REQUISITION</span>` + btn
                        } else if (data.status == 'PENGAJUAN PERUSAKAN') {
                            return `<span class="badge bg-orange">PENGAJUAN PERUSAKAN</span>` + btn
                        } else if (data.status == 'SKEP PERUSAKAN') {
                            return `<span class="badge bg-gray">SKEP PERUSAKAN</span>` + btn
                        } else if (data.status == 'PERUSAKAN') {
                            return `<span class="badge bg-maroon">PERUSAKAN</span>` + btn
                        } else if (data.status == 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING') {
                            return `<span class="badge bg-red">PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING</span>` + btn
                        } else if (data.status == 'PROSES INVOICE FA') {
                            return `<span class="badge bg-gold">PROSES INVOICE FA</span>` + btn
                        } else if (data.status == 'PROSES BC.25/41') {
                            return `<span class="badge bg-teal">PROSES BC.25/41</span>` + btn
                        } else if (data.status == 'AREA TPS OVERLOAD') {
                            return `<span class="badge bg-teal">AREA TPS OVERLOAD</span>` + btn
                        } else if (data.status == 'SELESAI') {
                            return `<span class="badge bg-green">SELESAI</span>` + btn
                        } else if (data.status == 'REJECT') {
                            return `<span class="badge bg-danger">REJECT</span>` + btn
                        }
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data",
                    "render": function(data) {
                        return `<span><strong>` + data.jenis + `</strong></span><br>
                            <span style="font-size: 10px;"><i>` + data.kategori + `</i></span>`
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.asal",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.date_created",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-center py-1',
                    "data": "data.section",
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    // "data": "data.file_bc",
                    "data": "data",
                    "render": function(data) {
                        if (user == 'EXIM') {
                            if (data.file_sr == '') {
                                button_doc = `<ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadsr('` + data.nomor_tiket + `')"> Upload</button></li>
                                    </ul>`
                            } else {
                                button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            }

                            if (data.file_bc == '') {
                                button_doc += `<ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadbc('` + data.nomor_tiket + `')"> Upload</button></li>
                                    </ul>`
                            } else {
                                button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;margin-right: 20px;"></a> <button class="btn btn-xs btn-danger" onclick="hapus_upload_bc('` + data.nomor_tiket + `')"><i class="fa fa-trash"></i></button></li>
                                    </ul>`
                            }


                        } else if (user == 'FATP') {
                            if (data.file_sr == '') {
                                button_doc = `<span class="badge bg-navy">Belum Upload SR/FWR</span>`
                            } else {
                                button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`
                            }

                            if (data.file_bc == '') {
                                button_doc += `<span class="badge bg-red">Belum Upload BC41/25</span>`
                            } else {
                                button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;margin-right: 20px;"></a></li>
                                    </ul>`
                            }


                        } else {
                            if (user == data.section) {
                                if (data.file_sr == '') {
                                    button_doc = `<ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SR<br><button class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" onclick="uploadsr('` + data.nomor_tiket + `')"> Upload</button></li>
                                    </ul>`
                                } else {
                                    button_doc = `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen FWR/SRs<br><a href="<?= base_url('user/dunlud_sr/') ?>` + data.file_sr + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;margin-right: 20px;"></a> <button class="btn btn-xs btn-danger" onclick="hapus_upload_sr('` + data.nomor_tiket + `')"><i class="fa fa-trash"></i></button></li>
                                    </ul>`
                                }


                                if (data.file_bc != '') {
                                    button_doc += `
                        <ul style="padding-left: 20px;">
                                            <li>Dokumen BC 25/41<br><a href="<?= base_url('user/dunlud_bc/') ?>` + data.file_bc + `"><img src="<?= base_url('assets/adminlte/dist/img/pdf.png') ?>" alt="pdf" width="32" height="32" style="margin-top: 5px;"></a></li>
                                    </ul>`

                                }
                            } else {
                                button_doc = '-'
                            }


                        }

                        return button_doc
                    }
                }, {
                    "target": [<?= $target ?>],
                    "className": 'text-left py-1',
                    "data": "data",
                    "render": function(data) {
                        var html = `<div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" onclick="cancel_scrap('${data.nomor_tiket}')" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Scrap"><i class="fa fa-trash"></i> Cancel</button>
                                    <a href="<?= base_url('user/detail_scrap?tiket=') ?>${data.nomor_tiket}&jenis=${data.jenis}" target="_blank" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>
                                </div>`

                        // if (data.status == 'CLOSED' || data.status == 'PROSES') {
                        var html_button_invoice = ""
                        var html_button_tpb = ""
                        var html_button_print = ""

                        // if (user == 'FATP') {
                        //     if (data.invoice_flag == "") {
                        //         html_button_invoice = `<button class="btn btn-danger btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Generate Invoice" onclick="generate_inv('${data.nomor_tiket}','${data.section}')"><i class="fa fa-pencil-square-o"></i> Generate Invoice</button>`
                        //     } else {
                        //         html_button_invoice = `<a href="<?= base_url('user/invoice?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Invoice"><i class="fa fa-print"></i> Invoice</a>`
                        //     }
                        // }

                        if (user == 'EXIM') {
                            html_button_tpb = `<a href="<?= base_url('user/downloadsr?tiket=') ?>${data.nomor_tiket}" class="btn btn-success btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Download Excel"><i class="fa fa-file-excel-o"></i> Excel</a>
                        `
                        }

                        if (user != 'FATP') {
                            if (data.cetak_pdf == "OK") {
                                if (data.jenis == 'ASSET NON FABRIKASI') {
                                    html_button_print = `
                            <a href="<?= base_url('user/fwr?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak FWR"><i class="fa fa-print"></i> FWR</a>
                            <a href="<?= base_url('user/lampiran?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Lampiran"><i class="fa fa-print"></i> Lampiran</a>
                            `
                                } else if (data.jenis == 'ASSET FABRIKASI') {
                                    html_button_print = `
                            <a href="<?= base_url('user/fabrikasi?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                } else if (data.jenis == 'RAW MATERIAL') {
                                    html_button_print = `
                            <a href="<?= base_url('user/rm?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                } else {
                                    html_button_print = `
                            <a href="<?= base_url('user/print?tiket=') ?>${data.nomor_tiket}" target="_blank" class="btn btn-default btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Scrap Requisition"><i class="fa fa-print"></i> SR</a>`
                                }
                            }
                        }

                        html = `<div class="d-flex justify-content-center">
                                    ${html_button_print}
                                    ${html_button_invoice}
                                    ${html_button_tpb}
                                    <a href="<?= base_url('user/detail_scrap?tiket=') ?>${data.nomor_tiket}&jenis=${data.jenis}" target="_blank" type="button" class="btn btn-info btn-sm waves-effect waves-float waves-light ms-3px" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail"><i class="fa fa-info-circle"></i> Detail</a>
                                    
                                </div>`
                        // }

                        return html
                    }
                }, ],
                "dom": '<"row px-2" <"col-md-6 pt-1" <"toolbar">><"col-md-6" f>>rt<"row px-2" <"col-md-6" i><"col-md-6" p>>',
                fnDrawCallback: function(oSettings) {
                    $('[data-bs-toggle="tooltip"]').tooltip()

                },
            })
        }


        // if (user == 'EXIM') {
        //     $(".toolbar").html(`
        //     <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#modal-mau-scrap"><i class="fa fa-plus"></i> Register Scrap</button>&nbsp;
        //     <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
        //     <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn btn-info"><i class="fa fa-inbox"></i> Kode Barang Scrap</a>
        //     <a href="<?= base_url('user/listapproval') ?>" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Approval</a>

        //     `)
        // } else {
        //     $(".toolbar").html(`
        //     <button type="button" class="btn bg-maroon" data-toggle="modal" data-target="#modal-mau-scrap"><i class="fa fa-plus"></i> Register Scrap</button>&nbsp;
        //     <a href="<?= base_url('user/dunlud/ListScrap.xlsx') ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Download Template Form List Scrap</a>
        //     <a href="<?= base_url('user/kodebarangscrap') ?>" class="btn btn-info"><i class="fa fa-inbox"></i> Kode Barang Scrap</button>

        //     `)
        // }




    });

    function reload_table() {
        $('#tableScrap').DataTable().ajax.reload(null, false);
    }

    function process_submit() {
        $("#btn-submit-upload").hide()
        $("#btn-process-upload").show()
    }

    function default_submit() {
        $("#btn-submit-upload").show()
        $("#btn-process-upload").hide()
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

        process_submit()
        var url_ajax = '<?= base_url() ?>user/import_excel'

        var file_data = $('#file_excel').prop('files')[0];
        var jenis = $('#jenis').val();
        var asal = $('#asal').val();

        if (jenis == 'RAW MATERIAL') {
            var kategori = 'PERUSAKAN';
        } else {
            var kategori = $('#kategori').val();
        }
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
                    default_submit()
                } else if (result.status == "kodebarang") {
                    default_submit()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message
                    })
                    $('#modal-default').modal("hide");
                    // toast_confirm('error', result.message)
                } else {
                    default_submit()
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

    $("#form_upload_excel_nobc").submit(function(e) {
        e.preventDefault()
        if ($('#file_excel_nobc').val() == "") {
            toast_confirm('error', "File Upload tidak boleh kosong!")
            return
        }

        process_submit()
        var url_ajax = '<?= base_url() ?>user/import_pengajuan_nobc'

        var file_data = $('#file_excel_nobc').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file_excel_nobc', file_data);

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
                    setTimeout(timer, 2000);

                    // close_edit()
                    // reload_table()
                    // default_submit()
                } else {
                    // default_submit()
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message
                    })
                    $('#modal-scrap-nobc').modal("hide");
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
                $('#modal-scrap-nobc').modal("hide");
                // toast_confirm('error', err.responseText)
            }
        });
    })

    function timer() {
        window.location.replace("<?= base_url('user/listapproval') ?>")
        // location.reload()
    }

    function uploadsr(no) {
        $('#modal-upload-sr').modal('show')
        $('#id_list_scrap').val(no)
    }

    function uploadb3(no) {
        $('#modal-upload-b3').modal('show')
        $('#tiket_b3').val(no)
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
        form_data.append('table', 'header_list_scrap');
        form_data.append('nomor_tiket', $("#tiket_b3").val());
        form_data.append('jenis', 'b3');

        if ($('#file').val() !== "") {
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

    $("#form_update_tiket_cetak").submit(function(e) {
        e.preventDefault()
        var form_data = new FormData();
        form_data.append('table', 'header_list_scrap');
        form_data.append('tiket_cetak', $("#tiket_cetak").val());


        var url_ajax = '<?= base_url() ?>user/tombol_cetak'

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
                    $('#modal-download-sr').modal("hide");
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

    $("#form_register").submit(function(e) {
        e.preventDefault()

        if ($('#nama_barang').val() == '') {
            Swal.fire(
                'error!',
                'Isikan Nama Barang',
                'error'
            )
            return
        }

        var form_data = new FormData();
        form_data.append('table', 'mst_barang');
        form_data.append('nama_barang', $("#nama_barang").val());
        form_data.append('unit', $("#unit").val());
        form_data.append('flag_ils', '0');
        form_data.append('fasilitas_bc', '1');
        form_data.append('dokumen_bc', 'YES');


        var url_ajax = '<?= base_url() ?>user/register_barang'

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
                    $('#modalregister').modal("hide");
                    $('#nama_barang').val('')
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

    function registerbarang() {
        $('#modalregister').modal('show')
    }

    function ganti_status(id, tiket) {
        // alert(id, kode_barang, nama_barang, invoice_po, section)

        $('#modal-list').modal('show')
        $('#id_scrap_2').val(id)
        $('#tiket').val(tiket)
    }

    function ganti_status_ga(id, tiket) {
        // alert(id, kode_barang, nama_barang, invoice_po, section)

        $('#modal-list-ga').modal('show')
        $('#id_scrap_2ga').val(id)
        $('#tiketga').val(tiket)
    }

    function reject_action() {
        if ($('#status_scrap').val() == 'REJECT') {
            $('#text_reject_reason').show()
        } else {
            $('#text_reject_reason').hide()
            $('#reject_reason').val('')
        }
    }

    $('#btn_update_status').on('click', function() {
        var html

        $.ajax({
            url: '<?= base_url() ?>user/update_status_all',
            data: {
                id: $("#id_scrap_2").val(),
                status_dokumen: $("#status_scrap").val(),
                tiket: $("#tiket").val(),
                reject: $("#reject_reason").val()
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

    $('#btn_update_status_ga').on('click', function() {
        var html

        $.ajax({
            url: '<?= base_url() ?>user/update_status_all',
            data: {
                id: $("#id_scrap_2ga").val(),
                status_dokumen: $("#status_scrapga").val(),
                tiket: $("#tiketga").val()
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                $('#modal-list-ga').modal('hide')

                if (result.status == "success") {
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    });

    function histori_status(id, tiket) {
        $('#modal-status').modal('show')

        var html = ""

        $.ajax({
            url: '<?= base_url() ?>user/get_status_all',
            data: {
                id_list_scrap: id,
                tiket: tiket
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                var no = 1
                html += ``
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

    function do_b3(status, tiket) {
        $.ajax({
            url: '<?= base_url() ?>user/approval_b3',
            data: {
                status: status,
                nomor_tiket: tiket
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == "success") {
                    Swal.fire(
                        'Updated!',
                        'Data berhasil di update.',
                        'success'
                    )
                    reload_table()
                } else
                    toast('error', result.message)
            }
        })
    }

    function generate_inv(tiket, section) {
        $('#modal-generate-invoice').modal('show')
        $('#tiket_scrap').val(tiket)
        $('#section_scrap').val(section)
    }

    $('#btn-generate-invoice').on('click', function() {
        $('#btn-generate-invoice').hide()
        $('#btn-process-invoice').show()
    })

    $("#form_generate_invoice").submit(function(e) {
        e.preventDefault()

        // if ($('#nomor_invoice').val() == '') {
        //     Swal.fire(
        //         'error!',
        //         'Isikan NOMOR INVOICE',
        //         'error'
        //     )
        //     return
        // }

        var form_data = new FormData();
        form_data.append('table', 'header_invoice_scrap');
        form_data.append('tiket_scrap', $("#tiket_scrap").val());
        form_data.append('section_scrap', $("#section_scrap").val());
        form_data.append('nomor_invoice', $("#nomor_invoice").val());
        form_data.append('invoice_flag', 'OK');


        var url_ajax = '<?= base_url() ?>user/generate_invoice'

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
                    $('#modal-generate-invoice').modal("hide");
                    $('#nomor_invoice').val('')
                    $('#btn-generate-invoice').show()
                    $('#btn-process-invoice').hide()
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

    function update_kolom(id, kolom, tiket) {
        var t = kolom + id
        console.log(t)
        //note : biar simple, bawa identifikasi id melalui function data
        $.ajax({
            url: '<?= base_url() ?>user/update_kolom_timbang',
            data: {
                id: id,
                nilai: $(`#timbang` + id).val(),
                // nilai: $('#timbang10417').val(),
                kolom: kolom,
                tiket: tiket
            },
            type: 'post',
            dataType: 'json',
            success: function(result) {
                if (result.status == 'success') {
                    toast('success', result.message)
                } else if (result.status == 'berat_kosong') {
                    Swal.fire(
                        'error!',
                        result.message,
                        'error'
                    )
                    $(`#timbang` + id).val('')
                } else {
                    toast('error', result.message)
                    $(`#timbang` + id).val('')
                }
                // reload_table()
            }
        })
    }

    function modal_packing(tiket) {
        $('#modal_packing').modal('show')
        $('#tiket_packing').val(tiket)
    }

    $("#modal_packing").submit(function(e) {
        e.preventDefault()
        // if ($('#file_excel').val() == "") {
        //     toast_confirm('error', "File Upload tidak boleh kosong!")
        //     return
        // }

        // process_submit()
        var url_ajax = '<?= base_url() ?>user/update_packing'

        var jenis_packing = $('#jenis_packing').val();
        var jumlah_packing = $('#jumlah_packing').val();
        var tiket_packing = $('#tiket_packing').val();
        var form_data = new FormData();
        form_data.append('jenis_packing', jenis_packing);
        form_data.append('jumlah_packing', jumlah_packing);
        form_data.append('tiket_packing', tiket_packing);

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
                    $('#jumlah_packing').val('')
                    $('#modal_packing').modal("hide");
                    reload_table()
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: result.message
                    })
                    $('#jumlah_packing').val('')
                    $('#modal_packing').modal("hide");
                }
            },
            error: function(err) {
                default_submit()
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: err.responseText
                })
                $('#jumlah_packing').val('')
                $('#modal_packing').modal("hide");
            }
        });
    })

    function generate_report(tiket, jenis, section) {

        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan melakukan generate report!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lakukan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/generate_report_invoice',
                    data: {
                        nomor_tiket: tiket,
                        jenis: jenis,
                        section: section
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Generated!',
                                'Report berhasil di generate.',
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

    function hapus_upload_sr(tiket) {
        // console.log(tiket)
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menghapus file SR/FWR!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lakukan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/hapus_upload_sr',
                    data: {
                        nomor_tiket: tiket
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Deleted!',
                                'File berhasil dihapus.',
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

    function hapus_upload_bc(tiket) {
        // console.log(tiket)
        Swal.fire({
            title: 'Apakah Anda Yakin ?',
            text: "Anda akan menghapus file BC25/41!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, lakukan saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url() ?>user/hapus_upload_bc',
                    data: {
                        nomor_tiket: tiket
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result) {
                        if (result.status == "success") {
                            Swal.fire(
                                'Deleted!',
                                'File berhasil dihapus.',
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