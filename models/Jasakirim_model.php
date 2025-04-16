<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JasaKirim_model extends CI_Model
{
    public function getAllJasaKirim()
    {
        return $this->db->get('jasa_kirim')->result_array();
    }

    public function tambahData()
    {
        $data = [
            'nama_jasa_kirim' => $this->input->post('nama_jasa_kirim', true),
            'estimasi_waktu' => $this->input->post('estimasi_waktu', true),
            'harga_per_km' => $this->input->post('harga_per_km', true),
            'status_aktif' => $this->input->post('status_aktif') ? 1 : 0
        ];
        $this->db->insert('jasa_kirim', $data);
    }

    public function editData()
    {
        $data = [
            'nama_jasa_kirim' => $this->input->post('nama_jasa_kirim', true),
            'estimasi_waktu' => $this->input->post('estimasi_waktu', true),
            'harga_per_km' => $this->input->post('harga_per_km', true),
            'status_aktif' => $this->input->post('status_aktif') ? 1 : 0
        ];
        $this->db->where('id_jasa_kirim', $this->input->post('id_jasa_kirim'));
        $this->db->update('jasa_kirim', $data);
    }

    public function hapusData($id)
    {
        $this->db->where('id_jasa_kirim', $id);
        $this->db->delete('jasa_kirim');
    }

    public function getCheckoutWithJasaKirim()
    {
        $this->db->select('checkout.*, jasa_kirim.nama_jasa_kirim, jasa_kirim.estimasi_waktu, jasa_kirim.harga_per_km');
        $this->db->from('checkout');
        $this->db->join('jasa_kirim', 'checkout.id_jasa_kirim = jasa_kirim.id_jasa_kirim', 'left');
        return $this->db->get()->result_array();
    }
}
