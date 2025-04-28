<?php

defined('BASEPATH') or exit('No direct script access allowed');

class penjualan_model extends CI_Model
{
    public function getAllBooking()
    {
        // Memodifikasi query untuk hanya mengambil data dengan status "Sudah Bayar" atau "Sudah Bayar DP" atau "Lunas"
        $query = $this->db->query("SELECT * FROM booking WHERE status_pembayaran = 'Sudah Bayar' OR status_pembayaran = 'Sudah Bayar DP' OR status_pembayaran = 'Lunas'");
        return $query->result_array();
    }

    public function getBookingById($id)
    {
        $query = $this->db->query("SELECT * FROM booking WHERE id_booking = $id");
        return $query->result_array();
    }

    public function getBookingByInvoice($invoice)
    {
        $query = $this->db->query("SELECT * FROM booking b JOIN meja m on b.id_meja = m.id_meja WHERE b.id_detail_menu = '$invoice'");
        return $query->row();
    }

    public function getTransaksiByInvoice($invoice)
    {
        $query = $this->db->query("SELECT * FROM menu_dibooking md JOIN menu as m ON md.nama_makanan = m.nama_menu where md.id_detail_menu = '$invoice'");
        return $query->result_array();
    }

    public function cetakBookingById($id)
    {
        $query = $this->db->query("SELECT * FROM booking WHERE id_booking = $id");
        return $query->result_array();
    }

    public function getBookingByDate($startDate, $endDate)
    {
        // Memodifikasi query untuk hanya mengambil data dengan status "Sudah Bayar", "Sudah Bayar DP", atau "Lunas" dalam rentang tanggal
        $query = $this->db->query("SELECT * FROM booking WHERE (status_pembayaran = 'Sudah Bayar' OR status_pembayaran = 'Pesanan Selesai' OR status_pembayaran = 'Lunas') AND tanggal_reservasi BETWEEN '$startDate' AND '$endDate'");
        return $query->result_array();
    }

    public function getProfilUsaha()
    {
        $getProfil = $this->db->query("SELECT * FROM profil_usaha");
        foreach ($getProfil->result_array() as $profil) {
            $arr['nama_usaha'] = $profil['nama_usaha'];
            $arr['deskripsi'] = $profil['deskripsi'];
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
}
