<?php

use chriskacerguis\RestServer\RestController;
class Produk extends RestController {
  public function __construct(){
    parent:: __construct();
    $this->load->model('produk_model', 'produk');
  }
  
  public function index_get(){
    $id = $this->get('id');   
    if($id === null){
      $page = $this->get('page');
      $page = (empty($page) ? 1 : $page);
      $count_data = $this->produk->count();
      $count_page = ceil($count_data / 5);
      $start = ($page - 1) * 5;
      $list = $this->produk->get(null, 5, $start);
      if($list){
        $data = [
          'status' => true,
          'page' => $page,
          'count_data' => $count_data,
          'count_page' => $count_page,
          'data' => $list
        ];
      }else{
        $data = [
          'status' => false,
          'msg' => 'Data tidak ditemukan.'
        ];
      }
      $this->response([$data], RestController::HTTP_OK);
    }else{
      $data = $this->produk->get($id);
      if($data){
        $this->response(['status'=>true, 'data'=>$data], RestController::HTTP_OK);
      }else{
        $this->response(['status'=>false, 'msg'=>$id . ' tidak ditemukan.'], RestController::HTTP_NOT_FOUND);
      }
    }
  }

  public function index_post(){
    $data = [
      'nama_produk' => $this->post('nama_produk', true), 
      'stok_produk' => $this->post('stok_produk', true), 
      'harga_produk' => $this->post('harga_produk', true)
    ];
    $insert = $this->produk->insert($data);
    if($insert['status']){
      $this->response(['status' => true, 'msg' => $insert['data'] . ' data telah tersimpan.'], RestController::HTTP_CREATED);
    }else{
      $this->response(['status' => false, 'msg' => $insert['msg']], RestController::HTTP_BAD_REQUEST);
    }
  }

  public function index_put(){
    $data = [
      'nama_produk' => $this->put('nama_produk', true), 
      'stok_produk' => $this->put('stok_produk', true), 
      'harga_produk' => $this->put('harga_produk', true)
    ];
    $id = $this->put('id', true);
    if($id === null){
      $this->response(['status' => false, 'msg' => 'Terjadi kesalahan: ID tidak boleh kosong.'], RestController::HTTP_BAD_REQUEST);
    }else{
      $update = $this->produk->update($id, $data);
      if($update['status']){
        if((int)$update['data'] > 0){
          $this->response(['status' => true, 'msg' => $update['data'] . ' data telah dirubah.'], RestController::HTTP_OK);              
        }else{
          $this->response(['status' => true, 'msg' => 'Tidak ada data yang dirubah.'], RestController::HTTP_OK);
        }
      }else{
        $this->response(['status' => false, 'msg' => $update['msg']], RestController::HTTP_BAD_REQUEST);
      }
    }
  }

  public function index_delete(){
    $id = $this->delete('id');
    if($id === null){
      $this->response(['status' => false, 'msg' => 'Terjadi kesalahan: ID tidak boleh kosong.'], RestController::HTTP_BAD_REQUEST);
    }else{
      $delete = $this->produk->delete($id);
      if($delete['status']){
        $this->response(['status' => true, 'msg' => 'ID:' . $id . ' telah dihapus.'], RestController::HTTP_OK);              
      }else{
        $this->response(['status' => false, 'msg' => $delete['msg']], RestController::HTTP_BAD_REQUEST);
      }
    }
  }
}
