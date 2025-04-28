<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog_model extends CI_Model
{
    public function getProfil()
    {
        $query = $this->db->query("SELECT * FROM profil_usaha");
        return $query->result_array();
    }

    public function getAllMakanan()
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('status_delete = 0 OR status_delete IS NULL');
        return $this->db->get()->result_array();
    }

    public function getMakananById($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id_menu', $id);
        return $this->db->get()->result_array();
    }

    public function getGambarById($id_menu)
    {
        $this->db->select('*');
        $this->db->from('gambar_menu gm');
        $this->db->join('menu m', 'gm.id_menu = m.id_menu');
        $this->db->where('m.id_menu', $id_menu);
        return $this->db->get()->result_array();
    }

    // Mendapatkan total pesanan untuk sebuah menu
    public function getTotalOrders($id_menu)
    {
        $this->db->select('SUM(jumlah) as total_orders');
        $this->db->from('menu_dibooking');
        $this->db->where('id_detail_menu', $id_menu);
        $result = $this->db->get()->row_array();

        return isset($result['total_orders']) ? $result['total_orders'] : 0;
    }

    // Fungsi pencarian dengan perbaikan
    public function searchMenu($keyword = '', $filter = '')
    {
        $this->db->select('menu.*');
        $this->db->from('menu');

        // First, apply the base condition for non-deleted items
        $this->db->where('(menu.status_delete = 0 OR menu.status_delete IS NULL)');

        // Apply category filter if provided
        if (!empty($filter)) {
            if ($filter == 'category_makanan') {
                $this->db->where('menu.kategori', 'Makanan');
            } else if ($filter == 'category_minuman') {
                $this->db->where('menu.kategori', 'Minuman');
            }
        }

        // Apply keyword search with proper handling of partial matches
        if (!empty($keyword)) {
            $this->db->group_start();
            $this->db->like('LOWER(menu.nama_menu)', strtolower($keyword));
            $this->db->or_like('LOWER(menu.detail_menu)', strtolower($keyword));
            $this->db->group_end();
        }

        // Apply price sorting
        if (!empty($filter)) {
            if ($filter == 'price_asc') {
                $this->db->order_by('menu.harga', 'ASC');
            } else if ($filter == 'price_desc') {
                $this->db->order_by('menu.harga', 'DESC');
            }
        } else {
            // Default ordering
            $this->db->order_by('menu.nama_menu', 'ASC');
        }

        // For debugging
        // $sql = $this->db->get_compiled_select();
        // echo $sql; die();

        return $this->db->get()->result_array();
    }

    // Mendapatkan menu populer
    public function getPopularMenu($limit = 4)
    {
        // Dapatkan menu yang paling banyak dipesan berdasarkan nama_makanan
        $this->db->select('menu.*, SUM(menu_dibooking.jumlah) as total_orders');
        $this->db->from('menu');
        $this->db->join('menu_dibooking', 'menu.nama_menu = menu_dibooking.nama_makanan', 'left');
        $this->db->where('menu.status_delete = 0 OR menu.status_delete IS NULL');
        $this->db->where("menu.stok != 'Tidak Tersedia'");
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('total_orders', 'DESC');
        $this->db->limit($limit);

        return $this->db->get()->result_array();
    }

    // Mendapatkan ID menu populer untuk penandaan
    public function getPopularMenuIds()
    {
        // Dapatkan ID menu populer berdasarkan nama_makanan
        $this->db->select('menu.id_menu');
        $this->db->from('menu');
        $this->db->join('menu_dibooking', 'menu.nama_menu = menu_dibooking.nama_makanan', 'left');
        $this->db->where('menu.status_delete = 0 OR menu.status_delete IS NULL');
        $this->db->where("menu.stok != 'Tidak Tersedia'");
        $this->db->group_by('menu.id_menu');
        $this->db->order_by('SUM(menu_dibooking.jumlah)', 'DESC');
        $this->db->limit(10);

        $results = $this->db->get()->result_array();
        return array_column($results, 'id_menu');
    }
    // Mendapatkan menu terkait berdasarkan kategori yang sama
    public function getRelatedMenu($id)
    {
        // Dapatkan menu yang dipilih
        $selected_menu = $this->getMakananById($id);

        if (empty($selected_menu)) {
            return [];
        }

        $kategori = $selected_menu[0]['kategori'];

        // Dapatkan menu dengan kategori yang sama (kecuali menu yang sedang dilihat)
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('kategori', $kategori);
        $this->db->where('id_menu !=', $id);
        $this->db->where('status_delete = 0 OR status_delete IS NULL');
        $this->db->where("stok != 'Tidak Tersedia'");
        $this->db->limit(4);

        return $this->db->get()->result_array();
    }
}
