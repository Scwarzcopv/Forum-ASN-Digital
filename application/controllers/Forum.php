<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('SweetAlert2_model', 'sa2');
        $this->load->model('Sidebar_model', 'sidebar');
        is_log_in();
        // Get data 'user'
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
        // Get session 'role_id'
        $this->role = $this->session->userdata('role_id');
    }

    public function index()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Forum';
        // Active Sidebar
        $data['sidebar'] = 'Forum';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/index', $data);
        $this->load->view('templates/footer');
    }

    public function pertanyaan_tertunda()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Pertanyaan Tertunda';
        // Active Sidebar
        $data['sidebar'] = 'Pertanyaan Tertunda';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/pertanyaan_tertunda', $data);
        $this->load->view('templates/footer');
    }

    public function pertanyaan()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Pertanyaan';
        // Active Sidebar
        $data['sidebar'] = 'Pertanyaan';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('forum/pertanyaan', $data);
        $this->load->view('templates/footer');
    }
}
