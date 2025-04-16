<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KelolaProduk_model extends CI_Model
{
    public function getAllProduk()
    {
        $this->db->select('m_kelola_produk.*, m_kategori_produk.nama_kategori');
        $this->db->from('m_kelola_produk');
        $this->db->join('m_kategori_produk', 'm_kategori_produk.id_kategori = m_kelola_produk.id_kategori');
        $produk = $this->db->get()->result_array();

        foreach ($produk as &$p) {
          
            $varian = $this->db->get_where('m_varian_produk', ['id_kelola' => $p['id_kelola']])->result_array();
            $p['varian'] = $varian;

            $p['total_stok'] = array_sum(array_column($varian, 'stok_varian'));
        }
        return $produk;
    }
            
    public function getProdukByKategori($kategori_id = null)
    {
        $this->db->select('m_kelola_produk.*, m_kategori_produk.nama_kategori, m_kelola_produk.foto');
        $this->db->from('m_kelola_produk');
        $this->db->join('m_kategori_produk', 'm_kelola_produk.id_kategori = m_kategori_produk.id_kategori');

        if ($kategori_id) {
            $this->db->where('m_kelola_produk.id_kategori', $kategori_id);
        }

        $this->db->order_by('m_kelola_produk.tanggal', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_product_by_id($id_kelola)
    {
        return $this->db->get_where('m_kelola_produk', ['id_kelola' => $id_kelola])->row_array();
    }

    public function addProduk($data, $varian, $stok_varian, $varian_tambahan = [], $harga_varian = [], $stok_warna_varian = [])
    {
        $this->db->insert('m_kelola_produk', $data);
        $id_kelola = $this->db->insert_id();
    
        // Simpan varian utama
        if (!empty($varian) && !empty($stok_varian)) {
            for ($i = 0; $i < count($varian); $i++) {
                $stok = isset($stok_varian[$i]) ? $stok_varian[$i] : 0;
                $harga = isset($harga_varian[$i]) ? $harga_varian[$i] : '';
    
                $this->db->insert('m_varian_produk', [
                    'id_kelola' => $id_kelola,
                    'nama_varian' => $varian[$i],
                    'stok_varian' => $stok,
                    'varian_tambahan' => '',
                    'harga_varian' => $harga
                ]);
            }
        }
    
        // Simpan varian tambahan (warna)
        if (!empty($varian_tambahan)) {
            for ($i = 0; $i < count($varian_tambahan); $i++) {
                $vt = trim($varian_tambahan[$i]);
                $stok_warna = isset($stok_warna_varian[$i]) ? $stok_warna_varian[$i] : 0;
        
                if ($vt !== '') {
                    $this->db->insert('m_varian_produk', [
                        'id_kelola' => $id_kelola,
                        'nama_varian' => '',
                        'stok_varian' => 0, 
                        'stok_warna_varian' => $stok_warna, 
                        'varian_tambahan' => $vt,
                        'harga_varian' => ''
                    ]);                    
                }
            }
        }        
    }     
    
    public function deleteProduk($id)
    {
        $this->db->where('id_kelola', $id);
        $this->db->delete('m_kelola_produk');

        return $this->db->affected_rows() > 0; 
    }

    public function updateProduk($id, $data)
    {
        $this->db->where('id_kelola', $id);
        $this->db->update('m_kelola_produk', $data);
    }        

    public function updateVarianProduk($id_kelola, $varian, $stok_varian, $varian_tambahan, $harga_varian, $stok_warna_varian)
    {
        
        $this->db->where('id_kelola', $id_kelola);
        $this->db->delete('m_varian_produk');
    
        if (!empty($varian)) {
            for ($i = 0; $i < count($varian); $i++) {
                $this->db->insert('m_varian_produk', [
                    'id_kelola' => $id_kelola,
                    'nama_varian' => $varian[$i],
                    'stok_varian' => isset($stok_varian[$i]) ? $stok_varian[$i] : 0,
                    'varian_tambahan' => '',
                    'harga_varian' => isset($harga_varian[$i]) ? $harga_varian[$i] : ''
                ]);
            }
        }
    
        if (!empty($varian_tambahan)) {
            for ($j = 0; $j < count($varian_tambahan); $j++) {
                $vt = trim($varian_tambahan[$j]);
                if ($vt !== '') {
                    $this->db->insert('m_varian_produk', [
                        'id_kelola' => $id_kelola,
                        'nama_varian' => '',
                        'stok_varian' => isset($stok_warna_varian[$j]) ? $stok_warna_varian[$j] : 0,
                        'varian_tambahan' => $vt,
                        'harga_varian' => ''
                    ]);
                }
            }
        }
    }    
} 