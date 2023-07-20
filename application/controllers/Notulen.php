<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notulen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('SweetAlert2_model', 'sa2');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'List Notulen';
        // Active Sidebar
        $data['sidebar'] = 'List Notulen';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        }
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notulen/index', $data);
        $this->load->view('templates/footer');
    }
    public function persetujuan()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'Persetujuan Notulen';
        // Active Sidebar
        $data['sidebar'] = 'Persetujuan Notulen';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        }
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('notulen/persetujuan', $data);
        $this->load->view('templates/footer');
    }
}