<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout_model extends CI_Model
{
    public function insert_checkout($data)
    {
        return $this->db->insert('checkout', $data);
    }

    public function getCheckoutById($id_checkout)
    {
        $this->db->select('checkout.*, jasa_kirim.nama_jasa_kirim, jasa_kirim.estimasi_waktu, jasa_kirim.harga_per_km');
        $this->db->from('checkout');
        $this->db->join('jasa_kirim', 'checkout.id_jasa_kirim = jasa_kirim.id_jasa_kirim', 'left');
        $this->db->where('checkout.id_checkout', $id_checkout);
        return $this->db->get()->row_array();
    }

}
