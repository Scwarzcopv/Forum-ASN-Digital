<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sidebar_model extends CI_Model
{
    public function sidebar($role)
    {
        if ($role == 1) {
            return 'Super Administrator';
        } elseif ($role == 2) {
            return 'Administrator';
        } elseif ($role == 3) {
            return 'Member';
        }
    }
}
