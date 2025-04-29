<?php

defined('BASEPATH') or exit('No direct script access allowed');

class pembayaran_model extends CI_Model
{
    // Tambahkan array status pembayaran yang valid di sini
    private $status_pembayaran_valid = [
        'Menunggu Pembayaran',
        'Belum Bayar',
        'Sudah Bayar',
        'Lunas',
        'Hangus'
    ];

    // Fungsi untuk validasi status
    public function isValidStatus($status)
    {
        return in_array($status, $this->status_pembayaran_valid);
    }
    public function getAllBooking()
    {

        $query = $this->db->query("SELECT * FROM booking");
        return $query->result_array();
    }

    public function getBookingById($id)
    {
        // Modifikasi query untuk mengambil nomor_meja dari tabel meja
        $query = $this->db->query("SELECT booking.*, meja.nomor_meja 
                                  FROM booking 
                                  LEFT JOIN meja ON booking.id_meja = meja.id_meja 
                                  WHERE booking.id_booking = $id");
        return $query->result_array();
    }

    public function checkExpiredPayments()
    {
        date_default_timezone_set('Asia/Bangkok');
        $tanggal_sekarang = date('Y-m-d H:i:s');

        // Query untuk mendapatkan semua booking yang masih dalam status menunggu pembayaran
        $query = $this->db->query(
            "SELECT id_booking, batas_pembayaran_dp 
         FROM booking 
         WHERE (status_pembayaran = 'Menunggu Pembayaran' OR status_pembayaran = 'Belum Bayar') 
         AND bukti_pembayaran = 'Kosong'"
        );

        $expired_bookings = array();

        foreach ($query->result_array() as $booking) {
            $tanggal_batas_bayar = strtotime($booking['batas_pembayaran_dp']);
            $tanggal_sekarang_timestamp = strtotime($tanggal_sekarang);

            if ($tanggal_sekarang_timestamp > $tanggal_batas_bayar) {
                // Melewati batas waktu, update status menjadi "Hangus"
                $this->db->where('id_booking', $booking['id_booking']);
                $this->db->update('booking', ['status_pembayaran' => 'Hangus']);

                $expired_bookings[] = $booking['id_booking'];
            }
        }

        return $expired_bookings;
    }

    public function edit()
    {
        $id_booking = $this->input->post('id_booking');
        $status_pembayaran = $this->input->post('status_pembayaran');

        // Update dengan status pembayaran dan total yang dibayarkan
        $data = [
            "status_pembayaran" => $status_pembayaran,
            "total_sudah_dibayar" => $this->input->post('total_sudah_dibayar')
        ];

        $this->db->where('id_booking', $id_booking);
        $this->db->update('booking', $data);

        // Jika status berubah menjadi "Belum Bayar", perbarui status bukti pembayaran
        if ($status_pembayaran == "Belum Bayar") {
            $data_bukti = [
                "bukti_pembayaran" => "Gambar Salah"
            ];
            $this->db->where('id_booking', $id_booking);
            $this->db->update('booking', $data_bukti);
        }
    }

    public function cariDetail($keyword)
    {
        $query = $this->db->query("SELECT * FROM booking where id_detail_menu like '%$keyword%' ");
        return $query->result_array();
    }

    public function delete($id)
    {
        $this->db->where('id_booking', $id);
        $this->db->delete('booking');
    }

    public function save()
    {
        // Upload Gambar
        if (empty($_FILES['bukti_pembayaran']['name'])) {
            $data = [
                "id_booking" => $this->session->userdata('id_booking'),
                "bukti_pembayaran" => 'Tidak Ada Gambar'
            ];
            $this->db->insert('booking', $data);
        } else {
            $file_name = $_FILES['bukti_pembayaran']['name'];
            $newfile_name = str_replace(' ', '', $file_name);
            $config['upload_path']          = './assets/dataresto/booking/';
            $config['allowed_types']        = 'jpg|png';
            $newName = date('dmYHis') . $newfile_name;
            $config['file_name']         = $newName;
            $config['max_size']             = 5100;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('bukti_pembayaran')) {
                $this->upload->data('file_name');
                $data = [
                    "id_booking" => $this->session->userdata('id_booking'),
                    "bukti_pembayaran" => $newName
                ];
                $this->db->insert('booking', $data);
            }
        }
    }

    public function uploadBuktiBayar()
    {
        $invoice = $this->input->post('invoice');


        $file_name1 = $_FILES['bukti_pembayaran']['name'];
        $newfile_name1 = str_replace(' ', '', $file_name1);
        $config['upload_path']          = './assets/dataresto/bukti_bayar';
        $newName = date('dmYHis') .  $newfile_name1;
        $config['file_name']         = $newName;
        $config['max_size']             = 10100;
        $config['allowed_types']        = 'jpg|png|jpeg';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('bukti_pembayaran')) {
            $data = [
                'bukti_pembayaran' => $newName
            ];

            $this->db->where('id_detail_menu', $invoice);
            $this->db->update('booking', $data);
        }
    }
}
