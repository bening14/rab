<?php
defined('BASEPATH') or exit('No direct script access allowed');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('./resources/phpmail/PHPMailer.php');
require('./resources/phpmail/Exception.php');
require('./resources/phpmail/OAuth.php');
require('./resources/phpmail/POP3.php');
require('./resources/phpmail/SMTP.php');

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
                        'id' => trim($user['id'])
                    );
                    //buat session
                    $this->session->set_userdata($data);

                    redirect('user');
                    // if ($this->session->userdata('section') == 'EXIM' || $this->session->userdata('section') == 'PGA-ADM' || $this->session->userdata('section') == 'FATP') {
                    //     $this->load->view('welcome');
                    // } else {
                    //     $this->load->view('maintenance');
                    // }

                    // $this->load->view('welcome');
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

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('nik', 'Nik', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'Email already take, please use another'
        ]);
        $this->form_validation->set_rules('nik', 'Nik', 'required|trim|is_unique[user.nomor_induk]', [
            'is_unique' => 'Nomor Induk sudah terdaftar'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password not match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('register');
        } else {
            $data = array(
                'name' => htmlspecialchars($this->input->post('name', true)), //menghindari xss
                'jabatan' => htmlspecialchars($this->input->post('jabatan', true)), //menghindari xss
                'nomor_induk' => htmlspecialchars($this->input->post('nik', true)), //menghindari xss
                'email' => htmlspecialchars($this->input->post('email', true)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 2
            );
            //tulis ke table via model
            $this->Crud->insert('user', $data);
            // kirim email


            //ambil data dari tbl_setting
            $set = $this->Crud->get_all('setting_email')->result_array();
            foreach ($set as $row) {
                $host = $row['host'];
                $username = $row['username'];
                $password = $row['password'];
                $secure = $row['secure'];
                $port = $row['port'];
                $emailfrom = $row['emailfrom'];
                $nama_pengirim = $row['nama_pengirim'];
            }

            //KIRIM EMAIL
            $mail = new PHPMailer;

            //Enable SMTP debugging. 
            // $mail->SMTPDebug = 3;

            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = $host; //host mail server
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = $username;   //nama-email smtp          
            $mail->Password = $password;           //password email smtp
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = $secure;
            //Set TCP port to connect to 
            $mail->Port = $port;

            $mail->From = $emailfrom; //email pengirim
            $mail->FromName = $nama_pengirim; //nama pengirim



            $mail->isHTML(true);

            $mail->addAddress($this->input->post('email'), $this->input->post('email')); //email penerima
            $mail->Subject = 'Pendaftaran Anda sedang dalam verifikasi oleh Tim Admin'; //subject
            $mail->Body    = '<p>Selamat Anda telah berhasil melakukan registrasi di Aplikasi Monitoring dan Evaluasi.</p>
    
                <p>Mohon tunggu, saat ini pendaftaran Anda sedang dalam masa review/verifikasi oleh tim Admin</p> 
                <p>Setelah tim kami melakukan verifikasi maka Anda akan bisa menggunakan Aplikasi Monitoring dan Evaluasi.</p> 
                 
                
                
                <p>Terima Kasih</p>'; //isi email
            $mail->AltBody = "PHP mailer"; //body email (optional)
            if (!$mail->send()) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Failed send email!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation your account has been created. Please check your email</div>');
                redirect('auth');
            }
        }
    }

    public function notfound()
    {
        $this->load->view('404');
    }
    public function register()
    {
        $this->load->view('auth/register');
    }
    public function forgot()
    {
        $this->load->view('auth/forgot');
    }
    public function resetpass()
    {
        $this->load->view('auth/reset');
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('image');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('section');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logout.</div>');
        redirect('auth');
    }

    function cekmail()
    {
        $where = array(
            'email' => $this->input->post('email'),
        );

        $table = 'user';
        $this->Crud->get_where($table, $where);

        if ($this->db->affected_rows() == true) {
            //kirim email
            //buat link dan simpan
            $a = uniqid();
            $b = password_hash($a, PASSWORD_DEFAULT);
            $c = $this->input->post('email');

            $data = array(
                'uniq' => $b
            );
            $this->Crud->insert('reset_pass', $data);
            //ambil data dari tbl_setting
            $set = $this->Crud->get_all('setting_email')->result_array();
            foreach ($set as $row) {
                $host = $row['host'];
                $username = $row['username'];
                $password = $row['password'];
                $secure = $row['secure'];
                $port = $row['port'];
                $emailfrom = $row['emailfrom'];
                $nama_pengirim = $row['nama_pengirim'];
            }

            //KIRIM EMAIL
            $mail = new PHPMailer;

            //Enable SMTP debugging. 
            // $mail->SMTPDebug = 3;

            //Set PHPMailer to use SMTP.
            $mail->isSMTP();
            //Set SMTP host name                          
            $mail->Host = $host; //host mail server
            //Set this to true if SMTP host requires authentication to send email
            $mail->SMTPAuth = true;
            //Provide username and password     
            $mail->Username = $username;   //nama-email smtp          
            $mail->Password = $password;           //password email smtp
            //If SMTP requires TLS encryption then set it
            $mail->SMTPSecure = $secure;
            //Set TCP port to connect to 
            $mail->Port = $port;

            $mail->From = $emailfrom; //email pengirim
            $mail->FromName = $nama_pengirim; //nama pengirim



            $mail->isHTML(true);

            $mail->addAddress($this->input->post('email'), $this->input->post('email')); //email penerima
            $mail->Subject = 'Reset Password Aplikasi Laporan Monitoring dan Evaluasi'; //subject
            $mail->Body    = '<p>Anda telah meminta untuk melakukan reset password terhadap akun Anda yang menggunakan email ini sebagai tautan akun.</p>

			<p>Jika memang benar aktivitas reset password ini atas permintaan Anda, silahkan klik link dibawah ini</p> 
			
			<p><a href="' . base_url('auth/changepass') . '?email=' . $c . '&ref=' . $b . '">' . base_url('auth/changepass') . '?email=' . $c . '&ref='  . $b . '</a></p> 
			
			<p>Namun apabila aktivitas reset ini bukan atas permintaan Anda, silahkan abaikan email ini.</p>
			
			
			<p>Terima Kasih</p>'; //isi email
            $mail->AltBody = "PHP mailer"; //body email (optional)
            if (!$mail->send()) {
                // echo "Mailer Error: " . $mail->ErrorInfo;
                $result = 500;
                echo json_encode($result);
            } else {
                // echo "Message has been sent successfully";
                $result = 200;
                echo json_encode($result);
            }
        } else {
            $result = '500';
            echo json_encode($result);
        }
    }

    public function changepass()
    {
        //ambil get url
        $where = array(
            'uniq' => $this->input->get('ref')
        );

        $this->Crud->get_where('reset_pass', $where);
        if ($this->db->affected_rows() == true) {
            $data['email'] = $this->input->get('email');
            $this->load->view('auth/changepass', $data);
        } else {
            $this->notfound();
        }
    }

    public function action_change()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password not match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $data = array(
                'email' => $this->input->post('email')
            );
            $this->load->view('auth/changepass', $data);
        } else {
            $data = array(
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            );
            $where = array(
                'email' => $this->input->post('email')
            );
            //tulis ke table via model
            $this->Crud->update('user', $data, $where);
            // $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulation your account has been reset. Please login</div>');
            redirect('auth');
        }
    }


    public function ajax_logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('image');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('section');

        $response = array('status' => 'success', 'message' => "Success Logout");
        echo json_encode($response);
    }

    public function ajax_relogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $response = ['status' => 'failed', 'message' => 'Email is not registered!'];
        $user = $this->Crud->get_where("mst_user", ['username' => $username])->row_array();
        if ($user['is_active'] !== 1) $response = ['status' => 'failed', 'message' => 'Email is not active!'];
        if (!password_verify($password, $user['password'])) $response = ['status' => 'failed', 'message' => 'Wrong Password!'];
        if (password_verify($password, $user['password'])) {
            $data = array(
                'username' => trim($user['username']),
                'section' => trim($user['section']),
                'role' => trim($user['role']),
                'nik' => trim($user['nik']),
                'image' => trim($user['image']),
                'id' => trim($user['id'])
            );
            $this->session->set_userdata($data);
            $response = ['status' => 'success', 'message' => 'User Authenticated!', 'session' => $this->session->userdata()];
        }

        echo json_encode($response);
    }

    public function check_session()
    {
        $username = $this->session->userdata('username');
        $response = array('status' => 'offline', 'message' => "Session kosong");

        if ($username !== null)
            $response = array('status' => 'online', 'message' => "Session Online ");

        echo json_encode($response);
    }
}
