<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KategoriProduk_model extends CI_Model
{
    public function getAllKategori()
    {
        return $this->db->get('m_kategori_produk')->result_array();
    }

    public function addKategori($data)
    {
        $this->db->insert('m_kategori_produk', $data);
    }

    public function editKategori($id, $data)
    {
        $this->db->where('id_kategori', $id);
        $this->db->update('m_kategori_produk', $data);
    }

    public function deleteKategori($id)
    {
        $this->db->where('id_kategori', $id);
        $this->db->delete('m_kategori_produk');
    }   
}
