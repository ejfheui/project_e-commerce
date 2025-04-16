<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JasaKirim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('JasaKirim_model');
    }

    public function jasa_kirim_paket()
    {
        $data['title'] = 'Jasa Kirim Paket';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['jasa_kirim'] = $this->JasaKirim_model->getAllJasaKirim();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/jasa_kirim_paket', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->JasaKirim_model->tambahData();
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data produk berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ');
        redirect('JasaKirim/jasa_kirim_paket');
    }

    public function edit()
    {
        $this->JasaKirim_model->editData();
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data produk berhasil diupdate!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ');
        redirect('JasaKirim/jasa_kirim_paket');
    }

    public function hapus($id)
    {
        $this->JasaKirim_model->hapusData($id);
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data produk berhasil dihapus!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ');
        redirect('JasaKirim/jasa_kirim_paket');
    }
}
