<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_log_in();
        $this->load->model('Time_model', 'time');
        $this->load->model('SweetAlert2_model', 'sa2');
        $this->load->model('Sidebar_model', 'sidebar');
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
        $data['title'] = 'User';
        // Waktu create akun
        $data['timeAgo'] = $this->time->getTimeAgo($data['user']['date_created']);
        $data['timeSince'] = $this->time->getTimeSince($data['user']['date_created']);
        // Active Sidebar
        $data['sidebar'] = 'My Profile';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        // Session
        $data['user'] = $this->data['user'];
        // Title
        $data['title'] = 'Edit Profile';
        // Active Sidebar
        $data['sidebar'] = 'Edit Profile';
        // Judul Sidebar
        $data['role'] = $this->sidebar->sidebar($this->role);

        // Load View
        $this->form_validation->set_message('required', '{field} tidak boleh kosong.');
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->session->userdata('username');
            // $username = $this->input->post('username');
            $name = htmlspecialchars($this->input->post('name'));

            $this->db->set('name', $name);
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->sa2->sweetAlert2Toast('Profil berhasil diperbarui', 'success');
            redirect('user/edit');
        }
    }
    public function editgambar()
    {
        if (empty($this->input->post('image')) || empty($this->input->post('oldImage'))) {
            redirect('user/edit');
        }

        // Get Post Data
        $username = $this->session->userdata('username');
        // $username = $this->input->post('username');
        $image = $this->input->post('image');
        $imageOld = $this->input->post('oldImage');

        // Manage Data
        $image_array = explode(";", $image);
        $image_array_1 = explode(",", $image_array[1]);
        $image = base64_decode($image_array_1[1]);
        $time = time();
        $imageName = FCPATH . 'assets/img/avatars/' . $username . '-' . $time . '.png';

        //Insert ke Dbs
        if (file_exists(FCPATH . 'assets/img/avatars/' . $imageOld) && $imageOld != 'default.png') {
            unlink(FCPATH . 'assets/img/avatars/' . $imageOld);
        }
        $filename = $username . '-' . $time . '.png';
        $this->db->set('image', $filename);
        $this->db->where('username', $username);
        $this->db->update('user');
        file_put_contents($imageName, $image);

        $this->sa2->sweetAlert2Toast('Gambar Berhasil diubah', 'success');
    }

    public function cekconfirm()
    {
        if (empty($this->input->post('newpassword1')) || empty($this->input->post('newpassword2'))) {
            redirect('user/edit');
        }

        // Get Post Data
        $pw1 = $this->input->post('newpassword1');
        $pw2 = $this->input->post('newpassword2');

        // Set kondisi
        if (!isset($pw1) || !isset($pw2)) {
            $remote = "true";
        } else {
            if ($pw1 === $pw2) {
                $remote = "true";
            } else {
                $remote = "false";
            }
        }
        echo $remote;
    }

    public function change_password()
    {
        if (empty($this->input->post('currentpassword'))) {
            redirect('user/edit');
        }

        // Session
        $data['user'] = $this->data['user'];

        // Get Post Data
        $currentpw = $this->input->post('currentpassword');
        $pw1 = $this->input->post('newpassword1');
        $pw2 = $this->input->post('newpassword2');

        // Proses Data
        if (!password_verify($currentpw, $data['user']['password'])) {
            echo json_encode(['status' => 'error', 'error' => 'Password Salah']);
        } else {
            if ($pw1 == $pw2) {
                if ($currentpw == $pw1) {
                    echo json_encode(['status' => 'error', 'error' => 'Password baru harus beda dengan password lama']);
                } else {
                    $pw_hash = password_hash($pw1, PASSWORD_DEFAULT);

                    $this->db->set('password', $pw_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');
                    echo json_encode(['status' => 'success', 'success' => 'Password berhasil diperbarui']);
                }
            } else {
                echo json_encode(['status' => 'error', 'error' => 'Konfirmasi Password Harus Sama']);
            }
        }
    }
}
