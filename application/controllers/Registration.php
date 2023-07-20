<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('SweetAlert2_model', 'sa2');
        // $this->load->library('form_validation');
    }
    public function index()
    {
        $this->form_validation->set_message('required', '{field} tidak boleh kosong.');
        // $this->form_validation->set_message('valid_email', 'Format {field} tidak sesuai.');
        $this->form_validation->set_message('is_unique', '{field} sudah terpakai.');
        $this->form_validation->set_message('min_length', '{field} setidaknya harus {param} karakter.');
        $this->form_validation->set_message('matches', '{field} harus sama dengan {param}.');
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]');

        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'Registration';
        // Active Sidebar
        $data['sidebar'] = 'Registration User';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('registration/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'name' =>  htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars(strtolower($this->input->post('username', true))),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => $this->input->post('role'),
                'is_active' => 1,
                'date_created' => time()
            ];
            $this->db->insert('user', $data);
            $this->sa2->sweetAlert2Toast('Registrasi berhasil', 'success');
            redirect('registration');
        }
    }
}
