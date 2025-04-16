<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Provinsi_model');
    }

    public function provinsi_daerah()
    {
        $data['title'] = 'Provinsi';

        $data['provinsi'] = $this->Provinsi_model->get_all_provinsi();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/provinsi_daerah', $data);
        $this->load->view('templates/footer');
    }

    public function add_provinsi()
    {
        $data = [
            'nama_provinsi' => $this->input->post('nama_provinsi'),
            'daerah'   => $this->input->post('daerah'),
            'kode_pos'    => $this->input->post('kode_pos'),
            'kecamatan'    => $this->input->post('kecamatan')
        ];

        $this->Provinsi_model->add_provinsi($data);
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data berhasil ditambahkan!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ');
        redirect('provinsi/provinsi_daerah');
    }

    public function edit_provinsi()
    {
        $id = $this->input->post('id_provinsi');
        $data = [
            'nama_provinsi' => $this->input->post('nama_provinsi'),
            'daerah'   => $this->input->post('daerah'),
            'kode_pos'    => $this->input->post('kode_pos'),
            'kecamatan'    => $this->input->post('kecamatan')
        ];

        $this->Provinsi_model->update_provinsi($id, $data);
        $this->session->set_flashdata('message', '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-3"></i> Data berhasil di update!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    ');
        redirect('provinsi/provinsi_daerah');
    }
}
