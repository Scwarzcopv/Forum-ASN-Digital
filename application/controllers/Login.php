<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SweetAlert2_model', 'sa2');
        // $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('user');
        }
        $this->form_validation->set_message('required', '{field} tidak boleh kosong.');
        // $this->form_validation->set_message('valid_email', 'Format {field} tidak sesuai.');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login User';
            $data['bgColor'] = '3d5ed4';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('login/login',);
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        //Jika usernya ada
        if ($user) {
            //Jika usernya aktif
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'name' => $user['name'],
                        'nip' => $user['nip'],
                        'id' => $user['id'],
                        'skpd_id' => $user['skpd_id'],
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    $this->sa2->sweetAlert2Toast('Selamat datang<br>' . $user['name'] . '', 'success');
                    if ($user['role_id'] == 1 || $user['role_id'] == 2) {
                        redirect('admin');
                    } elseif ($user['role_id'] == 3) {
                        redirect('user');
                    }
                } else {
                    $this->sa2->sweetAlert2Toast('Password Salah', 'error');
                    redirect('login');
                }
            } else {
                $this->sa2->sweetAlert2Toast('Username belum teraktivasi', 'error');
                redirect('login');
            }
        } else {
            $this->sa2->sweetAlert2Toast('Username belum pernah terdaftarkan', 'error');
            redirect('login');
        }
    }
    public function logout()
    {
        if ($this->session->userdata('username')) {
            $name = $this->session->userdata('name');
            $this->sa2->sweetAlert2Toast('Selamat tinggal<br>' . $name, 'success');
            $this->session->unset_userdata('name');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('role_id');
        }
        redirect('login');
    }
    public function blocked()
    {
        $this->load->view('login/blocked');
    }
    public function notfound()
    {
        $this->load->view('login/notfound');
    }
}
