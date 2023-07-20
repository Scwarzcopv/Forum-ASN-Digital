<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_log_in();
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'Admin';
        // Active Sidebar
        $data['sidebar'] = 'Dashboard';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }
    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        // Title
        $data['title'] = 'Role';
        // Active Sidebar
        $data['sidebar'] = 'Role';
        // Judul Sidebar
        if ($this->session->userdata('role_id') == 1) {
            $data['role'] = 'Administrator';
        } else {
            $data['role'] = 'User';
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }
    public function roleAccess($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        // Inisialisasi role & menu
        $data['user_role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();
        $this->db->where('id!=', 1);
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $data['title'] = 'Role Access';
        // Active Sidebar
        $data['sidebar'] = 'Role';
        // Judul Sidebar
        if ($this->session->userdata('role_id') == 1) {
            $data['role'] = 'Administrator';
        } else {
            $data['role'] = 'User';
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }
    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        // $this->_sweetAlert2Toast('Akses berhasil diganti', 'success');
    }
    //MENU MANAJEMEN
    //------------------------------------------- AJAX -------------------------------------------
    //----- Show data
    public function all()
    {
        $data = $this->db->get('user_role')->result_array();
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

    public function allRoleAccess()
    {
        $data = array();
        $data['user_menu'] = $this->db->get('user_menu')->result_array();
        foreach ($data['user_menu'] as $umenu) {
        }
        echo json_encode($data);
    }
}
