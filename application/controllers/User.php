<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Time_model', 'time');
        $this->load->model('SweetAlert2_model', 'sa2');
        is_log_in();
        $this->data = array(
            "user" => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
        );
    }
    public function index()
    {
        $data['user'] = $this->data['user'];

        // Title
        $data['title'] = 'User';
        // Waktu create akun
        $data['timeAgo'] = $this->time->getTimeAgo($data['user']['date_created']);
        $data['timeSince'] = $this->time->getTimeSince($data['user']['date_created']);
        // Active Sidebar
        $data['sidebar'] = 'My Profile';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        } elseif ($role == 3) {
            $data['role'] = 'Member';
        }
        // Load View
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['user'] = $this->data['user'];

        // Title
        $data['title'] = 'Edit Profile';
        // Active Sidebar
        $data['sidebar'] = 'Edit Profile';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        } elseif ($role == 3) {
            $data['role'] = 'Member';
        }
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
        $username = $this->session->userdata('username');
        // $username = $this->input->post('username');
        $image = $this->input->post('image');
        $imageOld = $this->input->post('oldImage');

        $image_array = explode(";", $image);
        $image_array_1 = explode(",", $image_array[1]);
        $image = base64_decode($image_array_1[1]);
        $imageName = FCPATH . 'assets/img/avatars/' . $username . '.png';

        //Insert ke dbs
        if (file_exists(FCPATH . 'assets/img/avatars/' . $imageOld) && $imageOld != 'default.png') {
            unlink(FCPATH . 'assets/img/avatars/' . $imageOld);
        }
        $filename = $username . '.png';
        $this->db->set('image', $filename);
        $this->db->where('username', $username);
        $this->db->update('user');
        // $sql = "SELECT * FROM akun WHERE username='$username'";
        // $result = mysqli_query($conn, $sql);
        // $row = mysqli_fetch_assoc($result);
        // $_SESSION['img-user'] = $row['images'];

        file_put_contents($imageName, $image);
        $this->sa2->sweetAlert2Toast('Gambar Berhasil diubah', 'success');
    }
    public function hapusgambar()
    {
        $username = $this->input->post('username');
        $old_img = $this->input->post('img');
        if (file_exists(FCPATH . 'assets/img/avatars/' . $old_img)) {
            unlink(FCPATH . 'assets/img/avatars/' . $old_img);
        }
        $default = 'default.png';
        $this->db->set('image', $default);
        $this->db->where('username', $username);
        $this->db->update('user');
    }
    public function change_password()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'Change Password';
        // Active Sidebar
        $data['sidebar'] = 'Change Password';
        // Judul Sidebar
        $role = $this->session->userdata('role_id');
        if ($role == 1) {
            $data['role'] = 'Super Administrator';
        } elseif ($role == 2) {
            $data['role'] = 'Administrator';
        } elseif ($role == 3) {
            $data['role'] = 'Member';
        }
        $this->form_validation->set_message('required', '{field} tidak boleh kosong.');
        $this->form_validation->set_message('matches', '{field} harus sama dengan {param}.');
        $this->form_validation->set_message('min_length', '{field} setidaknya harus {param} karakter.');
        $this->form_validation->set_rules('currentpassword', 'Password Sekarang', 'required|trim');
        $this->form_validation->set_rules('newpassword1', 'New Password', 'required|trim|min_length[3]|matches[newpassword2]');
        $this->form_validation->set_rules('newpassword2', 'Konfirmasi New Password', 'required|trim|min_length[3]|matches[newpassword1]');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $currentpassword = $this->input->post('currentpassword');
            $newpassword = $this->input->post('newpassword1');
            if (!password_verify($currentpassword, $data['user']['password'])) {
                $this->sa2->sweetAlert2Toast('Password salah', 'error');
                redirect('user/changepassword');
            } else {
                if ($currentpassword == $newpassword) {
                    $this->sa2->sweetAlert2Toast('Password baru harus beda dengan password lama', 'error');
                    redirect('user/changepassword');
                } else {
                    $password_hash = password_hash($newpassword, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');
                    $this->sa2->sweetAlert2Toast('Password berhasil diperbarui', 'success');
                    redirect('user/changepassword');
                }
            }
        }
    }
}
