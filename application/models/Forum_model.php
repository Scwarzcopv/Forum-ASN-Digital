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
    function data_komentar($id_forum, $id_forum_pertanyaan, $id_user, $role_id, $hidden_com, $del_com)
    {
        $this->db->select('*');
        $this->db->from('forum_comment');
        $this->db->where('id_forum', $id_forum);
        $this->db->where('id_forum_pertanyaan', $id_forum_pertanyaan);
        if ($role_id < 3) {
            if ($hidden_com === 'false') $this->db->where('forum_comment_hidden', null);
            if ($del_com === 'false') $this->db->where('forum_comment_del_by_user', null);
        }
        if ($role_id > 2) {
            $this->db
                ->where('forum_comment_hidden', null)
                ->where('forum_comment_del_by_user', null)
                ->or_where("(id_user = '" . $id_user . "' AND forum_comment_hidden = 1 AND id_forum = '" . $id_forum . "' AND id_forum_pertanyaan = '" . $id_forum_pertanyaan . "')", null, false);
        }
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get();
        return $result;
    }
    function update_forum_pertanyaan($id_fp, $isi_jawaban)
    {
        $data = array(
            'isi_jawaban' => $isi_jawaban,
            // 'updated_at' => 'NOW()',
        );
        $this->db->trans_start();
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db
            ->where('id', $id_fp)
            ->update('forum_pertanyaan', $data);
        $this->db->trans_complete();
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }
    function preUpdataForumComment($id_fc, $role_id)
    {
        $result = null;
        if ($role_id > 2) {
            $result = $this->db
                ->select('forum_comment_hidden')
                ->from('forum_comment')
                ->where('id', $id_fc)
                ->get();
            if ($result->num_rows() > 0) {
                $result = $result->row_array();
                $result = $result['forum_comment_hidden'];
            } else {
                $result = 'deleted';
            }
        }
        return $result;
    }
    function update_forum_comment($id_fc, $isi_comment)
    {
        $data = array(
            'isi_comment' => $isi_comment,
            // 'updated_at' => time(),
        );
        $this->db->trans_start();
        $this->db->set('updated_at', 'NOW()', FALSE);
        $this->db
            ->where('id', $id_fc)
            ->update('forum_comment', $data);
        $this->db->trans_complete();
        if ($this->db->affected_rows() == '1') {
            return true;
        } else {
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        }
    }
    function tambah_forum_comment_pertanyaan($data_insert)
    {
        $id_forum_pertanyaan = $data_insert['id_forum_pertanyaan'];
        $forum_pertanyaan = $this->db
            ->select('*')
            ->from('forum_pertanyaan')
            ->where('id', $id_forum_pertanyaan)
            ->get()
            ->num_rows();
        if ($forum_pertanyaan > 0) {
            $now = date('Y-m-d H:i:s', time());
            $data_insert['created_at'] = $now;
            $data_insert['updated_at'] = $now;
            $this->db->trans_start();
            $this->db->insert('forum_comment', $data_insert);
            $this->db->trans_complete();
            if ($this->db->trans_status() === false) {
                return false;
            }
            return true;
        } else {
            return false;
        }
    }
    function show_hide_forum_diskusi($id_fc, $instruction)
    {
        if ($instruction == 'hide') {
            $this->db->set('forum_comment_hidden', 1);
        } else if ($instruction == 'show') {
            $this->db->set('forum_comment_hidden', null);
        } else if ($instruction == 'delete') {
            $this->db->set('forum_comment_del_by_user', 1);
        }
        $this->db
            ->where('id', $id_fc)
            ->update('forum_comment');
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }
    function hapus_forum_diskusi_comment($id_fc)
    {
        $this->db
            ->where('id', $id_fc)
            ->delete('forum_comment');
        if ($this->db->affected_rows() || !$this->db->_error_message()) {
            return true;
        } else {
            return false;
        }
    }
    function hapus_forum_diskusi_pertanyaan($id_forum, $id_fp)
    {
        $this->db
            ->where('id_forum', $id_forum)
            ->where('id_forum_pertanyaan', $id_fp)
            ->delete('forum_comment');
        $this->db
            ->where('id', $id_fp)
            ->delete('forum_pertanyaan');
        if ($this->db->affected_rows() || !$this->db->_error_message()) {
            return true;
            // if ($this->db->trans_status() === false) {
            //     return false;
            // }
        } else {
            return false;
        }
    }
}
