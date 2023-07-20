<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Time_model extends CI_Model
{
    public function getTimeAgo($time)
    {
        $perbedaanWaktu = time() - $time;
        if ($perbedaanWaktu < 1) {
            return 'Kurang dari 1 detik yang lalu';
        }
        $formatPenulisan = array(
            12 * 30 * 24 * 60 * 60  =>  'tahun',
            30 * 24 * 60 * 60       =>  'bulan',
            24 * 60 * 60            =>  'hari',
            60 * 60                 =>  'jam',
            60                      =>  'menit',
            1                       =>  'detik'
        );
        foreach ($formatPenulisan as $format => $str) {
            $d = $perbedaanWaktu / $format;
            if ($d >= 1) {
                $t = round($d);
                return 'Dibuat ' . $t . ' ' . $str . ' yang lalu';
                // return 'about ' . $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
            }
        }
    }
}
