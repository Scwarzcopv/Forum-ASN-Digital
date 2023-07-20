<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Time_model', 'time');
        $this->load->model('SweetAlert2_model', 'sa2');
        is_log_in();
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $data['title'] = 'User';
        // Waktu create akun
        $data['timeAgo'] = $this->time->getTimeAgo($data['user']['date_created']);
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
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }
    public function edit()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

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
        $this->form_validation->set_message('required', '{field} tidak boleh kosong.');
        $this->form_validation->set_rules('name', 'Nama', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = htmlspecialchars($this->input->post('name'));
            $username = htmlspecialchars($this->input->post('username'));

            //Cek jika ada gambar yang diupload
            $uploadImg = $_FILES['image']['name'];
            if ($uploadImg) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '5120'; //5mb
                $config['upload_path'] = './assets/img/avatars/';
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_img = $data['user']['image'];
                    if ($old_img != 'default.png') {
                        if (file_exists(FCPATH . 'assets/img/avatars/' . $old_img)) {
                            unlink(FCPATH . 'assets/img/avatars/' . $old_img);
                        }
                    }

                    $new_img = $this->upload->data('file_name');
                    $this->db->set('image', $new_img);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->sa2->sweetAlert2Toast('Profil berhasil diperbarui', 'success');
            redirect('user');
        }
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
