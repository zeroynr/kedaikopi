<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Katalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('katalog_model');
    }

    public function getProfilUsaha()
    {
        $getProfil = $this->db->query("SELECT * FROM profil_usaha");
        $arr = [];
        foreach ($getProfil->result_array() as $profil) {
            $arr['nama_usaha'] = $profil['nama_usaha'];
            $arr['alamat'] = $profil['alamat'];
            $arr['jam_operasional'] = $profil['jam_operasional'];
            $arr['nomor_telepon'] = $profil['nomor_telepon'];
            $arr['maps_link'] = $profil['maps_link'];
            $arr['instagram'] = $profil['instagram'];
            $arr['facebook'] = $profil['facebook'];
            $arr['foto_usaha_1'] = $profil['foto_usaha_1'];
            $arr['foto_usaha_2'] = $profil['foto_usaha_2'];
            $arr['foto_usaha_3'] = $profil['foto_usaha_3'];
        }
        return $arr;
    }

    public function index()
    {
        $profil = $this->getProfilUsaha();
        $data['menu'] = $this->katalog_model->getAllMakanan();
        $data['popular_menu'] = $this->katalog_model->getPopularMenu(4); // Tampilkan 4 menu terpopuler
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['jam_operasional'] = $profil['jam_operasional'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['instagram'] = $profil['instagram'];
        $data['facebook'] = $profil['facebook'];

        // Tandai menu yang populer dan tambahkan informasi stok
        if (!empty($data['menu'])) {
            $popular_menu_ids = $this->katalog_model->getPopularMenuIds();
            foreach ($data['menu'] as $key => $menu) {
                $data['menu'][$key]['is_popular'] = in_array($menu['id_menu'], $popular_menu_ids);
            }
        }

        // Filter out menu items with status 'Tidak Tersedia'
        if (!empty($data['menu'])) {
            $filtered_menu = [];
            foreach ($data['menu'] as $menu) {
                if (!isset($menu['stok']) || $menu['stok'] !== 'Tidak Tersedia') {
                    $filtered_menu[] = $menu;
                }
            }
            $data['menu'] = $filtered_menu;
        }

        $this->load->view('home/layout/header', $data);
        $this->load->view('home/katalog/index');
        $this->load->view('home/layout/footer');
    }

    public function search()
    {
        $profil = $this->getProfilUsaha();

        // Trim input values to handle spaces
        $keyword = trim($this->input->get('keyword'));
        $filter = trim($this->input->get('filter'));

        // Optional debugging
        // echo "Keyword: [" . $keyword . "]<br>";
        // echo "Filter: [" . $filter . "]<br>";

        // Panggil fungsi pencarian dari model
        $menu_results = $this->katalog_model->searchMenu($keyword, $filter);

        // Filter stok yang tidak tersedia 
        $filtered_menu = [];
        foreach ($menu_results as $menu) {
            if (!isset($menu['stok']) || $menu['stok'] !== 'Tidak Tersedia') {
                $filtered_menu[] = $menu;
            }
        }

        $data['menu'] = $filtered_menu;
        $data['result_count'] = count($filtered_menu);

        // Pass search parameters back to the view for user feedback
        $data['keyword'] = $keyword;
        $data['filter'] = $filter;

        // Data profil untuk header
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['jam_operasional'] = $profil['jam_operasional'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['instagram'] = $profil['instagram'];
        $data['facebook'] = $profil['facebook'];

        // Tandai menu yang populer
        if (!empty($data['menu'])) {
            $popular_menu_ids = $this->katalog_model->getPopularMenuIds();
            foreach ($data['menu'] as $key => $menu) {
                $data['menu'][$key]['is_popular'] = in_array($menu['id_menu'], $popular_menu_ids);
            }
        }

        $this->load->view('home/layout/header', $data);
        $this->load->view('home/katalog/index');
        $this->load->view('home/layout/footer');
    }

    public function pemesanan()
    {
        $this->load->model('Meja_model');
        $this->load->model('Makanan_model');

        $profil = $this->getProfilUsaha();
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['deskripsi'] = $profil['deskripsi'];
        $data['alamat'] = $profil['alamat'];
        $data['jam_operasional'] = $profil['jam_operasional'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['instagram'] = $profil['instagram'];
        $data['facebook'] = $profil['facebook'];
        $data['maps_link'] = $profil['maps_link'];

        $data['menu'] = $this->Makanan_model->getMakananTersedia();

        $this->load->view('home/layout/header', $data);
        $this->load->view('home/pemesanan');
        $this->load->view('home/layout/footer');
    }

    public function detail($id)
    {
        $profil = $this->getProfilUsaha();
        $data['menu'] = $this->katalog_model->getMakananById($id);

        // Cek apakah menu ditemukan
        if (empty($data['menu'])) {
            show_404();
            return;
        }

        $data['gambar_menu'] = $this->katalog_model->getGambarById($id);
        $data['related_menu'] = $this->katalog_model->getRelatedMenu($id); // Menu terkait
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['jam_operasional'] = $profil['jam_operasional'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['instagram'] = $profil['instagram'];
        $data['facebook'] = $profil['facebook'];

        // Cek apakah menu ini populer
        $popular_menu_ids = $this->katalog_model->getPopularMenuIds();
        $data['is_popular'] = in_array($id, $popular_menu_ids);

        // Tambahkan jumlah pesanan jika menu ini populer
        $data['total_orders'] = $this->katalog_model->getTotalOrders($id);

        // Tandai menu terkait yang populer
        if (!empty($data['related_menu'])) {
            foreach ($data['related_menu'] as $key => $menu) {
                $data['related_menu'][$key]['is_popular'] = in_array($menu['id_menu'], $popular_menu_ids);
            }
        }

        // Filter out related menu items with status 'Tidak Tersedia'
        if (!empty($data['related_menu'])) {
            $filtered_related = [];
            foreach ($data['related_menu'] as $menu) {
                if (!isset($menu['stok']) || $menu['stok'] !== 'Tidak Tersedia') {
                    $filtered_related[] = $menu;
                }
            }
            $data['related_menu'] = $filtered_related;
        }

        $this->load->view('home/layout/header', $data);
        $this->load->view('home/katalog/detail');
        $this->load->view('home/layout/footer');
    }
}
