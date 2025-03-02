<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->library('form_validation');
    // }

    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('email');
        $password = $this->input->post('password');

        //ambil data dari model
        $table = 'mst_user';
        $where = array(
            'username' => $username,
        );
        $user = $this->Crud->get_where($table, $where)->row_array();

        if ($user) {
            //cek dulu member aktive atau tidak
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    //jika sukses
                    $data = array(
                        'username' => trim($user['username']),
                        'nama' => trim($user['nama']),
                        'id' => trim($user['id'])
                    );
                    //buat session
                    $this->session->set_userdata($data);

                    redirect('user');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Wrong Password</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email not yet activated</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is not registered</div>');
            redirect('auth');
        }
    }

    public function notfound()
    {
        $this->load->view('404');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('nama');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logout.</div>');
        redirect('auth');
    }

}
