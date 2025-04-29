<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meja_model extends CI_Model
{
    public function get_meja()
    {
        $query = $this->db->query("SELECT * FROM meja");
        return $query->result_array();
    }

    // Fungsi untuk mendapatkan meja yang tersedia saja
    public function get_meja_tersedia()
    {
        $this->db->where('status_tersedia', 1);
        $this->db->order_by('nomor_meja', 'ASC');
        $query = $this->db->get('meja');
        return $query->result_array();
    }

    // Fungsi untuk mengupdate status semua meja sekaligus
    public function update_all_tables_status($status)
    {
        $data = [
            'status_tersedia' => $status
        ];
        $this->db->update('meja', $data);
        return $this->db->affected_rows();
    }

    public function get_meja_kosong_by_date($array)
    {
        // Modifikasi query untuk hanya mengambil meja yang tersedia
        if (!empty($array)) {
            $query = $this->db->query("SELECT * FROM meja WHERE status_tersedia = 1 AND id_meja NOT IN ( '" . implode("', '", $array) . "' )");
        } else {
            $query = $this->db->query("SELECT * FROM meja WHERE status_tersedia = 1");
        }
        return $query->result_array();
    }

    // Fungsi untuk mendapatkan meja berdasarkan lokasi
    public function get_meja_by_lokasi($lokasi)
    {
        $this->db->where('lokasi', $lokasi);
        $this->db->order_by('nomor_meja', 'ASC');
        $query = $this->db->get('meja');
        return $query->result_array();
    }

    // Tambahkan parameter lokasi pada fungsi tambah_meja
    public function tambah_meja()
    {
        $data = [
            'nomor_meja' => htmlspecialchars($this->input->post('nomor_meja', true)),
            'kapasitas_meja' => htmlspecialchars($this->input->post('kapasitas', true)),
            'status_tersedia' => 1, // Default tersedia
            'lokasi' => htmlspecialchars($this->input->post('lokasi', true))
        ];
        $this->db->insert('meja', $data);
    }

    // Modifikasi fungsi edit_meja untuk mendukung perubahan lokasi
    public function edit_meja()
    {
        $data = [
            "kapasitas_meja" => $this->input->post('kapasitas_meja', true),
        ];

        // Jika ada perubahan lokasi
        if ($this->input->post('lokasi')) {
            $data["lokasi"] = $this->input->post('lokasi', true);
        }

        $this->db->where('id_meja', $this->input->post('id_meja'));
        $this->db->update('meja', $data);
    }


    public function get_meja_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM meja WHERE id_meja = $id");
        return $query->row();
    }

    // Fungsi baru untuk update status ketersediaan meja
    public function update_status_meja($id_meja, $status_tersedia)
    {
        $data = [
            'status_tersedia' => $status_tersedia
        ];
        $this->db->where('id_meja', $id_meja);
        $this->db->update('meja', $data);
    }
}
