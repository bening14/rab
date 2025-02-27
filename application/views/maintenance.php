<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
</head>

<body>
    <h2 style="text-align: center;margin-top: 100px;">MOHON MAAF, UNTUK SAAT INI MASIH SEDANG ADA PERBAIKAN DI SISTEM PORTAL SCRAP</h2>
    <!-- <h2 style="text-align: center;margin-top: 100px;">SABAR DULU YA.. MOHON MAAF KARENA TERLALU BANYAK ANTRIAN PROSES TIMBANG DAN PERUSAKAN, <br>SAAT INI PORTAL SCRAP DITUTUP SEMENTARA</h2> -->
    <div style="text-align: center;">
        <!-- <h3>Estimasi Tutup hingga 05-Feb-2024 </h3> -->
    </div>
    <div style="text-align: center;margin-top: 50px;">
        <img src="<?= base_url('assets/sad.png') ?>" alt="sad" style="max-width: 50px;">
    </div>
    <div style="text-align: center">
        <h4>EXIM-PGA</h4>
    </div>
</body>

</html>

<?php

$this->session->unset_userdata('username');
$this->session->unset_userdata('role');
$this->session->unset_userdata('nik');
$this->session->unset_userdata('image');
$this->session->unset_userdata('id');
$this->session->unset_userdata('section');

?>