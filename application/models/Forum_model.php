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
            // Cek akses user
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
    function cek_forum_active($id_forum, $id_user)
    {
        $this->db->select(['id', 'forum_active']);
        $this->db->from('forum');
        $this->db->where('id', $id_forum);
        $result = $this->db->get()->row_array();
        // Jika parameter link tidak terdaftar di dbs atau
        // Jika user menambahkan karakter ngawur di parameter
        if ($result == null || $result['id'] != $id_forum) {
            echo 'notfound';
            die();
        }
        // Hanya berlaku untuk user/anggota
        if ($id_user >= 2) {
            // Jika forum tidak aktif
            if ($result['forum_active'] == 0) {
                echo 'blocked';
                die();
            }
            // Cek akses user
            $this->db->select('id_forum');
            $this->db->from('forum_access');
            $this->db->where('id_forum', $id_forum);
            $this->db->where('id_user', $id_user);
            $result = $this->db->get()->row_array();
            // Jika user tidak memiliki akses (tidak presensi)
            if ($result == null) {
                echo 'blocked';
                die();
            }
        }
    }
    function cek_forum_tanya_active($id_forum, $role_id)
    {
        $this->db->select(['tanya_active']);
        $this->db->from('forum');
        $this->db->where('id', $id_forum);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $result = $result->row_array();
            if ($result['tanya_active'] != 1 && $role_id > 2) {
                echo 0;
                die();
            }
        } else {
            echo 'forum_notfound';
            die();
        }
    }
    function cek_forum_komentar_active($id_forum, $role_id)
    {
        $this->db->select(['komentar_active']);
        $this->db->from('forum');
        $this->db->where('id', $id_forum);
        $result = $this->db->get();
        if ($result->num_rows() > 0) {
            $result = $result->row_array();
            if ($result['komentar_active'] != 1 && $role_id > 2) {
                echo 0;
                die();
            }
        } else {
            echo 'forum_notfound';
            die();
        }
    }
    function foto_dokumentasi($id_forum)
    {
        $this->db->select('*');
        $this->db->from('notulen_foto');
        $this->db->where('rapat', $id_forum);
        $this->db->where('_active', 1);
        $result = $this->db->get();
        return $result;
    }
    function info_forum($id_forum)
    {
        // ['id_notulen a', '* b']
        $this->db->select('*');
        $this->db->from('forum');
        $this->db->where('id', $id_forum);
        $result = $this->db->get();
        return $result;
    }
    function info_notulen($id_forum)
    {
        // ['id_notulen a', '* b']
        $this->db->select('*');
        $this->db->from('forum a');
        $this->db->where('a.id', $id_forum);
        $this->db->join('notulen_hasil_rapat b', 'a.id_notulen = b.id', 'left');
        $result = $this->db->get();
        return $result;
    }
    function info_forum_pertanyaan($id_forum_pertanyaan)
    {
        $this->db->select('*');
        $this->db->from('forum_pertanyaan');
        $this->db->where('id', $id_forum_pertanyaan);
        $result = $this->db->get();
        return $result;
    }
    function info_user($id_user)
    {
        $this->db->select(['id', 'name', 'username', 'image', 'role_id']);
        $this->db->from('user');
        $this->db->where('id', $id_user);
        $result = $this->db->get()->row_array();
        return $result;
    }
    function data_komentar($id_forum, $id_forum_pertanyaan)
    {
        $this->db->select('*');
        $this->db->from('forum_comment');
        $this->db->where('id_forum', $id_forum);
        $this->db->where('id_forum_pertanyaan', $id_forum_pertanyaan);
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get();
        return $result;
    }
}
