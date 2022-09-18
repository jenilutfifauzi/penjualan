<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    // load session library
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model(['M_penjualan','M_global']);
  }

  public function index()
  {
    $data = $this->session->userdata();
    $data['title'] = 'Kelola Barang';
    $data['data_jenis_barang'] = $this->M_global->data_jenis();
    $data['data_barang'] = $this->M_barang->data_barang();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar');
    $this->load->view('index', $data);
    $this->load->view('template/footer');
  }
  public function aksi_tambah_barang()
  {
    $nama_barang = $this->input->post('nama_barang');
    $jenis_barang = $this->input->post('jenis_barang');
    $stok = $this->input->post('stok');

    $data = [
        'nama_barang' => $nama_barang,
        'id_jenis' => $jenis_barang,
        'stok' => $stok,
    ];

    $this->M_barang->insert_data('barang', $data);
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Barang Berhasil Ditambahkan <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('barang/');
  }

  public function aksi_update_barang()
  {
    $id_brg = $this->input->post('id_barang');
    $nama_barang = $this->input->post('nama_barang');
    $jenis_barang = $this->input->post('jenis_barang');
    $stok = $this->input->post('stok');

    $where = [
        'id_barang' =>$id_brg,
    ];

    $data = [
        'nama_barang' => $nama_barang,
        'id_jenis' => $jenis_barang,
        'stok' => $stok,
    ];

    $this->M_barang->update_data($where, $data, 'barang');
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Barang Berhasil Diupdate <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('barang/');
  }

  public function aksi_delete_data($id)
  {

    $where = [
        'id_barang' => $id,
    ];

    $this->M_barang->hapus_data($where, 'barang');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Barang Berhasil Dihapus <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('barang/');
  }


}