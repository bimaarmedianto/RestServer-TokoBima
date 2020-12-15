<?php
use SebastianBergmann\Environment\Console;

class Produk_model extends CI_Model {
    public function __construct(){
      parent:: __construct();
    }
    
    public function get($id = null, $limit = 5, $offset= 0){
      if($id === null){
        return $this->db->get('produk', $limit, $offset)->result();
      }else{
        return $this->db->get_where('produk', ['id_produk' => $id])->result_array();
      }
    }
    public function count(){
      return $this->db->get('produk')->num_rows();
    }
    
    public function insert($data){
      try{
        $check_produk = $this->db->select('nama_produk')->from('produk')->where(array('nama_produk' => $data['nama_produk']))->get();
        if($data['nama_produk'] === null || $data['stok_produk'] === null || $data['harga_produk'] === null){
          throw new Exception('Terjadi kesalahan: Data tidak boleh kosong.');
          return false;
        }else{
          if($check_produk->num_rows() == 0){
            $this->db->insert('produk', $data);
            return ['status' => true, 'data' => $this->db->affected_rows()];
          }else{
            throw new Exception('Terjadi kesalahan: Nama produk ' . $data['nama_produk'] . ' sudah terdaftar.');
            return false;
          }
        }
      }catch(Exception $e){
        return ['status' => false, 'msg' => $e->getMessage()];
      }
    }

    public function update($id, $data){
      try{
        $check_id = $this->db->select('id_produk')->from('produk')->where(array('id_produk' => $id))->get();
        if($check_id->num_rows() === 0){
          throw new Exception('Terjadi kesalahan: ID tidak ditemukan.');
          return false;
        }else{
          if($data['nama_produk'] === null || $data['stok_produk'] === null || $data['harga_produk'] === null){
            throw new Exception('Terjadi kesalahan: Data tidak boleh kosong.');
            return false;
          }else{
            $this->db->update('produk', $data, ['id_produk' => $id]);
            return ['status' => true, 'data' => $this->db->affected_rows()];
          }
        }
      }catch(Exception $e){
        return ['status' => false, 'msg' => $e->getMessage()];
      }
    }

    public function delete($id){
      try{
        $check_id = $this->db->select('id_produk')->from('produk')->where(array('id_produk' => $id))->get();
        if($check_id->num_rows() === 0){
          throw new Exception('Terjadi kesalahan: ID tidak ditemukan.');
          return false;
        }else{
          $this->db->delete('produk', ['id_produk' => $id]);
          return ['status' => true, 'data' => $this->db->affected_rows()];
        }
      }catch(Exception $e){
        return ['status' => false, 'msg' => $e->getMessage()];
      }
    }
  }
?>