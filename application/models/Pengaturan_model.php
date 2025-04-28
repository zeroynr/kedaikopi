<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_setting($nama_pengaturan)
    {
        $query = $this->db->get_where('pengaturan', ['nama_pengaturan' => $nama_pengaturan]);
        if ($query->num_rows() > 0) {
            return $query->row()->nilai;
        }
        return null;
    }

    public function update_setting($nama_pengaturan, $nilai)
    {
        $this->db->where('nama_pengaturan', $nama_pengaturan);
        return $this->db->update('pengaturan', ['nilai' => $nilai]);
    }
}
