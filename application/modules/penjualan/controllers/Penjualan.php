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
    $data['title'] = 'Kelola data penjualan';
    $data['data_barang'] = $this->M_global->data_barang();
    $data['data_jenis'] = $this->M_global->data_jenis();
    $data['data_penjualan'] = $this->M_penjualan->data_penjualan();
    

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar');
    $this->load->view('index', $data);
    $this->load->view('template/footer');
  }
  public function aksi_tambah_penjualan()
  {
    $id_barang = $this->input->post('id_barang');
    $jml_terjual = $this->input->post('jml_terjual');
    $tgl_transaksi = $this->input->post('tgl_transaksi');

    $data = [
        'id_barang' => $id_barang,
        'jml_terjual' => $jml_terjual,
        'tgl_transaksi' => $tgl_transaksi,
    ];

    $this->M_penjualan->insert_data('penjualan', $data);
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Penjualan Berhasil Ditambahkan <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('penjualan/');
  }

  public function aksi_update_penjualan()
  {
    $id_penjualan = $this->input->post('id_penjualan');
    $id_barang = $this->input->post('id_barang');
    $jml_terjual = $this->input->post('jml_terjual');
    $tgl_transaksi = $this->input->post('tgl_transaksi');


    $where = [
        'id_penjualan' =>$id_penjualan,
    ];

    $data = [
        'id_barang' => $id_barang,
        'jml_terjual' => $jml_terjual,
        'tgl_transaksi' => $tgl_transaksi,
    ];

    $this->M_penjualan->update_data($where, $data, 'penjualan');
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Penjualan Berhasil Diupdate <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('penjualan/');
  }

  public function aksi_delete_data($id)
  {

    $where = [
        'id_penjualan' => $id,
    ];

    $this->M_penjualan->hapus_data($where, 'penjualan');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Penjualan Berhasil Dihapus <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('penjualan/');
  }

  public function filter()
  {

    $id = $this->input->post('id_jenis');
    $tgl_awal = $this->input->post('tgl_awal');
    $tgl_akhir = $this->input->post('tgl_akhir');
    $filter_jml_terjual = $this->input->post('filter_jml_terjual');

    $data['title'] = 'Kelola data penjualan';
    $data['data_barang'] = $this->M_global->data_barang();
    $data['data_jenis'] = $this->M_global->data_jenis();
    $data['data_penjualan'] = $this->M_penjualan->data_penjualan();

    $data['data_filter'] = $this->M_global->filter_data2($id,$tgl_awal,$tgl_akhir,$filter_jml_terjual);
     
    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar');
    $this->load->view('filter', $data);
    $this->load->view('template/footer');
  }

}