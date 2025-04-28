<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (empty($this->session->userdata('id_pegawai'))) {
        //     redirect('auth/loginPegawai', 'refresh');
        // }
        $this->load->model('pembayaran_model');
        $this->pembayaran_model->checkExpiredPayments();
        $data['title'] = 'Daftar Riwayat Pemesanan';
        $data['booking'] = $this->pembayaran_model->getAllBooking();
    }

    public function getProfilUsaha()
    {
        $getProfil = $this->db->query("SELECT * FROM profil_usaha");
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
        if (empty($this->session->userdata('id_pegawai'))) {
            redirect('auth/loginPegawai', 'refresh');
        }
        $data['title'] = 'Daftar Riwayat Pemesanan';
        $data['booking'] = $this->pembayaran_model->getAllBooking();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/bayar/index');
        $this->load->view('admin/layout/footer');
    }

    public function cari()
    {
        $this->form_validation->set_rules('keyword', 'keyword', 'required');
        $profil = $this->getProfilUsaha();

        if ($this->form_validation->run() == FALSE) {
            $data['nama_usaha'] = $profil['nama_usaha'];
            $data['alamat'] = $profil['alamat'];
            $data['jam_operasional'] = $profil['jam_operasional'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['instagram'] = $profil['instagram'];
            $data['facebook'] = $profil['facebook'];
            $this->load->view('home/layout/header', $data);
            $this->load->view('home/cekbayar', $data);
            $this->load->view('home/layout/footer');
        } else {
            $keyword = $this->input->post('keyword', true);
            $data = $this->db->query("SELECT * FROM booking WHERE id_detail_menu = '$keyword'");

            // Inisialisasi variabel
            $status = '';
            $batas_dp = '';
            $bukti_pembayaran = '';

            // Cek apakah data ditemukan
            if ($data->num_rows() > 0) {
                foreach ($data->result_array() as $result) {
                    $batas_dp = $result['batas_pembayaran_dp'];
                    $status = $result['status_pembayaran'];
                    $bukti_pembayaran = $result['bukti_pembayaran'];
                }

                date_default_timezone_set('Asia/Bangkok');
                $tanggal_batas_bayar = strtotime($batas_dp);
                $tanggal_sekarang = strtotime(date('Y-m-d H:i:s'));
                $diff = $tanggal_batas_bayar - $tanggal_sekarang;
                $hours = $diff / 3600;

                // batas bayar satuan jam.
                if ($hours < 0 || $status === "Hangus") {
                    // Jika sudah hangus atau melewati batas waktu
                    if ($status !== "Hangus") {
                        // Update status menjadi Hangus jika belum
                        $this->db->where('id_detail_menu', $keyword);
                        $this->db->update('booking', ['status_pembayaran' => 'Hangus']);
                    }
                    $data = array('keyword' => 'Invalid', 'bbayar' => 'Invalid', 'status' => "Hangus");
                } else {
                    // Di dalam metode cari()
                    if ($status == "Menunggu Pembayaran" && $bukti_pembayaran == "Kosong") {
                        $data = array('keyword' => $keyword, 'bbayar' => 'Valid', 'status' => $status);
                    } else if ($status == "Belum Bayar" && $bukti_pembayaran == "Gambar Salah") {
                        // Status Belum Bayar untuk bukti pembayaran yang salah
                        $data = array('keyword' => $keyword, 'bbayar' => 'Gambar Salah', 'status' => $status);
                    } else {
                        $data = array('keyword' => 'Invalid', 'bbayar' => 'Invalid', 'status' => $status);
                    }
                }
            } else {
                // Data tidak ditemukan - tambahkan kode ini untuk menangani NOT FOUND
                $data = array('keyword' => $keyword, 'bbayar' => null, 'status' => null);
            }

            $data['nama_usaha'] = $profil['nama_usaha'];
            $data['alamat'] = $profil['alamat'];
            $data['jam_operasional'] = $profil['jam_operasional'];
            $data['nomor_telepon'] = $profil['nomor_telepon'];
            $data['instagram'] = $profil['instagram'];
            $data['facebook'] = $profil['facebook'];
            $this->load->view('home/layout/header', $data);
            $this->load->view('home/cekbayar', $data);
            $this->load->view('home/layout/footer');
        }
    }
    public function edit($id)
    {
        // Cek status pembayaran dulu
        $booking = $this->pembayaran_model->getBookingById($id);
        if (!empty($booking) && $booking[0]['status_pembayaran'] == 'Hangus') {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Pembayaran sudah hangus dan tidak dapat diproses.
        </div>');
            redirect('pembayaran');
            return;
        }

        $data['title'] = 'Detail & Konfirmasi';
        $data['booking'] = $booking;
        $data['title'] = 'Detail & Konfirmasi';
        $data['booking'] = $this->pembayaran_model->getBookingById($id);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/bayar/detail');
        $this->load->view('admin/layout/footer');
    }

    public function prosesEdit()
    {
        $this->form_validation->set_rules('total_sudah_dibayar', 'total_sudah_dibayar', 'required|numeric');
        $this->form_validation->set_rules('status_pembayaran', 'status_pembayaran', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
        Gagal Mengkonfirmasi Pembayaran
       </div>');
            redirect('pembayaran');
        } else {
            // Cek status pembayaran baru
            $status_baru = $this->input->post('status_pembayaran');

            // Jika status diubah menjadi "Sudah Bayar", proses normal
            $this->pembayaran_model->edit();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Sukses Mengkonfirmasi Pembayaran
        </div>');
            redirect('pembayaran');
        }
    }

    public function detail($id)
    {
        $data['title'] = 'Bukti Pembayaran';
        $data['booking'] = $this->pembayaran_model->getBookingById($id);
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/bayar/gambar');
        $this->load->view('admin/layout/footer');
    }

    public function delete($id)
    {
        if (empty($this->session->userdata('id_pegawai'))) {
            redirect('auth/loginPegawai', 'refresh');
        }
        if ($this->session->userdata('jabatan') != "admin") {
            redirect('pembayaran');
        } else {
            $this->pembayaran_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sukses Menghapus Data Pemesanan
            </div>');
            redirect('pembayaran');
        }
    }

    public function uploadGambar()
    {
        $profil = $this->getProfilUsaha();
        $this->pembayaran_model->uploadBuktiBayar();
        $data['nama_usaha'] = $profil['nama_usaha'];
        $data['alamat'] = $profil['alamat'];
        $data['jam_operasional'] = $profil['jam_operasional'];
        $data['nomor_telepon'] = $profil['nomor_telepon'];
        $data['instagram'] = $profil['instagram'];
        $data['facebook'] = $profil['facebook'];
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sukses Mengupload bukti pembayaran.
            </div>');
        $this->load->view('home/layout/header', $data);
        $this->load->view('home/cekbayar', $data);
        $this->load->view('home/layout/footer');
    }
}
