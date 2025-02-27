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
        $this->load->model("Crud2", "crud2");
        $this->load->model("Crud3", "crud3");
        $this->load->model("Crud4", "crud4");
    }

    public function index()
    {
        $data['title'] = 'Dashboard | Hitung RAB';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/rab');
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

    public function material()
    {
        $data['title'] = 'Material | Hitung RAB';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/material');
        $this->load->view('template/footer');
    }

    public function jasa()
    {
        $data['title'] = 'Jasa | Hitung RAB';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('rab/jasa');
        $this->load->view('template/footer');
    }

    public function pekerjaan()
    {
        $data['title'] = 'Pekerjaan | Hitung RAB';
        $data['kab_kota'] = $this->crud->get_all('mst_lokasi')->result_array();

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
        $id = $_GET['id'];
        $where = array(
            'id' => $id,
            'kode_pekerjaan' => $kode,
            'uraian_pekerjaan' => $uraian
        );
        $data['detail_pekerjaan'] = $this->crud->get_where('tbl_pekerjaan_detail', $where)->result_array();
        $data['detail_barang'] = $this->crud->get_all('mst_barang')->result_array();


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
        $getBrg = $this->crud->get_where('mst_barang', $whereBrg)->row_array();
        $getBrg['kode_barang'];
        $getBrg['nama_barang'];
        $whereLokasi = array(
            'id' => $id_mst_lokasi
        );
        $getLokasi = $this->crud->get_where('mst_lokasi', $whereLokasi)->row_array();
        $getLokasi['kab_kota'];

        $data = array(
            'id_mst_barang' => $id_mst_barang,
            'kode_barang' => $getBrg['kode_barang'],
            'nama_barang' => $getBrg['nama_barang'],
            'harga' => $harga,
            'id_mst_lokasi' => $id_mst_lokasi,
            'kab_kota' => $getLokasi['kab_kota']
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
        $getJs = $this->crud->get_where('mst_jasa', $whereJs)->row_array();
        $getJs['kode_jasa'];
        $getJs['nama_jasa'];
        $whereLokasi = array(
            'id' => $id_mst_lokasi
        );
        $getLokasi = $this->crud->get_where('mst_lokasi', $whereLokasi)->row_array();
        $getLokasi['kab_kota'];

        $data = array(
            'id_mst_jasa' => $id_mst_jasa,
            'kode_jasa' => $getJs['kode_jasa'],
            'nama_jasa' => $getJs['nama_jasa'],
            'harga' => $harga,
            'id_mst_lokasi' => $id_mst_lokasi,
            'kab_kota' => $getLokasi['kab_kota']
        );

        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];

        echo json_encode($response);
    }

    public function ajax_table_barang()
    {
        $table = 'mst_barang'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'kode_barang', 'nama_barang', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kode_barang', 'nama_barang', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_barang, nama_barang, date_created';
        $group = 'id, kode_barang, nama_barang, date_created';
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

        $column_order = array('id', 'kode_jasa', 'nama_jasa', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kode_jasa', 'nama_jasa', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_jasa, nama_jasa, date_created';
        $group = 'id, kode_jasa, nama_jasa, date_created';
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

        $column_order = array('id', 'id_mst_barang', 'kode_barang', 'nama_barang', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'id_mst_barang', 'kode_barang', 'nama_barang', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_barang, kode_barang, nama_barang, harga, id_mst_lokasi, kab_kota, date_created';
        $group = 'id, id_mst_barang, kode_barang, nama_barang, harga, id_mst_lokasi, kab_kota, date_created';
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

        $column_order = array('id', 'id_mst_jasa', 'kode_jasa', 'nama_jasa', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'id_mst_jasa', 'kode_jasa', 'nama_jasa', 'harga', 'id_mst_lokasi', 'kab_kota', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, id_mst_jasa, kode_jasa, nama_jasa, harga, id_mst_lokasi, kab_kota, date_created';
        $group = 'id, id_mst_jasa, kode_jasa, nama_jasa, harga, id_mst_lokasi, kab_kota, date_created';
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

        $column_order = array('id', 'kode_pekerjaan', 'uraian_pekerjaan', 'harga_dasar', 'kab_kota', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'kode_pekerjaan', 'uraian_pekerjaan', 'harga_dasar', 'kab_kota', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, kode_pekerjaan, uraian_pekerjaan, harga_dasar, kab_kota, date_created';
        $group = 'id, kode_pekerjaan, uraian_pekerjaan, harga_dasar, kab_kota, date_created';
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
            $row['data']['harga_dasar'] = 'Rp. ' . number_format(trim($key->harga_dasar), 2);
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
































    public function copy()
    {
        $a = $this->crud->get_all('list_scrap')->result_array();
        foreach ($a as $key => $value) {
            if ($value['weight'] != '') {
                $weight = $value['weight'];
                $id = $value['id'];

                $data = array(
                    'weight_asal' => $weight
                );
                $where = array(
                    'id' => $id
                );

                $update = $this->crud->update('list_scrap', $data, $where);

                if ($update) {
                    echo 'SUKSES';
                } else {
                    echo 'NO';
                }
            } else {
                echo 'data kosong <br>';
            }
        }
    }


    public function kodebarangscrap()
    {

        echo '<div style="padding: 20px;background-color: aqua;border: 1px solid gray;font-family: Arial, Helvetica, sans-serif;text-align: center;margin: 100 40 40 100;">HALAMAN TIDAK DITEMUKAN, BARANG YANG DISCRAP HARUS MEMILIKI RIWAYAT IN DI IT.INVENTORY<br style="margin-bottom: 30px;"><a href="/scrap/user">Kembali</a></div>';
        // $data['title'] = 'Dashboard | ILS';

        // $this->load->view('template/header', $data);
        // $this->load->view('template/sidebar');
        // $this->load->view('scrap/kode_barang');
        // $this->load->view('template/footer');
    }

    public function listapproval()
    {
        $data['title'] = 'Dashboard | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/list_approval');
        $this->load->view('template/footer');
    }

    public function listapprovaldetail()
    {
        $data['title'] = 'Dashboard | ILS';
        $data['st'] = $this->crud->get_where('detail_pengajuan', ['nomor_tiket' => $_GET["tiket"]])->row_array();
        $data['harga'] = $this->crud->get_all('mst_harga_scrap')->result_array();

        // foreach ($data['harga'] as $key => $value) {
        //     echo $value['item'];
        // }
        // die;


        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/list_approval_detail');
        $this->load->view('template/footer');
    }

    public function listinvoice()
    {
        $data['title'] = 'Dashboard | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/list_invoice');
        $this->load->view('template/footer');
    }

    public function listinvoicedetail()
    {
        $data['title'] = 'Dashboard | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/list_invoice_detail');
        $this->load->view('template/footer');
    }

    public function masterharga()
    {
        $data['title'] = 'Dashboard | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/master_harga');
        $this->load->view('template/footer');
    }

    public function packinglist()
    {
        $data['title'] = 'Dashboard | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/packing_list');
        $this->load->view('template/footer');
    }

    public function packinglistdetail()
    {
        $data['title'] = 'Dashboard | ILS';

        // $where = array(
        //     'no_packing' => $_GET['no_packing']
        // );
        // $data['detail'] = $this->crud->get_where('packing_list', $where)->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/packing_list_detail');
        $this->load->view('template/footer');
    }

    public function invoicedetil()
    {
        $data['title'] = 'Dashboard | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/invoice_detil');
        $this->load->view('template/footer');
    }

    public function status()
    {
        $data['title'] = 'Info Status | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/status');
        $this->load->view('template/footer');
    }

    public function reject()
    {
        $data['title'] = 'Barang tidak bisa scrap | ILS';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('scrap/reject');
        $this->load->view('template/footer');
    }

    public function detail_scrap()
    {
        $data['title'] = 'Detail Scrap | ILS';

        $data['tiket'] = $this->input->get('tiket');
        $data['jenis'] = $this->input->get('jenis');

        //ambil data untuk option dari mst_harga_scrap
        $data['getitem'] = $this->crud->get_select('item', 'mst_harga_scrap')->result_array();



        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        if ($this->input->get('jenis') == 'ASSET NON FABRIKASI') {
            $this->load->view('scrap/detail_asset', $data);
        } else {
            $this->load->view('scrap/detail', $data);
        }
        $this->load->view('template/footer');
    }

    public function downloadsr()
    {
        $numrow = 3;
        $no = 1;
        $tiket = $this->input->get('tiket');
        $where = array(
            'tiket_no' => $tiket
        );


        $data = $this->crud->get_where('list_scrap', $where)->result();

        $spreadsheet = new Spreadsheet();

        $excel = $spreadsheet->getActiveSheet();
        $excel->setTitle('PORTAL SCRAP');
        // $excel2 = $spreadsheet->createSheet();
        // $excel2->setTitle('HS ASAL');
        // $excel3 = $spreadsheet->createSheet();
        // $excel3->setTitle('HS SEKARANG');

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(20);
        $excel->getColumnDimension('D')->setWidth(20);
        $excel->getColumnDimension('E')->setWidth(20);
        $excel->getColumnDimension('F')->setWidth(20);
        $excel->getColumnDimension('G')->setWidth(20);
        $excel->getColumnDimension('H')->setWidth(10);
        $excel->getColumnDimension('I')->setWidth(10);
        $excel->getColumnDimension('J')->setWidth(20);
        $excel->getColumnDimension('K')->setWidth(50);
        $excel->getColumnDimension('L')->setWidth(20);
        $excel->getColumnDimension('M')->setWidth(20);
        $excel->getColumnDimension('N')->setWidth(20);
        $excel->getColumnDimension('O')->setWidth(15);
        $excel->getColumnDimension('P')->setWidth(15);
        $excel->getColumnDimension('Q')->setWidth(20);
        $excel->getColumnDimension('R')->setWidth(20);
        $excel->getColumnDimension('S')->setWidth(20);
        $excel->getColumnDimension('T')->setWidth(20);
        $excel->getColumnDimension('U')->setWidth(20);
        $excel->getColumnDimension('V')->setWidth(20);
        $excel->getColumnDimension('W')->setWidth(20);
        $excel->getColumnDimension('X')->setWidth(20);
        $excel->getColumnDimension('Y')->setWidth(40);
        $excel->getColumnDimension('Z')->setWidth(20);
        $excel->getColumnDimension('AA')->setWidth(20);
        $excel->getColumnDimension('AB')->setWidth(20);
        $excel->getColumnDimension('AC')->setWidth(20);

        $excel->getRowDimension('2')->setRowHeight(15);

        // $excel->getStyle('A1')->getFont()->setBold(true);
        // $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A2:AC2')->getFont()->setBold(true);

        // $excel->getStyle('A2:A3')->getFont()->setSize(9);
        // $excel->getStyle('A2:F2')->getFont()->setSize(10);
        // $excel->getStyle('A7')->getFont()->setSize(9);
        // $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A2:AC2')->applyFromArray($styleArray);



        $excel->setCellValue('A2', "NO");
        $excel->setCellValue('B2', "KODE BARANG");
        $excel->setCellValue('C2', "YBM CODE");
        $excel->setCellValue('D2', "NAMA BARANG");
        $excel->setCellValue('E2', "INVOICE PO");
        $excel->setCellValue('F2', "DATE INVOICE/PO");
        $excel->setCellValue('G2', "SUPPLIER");
        $excel->setCellValue('H2', "QTY");
        $excel->setCellValue('I2', "UOM");
        $excel->setCellValue('J2', "WEIGHT(KG)");
        $excel->setCellValue('K2', "REASON");
        $excel->setCellValue('L2', "TIKET NO");
        $excel->setCellValue('M2', "JENIS");
        $excel->setCellValue('N2', "KATEGORI");
        $excel->setCellValue('O2', "SECTION");
        $excel->setCellValue('P2', "ASAL");
        $excel->setCellValue('Q2', "HSCODE MASUK");
        $excel->setCellValue('R2', "BM MASUK");
        $excel->setCellValue('S2', "PPN MASUK");
        $excel->setCellValue('T2', "PPH MASUK");
        $excel->setCellValue('U2', "HSCODE SEKARANG");
        $excel->setCellValue('V2', "BM SEKARANG");
        $excel->setCellValue('W2', "PPN SEKARANG");
        $excel->setCellValue('X2', "PPH SEKARANG");
        $excel->setCellValue('Y2', "NOMOR AJU");
        $excel->setCellValue('Z2', "NOMOR DAFTAR");
        $excel->setCellValue('AA2', "TANGGAL DAFTAR");
        $excel->setCellValue('AB2', "JENIS DOC ASAL");
        $excel->setCellValue('AC2', "NOMOR SERI");


        foreach ($data as $key) {
            $hs = '';
            $bm = '';
            $ppn = '';
            $pph = '';

            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, trim($key->kode_barang));
            $excel->setCellValue('C' . $numrow, $key->ybm_code);
            $excel->setCellValue('D' . $numrow, trim($key->nama_barang));
            $excel->setCellValue('E' . $numrow, trim($key->invoice_po));
            $excel->setCellValue('F' . $numrow, $key->date_inv_po);
            $excel->setCellValue('G' . $numrow, $key->supplier);
            $excel->setCellValue('H' . $numrow, $key->qty);
            $excel->setCellValue('I' . $numrow, $key->uom);
            $excel->setCellValue('J' . $numrow, $key->weight);
            $excel->setCellValue('K' . $numrow, trim($key->reason));
            $excel->setCellValue('L' . $numrow, $key->tiket_no);
            $excel->setCellValue('M' . $numrow, trim($key->jenis));
            $excel->setCellValue('N' . $numrow, $key->kategori);
            $excel->setCellValue('O' . $numrow, $key->section);
            $excel->setCellValue('P' . $numrow, trim($key->asal));
            $excel->setCellValue('Q' . $numrow, trim($key->hscode_masuk));
            $excel->setCellValue('R' . $numrow, trim($key->bm_masuk));
            $excel->setCellValue('S' . $numrow, trim($key->ppn_masuk));
            $excel->setCellValue('T' . $numrow, trim($key->pph_masuk));

            //ambil data hscode dari sqlserver IMS
            $g = array(
                'item_code' => trim($key->kode_barang)
            );
            $v = $this->crud4->get_where('mst_item', $g)->row_array();
            if ($v == null) {
                $hs = '';
            } else {
                $hs = $v['hscode'];

                $h = array(
                    'hscode' => $hs
                );
                $w = $this->crud4->get_where_select('mst_hscode', 'bm,ppn,pph', $h)->row_array();
                if ($w == null) {
                    $bm = '';
                    $ppn = '';
                    $pph = '';
                } else {
                    $bm = $w['bm'] * 100;
                    $ppn = $w['ppn'] * 100;
                    $pph = $w['pph'] * 100;
                }
            }


            $excel->setCellValue('U' . $numrow, $hs);
            $excel->setCellValue('V' . $numrow, $bm);
            $excel->setCellValue('W' . $numrow, $ppn);
            $excel->setCellValue('X' . $numrow, $pph);
            $excel->setCellValue('Y' . $numrow, trim($key->nomor_aju));
            $excel->setCellValue('Z' . $numrow, trim($key->nomor_daftar));
            $excel->setCellValue('AA' . $numrow, $key->tanggal_daftar);
            $excel->setCellValue('AB' . $numrow, trim($key->jenis_doc));
            $excel->setCellValue('AC' . $numrow, trim($key->nomor_seri));
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':AC' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':AC' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }

        $file_name = 'downloadsr-' . $tiket . '.xlsx';

        //format excel baru
        // $writer = new Xlsx($spreadsheet);
        // $writer->save($file_name);

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function downloadsruser()
    {
        $numrow = 3;
        $no = 1;
        $tiket = $this->input->get('tiket');
        $where = array(
            'tiket_no' => $tiket
        );

        // echo $tiket;
        // die;


        $data = $this->crud->get_where('list_scrap', $where)->result();

        // $d = $this->crud->get_where('header_list_scrap', $where)->row_array();

        $spreadsheet = new Spreadsheet();
        $excel = $spreadsheet->getActiveSheet();

        //styling
        $excel->getColumnDimension('A')->setWidth(5);
        $excel->getColumnDimension('B')->setWidth(20);
        $excel->getColumnDimension('C')->setWidth(10);
        $excel->getColumnDimension('D')->setWidth(40);
        $excel->getColumnDimension('E')->setWidth(15);
        $excel->getColumnDimension('F')->setWidth(20);
        $excel->getColumnDimension('G')->setWidth(20);
        $excel->getColumnDimension('H')->setWidth(10);
        $excel->getColumnDimension('I')->setWidth(10);
        $excel->getColumnDimension('J')->setWidth(20);
        $excel->getColumnDimension('K')->setWidth(50);
        $excel->getColumnDimension('L')->setWidth(20);
        $excel->getColumnDimension('M')->setWidth(20);
        $excel->getColumnDimension('N')->setWidth(20);
        $excel->getColumnDimension('O')->setWidth(15);
        $excel->getColumnDimension('P')->setWidth(15);
        $excel->getColumnDimension('Q')->setWidth(40);
        $excel->getColumnDimension('R')->setWidth(20);
        $excel->getColumnDimension('S')->setWidth(20);
        $excel->getColumnDimension('T')->setWidth(20);
        $excel->getColumnDimension('U')->setWidth(20);
        $excel->getColumnDimension('V')->setWidth(20);
        $excel->getColumnDimension('W')->setWidth(20);
        $excel->getColumnDimension('X')->setWidth(20);
        $excel->getColumnDimension('Y')->setWidth(10);

        $excel->getRowDimension('2')->setRowHeight(15);

        // $excel->getStyle('A1')->getFont()->setBold(true);
        // $excel->getStyle('A5')->getFont()->setBold(true);
        $excel->getStyle('A2:Y2')->getFont()->setBold(true);

        // $excel->getStyle('A2:A3')->getFont()->setSize(9);
        // $excel->getStyle('A2:F2')->getFont()->setSize(10);
        // $excel->getStyle('A7')->getFont()->setSize(9);
        // $excel->getStyle('A5')->getFont()->setSize(10);

        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel->getStyle('A2:Y2')->applyFromArray($styleArray);

        $excel->setCellValue('A2', "NO");
        $excel->setCellValue('B2', "KODE BARANG");
        $excel->setCellValue('C2', "YBM CODE");
        $excel->setCellValue('D2', "NAMA BARANG");
        $excel->setCellValue('E2', "INVOICE PO");
        $excel->setCellValue('F2', "DATE INVOICE/PO");
        $excel->setCellValue('G2', "SUPPLIER");
        $excel->setCellValue('H2', "QTY");
        $excel->setCellValue('I2', "UOM");
        $excel->setCellValue('J2', "WEIGHT(KG)");
        $excel->setCellValue('K2', "REASON");
        $excel->setCellValue('L2', "TIKET NO");
        $excel->setCellValue('M2', "JENIS");
        $excel->setCellValue('N2', "KATEGORI");
        $excel->setCellValue('O2', "SECTION");
        $excel->setCellValue('P2', "ASAL");
        $excel->setCellValue('Q2', "NOMOR AJU ASAL");
        $excel->setCellValue('R2', "NOMOR DAFTAR ASAL");
        $excel->setCellValue('S2', "TANGGAL DAFTAR ASAL");
        $excel->setCellValue('T2', "JENIS DOC ASAL");
        $excel->setCellValue('U2', "ID ASSET");
        $excel->setCellValue('V2', "ASSET NUMBER");
        $excel->setCellValue('W2', "ACQUISITION DATE");
        $excel->setCellValue('X2', "BOOK VALUE");
        $excel->setCellValue('Y2', "B3");

        foreach ($data as $key) {

            $excel->setCellValue('A' . $numrow, $no);
            $excel->setCellValue('B' . $numrow, trim($key->kode_barang));
            $excel->setCellValue('C' . $numrow, trim($key->ybm_code));
            $excel->setCellValue('D' . $numrow, trim($key->nama_barang));
            $excel->setCellValue('E' . $numrow, trim($key->invoice_po));
            $excel->setCellValue('F' . $numrow, $key->date_inv_po);
            $excel->setCellValue('G' . $numrow, trim($key->supplier));
            $excel->setCellValue('H' . $numrow, $key->qty);
            $excel->setCellValue('I' . $numrow, trim($key->uom));
            $excel->setCellValue('J' . $numrow, $key->weight);
            $excel->setCellValue('K' . $numrow, trim($key->reason));
            $excel->setCellValue('L' . $numrow, trim($key->tiket_no));
            $excel->setCellValue('M' . $numrow, trim($key->jenis));
            $excel->setCellValue('N' . $numrow, trim($key->kategori));
            $excel->setCellValue('O' . $numrow, trim($key->section));
            $excel->setCellValue('P' . $numrow, trim($key->asal));
            $excel->setCellValue('Q' . $numrow, trim($key->nomor_aju));
            $excel->setCellValue('R' . $numrow, trim($key->nomor_daftar));
            $excel->setCellValue('S' . $numrow, $key->tanggal_daftar);
            $excel->setCellValue('T' . $numrow, trim($key->jenis_doc));
            $excel->setCellValue('U' . $numrow, trim($key->id_asset));
            $excel->setCellValue('V' . $numrow, trim($key->asset_number));
            $excel->setCellValue('W' . $numrow, trim($key->acquisition_date));
            $excel->setCellValue('X' . $numrow, trim($key->book_value));
            $excel->setCellValue('Y' . $numrow, trim($key->b3));
            //IMPLEMENTASI ARRAY CELL
            $excel->getStyle('A' . $numrow . ':Y' . $numrow)->applyFromArray($styleArray);
            $excel->getStyle('A' . $numrow . ':Y' . $numrow)->getFont()->setSize(10);

            $numrow++;
            $no++;
        }
        $file_name = 'downloadsrfwruser-' . $tiket . '.xlsx';

        //format excel baru
        // $writer = new Xlsx($spreadsheet);
        // $writer->save($file_name);

        //format excel lama
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($file_name);
        //end format excel lama

        header('Content-Type: application/x-www-form-urlencoded');
        header('Content-Transfer-Encoding: Binary');
        header("Content-disposition: attachment; filename=\"" . $file_name . "\"");
        readfile($file_name);
        unlink($file_name);
        exit;
    }

    public function ajax_table_scrap()
    {

        $table = 'header_list_scrap'; //nama tabel dari database

        //jika user adalah EXIM tampilkan semua list all section

        // if ($this->session->userdata('section') == 'EXIM' || $this->session->userdata('section') == 'PGA-ADM' || $this->session->userdata('section') == 'FATP')
        //     $where = null;
        // else
        //     $where = array(
        //         'section' => $this->session->userdata('section')
        //     );

        $where = null;

        $column_order = array('id', 'nomor_tiket', 'status', 'jenis', 'kategori', 'date_created', 'section', 'asal', 'cetak_pdf', 'no_sr', 'file_bc', 'file_sr', 'kategori_b3', 'file_b3', 'invoice_flag', 'total_timbang', 'jenis_packing', 'jumlah_packing'); //field yang ada di table 
        $column_search = array('id', 'nomor_tiket', 'status', 'jenis', 'kategori', 'date_created', 'section', 'asal', 'cetak_pdf', 'no_sr', 'file_bc', 'file_sr', 'kategori_b3', 'file_b3', 'invoice_flag', 'total_timbang', 'jenis_packing', 'jumlah_packing'); //field yang diizin untuk pencarian 
        $select = 'id, nomor_tiket, status, jenis, kategori, date_created, section,asal,cetak_pdf,no_sr,file_bc,file_sr,kategori_b3, file_b3, invoice_flag, total_timbang, jenis_packing, jumlah_packing';
        $group = 'id, nomor_tiket, status, jenis, kategori, date_created, section,asal,cetak_pdf,no_sr,file_bc,file_sr,kategori_b3, file_b3, invoice_flag, total_timbang, jenis_packing, jumlah_packing';
        $order = array('date_create' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['nomor_tiket'] = trim($key->nomor_tiket);
            $row['data']['status'] = trim($key->status);
            $row['data']['jenis'] = trim($key->jenis);
            $row['data']['kategori'] = trim($key->kategori);
            $row['data']['section'] = trim($key->section);
            $row['data']['asal'] = trim($key->asal);
            $row['data']['cetak_pdf'] = trim($key->cetak_pdf);
            $row['data']['no_sr'] = trim($key->no_sr);
            $row['data']['file_bc'] = trim($key->file_bc);
            $row['data']['file_sr'] = trim($key->file_sr);
            $row['data']['kategori_b3'] = trim($key->kategori_b3);
            $row['data']['file_b3'] = trim($key->file_b3);
            $row['data']['invoice_flag'] = trim($key->invoice_flag);
            $row['data']['total_timbang'] = trim($key->total_timbang);
            $row['data']['jenis_packing'] = trim($key->jenis_packing);
            $row['data']['jumlah_packing'] = trim($key->jumlah_packing);
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



    // public function ajax_table_pengajuan_old()
    // {

    //     $table = 'tbl_pengajuan_scrap'; //nama tabel dari database


    //     $where = null;

    //     $column_order = array('id', 'nomor_tiket', 'username', 'section', 'status_approval', 'kategori', 'file_location', 'remark_exim', 'evidence', 'remark_pga', 'b3', 'date_created'); //field yang ada di table 
    //     $column_search = array('id', 'nomor_tiket', 'username', 'section', 'status_approval', 'kategori', 'file_location', 'remark_exim', 'evidence', 'remark_pga', 'b3', 'date_created'); //field yang diizin untuk pencarian 
    //     $select = 'id, nomor_tiket, username, section, status_approval, kategori, file_location, remark_exim, evidence, remark_pga, b3, date_created';
    //     $group = 'id, nomor_tiket, username, section, status_approval, kategori, file_location, remark_exim, evidence, remark_pga, b3, date_created';
    //     $order = array('id' => 'desc'); // default order 
    //     $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
    //     $data = array();
    //     $no = $_POST['start'];
    //     foreach ($list as $key) {
    //         $no++;
    //         $row = array();
    //         $row['data']['no'] = $no;
    //         $row['data']['id'] = trim($key->id);
    //         $row['data']['nomor_tiket'] = trim($key->nomor_tiket);
    //         $row['data']['username'] = trim($key->username);
    //         $row['data']['section'] = trim($key->section);
    //         $row['data']['status_approval'] = trim($key->status_approval);
    //         $row['data']['kategori'] = trim($key->kategori);
    //         $row['data']['file_location'] = trim($key->file_location);
    //         $row['data']['remark_exim'] = trim($key->remark_exim);
    //         $row['data']['evidence'] = trim($key->evidence);
    //         $row['data']['remark_pga'] = trim($key->remark_pga);
    //         $row['data']['b3'] = trim($key->b3);
    //         $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));

    //         $data[] = $row;
    //     }

    //     $output = array(
    //         "draw" => $_POST['draw'],
    //         "recordsTotal" => $this->crud->count_all($table),
    //         "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group),
    //         "data" => $data,
    //         "query" => $this->db->last_query(),
    //         // "list_data" => var_dump($list)
    //     );
    //     //output to json format
    //     echo json_encode($output);
    // }

    public function ajax_table_pengajuan()
    {
        $table = 'header_pengajuan'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'nomor_tiket', 'section', 'date_created', 'no_sr'); //field yang ada di table 
        $column_search = array('id', 'nomor_tiket', 'section', 'date_created', 'no_sr'); //field yang diizin untuk pencarian 
        $select = 'id, nomor_tiket, section, date_created,no_sr';
        $group = 'id, nomor_tiket, section, date_created,no_sr';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['nomor_tiket'] = trim($key->nomor_tiket);
            $row['data']['section'] = trim($key->section);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));
            $row['data']['no_sr'] = trim($key->no_sr);

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

    public function ajax_table_harga()
    {
        $table = 'mst_harga_scrap'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'item', 'harga', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'item', 'harga', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, item, harga, date_created';
        $group = 'id, item, harga, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['item'] = trim($key->item);
            $row['data']['harga'] = 'Rp. ' . number_format(trim($key->harga), 2);
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

    public function ajax_table_packing_header()
    {
        $table = 'header_packing_list'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'no_packing', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'no_packing', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, no_packing, date_created';
        $group = 'id, no_packing, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['no_packing'] = trim($key->no_packing);
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

    public function ajax_table_packing()
    {
        $table = 'packing_list'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'nomor_tiket', 'jumlah_packing', 'berat_timbang', 'date_created', 'jenis_packing', 'no_packing'); //field yang ada di table 
        $column_search = array('id', 'nomor_tiket', 'jumlah_packing', 'berat_timbang', 'date_created', 'jenis_packing', 'no_packing'); //field yang diizin untuk pencarian 
        $select = 'id, nomor_tiket, jumlah_packing, berat_timbang, date_created, jenis_packing, no_packing';
        $group = 'id, nomor_tiket, jumlah_packing, berat_timbang, date_created, jenis_packing, no_packing';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['nomor_tiket'] = trim($key->nomor_tiket);
            $row['data']['jumlah_packing'] = trim($key->jumlah_packing);
            $row['data']['berat_timbang'] = trim($key->berat_timbang);
            $row['data']['jenis_packing'] = trim($key->jenis_packing);
            $row['data']['no_packing'] = trim($key->no_packing);
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

    public function ajax_table_pengajuan_detail()
    {
        $table = 'detail_pengajuan'; //nama tabel dari database

        $where = array(
            'nomor_tiket' => $this->input->post('tiket')
        );

        $column_order = array('id', 'section', 'nomor_tiket', 'nama_barang', 'invoice_po', 'date_inv_po', 'harga', 'weight', 'uom', 'bc', 'b3', 'photo', 'evidence_bc', 'remark_pga', 'remark_exim', 'date_created', 'remark_user', 'file_manifest', 'no_sr', 'amount'); //field yang ada di table 
        $column_search = array('id', 'section', 'nomor_tiket', 'nama_barang', 'invoice_po', 'date_inv_po', 'harga', 'weight', 'uom', 'bc', 'b3', 'photo', 'evidence_bc', 'remark_pga', 'remark_exim', 'date_created', 'remark_user', 'file_manifest', 'no_sr', 'amount'); //field yang diizin untuk pencarian 
        $select = 'id, section, nomor_tiket, nama_barang, , invoice_po, date_inv_po,harga, weight, uom, bc, b3, photo, evidence_bc, remark_pga, remark_exim, date_created, remark_user, file_manifest, no_sr, amount';
        $group = 'id, section, nomor_tiket, nama_barang, , invoice_po, date_inv_po,harga, weight, uom, bc, b3, photo, evidence_bc, remark_pga, remark_exim, date_created, remark_user, file_manifest, no_sr, amount';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['section'] = trim($key->section);
            $row['data']['nomor_tiket'] = trim($key->nomor_tiket);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['invoice_po'] = trim($key->invoice_po);
            $row['data']['date_inv_po'] = trim($key->date_inv_po);
            $row['data']['harga'] = trim($key->harga);
            $row['data']['weight'] = trim($key->weight);
            $row['data']['uom'] = trim($key->uom);
            $row['data']['bc'] = trim($key->bc);
            $row['data']['b3'] = trim($key->b3);
            $row['data']['photo'] = trim($key->photo);
            $row['data']['evidence_bc'] = trim($key->evidence_bc);
            $row['data']['remark_pga'] = trim($key->remark_pga);
            $row['data']['remark_exim'] = trim($key->remark_exim);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));
            $row['data']['remark_user'] = trim($key->remark_user);
            $row['data']['file_manifest'] = trim($key->file_manifest);
            $row['data']['no_sr'] = trim($key->no_sr);
            $row['data']['amount'] = trim($key->amount);

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

    public function ajax_table_reject()
    {
        $table = 'histori_status'; //nama tabel dari database

        $where = array(
            'status_dokumen' => 'DOKUMEN ASAL TIDAK DITEMUKAN'
        );

        $column_order = array('kode_barang', 'nama_barang', 'invoice_po', 'section'); //field yang ada di table 
        $column_search = array('kode_barang', 'nama_barang', 'invoice_po', 'section'); //field yang diizin untuk pencarian 
        $select = 'kode_barang, nama_barang, invoice_po, section';
        $group = 'kode_barang, nama_barang, invoice_po, section';
        $order = array('kode_barang' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['kode_barang'] = trim($key->kode_barang);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['invoice_po'] = trim($key->invoice_po);
            $row['data']['section'] = trim($key->section);

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

    public function ajax_table_scrap_detail()
    {

        $table = 'list_scrap'; //nama tabel dari database
        $tiket = $this->input->post('tiket');
        if ($this->session->userdata('section') == 'EXIM' || $this->session->userdata('section') == 'PGA-ADM' || $this->session->userdata('section') == 'FATP' || $this->session->userdata('section') == 'MTC') {
            $where = array(
                'tiket_no' => $tiket
            );
        } else {
            $where = array(
                'tiket_no' => $tiket,
                'section' => $this->session->userdata('section')
            );
        }

        $column_order = array('id', 'kode_barang', 'ybm_code', 'nama_barang', 'invoice_po', 'supplier', 'qty', 'uom', 'weight', 'date_inv_po', 'reason', 'date_created', 'status_dokumen', 'tiket_no', 'jenis', 'kategori', 'batch', 'section', 'photo', 'asal', 'file_location', 'hscode_masuk', 'bm_masuk', 'ppn_masuk', 'pph_masuk', 'hscode_sekarang', 'bm_sekarang', 'ppn_sekarang', 'pph_sekarang', 'nomor_aju', 'nomor_daftar', 'jenis_doc', 'tanggal_daftar', 'nomor_seri', 'id_asset', 'asset_number', 'acquisition_date', 'book_value', 'b3', 'reject', 'file_manifest', 'weight_timbang', 'weight_asal', 'kategori_harga', 'invoice_po_invoice', 'nama_barang_fa'); //field yang ada di table 
        $column_search = array('id', 'kode_barang', 'ybm_code', 'nama_barang', 'invoice_po', 'supplier', 'qty', 'uom', 'weight', 'date_inv_po', 'reason', 'date_created', 'status_dokumen', 'tiket_no', 'jenis', 'kategori', 'batch', 'section', 'photo', 'asal', 'file_location', 'hscode_masuk', 'bm_masuk', 'ppn_masuk', 'pph_masuk', 'hscode_sekarang', 'bm_sekarang', 'ppn_sekarang', 'pph_sekarang', 'nomor_aju', 'nomor_daftar', 'jenis_doc', 'tanggal_daftar', 'nomor_seri', 'id_asset', 'asset_number', 'acquisition_date', 'book_value', 'b3', 'reject', 'file_manifest', 'weight_timbang', 'weight_asal', 'kategori_harga', 'invoice_po_invoice', 'nama_barang_fa'); //field yang diizin untuk pencarian 
        $select = 'id, kode_barang, ybm_code, nama_barang, invoice_po, supplier, qty,uom,weight,date_inv_po,reason,date_created,status_dokumen,tiket_no,jenis,kategori,batch,section,photo, asal, file_location, hscode_masuk,bm_masuk,ppn_masuk,pph_masuk,hscode_sekarang,bm_sekarang,ppn_sekarang,pph_sekarang,nomor_aju,nomor_daftar,jenis_doc,tanggal_daftar,nomor_seri,id_asset,asset_number,acquisition_date,book_value,b3,reject,file_manifest, weight_timbang, weight_asal, kategori_harga, invoice_po_invoice, nama_barang_fa';
        // $group = 'kode_barang, ybm_code, nama_barang, invoice_po, supplier, qty,uom,weight,date_inv_po,reason,date_created,status_dokumen,tiket_no,jenis,kategori,batch,section,photo';
        $order = array('date_create' => 'asc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group = null);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['kode_barang'] = trim($key->kode_barang);
            $row['data']['ybm_code'] = trim($key->ybm_code);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['invoice_po'] = trim($key->invoice_po);
            $row['data']['supplier'] = trim($key->supplier);
            $row['data']['qty'] = trim($key->qty);
            $row['data']['uom'] = trim($key->uom);
            $row['data']['weight'] = trim($key->weight);
            $row['data']['date_inv_po'] = date('d-M-Y', strtotime($key->date_inv_po));
            $row['data']['reason'] = trim($key->reason);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));
            $row['data']['status_dokumen'] = trim($key->status_dokumen);
            $row['data']['tiket_no'] = trim($key->tiket_no);
            $row['data']['jenis'] = trim($key->jenis);
            $row['data']['kategori'] = trim($key->kategori);
            $row['data']['batch'] = trim($key->batch);
            $row['data']['section'] = trim($key->section);
            $row['data']['photo'] = trim($key->photo);
            $row['data']['asal'] = trim($key->asal);
            $row['data']['file_location'] = trim($key->file_location);
            $row['data']['hscode_masuk'] = trim($key->hscode_masuk);
            $row['data']['bm_masuk'] = trim($key->bm_masuk);
            $row['data']['ppn_masuk'] = trim($key->ppn_masuk);
            $row['data']['pph_masuk'] = trim($key->pph_masuk);
            $row['data']['hscode_sekarang'] = trim($key->hscode_sekarang);
            $row['data']['bm_sekarang'] = trim($key->bm_sekarang);
            $row['data']['ppn_sekarang'] = trim($key->ppn_sekarang);
            $row['data']['pph_sekarang'] = trim($key->pph_sekarang);
            $row['data']['nomor_aju'] = trim($key->nomor_aju);
            $row['data']['nomor_daftar'] = trim($key->nomor_daftar);
            $row['data']['jenis_doc'] = trim($key->jenis_doc);
            $row['data']['tanggal_daftar'] = trim($key->tanggal_daftar);
            $row['data']['nomor_seri'] = trim($key->nomor_seri);
            $row['data']['id_asset'] = trim($key->id_asset);
            $row['data']['asset_number'] = trim($key->asset_number);
            $row['data']['acquisition_date'] = trim($key->acquisition_date);
            $row['data']['book_value'] = trim($key->book_value);
            $row['data']['b3'] = trim($key->b3);
            $row['data']['reject'] = trim($key->reject);
            $row['data']['file_manifest'] = trim($key->file_manifest);
            $row['data']['weight_timbang'] = trim($key->weight_timbang);
            $row['data']['weight_asal'] = trim($key->weight_asal);
            $row['data']['kategori_harga'] = trim($key->kategori_harga);
            $row['data']['invoice_po_invoice'] = trim($key->invoice_po_invoice);
            $row['data']['nama_barang_fa'] = trim($key->nama_barang_fa);

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->crud->count_all($table),
            "recordsFiltered" => $this->crud->count_filtered($table, $select, $column_order, $column_search, $order, $where, $group = null),
            "data" => $data,
            "query" => $this->db->last_query(),
            // "list_data" => var_dump($list)
        );
        //output to json format
        echo json_encode($output);
    }

    public function dunlud($excel)
    {
        force_download('application/template/' . $excel, NULL);
    }

    public function dunlud_sr()
    {
        $name = $this->uri->segment(3);
        $data = file_get_contents("assets/sr/" . $name);
        force_download($name, $data);
    }

    public function dunlud_evidence()
    {
        $name = $this->uri->segment(3);
        $data = file_get_contents("assets/nobc/evidence/" . $name);
        force_download($name, $data);
    }

    public function dunlud_bc()
    {
        $name = $this->uri->segment(3);
        $data = file_get_contents("assets/bc/" . $name);
        force_download($name, $data);
    }

    public function dunlud_pengajuan()
    {
        $name = $this->uri->segment(3);
        $data = file_get_contents("temp/pengajuan/" . $name);
        force_download($name, $data);
    }

    public function dunlud_b3()
    {
        $name = $this->uri->segment(3);
        $data = file_get_contents("assets/b3/" . $name);
        force_download($name, $data);
    }

    public function dunlud_pdf()
    {
        $filepath = $_GET['file_path'];

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        flush(); // Flush system output buffer
        readfile($filepath);
        die();
    }

    public function import_excel()
    {
        //prevent dulu apakah ada open tiket ?
        //generate nomor tiket

        //INI UNTUK MEMBATASI PENGAJUAN SCRAP JIKA MASIH ADA TIKET OPEN

        // $where_section = array(
        //     'section' => $this->session->userdata('section'),
        //     'status !=' => 'SELESAI'
        // );
        // $getTiket = $this->Crud->get_all_limit_where('header_list_scrap', $where_section)->num_rows();
        // if ($getTiket > 0) { //JIKA ADA YANG BELUM SELESAI
        //     // $response = ['status' => 'failed', 'message' => 'SEK DILUK! LAGI DIBETULIN'];
        //     $response = ['status' => 'failed', 'message' => 'PENGAJUAN SCRAP SEBELUMNYA BELUM SELESAI!'];
        //     echo json_encode($response);
        //     die;
        // }




        //buat nomor tiket
        // $getDataTiket = $this->Crud->get_all_limit('header_list_scrap')->row_array();
        // if ($getDataTiket > 0) {
        //     $a = explode("-", trim($getDataTiket['nomor_tiket']));
        //     $no = $a[1] + 1;
        // } else {
        //     $no = '1000';
        // }
        //ambil nomor tiket
        $getTiket = $this->Crud->get_all('mst_nomor_tiket')->row_array();
        $no = $getTiket['nomor'] + 1;
        // echo $no;
        // die;

        //buat nomor SR
        //lihat bulan
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m');
        $thn = date('Y');
        if ($bulan == '01') {
            $conv = 'I';
        } elseif ($bulan == '02') {
            $conv = 'II';
        } elseif ($bulan == '03') {
            $conv = 'III';
        } elseif ($bulan == '04') {
            $conv = 'IV';
        } elseif ($bulan == '05') {
            $conv = 'V';
        } elseif ($bulan == '06') {
            $conv = 'VI';
        } elseif ($bulan == '07') {
            $conv = 'VII';
        } elseif ($bulan == '08') {
            $conv = 'VIII';
        } elseif ($bulan == '09') {
            $conv = 'IX';
        } elseif ($bulan == '10') {
            $conv = 'X';
        } elseif ($bulan == '11') {
            $conv = 'XI';
        } else {
            $conv = 'XII';
        }

        $getNumberSr = $this->Crud->get_all('mst_number')->row_array();
        $seq = $getNumberSr['number'] + 1;
        $nombor = $seq . '/' . $this->session->userdata('section') . '/SCRAP/JAI/' . $conv . '/' . $thn;
        //selesai buat nomor



        $kategori = $this->input->post('kategori');
        $jenis = $this->input->post('jenis');
        $asal = $this->input->post('asal');

        // echo $kategori . '<br>';
        // echo $jenis . '<br>';
        // echo $asal . '<br>';
        // die;


        $this->load->library('upload');
        $file_name = uniqid();
        $ext = pathinfo($_FILES['file_excel']['name'], PATHINFO_EXTENSION);

        $config['upload_path']          = './temp/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['max_size']             = 2048;
        $config['overwrite']            = true;
        $config['file_name']            = $file_name;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if (!$this->upload->do_upload('file_excel')) {
            $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
            echo json_encode($response);
            die;
        }

        $data_upload = $this->upload->data();
        if ($ext == "xls")
            $excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        if ($ext == "xlsx")
            $excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        $loadexcel = $excelreader->load('temp/'  . $file_name . '.' . $ext); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

        $data = array();

        $numrow = 0;
        foreach ($sheet as $row) {
            if ($numrow > 10 && $row['C'] != '') {

                // echo $numrow;
                // die;

                //cek dulu apakah kode barang sudah terdaftar di PS System
                // $t = $this->crud3->get_where('mst_barang', ['kode_barang' => (string)$row['C']])->row_array();
                // if (!isset($t['kode_barang'])) {
                //     $response = ['status' => 'kodebarang', 'message' => 'KODE BARANG ' . $row['C'] . ' Tidak ditemukan di Master Barang ILS/PS System, Silahkan daftarkan terlebih dahulu'];
                //     echo json_encode($response);
                //     die;
                // }

                //cek dulu apakah kode barang sudah terdaftar di PS System
                // $ta = $this->crud2->get_where('mst_barang', ['kode_barang' => (string)$row['C']])->row_array();
                // if (!isset($ta['kode_barang'])) {
                //     $response = ['status' => 'kodebarang', 'message' => 'KODE BARANG ' . $row['C'] . ' Tidak ditemukan di Master Barang ILS/PS System, Silahkan daftarkan terlebih dahulu'];
                //     echo json_encode($response);
                //     die;
                // }
                //end cek

                //cek dulu apakah kode barang sudah terdaftar di mst_item
                $ta = $this->crud4->get_where('mst_item', ['item_code' => (string)$row['C']])->row_array();
                // var_dump($ta);
                // die;

                if (!isset($ta['item_code'])) {
                    $response = ['status' => 'kodebarang', 'message' => 'KODE BARANG ' . $row['C'] . ' Tidak ditemukan di Master Barang ILS System, Konsultasikan ke Tim ILS'];
                    echo json_encode($response);
                    die;
                }
                //end cek
                if ($jenis == 'FABRIKASI') {
                    //konversi dulu id section ke nama section
                    $section = 'PE';
                } else if ($jenis == 'ASSET NON FABRIKASI') {
                    $section = $this->session->userdata('section');
                } else if ($jenis == 'RAW MATERIAL') {
                    $section = $this->session->userdata('section');
                } else {
                    $getSection = $this->crud4->get_where('mst_section', ['id' => (string)$row['D']])->row_array();
                    $section = $getSection['name'];
                }
                // echo $section;
                // die;


                //cek dulu apakah ada kolom yang kosong
                if ($jenis == 'FABRIKASI' || $jenis == 'ASSET NON FABRIKASI') {
                    if ($row['C'] == '' || $row['D'] == '' || $row['F'] == '' || $row['G'] == '' || $row['H'] == '' || $row['I'] == '' || $row['J'] == '' || $row['K'] == '' || $row['L'] == '' || $row['M'] == '' || $row['N'] == '') {
                        $response = ['status' => 'kodebarang', 'message' => 'Silahkan cek kembali file excel, ada kolom yang wajib di isi tetapi tidak di sisi atau kosong!'];
                        echo json_encode($response);
                        die;
                    }

                    //cek dulu apakah sudah ada data di ILS SCRAP
                    if ($jenis == 'FABRIKASI') {
                        $wheree = array(
                            'asset_id' => (string)$row['D'],
                            'status !=' => 'scrap'
                        );

                        $tasi = $this->crud4->get_where('inv_fab_asset_id', $wheree)->row_array();
                        $fab_asset_id = $tasi['fab_asset_id'];


                        if (!isset($tasi['asset_id'])) {
                            $response = ['status' => 'id_asset', 'message' => 'ID ASSET ' . $row['D'] . ' Tidak ditemukan di DAFTAR FABRIKASI (ILS) atau sudah pernah di scrap'];
                            echo json_encode($response);
                            die;
                        }

                        $det_tas = $this->crud4->get_where('inv_fab_asset_detail', ['fab_asset_id' => $fab_asset_id])->result_array();
                        $item_code_tas = array_column($det_tas, "item_code");
                        if (!in_array($row['C'], $item_code_tas)) {
                            $response = ['status' => 'Unavailable', 'message' => 'KODE BARANG ' . $row['C'] . ' Tidak ditemukan di DAFTAR FABRIKASI (ILS)'];
                            echo json_encode($response);
                            die;
                        }
                    } else {
                        $whereee = array(
                            'asset_id' => (string)$row['D']
                        );
                        $tas = $this->crud4->get_where('inv_asset', $whereee)->row_array();
                        if (!isset($tas['asset_id'])) {
                            $response = ['status' => 'id_asset', 'message' => 'ID ASSET ' . $row['D'] . ' Tidak ditemukan di DAFTAR ASSET (ILS)'];
                            echo json_encode($response);
                            die;
                        }
                    }
                    //end cek

                    array_push($data, array(
                        'kode_barang' => (string)$row['C'],
                        'id_asset' => (string)$row['D'],
                        'asset_number' => (string)$row['E'],
                        'nama_barang' => (string)$row['F'],
                        'invoice_po' => (string)$row['G'],
                        'invoice_po_invoice' => (string)$row['H'],
                        'supplier' => (string)$row['I'],
                        'qty' => $row['J'],
                        'uom' => (string)$row['K'],
                        'weight' => (string)$row['L'],
                        'weight_asal' => $row['L'],
                        'date_inv_po' => date('Y-m-d', strtotime($row['M'])),
                        'reason' => (string)$row['N'],
                        'status_dokumen' => 'LIST SCRAP',
                        'tiket_no' => 'TIKET-' . $no,
                        'jenis' => $jenis,
                        'section' => $this->session->userdata('section'),
                        'kategori' => $kategori,
                        'batch' => $file_name,
                        'asal' => $asal,
                        'b3' => '',
                    ));
                } else if ($jenis == 'RAW MATERIAL' || $jenis == 'INVENTORY') {
                    if ($row['C'] == '' || $row['D'] == '' || $row['F'] == '' || $row['G'] == '' || $row['H'] == '' || $row['I'] == '' || $row['J'] == '' || $row['K'] == '' || $row['L'] == '' || $row['M'] == '' || $row['N'] == '') {
                        $response = ['status' => 'kodebarang', 'message' => 'Silahkan cek kembali file excel, ada kolom yang wajib di isi tetapi tidak di sisi atau kosong!'];
                        echo json_encode($response);
                        die;
                    }

                    //cek dulu apakah sudah ada data di ILS SCRAP
                    if ($jenis == 'INVENTORY') {
                        $dmn = array(
                            'item_code' => (string)$row['C']
                        );

                        $tasih = $this->crud4->get_where('mst_item', $dmn)->row_array();
                        $item_id = $tasih['id'];
                        // echo $item_id;
                        // die;

                        $dmn2 = array(
                            'item_id' => $item_id,
                            'section_id' => $row['D']
                        );

                        $getItem = $this->crud4->get_where_date('inv_sp_stock_jai', $dmn2)->row_array();
                        $stock_broken = $getItem['stock_broken'];
                        // echo $stock_broken;
                        // die;

                        // echo $stock_broken;
                        // die;

                        if (!isset($getItem['item_name'])) {
                            $response = ['status' => 'BARANG TIDAK DITEMUKAN', 'message' => 'Barang ' . $row['F'] . ' tidak ditemukan di stok broken di ILS'];
                            echo json_encode($response);
                            die;
                        }

                        if ($row['J'] > $stock_broken) {
                            $response = ['status' => 'JUMLAH', 'message' => 'Barang ' . $row['F'] . ' qty yang akan di scrap melebihi stock broken di ILS (Stock Control)'];
                            echo json_encode($response);
                            die;
                        }



                        // $det_tas = $this->crud4->get_where('inv_fab_asset_detail', ['fab_asset_id' => $fab_asset_id])->result_array();
                        // $item_code_tas = array_column($det_tas, "item_code");
                        // if (!in_array($row['C'], $item_code_tas)) {
                        //     $response = ['status' => 'Unavailable', 'message' => 'KODE BARANG ' . $row['C'] . ' Tidak ditemukan di DAFTAR FABRIKASI (ILS)'];
                        //     echo json_encode($response);
                        //     die;
                        // }
                    }
                    //end cek

                    // array_push($data, array(
                    //     'kode_barang' => (string)$row['C'],
                    //     'section' => $section,
                    //     'ybm_code' => (string)$row['E'],
                    //     'nama_barang' => (string)$row['F'],
                    //     'invoice_po' => (string)$row['G'],
                    //     'invoice_po_invoice' => (string)$row['H'],
                    //     'supplier' => (string)$row['I'],
                    //     'qty' => $row['J'],
                    //     'uom' => (string)$row['K'],
                    //     'weight' => (string)$row['L'],
                    //     'weight_asal' => $row['L'],
                    //     'date_inv_po' => date('Y-m-d', strtotime($row['M'])),
                    //     'reason' => (string)$row['N'],
                    //     'status_dokumen' => 'LIST SCRAP',
                    //     'tiket_no' => 'TIKET-' . $no,
                    //     'jenis' => $jenis,
                    //     'kategori' => $kategori,
                    //     'batch' => $file_name,
                    //     'asal' => $asal,
                    //     'b3' => 'NON B3',
                    // ));

                    array_push($data, array(
                        'kode_barang' => (string)$row['C'],
                        'section' => $section,
                        'ybm_code' => (string)$row['E'],
                        'nama_barang' => (string)$row['F'],
                        'invoice_po' => (string)$row['G'],
                        'invoice_po_invoice' => (string)$row['H'],
                        'supplier' => (string)$row['I'],
                        'qty' => $row['J'],
                        'uom' => (string)$row['K'],
                        // 'weight' => preg_match('/^[0-9]+(?:\.[0-9]+)?$/', $row['L']),
                        // 'weight_asal' => preg_match('/^[0-9]+(?:\.[0-9]+)?$/', $row['L']),
                        'weight' => (string)$row['L'],
                        'weight_asal' => $row['L'],
                        'date_inv_po' => date('Y-m-d', strtotime($row['M'])),
                        'reason' => (string)$row['N'],
                        'status_dokumen' => 'LIST SCRAP',
                        'tiket_no' => 'TIKET-' . $no,
                        'jenis' => $jenis,
                        'kategori' => $kategori,
                        'batch' => $file_name,
                        'asal' => $asal,
                        'b3' => '',
                    ));
                }




                // array_push($data, array(
                //     'kode_barang' => (string)$row['C'],
                //     'ybm_code' => (string)$row['D'],
                //     'nama_barang' => (string)$row['E'],
                //     'invoice_po' => (string)$row['F'],
                //     'invoice_po_invoice' => (string)$row['G'],
                //     'supplier' => (string)$row['H'],
                //     'qty' => $row['I'],
                //     'uom' => (string)$row['J'],
                //     'weight' => (string)$row['K'],
                //     'weight_asal' => $row['K'],
                //     'date_inv_po' => date('Y-m-d', strtotime($row['L'])),
                //     'reason' => (string)$row['M'],
                //     'status_dokumen' => 'LIST SCRAP',
                //     'tiket_no' => 'TIKET-' . $no,
                //     'jenis' => $jenis,
                //     'section' => $this->session->userdata('section'),
                //     'kategori' => $kategori,
                //     'batch' => $file_name,
                //     'asal' => $asal,
                //     'b3' => 'NON B3',
                // ));
                // echo '<pre>';
                // var_dump($data);
                // echo '</pre>';
                // die;
            }
            $numrow++; // Tambah 1 setiap kali looping

        }



        //PREVENT JIKA YANG DIUPLOAD FILE LEBIH DARI 100 ITEMS 111
        if ($numrow > 100) {
            $response = ['status' => 'failed', 'message' => 'PENGAJUAN SCRAP MELEBIHI 100 ITEMS!'];
            echo json_encode($response);
            die;
        }

        //buat data untuk insert tabel histori_status
        $data_status = array(
            'tiket' => 'TIKET-' . $no,
            'status_dokumen' => 'LIST SCRAP',
            'section' => $this->session->userdata('section')
        );

        //buat data untuk header
        $data_header = array(
            'nomor_tiket' => 'TIKET-' . $no,
            'status' => 'OPEN',
            'kategori' => $kategori,
            'jenis' => $jenis,
            'asal' => $asal,
            'no_sr' => $nombor,
            'section' => $this->session->userdata('section')
        );

        $insert_status = $this->crud->insert('histori_status', $data_status);

        $insert_header = $this->crud->insert('header_list_scrap', $data_header);

        $update_mst_number = $this->crud->update('mst_number', ['number' => $seq], ['id' => '1']);

        if (empty($data)) {
            $response = ['status' => 'error', 'message' => 'Tidak ada data baru!'];
            echo json_encode($response);
            die;
        }




        $insert_data = $this->db->insert_batch('list_scrap', $data);
        if ($insert_data > 0) {
            //tambahkan sequence di tabel mst_nomor_tiket
            $this->Crud->update('mst_nomor_tiket', ['nomor' => $no], ['id' => '1']);
            $response = ['status' => 'success', 'message' => 'Data Berhasil Diupload!'];
            echo json_encode($response);
            die;
        } else {
            $response = ['status' => 'error', 'message' => 'Data Gagal Diupload!'];
            echo json_encode($response);
            die;
        }
    }

    public function import_pengajuan_nobc()
    {
        //buat nomor tiket
        // $getDataTiket = $this->Crud->get_all_limit('header_list_scrap')->row_array();
        // if ($getDataTiket > 0) {
        //     $a = explode("-", trim($getDataTiket['nomor_tiket']));
        //     $no = $a[1] + 1;
        // } else {
        //     $no = '1000';
        // }

        $getTiket = $this->Crud->get_all('mst_nomor_tiket')->row_array();
        $no = $getTiket['nomor'] + 1;

        $user = $this->session->userdata('username');
        $section = $this->session->userdata('section');

        // echo $user . '<br>';
        // echo $section . '<br>';
        // die;


        // $table = $this->input->post("table");

        $config['upload_path']          = './temp/pengajuan/';
        $config['allowed_types']        = 'pdf|PDF|xls|xlsx';
        $config['max_size']             = 5024;
        $config['overwrite']            = true;

        $this->load->library('upload', $config);
        // $data = $this->input->post();
        // unset($data['table']);
        // unset($data['password']);

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file_excel_nobc')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            $file_location = $data_upload['file_name'];
        }

        $data = array(
            'nomor_tiket' => 'TIKET-' . $no,
            'username' => $user,
            'section' => $section,
            'status_approval' => 'OPEN',
            'b3' => 'OPEN',
            'kategori' => 'BELUM DIPUTUSKAN',
            'file_location' => $file_location
        );

        $insert_pengajuan = $this->crud->insert('tbl_pengajuan_scrap', $data);
        // echo $this->db->last_query();
        // die;


        if ($this->db->affected_rows() == TRUE) {
            //update tabel mst_nomor_tiket
            $this->Crud->update('mst_nomor_tiket', ['nomor' => $no], ['id' => '1']);

            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Data!'];
            echo json_encode($response);
            die;
        } else {
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Data!'];
            echo json_encode($response);
            die;
        }

        // echo json_encode($response);
    }

    public function import_photo()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id_list_scrap");
        $jenis = $this->input->post("jenis");

        // echo $table . $id . $jenis;
        // die;

        if ($jenis == 'approval') {
            $config['upload_path']          = "assets/nobc/barang/";
        } else {
            $config['upload_path']          = "assets/photo_scrap/";
        }
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 1024;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['id_list_scrap']);
        unset($data['jenis']);


        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            $data['photo'] = $data_upload['file_name'];
        }

        $update = $this->crud->update($table, $data, ['id' => $id]);


        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update Photo!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update Photo!'];

        echo json_encode($response);
    }

    public function import_file_sr()
    {
        $table = $this->input->post("table");
        $nomor_tiket = $this->input->post("nomor_tiket");
        $jenis = $this->input->post("jenis");

        // echo $table;
        // echo $nomor_tiket;
        // echo $jenis;
        // die;


        if ($jenis == 'sr') {
            $config['upload_path']          = "assets/sr/";
        } else if ($jenis == 'evidence') {
            $config['upload_path']          = "assets/nobc/evidence/";
            $id = $nomor_tiket;
        } else if ($jenis == 'b3') {
            $config['upload_path']          = "assets/b3/";
            $id = $nomor_tiket;
        } else {
            $config['upload_path']          = "assets/bc/";
        }
        $config['allowed_types']        = 'pdf|PDF';
        $config['max_size']             = 30000;
        $config['max_width']            = 10000;
        $config['max_height']           = 10000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);
        unset($data['nomor_tiket']);
        unset($data['jenis']);

        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // die;

        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();

            if ($jenis == 'sr') {
                $data['file_sr'] = $data_upload['file_name'];
            } else if ($jenis == 'evidence') {
                $data['evidence_bc'] = $data_upload['file_name'];
            } else if ($jenis == 'b3') {
                $data['file_manifest'] = $data_upload['file_name'];
            } else {
                $data['file_bc'] = $data_upload['file_name'];
            }
        }

        if ($jenis == 'b3') {
            $update = $this->crud->update($table, $data, ['id' => $id]);
        } else if ($jenis == "evidence") {
            $update = $this->crud->update($table, $data, ['id' => $id]);
        } else {
            $update = $this->crud->update($table, $data, ['nomor_tiket' => $nomor_tiket]);
        }
        // echo $this->db->last_query();
        // die;

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil UPLOAD DATA!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal UPLOAD DATA!'];

        echo json_encode($response);
    }

    public function tambah_data_barang()
    {
        //cek dulu apakah file sudah 100 ?
        $where = array(
            'tiket_no' => $this->input->post('tiket_no')
        );
        $a = $this->crud->get_where('list_scrap', $where)->num_rows();

        if ($a == 100) {
            $response = ['status' => 'error', 'message' => 'Maksimum data scrap adalah 100 item!'];
            echo json_encode($response);
            die;
        }



        $table = $this->input->post("table");


        $config['upload_path']          = "assets/photo_scrap/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 5000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);


        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('file')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            $data['photo'] = $data_upload['file_name'];
        }

        // $update = $this->crud->update($table, $data, ['id' => $id]);
        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Barang!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Barang!'];

        echo json_encode($response);
    }

    public function tambah_data_barang_nobc()
    {
        $table = $this->input->post("table");

        $config['upload_path']          = "assets/nobc/barang/";
        $config['allowed_types']        = 'jpg|png|jpeg|JPG|PNG|JPEG';
        $config['max_size']             = 5000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);
        $data = $this->input->post();
        unset($data['table']);


        if (count($_FILES) > 0) {
            if (!$this->upload->do_upload('photo')) {
                $response = array('status' => 'failed', 'message' => $this->upload->display_errors());
                echo json_encode($response);
                die;
            }
            $data_upload = $this->upload->data();
            $data['photo'] = $data_upload['file_name'];
        }

        // $update = $this->crud->update($table, $data, ['id' => $id]);
        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Barang!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Barang!'];

        echo json_encode($response);
    }

    public function cancel_scrap()
    {

        $where_header = array(
            'nomor_tiket' => $this->input->post('nomor_tiket')
        );
        $where_detail = array(
            'tiket_no' => $this->input->post('nomor_tiket')
        );

        //hapus data

        $hapus_header = $this->crud->delete('header_list_scrap', $where_header);
        $hapus_list = $this->crud->delete('list_scrap', $where_detail);

        if ($hapus_header > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function hapus_evidence()
    {
        $where = array(
            'id' => $this->input->post('id')
        );
        if ($this->input->post('jenis') == 'manifest') {
            $data = array(
                'file_manifest' => ''
            );
        } else {
            $data = array(
                'evidence_bc' => ''
            );
        }

        //hapus data
        $hapus = $this->crud->update('detail_pengajuan', $data, $where);

        // echo $this->db->last_query();
        // die;

        if ($hapus > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function remove_data()
    {
        $table = $this->input->post('table');
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'photo' => null
        );

        //hapus data

        $hapus_photo = $this->crud->update($table, $data, $where);

        if ($hapus_photo > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function remove_barang()
    {

        $where = array(
            'id' => $this->input->post('id')
        );

        //hapus data

        $hapus_data = $this->crud->delete('list_scrap', $where);

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function delete_data()
    {
        $table = $this->input->post('table');
        $where = array(
            'nomor_tiket' => $this->input->post('nomor_tiket')
        );

        //hapus data
        $hapus_data = $this->crud->delete($table, $where);

        // echo $this->db->last_query();
        // die;

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function delete_harga()
    {
        $table = $this->input->post('table');


        $where = array(
            'id' => $this->input->post('id')
        );

        //hapus data
        $hapus_data = $this->crud->delete($table, $where);

        // echo $this->db->last_query();
        // die;

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function hapus_id()
    {
        $table = $this->input->post('table');
        $where = array(
            'id' => $this->input->post('id')
        );

        //hapus data
        $hapus_data = $this->crud->delete($table, $where);

        // echo $this->db->last_query();
        // die;

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function get_calculate()
    {

        $where = array(
            'tiket_no' => $this->input->post('tiket')
        );

        $ambil = $this->crud->get_where('list_scrap', $where)->num_rows();



        if ($ambil > 0) {
            $response = ['status' => 'success', 'message' => 'OK', 'jumlah' => $ambil];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'NOK'];

        echo json_encode($response);
    }

    public function get_detail_tiket()
    {

        $where = array(
            'tiket_no' => $this->input->post('tiket')
        );

        $ambil = $this->crud->get_where('list_scrap', $where)->row_array();

        echo json_encode($ambil);
    }

    public function get_dokumen()
    {

        $invoice = $this->input->post('inv_po');

        $ambil = $this->crud2->get_like('invoice', $invoice, 'arsip_doc')->result_array();
        if ($ambil) {
            $response = ['status' => 'ada', 'data' => $ambil];
        } else {
            $response = ['status' => 'tidakada'];
        }

        echo json_encode($response);
    }

    public function get_dokumen_all()
    {
        $tiket = $this->input->post('tiket');

        $g = $this->crud->get_where_select('list_scrap', 'id, section, kode_barang, nama_barang, invoice_po', ['tiket_no' => $tiket])->result_array();
        foreach ($g as $key => $value) {
            $id = $value['id'];
            $invoice = $value['invoice_po'];
            $section = $value['section'];
            $kode_barang = $value['kode_barang'];
            $nama_barang = $value['nama_barang'];

            $getinv = $this->crud2->get_like('invoice', $invoice, 'arsip_doc')->result_array();

            if ($getinv) {
                foreach ($getinv as $keyu => $v) {
                    //ambil data dari tabel tpb_header atau ceisa40_header terlebih dahulu
                    $getTpbLama = $this->crud2->get_where_select('tpb_header', 'nomor_daftar,tanggal_daftar', ['nomor_aju' => $v['nomor']])->row_array();
                    if ($getTpbLama) {
                        $nomor_daftar =  $getTpbLama['nomor_daftar'];
                        $tanggal_daftar = $getTpbLama['tanggal_daftar'];
                    } else {
                        $getTpbBaru = $this->crud2->get_where_select('ceisa40_header', 'nomor_daftar,tanggal_daftar', ['nomor_aju' => $v['nomor']])->row_array();
                        $nomor_daftar = $getTpbBaru['nomor_daftar'] ?? "";
                        $tanggal_daftar = $getTpbBaru['tanggal_daftar'] ?? "";
                    }
                    //buat data insert tabel list_scrap
                    $data = array(
                        'file_location' => $v['location_file'],
                        'nomor_aju' => $v['nomor'],
                        'jenis_doc' => $v['jenis'],
                        'tanggal_daftar' => $tanggal_daftar,
                        'nomor_daftar' => $nomor_daftar,
                        'status_dokumen' => 'CARI DOKUMEN ASAL'
                    );
                    $where = array(
                        'tiket_no' => $tiket,
                        'invoice_po' => $invoice
                    );
                    $update = $this->crud->update('list_scrap', $data, $where);
                }
            }
            //buat data 
            $data_status = array(
                'id_list_scrap' => $id,
                'status_dokumen' => 'CARI DOKUMEN ASAL',
                'section' => $section,
                'tiket' => $tiket,
                'kode_barang' => $kode_barang,
                'nama_barang' => $nama_barang,
                'invoice_po' => $invoice
            );
            $insert = $this->crud->insert('histori_status', $data_status);
            $update_header = $this->crud->update('header_list_scrap', ['status' => 'PROSES'], ['nomor_tiket' => $tiket]);
        }

        $response = ['status' => 'selesai'];

        echo json_encode($response);
    }

    public function insert_dokumen()
    {
        $id_arsip = $this->input->post('id_arsip');
        $id = $this->input->post('id');
        // $nomor_aju = '00004002081920221207000001';
        $nomor_aju = $this->input->post('nomor_aju');
        $jenis_doc = $this->input->post('jenis_doc');

        $getData = $this->crud2->get_where('arsip_doc', ['id' => $id_arsip])->row_array();

        //ambil data dari tabel tpb_header atau ceisa40_header terlebih dahulu
        $getTpbLama = $this->crud2->get_where_select('tpb_header', 'nomor_daftar,tanggal_daftar', ['nomor_aju' => $nomor_aju])->row_array();
        if ($getTpbLama) {
            $nomor_daftar =  $getTpbLama['nomor_daftar'];
            $tanggal_daftar = $getTpbLama['tanggal_daftar'];
        } else {
            $getTpbBaru = $this->crud2->get_where_select('ceisa40_header', 'nomor_daftar,tanggal_daftar', ['nomor_aju' => $nomor_aju])->row_array();
            $nomor_daftar = $getTpbBaru['nomor_daftar'] ?? "";
            $tanggal_daftar = $getTpbBaru['tanggal_daftar'] ?? "";
        }

        $data = array(
            'file_location' => $getData['location_file'],
            'nomor_aju' => $nomor_aju,
            'jenis_doc' => $jenis_doc,
            'nomor_daftar' => $nomor_daftar,
            'tanggal_daftar' => $tanggal_daftar
        );

        $where = array(
            'id' => $id
        );

        $update = $this->crud->update('list_scrap', $data, $where);

        // echo $this->db->last_query();
        // die;




        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update Lokasi File!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update Lokasi File!'];

        echo json_encode($response);
    }


    public function hapus_doc()
    {

        $where = array(
            'id' => $this->input->post('id')
        );

        $data = array(
            'file_location' => '',
            'hscode_masuk' => '',
            'bm_masuk' => '',
            'ppn_masuk' => '',
            'pph_masuk' => '',
            'hscode_sekarang' => '',
            'bm_sekarang' => '',
            'ppn_sekarang' => '',
            'pph_sekarang' => '',
            'nomor_aju' => '',
            'nomor_daftar' => '',
            'jenis_doc' => '',
            'tanggal_daftar' => '',
            'nomor_seri' => ''
        );

        //hapus data

        $hapus_data = $this->crud->update('list_scrap', $data, $where);

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Dihapus!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Dihapus!'];

        echo json_encode($response);
    }

    public function update_status()
    {
        $id = $this->input->post('id');
        $status_dokumen = $this->input->post('status_dokumen');
        $tiket = $this->input->post('tiket');
        $reject = $this->input->post('reject');
        $kode_barang = $this->input->post('kode_barang');
        $nama_barang = $this->input->post('nama_barang');
        $invoice_po = $this->input->post('invoice_po');
        $section = $this->input->post('section');

        // echo $reject;
        // die;

        $data = array(
            'status_dokumen' => $status_dokumen,
            'reject' => $reject
        );

        $data_histori = array(
            'id_list_scrap' => $id,
            'status_dokumen' => $status_dokumen,
            'tiket' => $tiket,
            'reject' => $reject,
            'section' => $section,
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'invoice_po' => $invoice_po
        );

        $where = array(
            'id' => $id
        );

        $update = $this->crud->update('list_scrap', $data, $where);

        $insert = $this->crud->insert('histori_status', $data_histori);

        //cek jika status dokumen == SELESAI DOKUMEN ASAL , untuk menampilkan tombol cetak SR
        $where_status = array(
            'status_dokumen !=' => 'SELESAI DOKUMEN ASAL',
            'tiket_no' => $tiket
        );
        $cek_all = $this->crud->get_where('list_scrap', $where_status)->num_rows();

        if ($cek_all == 0) {
            $this->crud->update('header_list_scrap', ['status' => 'SELESAI DOKUMEN ASAL'], ['nomor_tiket' => $tiket]);
        } else {
            $this->crud->update('header_list_scrap', ['status' => 'PROSES'], ['nomor_tiket' => $tiket]);
        }


        //cek jika status dokumen == SELESAI , apakah sudah selesai semua
        // $where_status_closed = array(
        //     'status_dokumen !=' => 'SELESAI',
        //     'tiket_no' => $tiket
        // );
        // $cek_all_closed = $this->crud->get_where('list_scrap', $where_status_closed)->num_rows();

        // if ($cek_all_closed == 0) {
        //     $this->crud->update('header_list_scrap', ['status' => 'CLOSED'], ['nomor_tiket' => $tiket]);
        // }

        $data_status = array(
            'SCRAP REQUISITION',
            'PENGAJUAN PERUSAKAN',
            'SKEP PERUSAKAN',
            'PERUSAKAN',
            'PROSES INVOICE FA',
            'PROSES BC.25/41',
            'SELESAI',
            'REJECT'
        );

        $cek_all2 = $this->crud->get_where_in('list_scrap', 'status_dokumen', $data_status)->num_rows();
        if ($cek_all2 == 1) {
            $this->crud->update('header_list_scrap', ['status' => 'PROSES'], ['nomor_tiket' => $tiket]);
        }

        // echo $cek_all2;
        // echo $this->db->last_query();
        // die;
        //end cek status


        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update Status Scrap!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update Status Scrap!'];

        echo json_encode($response);
    }

    public function update_status_all()
    {
        $id = $this->input->post('id');
        $status_dokumen = $this->input->post('status_dokumen');
        $tiket = $this->input->post('tiket');
        $reject = $this->input->post('reject');

        // echo $id . '<br>';
        // echo $status_dokumen . '<br>';
        // echo $tiket . '<br>';
        // echo $reject . '<br>';

        // die;

        $data = array(
            'status_dokumen' => $status_dokumen,
            'reject' => $reject
        );

        $where = array(
            'tiket_no' => $tiket
        );

        $update = $this->crud->update('list_scrap', $data, $where);


        $update_header = $this->crud->update('header_list_scrap', ['status' => $status_dokumen], ['nomor_tiket' => $tiket]);



        $getdata = $this->crud->get_where('list_scrap', ['tiket_no' => $tiket])->result_array();
        foreach ($getdata as $key => $value) {
            $data_histori = array(
                'id_list_scrap' => $id,
                'status_dokumen' => $status_dokumen,
                'tiket' => $tiket,
                'reject' => $reject,
                'section' => $value['section'],
                'kode_barang' => $value['kode_barang'],
                'nama_barang' => $value['nama_barang'],
                'invoice_po' => $value['invoice_po']
            );
            $insert = $this->crud->insert('histori_status', $data_histori);
        }
        // echo $this->db->Last_query();
        // die;

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update Status Scrap!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update Status Scrap!'];

        echo json_encode($response);
    }

    public function update_kolom()
    {
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        $kolom = $this->input->post('kolom');
        $tiket = $this->input->post('tiket');

        $where = array(
            'id' => $id
        );

        $data = array(
            $kolom => $nilai
        );

        //update data

        $update_data = $this->crud->update('list_scrap', $data, $where);

        // echo $this->db->last_query();
        // die;

        //JIKA STATUS HEADER SUDAH CLOSED DAN KOLOM NOMOR SERI DIISI
        if ($kolom == 'nomor_seri') {
            // $rt =  $this->crud->get_where('list_scrap', ['nomor_seri' => '', 'tiket_no' => $tiket])->num_rows();

            // if ($rt == 0) {
            //     $this->crud->update('header_list_scrap', ['status' => 'SELESAI'], ['nomor_tiket' => $tiket]);
            // } else {
            //     $this->crud->update('header_list_scrap', ['status' => 'PROSES', 'cetak_pdf' => ''], ['nomor_tiket' => $tiket]);
            // }
            $this->crud->update('header_list_scrap', ['status' => 'PROSES', 'cetak_pdf' => ''], ['nomor_tiket' => $tiket]);
        }

        if ($update_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Update!'];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Update!'];

        echo json_encode($response);
    }

    public function update_kolom_timbang()
    {
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');
        $kolom = $this->input->post('kolom');
        $tiket = $this->input->post('tiket');

        //cek dulu apakah ada berat kosong yang belum diisi di tiket ini
        //sum berat
        $where = array(
            'tiket_no' => $tiket,
            'weight_asal' => null
        );

        $berat_timbang_total = 0;
        // $y = '';
        $f = $this->crud->get_where('list_scrap', ['tiket_no' => $tiket])->result_array();
        foreach ($f as $key => $value) {

            if ($value['weight_asal'] == null) {
                $response = ['status' => 'berat_kosong', 'message' => 'Ada data Weight asal yang masih kosong, minta User agar input data weight asal terlebih dahulu!'];
                echo json_encode($response);
                die;
            } else  if ($value['weight_asal'] == 0) {
                $response = ['status' => 'berat_kosong', 'message' => 'Ada data Weight asal yang masih kosong, minta User agar input data weight asal terlebih dahulu!'];
                echo json_encode($response);
                die;
            } else {
                //buat prosentase barang berdasarkan berat asal tiap tiap berat barang
                $berat_timbang_total = ($berat_timbang_total + $value['weight_asal']);
            }
        }

        foreach ($f as $k => $val) {
            $prosentase = ($val['weight_asal'] / $berat_timbang_total);
            //nilai final
            $timbang = $prosentase * $nilai;
            //input weight timbang
            $insert = $this->crud->update('list_scrap', ['weight_timbang' => $timbang], ['id' => $val['id']]);
        }

        $where = array(
            'id' => $id
        );

        $data = array(
            $kolom => $nilai
        );

        $update_data = $this->crud->update('header_list_scrap', $data, $where);

        if ($update_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Update!'];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Update!'];

        echo json_encode($response);
    }

    public function get_status()
    {
        $data = [];

        $id_list_scrap = $this->input->post('id_list_scrap');
        $tiket = $this->input->post('tiket');

        $get_data = $this->db->from("histori_status")
            ->where("id_list_scrap", $id_list_scrap)
            ->get()->result_array();

        $data = [];

        if (count($get_data) > 0) {
            foreach ($get_data as $key => $value) {
                $data[] = [
                    'status_dokumen' => $value['status_dokumen'],
                    'reject' => $value['reject'],
                    'time_change' => date("d-M-Y H:i:s", strtotime($value['time_change'])),
                ];
            }
        }

        echo json_encode($data);
    }

    public function get_status_all()
    {
        $data = [];

        $id_list_scrap = $this->input->post('id_list_scrap');
        $tiket = $this->input->post('tiket');

        $get_data = $this->db->select('status_dokumen, max(time_change) time_change, max(reject) reject')
            ->where("tiket", $tiket)
            ->group_by('status_dokumen')
            ->order_by('max(time_change)', 'ASC')
            ->get('histori_status')->result_array();

        // echo $this->db->last_query();
        // die;

        if (count($get_data) > 0) {
            foreach ($get_data as $key => $value) {
                $data[] = [
                    'status_dokumen' => $value['status_dokumen'],
                    'reject' => $value['reject'],
                    'time_change' => date("d-M-Y H:i:s", strtotime($value['time_change'])),
                ];
            }
        }

        echo json_encode($data);
    }

    public function print_hscode()
    {

        $this->load->view('report/printhscode');
    }

    public function print()
    {
        $tiket = $_GET['tiket'];
        $where = array(
            'tiket_no' => $tiket
        );

        $data['scrap'] = $this->crud->get_where('list_scrap', $where)->result();
        $data['no'] = $this->crud->get_where('header_list_scrap', ['nomor_tiket' => $tiket])->row_array();

        $this->load->view('report/printscr3', $data);
    }

    public function printnobc()
    {
        $tiket = $_GET['tiket'];
        $where = array(
            'nomor_tiket' => $tiket
        );

        $data['scrap'] = $this->crud->get_where('detail_pengajuan', $where)->result();
        $data['no'] = $this->crud->get_where('header_pengajuan', ['nomor_tiket' => $tiket])->row_array();

        $this->load->view('report/printscrnobc', $data);
    }

    public function fwr()
    {
        $tiket = $_GET['tiket'];
        $where = array(
            'tiket_no' => $tiket
        );

        $data['scrap'] = $this->crud->get_where('list_scrap', $where)->result();
        $data['no'] = $this->crud->get_where('header_list_scrap', ['nomor_tiket' => $tiket])->row_array();
        $d = $this->crud->count_where('list_scrap', $where);

        $data['count'] = $d;

        $this->load->view('report/print_fwr', $data);
    }

    public function fabrikasi()
    {
        $tiket = $_GET['tiket'];
        $where = array(
            'tiket_no' => $tiket
        );

        $data['scrap'] = $this->crud->get_where('list_scrap', $where)->result();
        $data['no'] = $this->crud->get_where('header_list_scrap', ['nomor_tiket' => $tiket])->row_array();

        $this->load->view('report/printscrfabrikasi', $data);
    }

    public function rm()
    {
        $tiket = $_GET['tiket'];
        $where = array(
            'tiket_no' => $tiket
        );

        $data['scrap'] = $this->crud->get_where('list_scrap', $where)->result();
        $data['no'] = $this->crud->get_where('header_list_scrap', ['nomor_tiket' => $tiket])->row_array();

        $this->load->view('report/printscrrm', $data);
    }

    public function lampiran()
    {
        $tiket = $_GET['tiket'];
        $where = array(
            'tiket_no' => $tiket
        );

        $data['scrap'] = $this->crud->get_where('list_scrap', $where)->result();
        $data['no'] = $this->crud->get_where('header_list_scrap', ['nomor_tiket' => $tiket])->row_array();

        $this->load->view('report/lampiranfwr', $data);
    }

    public function ubah_password()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $password = $this->input->post("password");


        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);
        unset($data['password']);

        $data['password'] = password_hash($password, PASSWORD_DEFAULT);

        $update = $this->crud->update($table, $data, ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Password!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Password!'];

        echo json_encode($response);
    }

    public function register_barang()
    {
        $table = $this->input->post("table");
        $nama_barang = $this->input->post("nama_barang");

        $data = $this->input->post();
        unset($data['table']);
        //buat kode_barang
        $y = $this->crud->get_where('mst_nomor_kode_barang', ['id' => '1'])->row_array();
        $u = $y['nomor'] + 1;
        $kode = 'SCSC' . $u;

        $data['kode_group'] = 'SC';
        $data['nama_group'] = 'SCRAP';
        $data['kode_subgroup'] = 'SC';
        $data['nama_subgroup'] = 'SCRAP';
        $data['kode_barang'] = $kode;

        //buat data untuk disimpan di ms sql
        $data_mst = array(
            'kode_barang' => $kode,
            'nama_barang' => $nama_barang,
        );

        $update = $this->crud3->insert($table, $data);
        $insert = $this->crud->insert('mst_barang_scrap', $data_mst);

        $this->crud->update('mst_nomor_kode_barang', ['nomor' => $u], ['id' => 1]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Menambahkan Kode Barang!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Menambahkan Kode Barang!'];

        echo json_encode($response);
    }

    public function approval_pengajuan()
    {
        $status = $this->input->post("status");
        $id = $this->input->post("id");
        $remark = $this->input->post("remark");

        $data = $this->input->post();

        if ($this->session->userdata('section') == 'PGA-ADM') {
            $data['remark_pga'] = $remark;
            if ($status == 'b3') {
                $data['b3'] = 'B3';
            } else {
                $data['b3'] = 'NON B3';
            }
        } else if ($this->session->userdata('section') == 'EXIM') {
            $data['remark_exim'] = $remark;
            if ($status == 'bc') {
                $data['bc'] = 'BC';
            } else {
                $data['bc'] = 'NOBC';
            }
        }



        unset($data['table']);
        unset($data['id']);
        unset($data['status']);
        unset($data['remark']);

        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';
        // die;

        $update = $this->crud->update('detail_pengajuan', $data, ['id' => $id]);

        // echo $this->db->last_query();
        // die;

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update Approval!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update Approval!'];

        echo json_encode($response);
    }

    public function approval_b3()
    {
        $status = $this->input->post('status');
        $nomor_tiket = $this->input->post('nomor_tiket');

        $data = array(
            'kategori_b3' => $status
        );

        $where = array(
            'nomor_tiket' => $nomor_tiket
        );

        $update = $this->crud->update('header_list_scrap', $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update Approval!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update Approval!'];

        echo json_encode($response);
    }

    public function generatenobc()
    {
        $table = $this->input->post('table');

        //ambil nomor tiket
        $getTiket = $this->Crud->get_all('mst_nomor_tiket')->row_array();
        $no = $getTiket['nomor'] + 1;

        $data = array(
            'nomor_tiket' => 'TIKET-' . $no,
            'section' => $this->session->userdata('section')
        );

        $insert = $this->crud->insert($table, $data);

        if ($this->db->affected_rows() > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil generate tiket!'];
            //update mst_nomor_tiket
            $this->crud->update('mst_nomor_tiket', ['nomor' => $no], ['id' => '1']);
        } else
            $response = ['status' => 'error', 'message' => 'Gagal generate tiket!'];

        echo json_encode($response);
    }

    public function generate_sr()
    {
        $nomor_tiket = $this->input->post('nomor_tiket');



        //cek dulu apakah ada barang dengan status BC
        $getdata = $this->crud->get_where('detail_pengajuan', ['nomor_tiket' => $nomor_tiket, 'bc' => 'bc'])->row_array();
        if (isset($getdata['bc'])) {
            $response = ['status' => 'bc', 'message' => 'Ada barang kategori BC dalam list, silahkan hapus terlebih dahulu!'];
            echo json_encode($response);
            die;
        }

        //cek dulu apakah barang sudah ditambahkan
        $getdata = $this->crud->get_where('detail_pengajuan', ['nomor_tiket' => $nomor_tiket])->row_array();
        if (!isset($getdata['bc'])) {
            $response = ['status' => 'bc', 'message' => 'Barang belum ditambahkan atau Kategori BC belum ditentukan oleh EXIM!'];
            echo json_encode($response);
            die;
        }

        //buat nomor SR
        //lihat bulan
        date_default_timezone_set('Asia/Jakarta');
        $bulan = date('m');
        $thn = date('Y');
        if ($bulan == '01') {
            $conv = 'I';
        } elseif ($bulan == '02') {
            $conv = 'II';
        } elseif ($bulan == '03') {
            $conv = 'III';
        } elseif ($bulan == '04') {
            $conv = 'IV';
        } elseif ($bulan == '05') {
            $conv = 'V';
        } elseif ($bulan == '06') {
            $conv = 'VI';
        } elseif ($bulan == '07') {
            $conv = 'VII';
        } elseif ($bulan == '08') {
            $conv = 'VIII';
        } elseif ($bulan == '09') {
            $conv = 'IX';
        } elseif ($bulan == '10') {
            $conv = 'X';
        } elseif ($bulan == '11') {
            $conv = 'XI';
        } else {
            $conv = 'XII';
        }

        $getNumberSr = $this->Crud->get_all('mst_number')->row_array();
        $seq = $getNumberSr['number'] + 1;
        $nombor = $seq . '/' . $this->session->userdata('section') . '/SCRAP/JAI/' . $conv . '/' . $thn;
        //selesai buat nomor

        //update tabel
        $update = $this->crud->update('header_pengajuan', ['no_sr' => $nombor], ['nomor_tiket' => $nomor_tiket]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update data!'];
            //update nomor
            $this->crud->update('mst_number', ['number' => $seq], ['id' => '1']);
            $this->crud->update('detail_pengajuan', ['no_sr' => $nombor], ['nomor_tiket' => $nomor_tiket]);
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update data!'];

        echo json_encode($response);
    }

    public function kategori_b3()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $jenis = $this->input->post('jenis');

        $update = $this->crud->update($table, ['b3' => $jenis], ['id' => $id]);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Update data!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Update data!'];

        echo json_encode($response);
    }

    public function tombol_cetak()
    {
        $table = $this->input->post("table");
        $tiket_cetak = $this->input->post("tiket_cetak");

        $where = array(
            'nomor_tiket' => $tiket_cetak
        );

        $data = array(
            'cetak_pdf' => 'OK'
        );

        $update = $this->crud->update($table, $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Password!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Password!'];

        echo json_encode($response);
    }

    public function invoice()
    {
        $nomor_invoice = $_GET['inv'];
        $where = array(
            'nomor_invoice' => $nomor_invoice
        );

        $data['inv_header'] = $this->crud->get_where('header_invoice_scrap', $where)->row_array();
        $data['inv_detil'] = $this->crud->get_where('detail_invoice_scrap', $where)->result_array();

        $total = $data['inv_header']['amount'];
        $ppn = $total * 0.11;
        $nilai = ($ppn + $total);

        $data['nilai'] = $nilai;
        $data['ppn'] = $ppn;
        $data['terbilang'] = $this->terbilang($nilai);

        // echo $data['terbilang'];
        // die;

        $this->load->view('report/invoice', $data);
    }

    public function create_invoice()
    {
        date_default_timezone_set('Asia/Jakarta');

        $tipe = $this->input->post('tipe'); //TIPE PROFORMA atau INVOICE untuk invoice header (Kategori)
        $tanggal_inv = $this->input->post('tanggal_invoice'); //invoice header (Invoice Date)
        $data_tiket = $this->input->post('data_tiket');

        $get_data_list_scrap_nob3 = $this->db->select("*")->from("list_scrap")->where_in("tiket_no", $data_tiket)->where('b3', 'NON B3')->get()->result_array();
        $get_data_list_scrap_b3 = $this->db->select("*")->from("list_scrap")->where_in("tiket_no", $data_tiket)->where('b3', 'B3')->get()->result_array();

        $data_b3 = count($get_data_list_scrap_b3);
        $data_nob3 = count($get_data_list_scrap_nob3);

        //cacah data non b3
        if ($data_nob3 > 0) {
            $total_amount = 0;
            $total_qty = 0;
            $total_berat = 0;
            $data_header = [];
            $data_detail = [];
            $kategori = 'NON B3';

            $nomor_invoice = $this->generate_invoice_number();

            foreach ($get_data_list_scrap_nob3 as $key => $value) {
                $kategori_harga = trim($value['kategori_harga']) == '' ? 0 : trim($value['kategori_harga']);
                $nama_barang = $value['nama_barang'];
                $kode_barang = $value['kode_barang'];
                $qty = (float)$value['qty'];
                $berat = (float)$value['weight'];
                $id_asset = $value['id_asset'];
                $asset_number = $value['asset_number'];
                $weight_timbang = $value['weight_timbang'] ?? 0;
                $amount = $qty * $kategori_harga;

                // input ke tabel detail_invoice_scrap
                $data_detail[] = array(
                    'nama_barang' => $nama_barang,
                    'kode_barang' => $kode_barang,
                    'qty' => $qty,
                    'id_asset' => $id_asset,
                    'number_asset' => $asset_number,
                    'berat' => $weight_timbang,
                    'harga' => $kategori_harga,
                    'amount' => $amount,
                    'nomor_invoice' => $nomor_invoice
                );

                $total_amount = $total_amount + $amount;
                $total_qty = $total_qty + $qty;
                $total_berat = $total_berat + $berat;
            }

            $data_header = array(
                'nomor_tiket' => '',
                'section' => '',
                'nomor_invoice' => $nomor_invoice,
                'invoice_date' => $tanggal_inv,
                'vendor' => 'PT. AL RASHEED',
                'alamat_vendor' => 'Manduro Manggung Gajah Ngoro - Kab Mojokerto',
                'amount' => $total_amount,
                'kategori' => $kategori,
                'tipe' => $tipe,
                'deskripsi' => 'WASTE',
                'total_qty' => $total_qty,
                'total_berat' => $total_berat,
                'jml_tiket' => implode(' ', $data_tiket),
                'status_inv' => 'AKTIF'
            );

            $this->db->insert('header_invoice_scrap', $data_header);
            $this->db->insert_batch('detail_invoice_scrap', $data_detail);
        }

        //cacah data b3
        if ($data_b3 > 0) {
            $total_amount = 0;
            $total_qty = 0;
            $total_berat = 0;
            $data_header = [];
            $data_detail = [];
            $kategori = 'B3';

            $nomor_invoice = $this->generate_invoice_number();

            foreach ($get_data_list_scrap_b3 as $key => $value) {
                $kategori_harga = trim($value['kategori_harga']) == '' ? 0 : trim($value['kategori_harga']);
                $nama_barang = $value['nama_barang'];
                $kode_barang = $value['kode_barang'];
                $qty = (float)$value['qty'];
                $berat = (float)$value['weight'];
                $id_asset = $value['id_asset'];
                $asset_number = $value['asset_number'];
                $weight_timbang = $value['weight_timbang'] ?? 0;
                $amount = $qty * $kategori_harga;

                // input ke tabel detail_invoice_scrap
                $data_detail[] = array(
                    'nama_barang' => $nama_barang,
                    'kode_barang' => $kode_barang,
                    'qty' => $qty,
                    'id_asset' => $id_asset,
                    'number_asset' => $asset_number,
                    'berat' => $weight_timbang,
                    'harga' => $kategori_harga,
                    'amount' => $amount,
                    'nomor_invoice' => $nomor_invoice
                );

                $total_amount = $total_amount + $amount;
                $total_qty = $total_qty + $qty;
                $total_berat = $total_berat + $berat;
            }

            $data_header = array(
                'nomor_tiket' => '',
                'section' => '',
                'nomor_invoice' => $nomor_invoice,
                'invoice_date' => $tanggal_inv,
                'vendor' => 'PT. AL RASHEED',
                'alamat_vendor' => 'Manduro Manggung Gajah Ngoro - Kab Mojokerto',
                'amount' => $total_amount,
                'kategori' => $kategori,
                'tipe' => $tipe,
                'deskripsi' => 'WASTE',
                'total_qty' => $total_qty,
                'total_berat' => $total_berat,
                'jml_tiket' => implode(' ', $data_tiket),
                'status_inv' => 'AKTIF'
            );

            $this->db->insert('header_invoice_scrap', $data_header);
            $this->db->insert_batch('detail_invoice_scrap', $data_detail);
        }

        if ($data_b3 == 0 && $data_nob3 == 0) {
            $message = "Data B3 & Non B3 Tidak ditemukan";
            $response = ['status' => 'error', 'message' => "Failed Create Invoice! $message"];
        } else $response = ['status' => 'success', 'message' => "Success Create Invoice!, Data B3 : $data_b3, Data Non B3 : $data_nob3", 'data_b3' => $data_b3, 'data_nob3' => $data_nob3];

        echo json_encode($response);
    }

    function simpan_timbang()
    {
        $jenis_packing = $this->input->post('jenis_packing'); //TIPE PROFORMA atau INVOICE untuk invoice header (Kategori)
        $jumlah_packing = $this->input->post('jumlah_packing'); //invoice header (Invoice Date)
        $berat_timbang = $this->input->post('berat_timbang'); //invoice header (Invoice Date)
        $data_tiket = $this->input->post('data_tiket');
        $tikets = implode(' ', $data_tiket);

        $data = array(
            'nomor_tiket' => $tikets,
            'jumlah_packing' => $jumlah_packing,
            'jenis_packing' => $jenis_packing,
            'berat_timbang' => $berat_timbang,
        );

        $insert = $this->db->insert('packing_list', $data);

        if ($insert > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Input Packing!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Input Packing!'];

        echo json_encode($response);
    }

    function generate_invoice_number()
    {
        //buat nomor invoice
        $getno = $this->crud->get_all_limit('header_invoice_scrap')->row_array();
        $thn = date('y');
        $bln = date('m');
        $sequence = 1001;

        //Contoh Nomor Invoice JSI-2406001
        if ($getno) {
            $bln_inv = substr($getno['nomor_invoice'], 6, 2);
            $last_sequence = substr($getno['nomor_invoice'], 8, 3);
            if ($bln == $bln_inv) $sequence = $last_sequence + 1001;
        }

        $sequence = substr($sequence, 1);
        $nomor_invoice = 'JSI-' . $thn . $bln . $sequence;

        return $nomor_invoice;
    }

    function update_packing()
    {
        $jenis = $this->input->post('jenis_packing');
        $jumlah = $this->input->post('jumlah_packing');
        $tiket = $this->input->post('tiket_packing');

        $data = array(
            'jenis_packing' => $jenis,
            'jumlah_packing' => $jumlah
        );

        $where = array(
            'nomor_tiket' => $tiket
        );

        $update = $this->crud->update('header_list_scrap', $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil Input Jenis Packing!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Input Jenis Packing!'];

        echo json_encode($response);
    }

    function generate_report_invoice()
    {
        //tentukan waktu dan zona waktu
        date_default_timezone_set('Asia/Jakarta');
        $today = date('Y-m-d');

        $nomor_tiket = $this->input->post('nomor_tiket');
        $jenis = $this->input->post('jenis');
        $section = $this->input->post('section');
        $vendor = 'PT. AL RASHEED';
        $alamat_vendor = 'Manduro Manggung Gajah Ngoro - Kab Mojokerto';
        //generate nomor invoice
        $getinv = $this->crud->get_where('mst_number_invoice', ['id' => '1'])->row_array();
        $seq_inv = $getinv['number_invoice'] + 1;

        if ($jenis == 'proformab3') {
            //ambil data dari list_scrap
            $where = array(
                'tiket_no' => $nomor_tiket
            );
            $getdata = $this->crud->get_where('list_scrap', $where)->result_array();

            //data header
            $data_header = array(
                'section' => $section,
                'nomor_tiket' => $nomor_tiket,
                'nomor_invoice' => 'JSI-' . $seq_inv,
                'invoice_date' => $today,
                'vendor' => $vendor,
                'alamat_vendor' => $alamat_vendor
            );
        }

        var_dump($data_header);

        die;
    }

    function hapus_upload_sr()
    {
        $tiket = $this->input->post('nomor_tiket');

        $where = array(
            'nomor_tiket' => $tiket
        );

        $data = array(
            'file_sr' => ''
        );

        $update = $this->crud->update('header_list_scrap', $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil hapus!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal hapus!'];

        echo json_encode($response);
    }

    function hapus_upload_bc()
    {
        $tiket = $this->input->post('nomor_tiket');

        $where = array(
            'nomor_tiket' => $tiket
        );

        $data = array(
            'file_bc' => ''
        );

        $update = $this->crud->update('header_list_scrap', $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Berhasil hapus!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal hapus!'];

        echo json_encode($response);
    }

    public function ubah_harga()
    {
        $table = $this->input->post("table");
        $id = $this->input->post("id");
        $harga = $this->input->post("harga");

        $data = $this->input->post();
        unset($data['table']);
        unset($data['id']);

        $update = $this->crud->update($table, $data, ['id' => $id]);
        // $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Ubah Barang!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Ubah Barang!'];

        echo json_encode($response);
    }

    public function tambah_harga()
    {
        $table = $this->input->post("table");
        $item = $this->input->post("item");
        $harga = $this->input->post("harga");

        // echo $item . $harga;
        // die;

        $data = $this->input->post();
        unset($data['table']);

        // $update = $this->crud->update($table, $data, ['id' => $id]);
        $insert = $this->crud->insert($table, $data);


        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Barang!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Barang!'];

        echo json_encode($response);
    }

    public function reset_harga()
    {
        $table = $this->input->post('table');
        $where = array(
            'id' => $this->input->post('id')
        );
        $data = array(
            'kategori_harga' => ''
        );

        //hapus data
        $hapus_data = $this->crud->update($table, $data, $where);

        // echo $this->db->last_query();
        // die;

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Direset!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Direset!'];

        echo json_encode($response);
    }

    public function ubah_kategori()
    {
        $id = $this->input->post('id');
        $table = $this->input->post('table');
        $item = $this->input->post('item');

        $where = array(
            'id' => $id
        );

        $data = array(
            'kategori_harga' => $item
        );

        $update = $this->crud->update($table, $data, $where);
        // $insert = $this->crud->insert($table, $data);

        if ($this->db->affected_rows() == TRUE) {
            $response = ['status' => 'success', 'message' => 'Berhasil Tambah Kategori!'];
        } else
            $response = ['status' => 'error', 'message' => 'Gagal Tambah Kategori!'];

        echo json_encode($response);
    }

    public function reset_b3()
    {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $where = array(
            'id' => $id
        );
        $data = array(
            'b3' => ''
        );

        // echo $table . $b3 . $id;
        // die;

        //hapus data
        $hapus_data = $this->crud->update($table, $data, $where);

        // echo $this->db->last_query();
        // die;

        if ($hapus_data > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Direset!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Direset!'];

        echo json_encode($response);
    }

    public function ajax_table_tiket()
    {
        $table = 'header_list_scrap'; //nama tabel dari database

        $where = [
            // 'status' => 'PROSES TIMBANG - INPUT BERAT TOTAL - INPUT PACKING',
            // 'status' => 'PENGAJUAN PERUSAKAN',
        ];

        $column_order = array('id', 'nomor_tiket'); //field yang ada di table 
        $column_search = array('id', 'nomor_tiket'); //field yang diizin untuk pencarian 
        $select = 'id, nomor_tiket';
        $group = 'id, nomor_tiket';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['nomor_tiket'] = trim($key->nomor_tiket);

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

    public function ajax_table_invoice()
    {
        $table = 'header_invoice_scrap'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'section', 'nomor_tiket', 'nomor_invoice', 'invoice_date', 'vendor', 'alamat_vendor', 'amount', 'date_created', 'kategori', 'tipe', 'deskripsi', 'jml_tiket', 'status_inv', 'reason_inv'); //field yang ada di table 
        $column_search = array('id', 'section', 'nomor_tiket', 'nomor_invoice', 'invoice_date', 'vendor', 'alamat_vendor', 'amount', 'date_created', 'kategori', 'tipe', 'deskripsi', 'jml_tiket', 'status_inv', 'reason_inv'); //field yang diizin untuk pencarian 
        $select = 'id, section, nomor_tiket, nomor_invoice, invoice_date, vendor, alamat_vendor, amount, date_created, kategori, tipe, deskripsi, jml_tiket, status_inv, reason_inv';
        $group = 'id, section, nomor_tiket, nomor_invoice, invoice_date, vendor, alamat_vendor, amount, date_created, kategori, tipe, deskripsi, jml_tiket, status_inv, reason_inv';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['section'] = trim($key->section);
            $row['data']['nomor_tiket'] = trim($key->nomor_tiket);
            $row['data']['nomor_invoice'] = trim($key->nomor_invoice);
            $row['data']['invoice_date'] = date('d-M-Y H:i:s', strtotime($key->invoice_date));
            $row['data']['vendor'] = trim($key->vendor);
            $row['data']['alamat_vendor'] = trim($key->alamat_vendor);
            $row['data']['amount'] = trim($key->amount);
            $row['data']['date_created'] = date('d-M-Y H:i:s', strtotime($key->date_created));
            $row['data']['kategori'] = trim($key->kategori);
            $row['data']['tipe'] = trim($key->tipe);
            $row['data']['deskripsi'] = trim($key->deskripsi);
            $row['data']['jml_tiket'] = trim($key->jml_tiket);
            $row['data']['status_inv'] = trim($key->status_inv);
            $row['data']['reason_inv'] = trim($key->reason_inv);

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

    public function ajax_table_invoice_detail()
    {
        $table = 'detail_invoice_scrap'; //nama tabel dari database

        $where = null;

        $column_order = array('id', 'nama_barang', 'kode_barang', 'qty', 'id_asset', 'number_asset', 'berat', 'harga', 'amount', 'nomor_invoice', 'date_created'); //field yang ada di table 
        $column_search = array('id', 'nama_barang', 'kode_barang', 'qty', 'id_asset', 'number_asset', 'berat', 'harga', 'amount', 'nomor_invoice', 'date_created'); //field yang diizin untuk pencarian 
        $select = 'id, nama_barang, kode_barang, qty, id_asset, number_asset, berat, harga, amount, nomor_invoice, date_created';
        $group = 'id, nama_barang, kode_barang, qty, id_asset, number_asset, berat, harga, amount, nomor_invoice, date_created';
        $order = array('id' => 'desc'); // default order 
        $list = $this->crud->get_datatables($table, $select, $column_order, $column_search, $order, $where, $group);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row['data']['no'] = $no;
            $row['data']['id'] = trim($key->id);
            $row['data']['nama_barang'] = trim($key->nama_barang);
            $row['data']['kode_barang'] = trim($key->kode_barang);
            $row['data']['qty'] = trim($key->qty);
            $row['data']['id_asset'] = trim($key->id_asset);
            $row['data']['number_asset'] = trim($key->number_asset);
            $row['data']['berat'] = trim($key->berat);
            $row['data']['harga'] = trim($key->harga);
            $row['data']['amount'] = trim($key->amount);
            $row['data']['nomor_invoice'] = trim($key->nomor_invoice);
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

    function update_invoice()
    {
        $table = 'header_invoice_scrap';
        $invoice_date = $this->input->post('tanggal_invoice');
        $nomor_invoice = $this->input->post('nomor_invoice');
        $tipe = 'INVOICE';

        $where = array(
            'nomor_invoice' => $nomor_invoice
        );
        $data = array(
            'invoice_date' => $invoice_date,
            'tipe' => $tipe
        );

        //hapus data
        $update = $this->crud->update($table, $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Diupdate!'];
            // $insert_log = $this->db->insert('tbl_log', ['username' => $this->session->userdata('username'), 'activity' => 'Upload Data Excel']);
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Diupdate!'];

        echo json_encode($response);
    }

    //buat function untuk terbilang
    public function konversi($x)
    {

        $x = abs($x);
        $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";

        if ($x < 12) {
            $temp = " " . $angka[$x];
        } else if ($x < 20) {
            $temp = $this->konversi($x - 10) . " belas";
        } else if ($x < 100) {
            $temp = $this->konversi($x / 10) . " puluh" . $this->konversi($x % 10);
        } else if ($x < 200) {
            $temp = " seratus" . $this->konversi($x - 100);
        } else if ($x < 1000) {
            $temp = $this->konversi($x / 100) . " ratus" . $this->konversi($x % 100);
        } else if ($x < 2000) {
            $temp = " seribu" . $this->konversi($x - 1000);
        } else if ($x < 1000000) {
            $temp = $this->konversi($x / 1000) . " ribu" . $this->konversi($x % 1000);
        } else if ($x < 1000000000) {
            $temp = $this->konversi($x / 1000000) . " juta" . $this->konversi($x % 1000000);
        } else if ($x < 1000000000000) {
            $temp = $this->konversi($x / 1000000000) . " milyar" . $this->konversi($x % 1000000000);
        }

        return $temp;
    }

    public function tkoma($x)
    {
        // $x='3.924.000';
        $ex = explode('.', $x);
        if (isset($ex[1])) {
            $x = abs($ex[1]);
        } else {
            $x = 0;
        }
        $angka = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";

        if ($x < 12) {
            $temp = " " . $angka[$x];
        } else if ($x < 20) {
            $temp = $this->konversi($x - 10) . " belas";
        } else if ($x < 100) {
            $temp = $this->konversi($x / 10) . " puluh" . $this->konversi($x % 10);
        } else if ($x < 200) {
            $temp = " seratus" . $this->konversi($x - 100);
        } else if ($x < 1000) {
            $temp = $this->konversi($x / 100) . " ratus" . $this->konversi($x % 100);
        } else if ($x < 2000) {
            $temp = " seribu" . $this->konversi($x - 1000);
        } else if ($x < 1000000) {
            $temp = $this->konversi($x / 1000) . " ribu" . $this->konversi($x % 1000);
        } else if ($x < 1000000000) {
            $temp = $this->konversi($x / 1000000) . " juta" . $this->konversi($x % 1000000);
        } else if ($x < 1000000000000) {
            $temp = $this->konversi($x / 1000000000) . " milyar" . $this->konversi($x % 1000000000);
        }

        return $temp;
    }

    public function terbilang($x)
    {
        if ($x < 0) {
            $hasil = "minus " . trim($this->konversi($x));
        } else {
            $poin = trim($this->tkoma($x));
            $hasil = trim($this->konversi($x));
        }

        if ($poin) {
            $hasil = $hasil . " koma " . $poin;
        } else {
            $hasil = $hasil;
        }
        return $hasil;
    }

    public function update_deskripsi()
    {
        $table = 'header_invoice_scrap';
        $data = $this->input->post('data');
        $id = $this->input->post('id');

        $data = array(
            'deskripsi' => $data
        );
        $where = array(
            'id' => $id
        );

        //hapus data
        $update = $this->crud->update($table, $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Diupdate!'];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Diupdate!'];

        echo json_encode($response);
    }

    public function update_cancel()
    {
        $table = 'header_invoice_scrap';
        $reason_inv = $this->input->post('reason_inv');
        $nomor_invoice = $this->input->post('nomor_invoice');

        $data = array(
            'status_inv' => 'CANCEL',
            'reason_inv' => $reason_inv
        );
        $where = array(
            'nomor_invoice' => $nomor_invoice
        );

        //hapus data
        $update = $this->crud->update($table, $data, $where);

        if ($update > 0) {
            $response = ['status' => 'success', 'message' => 'Data Berhasil Diupdate!'];
        } else
            $response = ['status' => 'error', 'message' => 'Data Gagal Diupdate!'];

        echo json_encode($response);
    }
}
