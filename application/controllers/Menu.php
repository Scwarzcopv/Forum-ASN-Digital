<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Menu_model', 'menu');
        $this->load->model('SweetAlert2_model', 'sa2');
    }
    // MENU MANAJEMEN
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'Menu Manajemen';
        // Active Sidebar
        $data['sidebar'] = 'Menu Manajemen';
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
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    //MENU MANAJEMEN
    //------------------------------------------- AJAX -------------------------------------------
    //----- Show data
    public function all()
    {
        $data = $this->db->get('user_menu')->result_array();
        echo json_encode($data);
    }
    //----- Cek unique data
    public function cekdata()
    {
        $menu = $this->input->get('menu_Tambah');
        $data = $this->db->get_where('user_menu', ['menu' => $menu])->row_array();
        if (!isset($data)) {
            echo "true";
        } else echo "false";
    }
    public function cekdata2()
    {
        $id = $this->input->get('id');
        $menu = $this->input->get('menu');
        $data = $this->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu = strtolower($menu);
        // Ambil data menu lama
        $dataLama = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        $menuLama = $dataLama['menu'];
        $menuLama = strtolower($menuLama);
        // $data2 = $this->db->get_where('user_menu', ['menu' => $menuLama])->row_array();
        // Set kondisi
        if (!isset($data)) {
            $remote = "true";
        } else {
            if ($menuLama == $menu) {
                $remote = "true";
            } else {
                $remote = "false";
            }
        }
        echo $remote;
    }
    //----- Submit tambahkan data
    public function tambahdata()
    {
        $menu = htmlspecialchars($this->input->post('menu_Tambah', true));
        $menu = strtolower($menu);
        $menu = ucwords($menu);

        $this->db->insert('user_menu', ['menu' => $menu]);
        echo json_encode(['status' => 'success', 'success' => $menu]);
    }
    //----- Input field update data
    public function getdata()
    {
        $id = $this->input->get('id');
        $data = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        echo json_encode($data);
    }
    //----- Submit ubah data
    public function ubahdata()
    {
        $id = $this->input->post('id_Edit');
        $menu = htmlspecialchars($this->input->post('menu_Edit', true));
        $menu = strtolower($menu);
        $menu = ucwords($menu);
        // Masukkan data ke array
        $data = array(
            'menu' => $menu
        );
        // Ambil data menu lama
        $dataLama = $this->db->get_where('user_menu', ['id' => $id])->row_array();
        $menuLama = $dataLama['menu'];
        // Update data menu
        $this->db->where('id', $id);
        $this->db->update('user_menu', $data);
        echo json_encode(['status' => 'success', 'success' => $menu, 'menuLama' => $menuLama]);
    }
    //---- Hapus data
    public function hapusmenu()
    {
        $id = $this->input->post('id');
        $this->menu->hapusData('user_menu', $id);
    }
    //----------------------------------------- END AJAX -----------------------------------------





    // SUB MENU MANAJEMEN
    public function submenu()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'Sub Menu Manajemen';
        $data['sidebar'] = 'Sub Menu Manajemen';
        if ($this->session->userdata('role_id') == 1) {
            $data['role'] = 'Administrator';
        } else {
            $data['role'] = 'User';
        }
        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_message('required', 'Field tidak boleh kosong.');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('id_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->sa2->sweetAlert2Toast('Submenu ditambahkan', 'success');
            redirect('menu/submenu');
        }
    }
}
