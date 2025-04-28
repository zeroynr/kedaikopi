<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Profilusaha_model extends CI_Model
{
    public function getProfilUsaha()
    {
        $query = $this->db->query("SELECT * FROM profil_usaha");
        return $query->result_array();
    }

    public function getMetodePembayaran()
    {
        $query = $this->db->query("SELECT * FROM metode_pembayaran");
        return $query->result_array();
    }

    public function get_metode_by_id($id)
    {
        $query = $this->db->query("SELECT * FROM metode_pembayaran WHERE id_metode = $id");
        return $query->row();
    }

    public function updateStatusNotifikasi($status)
    {
        $data = [
            'notifikasi_aktif' => $status,
            'last_updated' => time() // Tambahkan timestamp saat status berubah
        ];
        $this->db->where('id', 1); // Asumsi ID profil usaha default
        $this->db->update('profil_usaha', $data);
        return $this->db->affected_rows();
    }

    public function updatePesanNotifikasi($pesan)
    {
        $data = [
            'pesan_notifikasi' => htmlspecialchars($pesan, true),
            'last_updated' => time() // Tambahkan timestamp saat pesan berubah
        ];
        $this->db->where('id', 1); // Asumsi ID profil usaha default
        $this->db->update('profil_usaha', $data);
        return $this->db->affected_rows();
    }

    // Method tambahan untuk memaksa refresh notifikasi
    public function forceRefreshNotifikasi()
    {
        $data = [
            'last_updated' => time()
        ];
        $this->db->where('id', 1);
        $this->db->update('profil_usaha', $data);
        return $this->db->affected_rows();
    }

    // Method lainnya tetap sama
    public function tambah_metode_pembayaran()
    {
        $data = [
            'nama_merchant' => htmlspecialchars($this->input->post('nama_merchant', true)),
            'kode_pembayaran' => htmlspecialchars($this->input->post('kode_pembayaran', true)),
            'atas_nama' => htmlspecialchars($this->input->post('atas_nama', true)),
        ];
        $this->db->insert('metode_pembayaran', $data);
    }

    public function edit_metode_pembayaran()
    {
        $data = [
            'nama_merchant' => htmlspecialchars($this->input->post('nama_merchant', true)),
            'kode_pembayaran' => htmlspecialchars($this->input->post('kode_pembayaran', true)),
            'atas_nama' => htmlspecialchars($this->input->post('atas_nama', true)),
        ];
        $this->db->where('id_metode', $this->input->post('id_metode'));
        $this->db->update('metode_pembayaran', $data);
    }

    public function hapus_metode_pembayaran($id)
    {
        $this->db->where('id_metode', $id);
        $this->db->delete('metode_pembayaran');
    }

    public function edit_profil_usaha()
    {
        // Kode asli tetap sama
        $pathFUsaha = "assets/dataresto/foto_usaha/";
        $current_usaha = $this->input->post('current_id');
        $getDataGambar = $this->db->query("SELECT * FROM profil_usaha WHERE id = $current_usaha");

        // Dalam getDataGambar, tambahkan:
        foreach ($getDataGambar->result_array() as $gambar) {
            $gambar1_old = $gambar['foto_usaha_1'];
            $gambar2_old = $gambar['foto_usaha_2'];
            $gambar3_old = $gambar['foto_usaha_3'];
            $gambar4_old = $gambar['foto_usaha_4'];  // Tambahkan ini
            $gambar5_old = $gambar['foto_usaha_5'];  // Tambahkan ini
        }

        if ($_FILES['foto_usaha_1']['size'] != 0) {
            $file_name1 = $_FILES['foto_usaha_1']['name'];
            $newfile_name1 = str_replace(' ', '', $file_name1);
            $config['upload_path']          = './assets/dataresto/foto_usaha';
            $newName = date('dmYHis') .  $newfile_name1;
            $config['file_name']         = $newName;
            $config['max_size']             = 10100;
            $config['allowed_types']        = 'jpg|png|jpeg';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('foto_usaha_1')) {
                if ($gambar1_old != "1.jpg") {
                    unlink($pathFUsaha . $gambar1_old);
                }
                $data = [
                    'foto_usaha_1' => $newName
                ];

                $this->db->where('id', $current_usaha);
                $this->db->update('profil_usaha', $data);
            }
        }

        if ($_FILES['foto_usaha_2']['size'] != 0) {
            $file_name2 = $_FILES['foto_usaha_2']['name'];
            $newfile_name2 = str_replace(' ', '', $file_name2);
            $config1['upload_path']          = './assets/dataresto/foto_usaha';
            $newName1 = date('dmYHis') .  $newfile_name2;
            $config1['file_name']         = $newName1;
            $config1['max_size']             = 10100;
            $config1['allowed_types']        = 'jpg|png|jpeg';
            $this->load->library('upload', $config1);
            $this->upload->initialize($config1);
            if ($this->upload->do_upload('foto_usaha_2')) {
                if ($gambar2_old != "2.jpg") {
                    unlink($pathFUsaha . $gambar2_old);
                }
                $data = [
                    'foto_usaha_2' => $newName1
                ];

                $this->db->where('id', $current_usaha);
                $this->db->update('profil_usaha', $data);
            }
        }

        if ($_FILES['foto_usaha_3']['size'] != 0) {
            $file_name3 = $_FILES['foto_usaha_3']['name'];
            $newfile_name3 = str_replace(' ', '', $file_name3);
            $config2['upload_path']          = './assets/dataresto/foto_usaha';
            $newName2 = date('dmYHis') .  $newfile_name3;
            $config2['file_name']         = $newName2;
            $config2['max_size']             = 10100;
            $config2['allowed_types']        = 'jpg|png|jpeg';
            $this->load->library('upload', $config2);
            $this->upload->initialize($config2);
            if ($this->upload->do_upload('foto_usaha_3')) {
                if ($gambar3_old != "3.jpg") {
                    unlink($pathFUsaha . $gambar3_old);
                }
                $data = [
                    'foto_usaha_3' => $newName2
                ];

                $this->db->where('id', $current_usaha);
                $this->db->update('profil_usaha', $data);
            }
        }

        // Tambahkan kode untuk mengelola foto_usaha_4
        if ($_FILES['foto_usaha_4']['size'] != 0) {
            $file_name4 = $_FILES['foto_usaha_4']['name'];
            $newfile_name4 = str_replace(' ', '', $file_name4);
            $config3['upload_path']          = './assets/dataresto/foto_usaha';
            $newName3 = date('dmYHis') .  $newfile_name4;
            $config3['file_name']         = $newName3;
            $config3['max_size']             = 10100;
            $config3['allowed_types']        = 'jpg|png|jpeg';
            $this->load->library('upload', $config3);
            $this->upload->initialize($config3);
            if ($this->upload->do_upload('foto_usaha_4')) {
                if ($gambar4_old != "4.jpg") {
                    unlink($pathFUsaha . $gambar4_old);
                }
                $data = [
                    'foto_usaha_4' => $newName3
                ];

                $this->db->where('id', $current_usaha);
                $this->db->update('profil_usaha', $data);
            }
        }

        // Tambahkan kode untuk mengelola foto_usaha_5
        if ($_FILES['foto_usaha_5']['size'] != 0) {
            $file_name5 = $_FILES['foto_usaha_5']['name'];
            $newfile_name5 = str_replace(' ', '', $file_name5);
            $config4['upload_path']          = './assets/dataresto/foto_usaha';
            $newName4 = date('dmYHis') .  $newfile_name5;
            $config4['file_name']         = $newName4;
            $config4['max_size']             = 10100;
            $config4['allowed_types']        = 'jpg|png|jpeg';
            $this->load->library('upload', $config4);
            $this->upload->initialize($config4);
            if ($this->upload->do_upload('foto_usaha_5')) {
                if ($gambar5_old != "5.jpg") {
                    unlink($pathFUsaha . $gambar5_old);
                }
                $data = [
                    'foto_usaha_5' => $newName4
                ];

                $this->db->where('id', $current_usaha);
                $this->db->update('profil_usaha', $data);
            }
        }

        $data = [
            'nama_usaha' => htmlspecialchars($this->input->post('nama_usaha', true)),
            'deskripsi' => htmlspecialchars($this->input->post('deskripsi', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', true)),
            'nomor_telepon' => htmlspecialchars($this->input->post('nomor_telepon', true)),
            'jam_operasional' => htmlspecialchars($this->input->post('jam_operasional', true)),
            'email' => htmlspecialchars($this->input->post('email', true)),
            'instagram' => htmlspecialchars($this->input->post('instagram', true)),
            'facebook' => htmlspecialchars($this->input->post('facebook', true)),
            'maps_link' => $this->input->post('maps_link')
        ];

        $this->db->where('id', $current_usaha);
        $this->db->update('profil_usaha', $data);
    }
}
