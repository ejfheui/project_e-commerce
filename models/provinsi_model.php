<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Provinsi_model extends CI_Model
{
    public function get_all_provinsi()
    {
        return $this->db->get('provinsi')->result_array();
    }

    public function get_provinsi_by_id($id)
    {
        return $this->db->get_where('provinsi', ['id_provinsi' => $id])->row_array();
    }

    public function add_provinsi($data)
    {
        return $this->db->insert('provinsi', $data);
    }

    public function update_provinsi($id, $data)
    {
        $this->db->where('id_provinsi', $id);
        return $this->db->update('provinsi', $data);
    }
}
