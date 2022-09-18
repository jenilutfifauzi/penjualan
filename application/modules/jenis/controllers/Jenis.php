<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    // load session library
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model('M_jenis');
  }

  public function index()
  {
    $data = $this->session->userdata();
    $data['title'] = 'Kelola Jenis Barang';
    $data['data_jenis_barang'] = $this->M_jenis->data_jenis();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar');
    $this->load->view('jenis_barang/index', $data);
    $this->load->view('template/footer');
  }
  public function aksi_tambah_jenis_brg()
  {
    $jenis_brg = $this->input->post('jenis_brg');

    $data = [
        'nama_jenis_barang' => $jenis_brg,
    ];

    $this->M_jenis->insert_data('jenis_barang', $data);
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Jenis Barang Berhasil Ditambahkan <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('jenis/');
  }

  public function aksi_update_jenis_brg()
  {
    $id_brg = $this->input->post('id_jenis');
    $jenis_brg = $this->input->post('jenis_brg');

    $where = [
        'id_jenis' =>$id_brg,
    ];

    $data = [
        'nama_jenis_barang' => $jenis_brg,
    ];

    $this->M_jenis->update_data($where, $data, 'jenis_barang');
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Jenis Barang Berhasil Diupdate <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('jenis/');
  }

  public function aksi_delete_data($id)
  {

    $where = [
        'id_jenis' => $id,
    ];

    $this->M_jenis->hapus_data($where, 'jenis_barang');
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Jenis Barang Berhasil Dihapus <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('jenis/');
  }


}