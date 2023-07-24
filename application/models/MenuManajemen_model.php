<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MenuManajemen_model extends CI_Model
{
    public function showMenuManajemen()
    {
        $query = "
        SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu` 
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";
        return $this->db->get('user_menu')->result_array();
    }
    public function GetId($id = '')
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }
    public function hapusMenuManajemen($id)
    {
        $this->db->delete('user_menu', array('id' => $id));
    }
    public function cekTambah($menu)
    {
        $data = $this->db->get_where('user_menu', ['menu' => $menu])->row_array();
        if (!isset($data)) {
            echo "true";
        } else echo "false";
    }
    public function cekEdit($id, $menu)
    {
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
}
