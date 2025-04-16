<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan_model extends CI_Model
{
    public function get_all_pesanan()
    {
        return $this->db->get('pesanan')->result_array();
    }

    public function update_status($id_pesanan, $status)
    {
        $this->db->where('id_pesanan', $id_pesanan);
        return $this->db->update('pesanan', ['status' => $status]);
    }
}
