<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meja extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (empty($this->session->userdata('id_pegawai'))) {
            redirect('auth/loginPegawai', 'refresh');
        }
        $this->load->model('Meja_model');
    }

    // Fungsi untuk mengaktifkan semua meja sekaligus
    public function activate_all_tables()
    {
        $this->Meja_model->update_all_tables_status(1);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Sukses mengaktifkan semua meja menjadi tersedia
    </div>');
        redirect('meja');
    }

    // Fungsi untuk menonaktifkan semua meja sekaligus
    public function deactivate_all_tables()
    {
        $this->Meja_model->update_all_tables_status(0);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Sukses menonaktifkan semua meja menjadi tidak tersedia
    </div>');
        redirect('meja');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Pegawai';
        $data['meja'] = $this->Meja_model->get_meja();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/layout/side');
        $this->load->view('admin/layout/side-header');
        $this->load->view('admin/meja/index');
        $this->load->view('admin/layout/footer');
    }

    public function tambah()
    {
        $this->form_validation->set_rules(
            'nomor_meja',
            'nomor_meja',
            'required|is_unique[meja.nomor_meja]',
            array(
                'is_unique'     => 'Nomor Meja Tidak Boleh Sama!'
            )
        );
        $this->form_validation->set_rules('kapasitas', 'kapasitas', 'numeric|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('meja');
        } else {
            $this->Meja_model->tambah_meja();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sukses Menambah Data Meja
            </div>');
            redirect('meja');
        }
    }

    public function edit()
    {
        $this->form_validation->set_rules('kapasitas_meja', 'kapasitas_meja', 'numeric|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('meja');
        } else {
            $this->Meja_model->edit_meja();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Sukses Mengedit Data Meja
            </div>');
            redirect('meja');
        }
    }

    public function get_meja_by_id($id)
    {
        echo json_encode($this->Meja_model->get_meja_by_id($id));
    }

    public function hapus($id)
    {
        $this->Meja_model->hapus_meja($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Sukses Hapus Data Meja
        </div>');
        redirect('meja');
    }

    // Fungsi baru untuk mengubah status ketersediaan meja
    public function update_status()
    {
        $id_meja = $this->input->post('id_meja');
        $status_tersedia = $this->input->post('status_tersedia');

        $this->Meja_model->update_status_meja($id_meja, $status_tersedia);

        $status_text = ($status_tersedia == 1) ? 'tersedia' : 'tidak tersedia';
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Sukses mengubah status meja menjadi ' . $status_text . '
        </div>');

        redirect('meja');
    }
}
