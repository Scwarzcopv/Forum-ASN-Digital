<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dt_notulen extends CI_Model
{

    // start datatables
    var $column_order   = array(null);
    var $column_search  = array("no_surat","agenda_rapat","tgl_mulai"); //set column field database for datatable searchable
    var $order          = array(null); // default order 
    var $except         = null;

    function __construct()
    {
        parent::__construct();
    }

    private function _base_query()
    {
        $nip = $this->session->userdata('nip');
        $id = $this->session->userdata('id');


        $temp = $this->db->query("select group_concat(id) as id FROM (SELECT no.id
        FROM `notulen_hasil_rapat` `no`
        LEFT JOIN `notulen_peserta` `d` ON `no`.`id`=`d`.`id_notulen` AND `d`.`status` = 'Masuk'
        LEFT JOIN `notulen_peserta` `p` ON `no`.`id`=`p`.`id_notulen` AND `p`.`status` = 'Pulang'
        WHERE `d`.`time` IS NOT NULL
        AND `p`.`time` IS NOT NULL
        AND `d`.`users_id` = ".$id."
        AND `p`.`users_id` = ".$id."
        GROUP BY `no`.`id`) AS temp")->row();
        $subquery = explode(',', $temp->id);

        $query1 = $this->db->select('notu.id, notu.no_surat, notu.tgl_mulai, notu.agenda_rapat, notu.nama_notulis, COALESCE(u.name, "-") AS pimpinan_rapat, notu.verified, notu.kirim')->from('notulen_hasil_rapat notu')->join('user u','notu.pimpinan_rapat = u.id','left')->where(['notu._active' => 1, 'id_notulis' => $id])
            ->get_compiled_select();
        $this->db->select('no.id, no.no_surat, no.tgl_mulai, no.agenda_rapat, no.nama_notulis, COALESCE(u.name, "-") AS pimpinan_rapat, no.verified, no.kirim')->from('notulen_hasil_rapat no')->join('user u','no.pimpinan_rapat=u.id','left')->join('notulen_peserta np','no.id=np.id_notulen','left')
        ->where(['no._active' => 1, 'no.verified' => 1]);
        if(is_null($subquery)){
            $this->db->where(['no.id' => null]);
        }
        else{
            $this->db->where_in('no.id', $subquery);
        }
        $query2 = $this->db->get_compiled_select();
        $this->db->from("($query1 UNION $query2) notulen")->order_by('tgl_mulai','DESC');
      
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatables_query()
    {
        $this->_base_query();

        $i = 0;

        if (@$_POST['search']['value']) { // if datatable send POST for search
            foreach ($this->column_search as $item) { // loop column 
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
                $i++;
            }
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered()
    {
       $query =  $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->_get_datatables_query();
        return $this->db->count_all_results();
    }

    public function get_data($id, $jns)
    {
        if ($jns == "sm")
            $table = "srt_masuk";
        else if($jns == "sk")
            $table = "srt_keluar";

        $get_surat = $this->db->select("no_surat, skpd_id")->from($table)->where(['id'=>$id])->get()->row();

        if(!empty($get_surat)){
            $query1 = $this->db->select('id, nama_notulis, CONCAT("/pdf/notulen/pdf/",md5(concat(id,id_notulis)),".pdf") AS url, cek_pimpinan')->from('notulen_hasil_rapat')->where(['_active' => 1, 'no_surat' => $get_surat->no_surat, 'skpd_id' => $get_surat->skpd_id])
                ->get_compiled_select();
            $subquery = $this->db->select('np.skpd_id')->from('notulen_peserta np')
                ->join('notulen_peserta d','np.users_id=d.users_id AND d.status = "Masuk"','left')
                ->join('notulen_peserta p','np.users_id=p.users_id AND p.status = "Pulang"','left')
                ->where(['d.time !='=>NULL,'p.time !='=>NULL])
                ->group_by('np.users_id')
                ->get_compiled_select();
            $query2 = $this->db->select('no.id, no.nama_notulis, CONCAT("/pdf/notulen/pdf/",md5(concat(no.id,no.id_notulis)),".pdf") AS url, cek_pimpinan')->from('notulen_hasil_rapat no')->join('user u','no.pimpinan_rapat=u.id','left')->join('notulen_peserta np','no.id=np.id_notulen AND np.skpd_id IN ('.$subquery.')','left')
            ->where(['no._active' => 1, 'no.verified' => 1, 'no_surat' => $get_surat->no_surat, 'np.skpd_id' => $get_surat->skpd_id])->get_compiled_select();
            $list_notulen = $this->db->from("($query1 UNION $query2) subquery")->get()->result();
            // return $this->db->last_query();die();
            return $list_notulen;
        }
        return $get_surat;
    }
}
