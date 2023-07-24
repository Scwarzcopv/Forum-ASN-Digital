<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Sidebar_model', 'sidebar');
        // $this->load->model('Menu_model', 'menu');
        $this->load->model('MenuManajemen_model', 'model_menuManajemen');
        $this->load->model('SweetAlert2_model', 'sa2');
        // Get data 'user'
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
        // Get session 'role_id'
        $this->role = $this->session->userdata('role_id');
    }
    // MENU MANAJEMEN
    public function index()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Menu Manajemen';
        // Active Sidebar
        $data['sidebar'] = 'Menu Manajemen';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Data menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    //------------------------------------------- MENU MANAJEMEN -------------------------------------------
    //----- Show data
    public function get_items()
    {
        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $query = $this->db->get("items");
        $data = [];
        foreach ($query->result() as $r) {
            $data[] = array(
                $r->id,
                $r->title,
                $r->description
            );
        }
        $result = array(
            "draw" => $draw,
            "recordsTotal" => $query->num_rows(),
            "recordsFiltered" => $query->num_rows(),
            "data" => $data
        );
        echo json_encode($result);
        exit();
    }
    public function showMenuManajemen()
    {
        $data['result'] = $this->model_menuManajemen->showMenuManajemen();
        $this->load->view('menu/menumanajemen/data-menu', $data);
    }
    //----- Tambah
    public function cekMenuManajemenTambah()
    {
        $menu = $this->input->get('menu');
        $this->model_menuManajemen->cekTambah($menu);
    }
    public function tambahMenuManajemen()
    {
        $action = $this->input->post('action');
        $this->load->view('menu/menumanajemen/tambah', $action);
    }
    //----- Edit
    public function cekMenuManajemenEdit()
    {
        $id = $this->input->get('id');
        $menu = $this->input->get('menu');
        $this->model_menuManajemen->cekEdit($id, $menu);
    }
    public function editMenuManajemen()
    {
        $id = $this->input->post('id');
        $data['result'] = $this->model_menuManajemen->getId($id);
        $this->load->view('menu/menumanajemen/edit', $data);
    }
    public function __hapusMenuManajemen()
    {
        $id = $this->input->post('id');
        $data['result'] = $this->model_menuManajemen->getId($id);
        $this->load->view('menu/menumanajemen/hapus', $data);
    }
    public function saveMenuManajemen()
    {
        // Get Data
        $menu = $this->input->post('menu');
        $menu = htmlspecialchars($menu);
        $menu = strtolower($menu);
        $menu = ucwords($menu);
        // Insert Data
        $data = array(
            'menu' => $menu
        );
        $this->db->insert('user_menu', $data);
        // Return Resutl
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'success' => $menu]);
        }
    }
    public function saveEditMenuManajemen()
    {
        // Get Data
        $id = $this->input->post('id');
        $menu = $this->input->post('menu');
        $menu = htmlspecialchars($menu);
        $menu = strtolower($menu);
        $menu = ucwords($menu);
        $dataLama = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        $menuLama = $dataLama['menu'];
        // Insert Data
        $data = array(
            'menu' => $menu
        );
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
        // Return Result
        echo json_encode(['status' => 'success', 'success' => $menu, 'menuLama' => $menuLama]);
    }
    public function hapusMenuManajemen()
    {
        $id = $this->input->post('id');
        $this->db->delete('user_menu', array('id' => $id));
    }

    //----------------------------------------- END MENU MANAJEMEN -----------------------------------------
}
