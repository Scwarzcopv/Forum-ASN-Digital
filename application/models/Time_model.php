<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Carbon\Carbon;

class Time_model extends CI_Model
{
    // public function getTimeAgo($time)
    // {
    //     $perbedaanWaktu = time() - $time;
    //     if ($perbedaanWaktu < 1) {
    //         return 'Kurang dari 1 detik yang lalu';
    //     }
    //     $formatPenulisan = array(
    //         12 * 30 * 24 * 60 * 60  =>  'tahun',
    //         30 * 24 * 60 * 60       =>  'bulan',
    //         24 * 60 * 60            =>  'hari',
    //         60 * 60                 =>  'jam',
    //         60                      =>  'menit',
    //         1                       =>  'detik'
    //     );
    //     foreach ($formatPenulisan as $format => $str) {
    //         $d = $perbedaanWaktu / $format;
    //         if ($d >= 1) {
    //             $t = round($d);
    //             return 'Dibuat ' . $t . ' ' . $str . ' yang lalu';
    //             // return 'about ' . $t . ' ' . $str . ($t > 1 ? 's' : '') . ' ago';
    //         }
    //     }
    // }
    public function __construct()
    {
        parent::__construct();
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        date_default_timezone_get();
    }
    public function getTimeAgo($time)
    {
        $time = (int)$time;
        $carbon = Carbon::createFromTimeStamp($time)->diffForHumans();
        return $carbon;
    }
    public function getTimeSince($time)
    {
        $time = (int)$time;
        $carbon = Carbon::parse($time);
        $carbon->timezone('Asia/Jakarta');
        $carbon = $carbon->isoFormat('dddd, Do MMMM YYYY');
        // $carbon = $carbon->isoFormat('dddd, Do MMMM YYYY, [jam] hh:mm:ss a [WIB]');
        return $carbon;
    }
}
