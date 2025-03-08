<?php
defined('BASEPATH') or exit('No direct script access allowed');

require('./application/third_party/phpoffice/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;




class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Please Login!</div>');
            redirect('auth');
        }
        $this->load->model("Crud", "crud");
    }

    public function index()
    {
        $data['title'] = 'Dashboard | Hitung RAB';
        $data['kab_kota'] = $this->crud->get_all('mst_lokasi')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/hitung_rab');
        $this->load->view('template/footer');
    }

    public function lokasi()
    {
        $data['title'] = 'Lokasi | Hitung RAB';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/lokasi');
        $this->load->view('template/footer');
    }

    public function user()
    {
        $data['title'] = 'User | Hitung RAB';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/user');
        $this->load->view('template/footer');
    }

    public function satuan()
    {
        $data['title'] = 'Satuan | Hitung RAB';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/satuan');
        $this->load->view('template/footer');
    }

    public function material()
    {
        $data['title'] = 'Material | Hitung RAB';
        $data['satuan'] = $this->crud->get_all('mst_satuan')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/material');
        $this->load->view('template/footer');
    }

    public function jasa()
    {
        $data['title'] = 'Jasa | Hitung RAB';
        $data['satuan'] = $this->crud->get_all('mst_satuan')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/jasa');
        $this->load->view('template/footer');
    }

    public function pekerjaan()
    {
        $data['title'] = 'Pekerjaan | Hitung RAB';
        $data['kab_kota'] = $this->crud->get_all('mst_lokasi')->result_array();
        $data['satuan'] = $this->crud->get_all('mst_satuan')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/pekerjaan');
        $this->load->view('template/footer');
    }

    public function pekerjaan_detail()
    {
        $data['title'] = 'Pekerjaan Detail | Hitung RAB';
        $kode = $_GET['kode_pekerjaan'];
        $uraian = $_GET['uraian'];
        $kota = $_GET['kota'];
        $where = array(
            'kode_pekerjaan' => $kode,
            'uraian_pekerjaan' => $uraian
        );
        $getDetail = $this->crud->sum_where('tbl_pekerjaan_detail', $where, 'harga_konversi')->row_array();
        if ($getDetail['harga_konversi'] > 0) {
            $data['harga_total'] = 'Rp. ' . number_format(trim($getDetail['harga_konversi']), 2);
        } else {
            $data['harga_total'] = 'Rp. 0';
        }

        // $getPrev = $this->crud->count_where('tbl_pekerjaan_detail', $where);

        if (isset($kota)) {
            $data['kab_kota'] = $kota;
        } else {
            $data['kab_kota'] = 'Belum Klasifikasi';
        }

        $whereBrg = array(
            'kab_kota' => $kota
        );

        $data['detail_pekerjaan'] = $this->crud->get_where('tbl_pekerjaan_detail', $where)->result_array();
        $data['detail_barang'] = $this->crud->get_where('tbl_harga_material', $whereBrg)->result_array();
        $data['detail_jasa'] = $this->crud->get_where('tbl_harga_jasa', $whereBrg)->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/pekerjaan_detail');
        $this->load->view('template/footer');
    }

    public function harga_material()
    {
        $data['title'] = 'Harga Material | Hitung RAB';
        $data['kab_kota'] = $this->crud->get_all('mst_lokasi')->result_array();
        $data['barang'] = $this->crud->get_all('mst_barang')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/harga_material');
        $this->load->view('template/footer');
    }

    public function harga_jasa()
    {
        $data['title'] = 'Harga Jasa | Hitung RAB';
        $data['kab_kota'] = $this->crud->get_all('mst_lokasi')->result_array();
        $data['jasa'] = $this->crud->get_all('mst_jasa')->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/harga_jasa');
        $this->load->view('template/footer');
    }

    public function rab_detail()
    {
        $data['title'] = 'Detail | Hitung RAB';
        $so_number = $_GET['so_number'];
        $kab_kota = $_GET['kota'];


        $customer = $_GET['customer'];
        if (isset($customer)) {
            $data['customer'] = $customer;
        } else {
            $data['customer'] = 'Belum Klasifikasi';
        }
        $kota = $_GET['kota'];
        if (isset($kota)) {
            $data['kota'] = $kota;
        } else {
            $data['kota'] = 'Belum Klasifikasi';
        }
        $alamat = $_GET['alamat'];
        if (isset($alamat)) {
            $data['alamat'] = $alamat;
        } else {
            $data['alamat'] = 'Belum Klasifikasi';
        }
        $hp = $_GET['hp'];
        if (isset($hp)) {
            $data['hp'] = $hp;
        } else {
            $data['hp'] = 'Belum Klasifikasi';
        }
        $where = array(
            'so_number' => $so_number
        );
        $getDetail = $this->crud->sum_where('tbl_rab_detail', $where, 'harga_final')->row_array();
        if ($getDetail['harga_final'] > 0) {
            $data['harga_total'] = 'Rp. ' . number_format(trim($getDetail['harga_final']), 2);
        } else {
            $data['harga_total'] = 'Rp. 0';
        }


        $whereBrg = array(
            'kab_kota' => $kota
        );

        $data['detail_pekerjaan'] = $this->crud->get_where('tbl_pekerjaan_header', $whereBrg)->result_array();


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/hitung_rab_detail');
        $this->load->view('template/footer');
    }

    public function ajax_table_lokasi()
    {
        $table = 'mst_lokasi'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'kab_kota', 'provinsi', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kab_kota', 'provinsi', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kab_kota, provinsi, date_created';
        $group = 'id, kab_kota, provinsi, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['kab_kota'] = trim($key->kab_kota);
            $row['data']['provinsi'] = trim($key->provinsi);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_user()
    {
        $table = 'mst_user'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'username', 'nama', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'username', 'nama', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, username, nama, date_created';
        $group = 'id, username, nama, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['username'] = trim($key->username);
            $row['data']['nama'] = trim($key->nama);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete()
    {
        $table = $this->input->post('table');


        $where = array(
            'id' => $this->input->post('id')
        );

        //hapus data
        $hapus_data = $this->crud->delete($table, $where);


        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function ubah()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");

        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);

        $update = $this->crud->update($table, $data, ['id' => $id]);
        // $insert = $this->crud->insert($table, $data);

        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Data!'];

        echo json_encode($response);
    }

    public function ubah_pass()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $p4s5 = $this->input->post("p4s5");
        $p = password_hash($p4s5, PASSWORD_DEFAULT);

        $data = array(
            'password' => $p
        );

        $update = $this->crud->update($table, $data, ['id' => $id]);
        // $insert = $this->crud->insert($table, $data);

        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Data!'];

        echo json_encode($response);
    }

    public function tambah()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_user()
    {
        $table = $this->input->post("table");
        $u5 = $this->input->post("u5");
        $p4s5 = $this->input->post("p4s5");
        $nama = $this->input->post("nama");
        $p = password_hash($p4s5, PASSWORD_DEFAULT);

        $data = array(
            'username' => $u5,
            'password' => $p,
            'nama' => $nama,
            'is_active' => '1'
        );


        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_barang()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        //buat nomor tiket
        $getKode = $this->Crud->get_all_limit($table)->row_array();
        if ($getKode > 0) {
            $a = explode("-", trim($getKode['kode_barang']));
            $no = $a[1] + 1;
        } else {
            $no = '1001';
        }

        $kode_brg = 'RM-' . $no;
        $data['kode_barang'] = $kode_brg;

        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_pekerjaan()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        //ambil data
        $getKota = $this->crud->get_where('mst_lokasi', ['id' => $this->input->post('kab_kota')])->row_array();

        unset($data['kab_kota']);
        unset($data['table']);

        //buat nomor tiket
        $getKode = $this->Crud->get_all_limit($table)->row_array();
        if ($getKode > 0) {
            $a = explode("-", trim($getKode['kode_pekerjaan']));
            $no = $a[1] + 1;
        } else {
            $no = '1001';
        }

        $kode_brg = 'ITEM-' . $no;
        $data['kode_pekerjaan'] = $kode_brg;
        $data['kab_kota'] = $getKota['kab_kota'];

        $insert = $this->crud->insert($table, $data);

        // echo $this->db->last_query();
        // die;

        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_harga_material()
    {
        $table = $this->input->post("table");
        $id_mst_barang = $this->input->post("id_mst_barang");
        $harga = $this->input->post("harga");
        $id_mst_lokasi = $this->input->post("id_mst_lokasi");
        //lakukan preventive dulu
        $where = array(
            'id_mst_barang' => $id_mst_barang,
            'id_mst_lokasi' => $id_mst_lokasi
        );
        $getPrev = $this->crud->count_where('tbl_harga_material', $where);
        if ($getPrev > 0) {
            $response = ['status' => 'error', 'message' => 'Data Harga atas barang ini sudah ada di database!'];
            echo json_encode($response);
            die;
        }
        //ambil data
        $whereBrg = array(
            'id' => $id_mst_barang
        );
        $getBrg = $this->crud->get_where('mst_barang', $whereBrg)->result_array();
        foreach ($getBrg as $key => $value) {
            $kode_barang = $value['kode_barang'];
            $nama_barang = $value['nama_barang'];
            $satuan = $value['satuan'];
        }

        $whereLokasi = array(
            'id' => $id_mst_lokasi
        );
        $getLokasi = $this->crud->get_where('mst_lokasi', $whereLokasi)->result_array();
        foreach ($getLokasi as $key1 => $val) {
            $kab_kota = $val['kab_kota'];
        }

        $data = array(
            'id_mst_barang' => $id_mst_barang,
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'satuan' => $satuan,
            'harga' => $harga,
            'id_mst_lokasi' => $id_mst_lokasi,
            'kab_kota' => $kab_kota
        );

        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_harga_jasa()
    {
        $table = $this->input->post("table");
        $id_mst_jasa = $this->input->post("id_mst_jasa");
        $harga = $this->input->post("harga");
        $id_mst_lokasi = $this->input->post("id_mst_lokasi");
        //lakukan preventive dulu
        $where = array(
            'id_mst_jasa' => $id_mst_jasa,
            'id_mst_lokasi' => $id_mst_lokasi
        );
        $getPrev = $this->crud->count_where('tbl_harga_jasa', $where);
        if ($getPrev > 0) {
            $response = ['status' => 'error', 'message' => 'Data Harga atas jasa ini sudah ada di database!'];
            echo json_encode($response);
            die;
        }
        //ambil data
        $whereJs = array(
            'id' => $id_mst_jasa
        );
        $getJs = $this->crud->get_where('mst_jasa', $whereJs)->result_array();
        foreach ($getJs as $key => $value) {
            $kode_jasa = $value['kode_jasa'];
            $nama_jasa = $value['nama_jasa'];
            $satuan = $value['satuan'];
        }
        $whereLokasi = array(
            'id' => $id_mst_lokasi
        );
        $getLokasi = $this->crud->get_where('mst_lokasi', $whereLokasi)->result_array();
        foreach ($getLokasi as $key1 => $val) {
            $kab_kota = $val['kab_kota'];
        }

        $data = array(
            'id_mst_jasa' => $id_mst_jasa,
            'kode_jasa' => $kode_jasa,
            'nama_jasa' => $nama_jasa,
            'satuan' => $satuan,
            'harga' => $harga,
            'id_mst_lokasi' => $id_mst_lokasi,
            'kab_kota' => $kab_kota
        );

        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function ajax_table_satuan()
    {
        $table = 'mst_satuan'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'satuan', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'satuan', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, satuan, date_created';
        $group = 'id, satuan, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['satuan'] = trim($key->satuan);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_barang()
    {
        $table = 'mst_barang'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'kode_barang', 'nama_barang', 'satuan', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kode_barang', 'nama_barang', 'satuan', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_barang, nama_barang, satuan, date_created';
        $group = 'id, kode_barang, nama_barang, satuan, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['kode_barang'] = trim($key->kode_barang);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['satuan'] = trim($key->satuan);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_jasa()
    {
        $table = 'mst_jasa'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'kode_jasa', 'nama_jasa', 'satuan', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kode_jasa', 'nama_jasa', 'satuan', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_jasa, nama_jasa, satuan, date_created';
        $group = 'id, kode_jasa, nama_jasa, satuan, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['kode_jasa'] = trim($key->kode_jasa);
            $row['data']['nama_jasa'] = trim($key->nama_jasa);
            $row['data']['satuan'] = trim($key->satuan);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function tambah_jasa()
    {
        $table = $this->input->post("table");

        $data = $this->input->post();
        unset($data['table']);

        //buat nomor tiket
        $getKode = $this->Crud->get_all_limit($table)->row_array();
        if ($getKode > 0) {
            $a = explode("-", trim($getKode['kode_jasa']));
            $no = $a[1] + 1;
        } else {
            $no = '1001';
        }

        $kode_brg = 'JS-' . $no;
        $data['kode_jasa'] = $kode_brg;

        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function ajax_table_harga_material()
    {
        $table = 'tbl_harga_material'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'id_mst_barang', 'kode_barang', 'nama_barang', 'satuan', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'id_mst_barang', 'kode_barang', 'nama_barang', 'satuan', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_barang, kode_barang, nama_barang, satuan, harga, id_mst_lokasi, kab_kota, date_created';
        $group = 'id, id_mst_barang, kode_barang, nama_barang, satuan, harga, id_mst_lokasi, kab_kota, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['id_mst_barang'] = trim($key->id_mst_barang);
            $row['data']['kode_barang'] = trim($key->kode_barang);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['satuan'] = trim($key->satuan);
            $row['data']['harga'] = 'Rp. ' . number_format(trim($key->harga), 2);
            $row['data']['id_mst_lokasi'] = trim($key->id_mst_lokasi);
            $row['data']['kab_kota'] = trim($key->kab_kota);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_harga_jasa()
    {
        $table = 'tbl_harga_jasa'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'id_mst_jasa', 'kode_jasa', 'nama_jasa', 'satuan', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'id_mst_jasa', 'kode_jasa', 'nama_jasa', 'satuan', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_jasa, kode_jasa, nama_jasa, satuan, harga, id_mst_lokasi, kab_kota, date_created';
        $group = 'id, id_mst_jasa, kode_jasa, nama_jasa, satuan, harga, id_mst_lokasi, kab_kota, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['id_mst_jasa'] = trim($key->id_mst_jasa);
            $row['data']['kode_jasa'] = trim($key->kode_jasa);
            $row['data']['nama_jasa'] = trim($key->nama_jasa);
            $row['data']['satuan'] = trim($key->satuan);
            $row['data']['harga'] = 'Rp. ' . number_format(trim($key->harga), 2);
            $row['data']['id_mst_lokasi'] = trim($key->id_mst_lokasi);
            $row['data']['kab_kota'] = trim($key->kab_kota);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_pekerjaan()
    {
        $table = 'tbl_pekerjaan_header'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'kode_pekerjaan', 'uraian_pekerjaan', 'satuan', 'kab_kota', 'harga_origin', 'harga_up_30', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kode_pekerjaan', 'uraian_pekerjaan',  'satuan', 'kab_kota', 'harga_origin', 'harga_up_30', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_pekerjaan, uraian_pekerjaan,  satuan, kab_kota, harga_origin, harga_up_30, date_created';
        $group = 'id, kode_pekerjaan, uraian_pekerjaan,  satuan, kab_kota, harga_origin, harga_up_30, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['kode_pekerjaan'] = trim($key->kode_pekerjaan);
            $row['data']['uraian_pekerjaan'] = trim($key->uraian_pekerjaan);
            $row['data']['satuan'] = trim($key->satuan);
            $row['data']['kab_kota'] = trim($key->kab_kota);
            $row['data']['harga_origin'] =  'Rp. ' . number_format(trim($key->harga_origin), 2);
            $row['data']['harga_up_30'] =  'Rp. ' . number_format(trim($key->harga_up_30), 2);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_pekerjaan_detail()
    {
        $table = 'tbl_pekerjaan_detail'; //nama tabel dari database
        $kode_pekerjaan = $this->input->post('kode_pekerjaan');
        $where = array(
            'kode_pekerjaan' => $kode_pekerjaan
        );

        $column_order = array('id', 'id_tbl_pekerjaan_header', 'kode_pekerjaan', 'uraian_pekerjaan', 'kode_barang', 'nama_barang', 'qty', 'harga_bahan', 'harga_konversi', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'id_tbl_pekerjaan_header', 'kode_pekerjaan', 'uraian_pekerjaan', 'kode_barang', 'nama_barang', 'qty', 'harga_bahan', 'harga_konversi', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_tbl_pekerjaan_header, kode_pekerjaan, uraian_pekerjaan, kode_barang, nama_barang, qty, harga_bahan, harga_konversi, date_created';
        $group = 'id, id_tbl_pekerjaan_header, kode_pekerjaan, uraian_pekerjaan, kode_barang, nama_barang, qty, harga_bahan, harga_konversi, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['id_tbl_pekerjaan_header'] = trim($key->id_tbl_pekerjaan_header);
            $row['data']['kode_pekerjaan'] = trim($key->kode_pekerjaan);
            $row['data']['uraian_pekerjaan'] = trim($key->uraian_pekerjaan);
            $row['data']['kode_barang'] = trim($key->kode_barang);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['qty'] = number_format(trim($key->qty), 2);
            $row['data']['harga_bahan'] = 'Rp. ' . number_format(trim($key->harga_bahan), 2);
            $row['data']['harga_konversi'] = 'Rp. ' . number_format(trim($key->harga_konversi), 2);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function tambah_pekerjaan_detail()
    {
        $table = $this->input->post("table");
        $kode_barang = $this->input->post("kode_barang");
        $kab_kota = $this->input->post("kab_kota");
        $qty = $this->input->post("qty");
        $kode_pekerjaan = $this->input->post("kode_pekerjaan");

        $wherePkj = array(
            'kode_pekerjaan' => $kode_pekerjaan
        );
        $getPkj = $this->crud->get_where('tbl_pekerjaan_header', $wherePkj)->result_array();
        foreach ($getPkj as $key => $value) {
            $idPkj = $value['id'];
            $uraian = $value['uraian_pekerjaan'];
        }
        $whereBrg = array(
            'kode_barang' => $kode_barang,
            'kab_kota' => $kab_kota
        );
        $getBrg = $this->crud->get_where('tbl_harga_material', $whereBrg)->result_array();
        foreach ($getBrg as $key1 => $val) {
            $nama_barang = $val['nama_barang'];
            $harga = $val['harga'];
        }

        $data = array(
            'id_tbl_pekerjaan_header' => $idPkj,
            'kode_pekerjaan' => $kode_pekerjaan,
            'uraian_pekerjaan' => $uraian,
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'qty' => $qty,
            'harga_bahan' => $harga,
            'harga_konversi' => ($harga * $qty)
        );

        $this->crud->insert($table, $data);

        //update tbl_pekerjaan (harga_origin)
        $whereOrg = array(
            'kode_pekerjaan' => $kode_pekerjaan
        );
        $a = $this->crud->sum_where('tbl_pekerjaan_detail', $whereOrg, 'harga_konversi')->row_array();
        $b = $a['harga_konversi'];
        $c = floatval($b);
        $d = $c * 0.3;
        $e = $c + $d;
        $dataOrg = array(
            'harga_origin' => $b,
            'harga_up_30' => $e
        );
        $this->crud->update('tbl_pekerjaan_header', $dataOrg, $whereOrg);

        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!', 'harga_origin' => $b];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_pekerjaan_detail_jasa()
    {
        $table = $this->input->post("table");
        $kode_barang = $this->input->post("kode_barang");
        $kab_kota = $this->input->post("kab_kota");
        $qty = $this->input->post("qty");
        $kode_pekerjaan = $this->input->post("kode_pekerjaan");

        $wherePkj = array(
            'kode_pekerjaan' => $kode_pekerjaan
        );
        $getPkj = $this->crud->get_where('tbl_pekerjaan_header', $wherePkj)->result_array();
        foreach ($getPkj as $key => $value) {
            $idPkj = $value['id'];
            $uraian = $value['uraian_pekerjaan'];
        }
        $whereBrg = array(
            'kode_jasa' => $kode_barang,
            'kab_kota' => $kab_kota
        );
        $getBrg = $this->crud->get_where('tbl_harga_jasa', $whereBrg)->result_array();
        foreach ($getBrg as $key1 => $val) {
            $nama_barang = $val['nama_jasa'];
            $harga = $val['harga'];
        }

        $data = array(
            'id_tbl_pekerjaan_header' => $idPkj,
            'kode_pekerjaan' => $kode_pekerjaan,
            'uraian_pekerjaan' => $uraian,
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'qty' => $qty,
            'harga_bahan' => $harga,
            'harga_konversi' => ($harga * $qty)
        );

        $this->crud->insert($table, $data);

        //update tbl_pekerjaan (harga_origin)
        $whereOrg = array(
            'kode_pekerjaan' => $kode_pekerjaan
        );
        $a = $this->crud->sum_where('tbl_pekerjaan_detail', $whereOrg, 'harga_konversi')->row_array();
        $b = $a['harga_konversi'];
        $c = floatval($b);
        $d = $c * 0.3;
        $e = $c + $d;
        $dataOrg = array(
            'harga_origin' => $b,
            'harga_up_30' => $e
        );
        $this->crud->update('tbl_pekerjaan_header', $dataOrg, $whereOrg);

        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!', 'harga_origin' => $b];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function delete_detail()
    {
        $table = $this->input->post('table');
        $kode_pekerjaan = $this->input->post('kode_pekerjaan');


        $where = array(
            'id' => $this->input->post('id')
        );

        //hapus data
        $hapus_data = $this->crud->delete($table, $where);

        //update tbl_pekerjaan (harga_origin)
        $whereOrg = array(
            'kode_pekerjaan' => $kode_pekerjaan
        );
        $a = $this->crud->sum_where('tbl_pekerjaan_detail', $whereOrg, 'harga_konversi')->row_array();
        if (isset($a['harga_konversi'])) {
            $b = $a['harga_konversi'];
            $c = floatval($b);
            $d = $c * 0.3;
            $e = $c + $d;
        } else {
            $b = 0;
            $e = 0;
        }
        $dataOrg = array(
            'harga_origin' => $b,
            'harga_up_30' => $e
        );
        $this->crud->update('tbl_pekerjaan_header', $dataOrg, $whereOrg);



        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!', 'harga_origin' => $b];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function ajax_table_rab()
    {
        $table = 'tbl_rab_header'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'so_number', 'customer', 'alamat', 'hp', 'nilai_origin', 'nilai_final', 'profit', 'kab_kota', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'so_number', 'customer',  'alamat', 'hp', 'nilai_origin', 'nilai_final', 'profit', 'kab_kota', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, so_number, customer,  alamat, hp, nilai_origin, nilai_final, profit, kab_kota, date_created';
        $group = 'id, so_number, customer,  alamat, hp, nilai_origin, nilai_final, profit, kab_kota, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['so_number'] = trim($key->so_number);
            $row['data']['customer'] = trim($key->customer);
            $row['data']['alamat'] = trim($key->alamat);
            $row['data']['hp'] =  trim($key->hp);
            $row['data']['nilai_origin'] = 'Rp. ' . number_format(trim($key->nilai_origin), 2);
            $row['data']['nilai_final'] = 'Rp. ' . number_format(trim($key->nilai_final), 2);
            $row['data']['profit'] = 'Rp. ' . number_format(trim($key->profit), 2);
            $row['data']['kab_kota'] =  trim($key->kab_kota);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_table_rab_detail()
    {
        $table = 'tbl_rab_detail'; //nama tabel dari database

        $so_number = $this->input->post('so_number');
        $where = array(
            'so_number' => $so_number
        );

        $column_order = array('id', 'id_tbl_rab_header', 'so_number', 'customer', 'kode_pekerjaan', 'uraian_pekerjaan', 'satuan', 'harga_origin', 'qty', 'harga_konversi', 'margin_persen', 'margin_amount', 'resiko_persen', 'resiko_amount', 'harga_final', 'profit', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'id_tbl_rab_header', 'so_number', 'customer',  'kode_pekerjaan', 'uraian_pekerjaan', 'satuan', 'harga_origin', 'qty', 'harga_konversi', 'margin_persen', 'margin_amount', 'resiko_persen', 'resiko_amount', 'harga_final', 'profit', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_tbl_rab_header, so_number, customer,  kode_pekerjaan, uraian_pekerjaan, satuan, harga_origin, qty, harga_konversi, margin_persen, margin_amount, resiko_persen, resiko_amount, harga_final, profit, date_created';
        $group = 'id, id_tbl_rab_header, so_number, customer,  kode_pekerjaan, uraian_pekerjaan, satuan, harga_origin, qty, harga_konversi, margin_persen, margin_amount, resiko_persen, resiko_amount, harga_final, profit, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['id_tbl_rab_header'] = trim($key->id_tbl_rab_header);
            $row['data']['so_number'] = trim($key->so_number);
            $row['data']['customer'] = trim($key->customer);
            $row['data']['kode_pekerjaan'] = trim($key->kode_pekerjaan);
            $row['data']['uraian_pekerjaan'] =  trim($key->uraian_pekerjaan);
            $row['data']['satuan'] =  trim($key->satuan);
            $row['data']['harga_origin'] = 'Rp. ' . number_format(trim($key->harga_origin), 2);
            $row['data']['qty'] = number_format(trim($key->qty), 2);
            $row['data']['harga_konversi'] = 'Rp. ' . number_format(trim($key->harga_konversi), 2);
            $row['data']['margin_persen'] = number_format(trim($key->margin_persen), 2);
            $row['data']['margin_amount'] = 'Rp. ' . number_format(trim($key->margin_amount), 2);
            $row['data']['resiko_persen'] =  number_format(trim($key->resiko_persen), 2);
            $row['data']['resiko_amount'] =  'Rp. ' . number_format(trim($key->resiko_amount), 2);
            $row['data']['harga_final'] =  'Rp. ' . number_format(trim($key->harga_final), 2);
            $row['data']['profit'] =  'Rp. ' . number_format(trim($key->profit), 2);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function tambah_hitung_rab()
    {
        $table = $this->input->post("table");
        $so_number = $this->input->post("so_number");
        $customer = $this->input->post("customer");
        $alamat = $this->input->post("alamat");
        $hp = $this->input->post("hp");
        $kegiatan_pekerjaan = $this->input->post("kegiatan_pekerjaan");
        $luas_area = $this->input->post("luas_area");

        //cek dulu apakah SO sudah ada?
        $whereSo = array(
            'so_number' => $so_number
        );
        $getPrev = $this->crud->count_where('tbl_rab_header', $whereSo);
        if ($getPrev > 0) {
            $response = ['status' => 'error', 'message' => 'SO sudah terdaftar di database!'];
            echo json_encode($response);
            die;
        }

        //ambil data
        $where = array(
            'id' => $this->input->post('id_mst_lokasi')
        );
        $getLok = $this->crud->get_where('mst_lokasi', $where)->row_array();

        $kab_kota = $getLok['kab_kota'];

        $data = array(
            'so_number' => $so_number,
            'kegiatan_pekerjaan' => $kegiatan_pekerjaan,
            'luas_area' => $luas_area,
            'customer' => $customer,
            'alamat' => $alamat,
            'hp' => $hp,
            'kab_kota' => $kab_kota,
        );

        $insert = $this->crud->insert($table, $data);
        // echo $this->db->last_query();
        // die;


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function tambah_rab_detail()
    {
        $table = $this->input->post("table");
        $kab_kota = $this->input->post("kab_kota");
        $qty = $this->input->post("qty");
        $kode_pekerjaan = $this->input->post("kode_pekerjaan");
        $so_number = $this->input->post("so_number");
        $a = $this->input->post("margin_persen");
        $b = $this->input->post("resiko_persen");
        $c = floatval($a);
        $d = floatval($b);

        $margin_persen = $c / 100;
        $resiko_persen = $d / 100;

        $wherePkj = array(
            'so_number' => $so_number
        );
        $getPkj = $this->crud->get_where('tbl_rab_header', $wherePkj)->result_array();
        foreach ($getPkj as $key => $value) {
            $idPkj = $value['id'];
            $customer = $value['customer'];
        }

        $whereBrg = array(
            'kode_pekerjaan' => $kode_pekerjaan,
            'kab_kota' => $kab_kota
        );
        $getBrg = $this->crud->get_where('tbl_pekerjaan_header', $whereBrg)->result_array();
        foreach ($getBrg as $key1 => $val) {
            $uraian = $val['uraian_pekerjaan'];
            $satuan = $val['satuan'];
            $harga_origin = $val['harga_origin'];
            $harga_konversi = $val['harga_origin'] * $qty;
        }

        $margin_amount = $margin_persen * $harga_konversi;
        $resiko_amount = $resiko_persen * $harga_konversi;
        $harga_final = $harga_konversi + $margin_amount + $resiko_amount;
        $profit = $harga_final - $harga_konversi;

        // echo 'id='. $idPkj.'<br>';
        // echo 'so number='. $so_number.'<br>';
        // echo 'customer='. $customer.'<br>';
        // echo 'kode pekerjaan='. $kode_pekerjaan.'<br>';
        // echo 'uaraian pekerjaan='. $uraian.'<br>';
        // echo 'harga origin='. $harga_origin.'<br>';
        // echo 'qty='. $qty.'<br>';
        // echo 'harga konversi='. $harga_konversi.'<br>';
        // echo 'margin persen='. $margin_persen.'<br>';
        // echo 'margin amount='. $margin_amount.'<br>';
        // echo 'resiko persen='. $resiko_persen.'<br>';
        // echo 'resiko amount='. $resiko_amount.'<br>';
        // echo 'harga final='. $harga_final.'<br>';
        // echo 'profit='. $profit;
        // die;
        $data = array(
            'id_tbl_rab_header' => $idPkj,
            'so_number' => $so_number,
            'customer' => $customer,
            'kode_pekerjaan' => $kode_pekerjaan,
            'uraian_pekerjaan' => $uraian,
            'satuan' => $satuan,
            'harga_origin' => $harga_origin,
            'qty' => $qty,
            'harga_konversi' => $harga_konversi,
            'margin_persen' => $margin_persen,
            'margin_amount' => $margin_amount,
            'resiko_persen' => $resiko_persen,
            'resiko_amount' => $resiko_amount,
            'harga_final' => $harga_final,
            'profit' => $profit
        );

        $this->crud->insert($table, $data);




        //update tbl_rab_header (nilai_origin, nilai_final, profit)
        $whereOrg = array(
            'so_number' => $so_number
        );
        $a = $this->crud->sum_where('tbl_rab_detail', $whereOrg, 'harga_konversi')->row_array();
        $b = $a['harga_konversi'];

        $c = $this->crud->sum_where('tbl_rab_detail', $whereOrg, 'harga_final')->row_array();
        $d = $c['harga_final'];

        $e = $this->crud->sum_where('tbl_rab_detail', $whereOrg, 'profit')->row_array();
        $f = $e['profit'];

        $dataOrg = array(
            'nilai_origin' => $b,
            'nilai_final' => $d,
            'profit' => $f
        );
        $this->crud->update('tbl_rab_header', $dataOrg, $whereOrg);

        if ($this->db->affected_rows() == TRUE) {
            // $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!', 'nilai_final' => $d];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function delete_detail_rab()
    {
        $table = $this->input->post('table');
        $so_number = $this->input->post('so_number');


        $where = array(
            'id' => $this->input->post('id')
        );

        //hapus data
        $hapus_data = $this->crud->delete($table, $where);

        //update tbl_rab_header (nilai_origin, nilai_final, profit)
        $whereOrg = array(
            'so_number' => $so_number
        );
        $a = $this->crud->sum_where('tbl_rab_detail', $whereOrg, 'harga_konversi')->row_array();
        if (isset($a['harga_konversi'])) {
            $b = $a['harga_konversi'];
        } else {
            $b = 0;
        }


        $c = $this->crud->sum_where('tbl_rab_detail', $whereOrg, 'harga_final')->row_array();
        if (isset($c['harga_final'])) {
            $d = $c['harga_final'];
        } else {
            $d = 0;
        }

        $e = $this->crud->sum_where('tbl_rab_detail', $whereOrg, 'profit')->row_array();
        if (isset($e['profit'])) {
            $f = $e['profit'];
        } else {
            $f = 0;
        }

        $dataOrg = array(
            'nilai_origin' => $b,
            'nilai_final' => $d,
            'profit' => $f
        );
        $this->crud->update('tbl_rab_header', $dataOrg, $whereOrg);



        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!', 'nilai_final' => $d];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function print_rab()
    {
        $so_number = $_GET['so_number'];
        $where = array(
            'so_number' => $so_number
        );

        $data['header'] = $this->crud->get_where('tbl_rab_header', $where)->row_array();
        $data['detail'] = $this->crud->get_where('tbl_rab_detail', $where)->result_array();

        $this->load->view('report/printrab', $data);
    }

    public function print_rm()
    {
        $so_number = $_GET['so_number'];
        $where = array(
            'so_number' => $so_number
        );

        $data['rm'] = $this->crud->get_where('tbl_rab_material', $where)->result_array();
        $data['header'] = $this->crud->get_where('tbl_rab_header', $where)->row_array();

        $this->load->view('report/printrm', $data);
    }
}
