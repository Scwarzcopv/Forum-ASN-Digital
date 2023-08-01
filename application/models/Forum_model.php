<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forum_model extends CI_Model
{
    function cek_forum_access($id_forum, $id_user)
    {
        $this->db->select(['id', 'forum_active']);
        $this->db->from('forum');
        $this->db->where('id', $id_forum);
        $result = $this->db->get()->row_array();
        // Jika parameter link tidak terdaftar di dbs atau
        // Jika user menambahkan karakter ngawur di parameter
        if ($result == null || $result['id'] != $id_forum) {
            redirect('login/notfound');
        }
        // Hanya berlaku untuk user/anggota
        if ($id_user >= 2) {
            // Jika forum tidak aktif
            if ($result['forum_active'] == 0) {
                redirect('login/blocked');
            }
            $this->db->select('id_forum');
            $this->db->from('forum_access');
            $this->db->where('id_forum', $id_forum);
            $this->db->where('id_user', $id_user);
            $result = $this->db->get()->row_array();

            // Jika user tidak memiliki akses (tidak presensi)
            if ($result == null) {
                redirect('login/blocked');
            }
        }
    }
}
