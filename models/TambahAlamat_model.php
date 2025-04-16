<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TambahAlamat_model extends CI_Model
{
    public function get_all_alamat()
    {
        return $this->db->get('tambah_alamat')->result_array();
    }

    public function insert_alamat($data)
    {
        return $this->db->insert('tambah_alamat', $data);
    }

    public function get_alamat_by_id($id)
    {
        return $this->db->get_where('tambah_alamat', ['id_tambahalamat' => $id])->row_array();
    }

    public function update_alamat($id, $data)
    {
        $this->db->where('id_tambahalamat', $id);
        return $this->db->update('tambah_alamat', $data);
    }

    public function delete_alamat($id)
    {
        $this->db->where('id_tambahalamat', $id);
        return $this->db->delete('tambah_alamat');
    }
}
