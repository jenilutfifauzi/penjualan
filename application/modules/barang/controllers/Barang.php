<?php

use LDAP\Result;

defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
    // load session library
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model('M_barang');
  }

  public function index()
  {
    $data = $this->session->userdata();
    $data['title'] = 'Kelola Barang';
    $data['nama_subkomponen'] = $this->M_barang->data_barang();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar');
    $this->load->view('template/dashboard_p', $data);
    $this->load->view('template/footer');
  }
  public function profile()
  {
    $data = $this->session->userdata();
    $data['title'] = 'Kelola Profile';
    $id = $this->session->userdata('id');
    $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar_wadir1');
    $this->load->view('template/profile/profile_wadir1');
    $this->load->view('template/footer');
  }

  public function update_profile()
  {
    $name = $this->input->post('nama');
    $no_hp = $this->input->post('no_hp');

    $where = array(
      'id' => $this->session->userdata('id')
    );
    $data = array(
      'name' => $name,
      'no_hp' => $no_hp
    );
    $this->M_wadir1->update_data($where, $data, 'user');
    echo $this->session->set_flashdata('message', '<div        class="alert alert-success" role="alert">
      Data Profil Berhasil Diupdate <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
          </div>');
    redirect(base_url('wadir1/profile/'));
  }
  public function usulan_anggaran_thn()
  {
    $data = $this->session->userdata();
    $data['data_subkomponen'] = $this->M_wadir1->usulan_thn()->result_array();
    $data['title'] = 'Usulan Anggaran Tahunan';
    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar');
    $this->load->view('draf_thn', $data);
    $this->load->view('template/footer');
  }
  //keg baru
  public function usulan_anggaran_thn_keg_baru()
  {
    $data = $this->session->userdata();
    $data['data_subkomponen'] = $this->M_wadir1->usulan_thn_keg_baru()->result_array();
    $data['title'] = 'Usulan Anggaran Tahunan';
    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar_direktur');
    $this->load->view('draf_thn_keg_baru', $data);
    $this->load->view('template/footer');
  }
  public function lihat_rab()
  {
    $id_data = $this->uri->segment(3);
    $data = $this->session->userdata();
    $data['kode_detail'] = $id_data;
    $data['title'] = 'Kelola RAB';
    $data['durasi'] = $this->db->get('durasiotp')->row();

    $where = array('kode' => $id_data);
    $data['data_rab_kode'] = $this->M_wadir1->edit_data($where, 'kegiatan')->row();
    $data['data_rab'] = $this->M_wadir1->edit_data($where, 'rab')->result_array();
    //data dukung
    $where = array('kode_detail' => $id_data);
    $data['data_dukung_kode'] = $this->M_wadir1->edit_data($where, 'kegiatan')->row();
    $data['data_gambar'] = $this->M_wadir1->edit_data($where, 'data_dukung')->row();
    $data['data_dukung'] = $this->M_wadir1->edit_data($where, 'data_dukung')->result_array();
    $data['data_tor'] = $this->M_wadir1->edit_data($where, 'data_tor')->result_array();
    $data['data_semulamenjadi'] = $this->M_wadir1->edit_data($where, 'data_semulamenjadi')->result_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('template/sidebar_wadir1');
    $this->load->view('rab_datadukung/data_rab_datadukung', $data);
    $this->load->view('template/footer');
  }

  public function tambah_aksi_user()
  {

    $id         = '';
    $name       = $this->input->post('name');
    $email      = $this->input->post('email');
    $password   =  $this->input->post('password');
    $password1  = password_hash($password, PASSWORD_DEFAULT);
    $role       = $this->input->post('role');

    $data = array(
      'id' => $id,
      'name' => $name,
      'email' => $email,
      'password' => $password1,
      'role' => $role,
    );
    $this->m_user->insert_data('user', $data);
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data User Berhasil Ditambahkan <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('admin/manage_user');
  }
  public function delete($id)
  {
    $where = array('id' => $id);
    $this->m_user->hapus_data($where, 'user');
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
      Data User Berhasil Dihapus
      </div>');
    redirect('admin/manage_user');
  }


  public function editotp($id)
  {
    $data = $this->session->userdata();
    $data['title'] = 'Edit durasi';

    $where = array('id' => $id);
    $data['durasi'] = $this->m_user->edit_data($where, 'durasiotp')->result();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('sidebar_wadir1');
    $this->load->view('editdurasi', $data);
    $this->load->view('template/footer');
  }
  public function edit_session($id)
  {
    $data = $this->session->userdata();
    $data['title'] = 'Edit durasi session';

    $where = array('id' => $id);
    $data['durasi'] = $this->m_user->edit_data($where, 'timeout')->result();
    // $durasi = $this->m_user->edit_data($where,'timeout')->result();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('sidebar_wadir1');
    $this->load->view('editdurasilogin', $data);
    $this->load->view('template/footer');
  }

  public function update_otp()
  {
    $id = 1;
    $durasi = $this->input->post('durasi');

    date_default_timezone_set('Asia/Jakarta');
    $tanggalSekarang = date('Y-m-d h:i:s');
    $datetime = new DateTime($tanggalSekarang);
    $datetime->modify('+' . $durasi . ' minute');

    $create = $datetime->format('Y-m-d H:i:s');

    $data = array(
      'id' => $id,
      'durasi' => $durasi,
      'create_at' => $create
    );
    $where = array(
      'id' => $id
    );

    $this->m_user->update_data($where, $data, 'durasiotp');
    redirect('admin/durasiotp');
  }
  public function update_durasi_login()
  {
    $id = 1;
    $durasi = $this->input->post('durasi');
    $durasi = $durasi * 60000;

    date_default_timezone_set('Asia/Jakarta');
    $tanggalSekarang = date('Y-m-d h:i:s');


    $data = array(
      'id' => $id,
      'time' => $durasi,
      'create_at' => $tanggalSekarang,
    );
    $where = array(
      'id' => $id
    );

    $this->m_user->update_data($where, $data, 'timeout');
    redirect('admin/durasilogin');
  }

  public function aksi_tolak()
  {
    //ambil id
    $kode = $this->uri->segment(3);
    //aksi tolak
    $this->M_wadir1->update_data(array('id' => $kode), array('submit' => 0, 'direktur' => 0, 'wadir1' => 0, 'wadir2' => 0), 'data_subkomponen');
    //notif aksi
    // cari nama kegiatan
    $data = $this->M_wadir1->edit_data(array('id' => $kode), 'data_subkomponen')->row();
    $nama_kegiatan = $data->nama_subkomponen;

    // cari no hp unit
    $id_unit = $data->id_unit;
    $where = array(
      'kode' => $kode
    );
    $unit = $this->M_wadir1->data_no_hp($id_unit)->row();

    $tujuan = $unit->no_hp;
    $pesan = urlencode("Kegiatan " . $nama_kegiatan . " telah ditolak, harap periksa kembali usulan yang telah diajukan.(Wadir 1)
    ");
    $result = file_get_contents("http://localhost:3000/" . "api?tujuan=" . $tujuan . "&pesan=" . $pesan);

    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Data Kegiatan di tolak <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>');
    redirect('wadir1/usulan_anggaran_thn');
  }
  public function aksi_tolak_keg_baru()
  {
    //ambil id
    $kode = $this->uri->segment(3);
    //aksi tolak
    $this->M_wadir1->update_data(array('id' => $kode), array('submit' => 0, 'direktur' => 0, 'wadir1' => 0, 'wadir2' => 0), 'data_subkomponen_keg_baru');
    //notif aksi
    // cari nama kegiatan
    $data = $this->M_wadir1->edit_data(array('id' => $kode), 'data_subkomponen_keg_baru')->row();
    $nama_kegiatan = $data->nama_subkomponen;

    // cari no hp unit
    $id_unit = $data->id_unit;
    $where = array(
      'kode' => $kode
    );
    $unit = $this->M_wadir1->data_no_hp($id_unit)->row();

    $tujuan = $unit->no_hp;
    $pesan = urlencode("Kegiatan " . $nama_kegiatan . " telah ditolak, harap periksa kembali usulan yang telah diajukan.(Wadir 1)
    ");
    $result = file_get_contents("http://localhost:3000/" . "api?tujuan=" . $tujuan . "&pesan=" . $pesan);

    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    Data Kegiatan di tolak <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
    </div>');
    redirect('wadir1/usulan_anggaran_thn');
  }
  public function revisi()
  {
    $data = $this->session->userdata();
    $id = $this->uri->segment(3);
    $data['title'] = 'Revisi RAB dan Data Dukung';
    $where = array('kode_subkomponen' => $id);
    $data['data_kegiatan'] = $this->M_wadir1->edit_data($where, 'kegiatan')->result_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('sidebar_wadir1');
    $this->load->view('revisi', $data);
    $this->load->view('template/footer');
  }

  //keg baru
  public function revisi_keg_baru()
  {
    $data = $this->session->userdata();
    $id = $this->uri->segment(3);
    $data['title'] = 'Revisi RAB dan Data Dukung';
    $where = array('kode_subkomponen' => $id);
    $data['data_kegiatan'] = $this->M_wadir1->edit_data($where, 'kegiatan_baru')->result_array();

    $this->load->view('template/header', $data);
    $this->load->view('template/navbar', $data);
    $this->load->view('sidebar_wadir2');
    $this->load->view('revisi', $data);
    $this->load->view('template/footer');
  }

  public function aksi_revisi()
  {
    $id_unit    = $this->input->post('id_unit');
    $kode       = $this->input->post('kode');
    $komentar      = $this->input->post('komentar');

    $data = array(
      'id_unit' => $id_unit,
      'kode' => $kode,
      'komentar' => $komentar,

    );

    $this->M_wadir1->insert_data('revisi', $data);
    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Revisi Berhasil Ditambahkan <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('Wadir1/usulan_anggaran_thn');
  }
  public function aksi_validasi()
  {
    $kode = $this->uri->segment(3);
    $wadir1 = 1;
    $data = array(
      'wadir1' => $wadir1,

    );
    $where = array(
      'id' => $kode
    );

    $this->M_wadir1->update_data($where, $data, 'data_subkomponen');

    // cari nama kegiatan

    $data = $this->M_wadir1->edit_data($where, 'data_subkomponen')->row();
    $nama_kegiatan = $data->nama_subkomponen;

    // cari no hp unit
    $id_unit = $data->id_unit;
    $where = array(
      'kode' => $kode
    );
    $unit = $this->M_wadir1->data_no_hp($id_unit)->row();

    $tujuan = $unit->no_hp;
    $pesan = urlencode("Kegiatan " . $nama_kegiatan . " telah divalidasi Wadir1
     ");
    $result = file_get_contents("http://localhost:3000/" . "api?tujuan=" . $tujuan . "&pesan=" . $pesan);


    //notif ke wadir 2
    // cari no hp wadir 2
    $id_wadir2 = 22;

    $wadir2 = $this->M_wadir1->data_no_hp_user($id_wadir2)->row();

    $tujuanwadir2 = $wadir2->no_hp;
    $pesanwadir2 = urlencode("*Notif Wadir 2*
Kegiatan " . $nama_kegiatan . " telah divalidasi Wadir 1
    ");
    $result = file_get_contents("http://localhost:3000/" . "api?tujuan=" . $tujuanwadir2 . "&pesan=" . $pesanwadir2);


    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Berhasil Divalidasi <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('Wadir1/usulan_anggaran_thn');
  }
  // keg baru
  public function aksi_validasi_keg_baru()
  {
    $kode = $this->uri->segment(3);
    $wadir1 = 1;
    $data = array(
      'wadir1' => $wadir1,

    );
    $where = array(
      'id' => $kode
    );

    $this->M_wadir1->update_data($where, $data, 'data_subkomponen_keg_baru');

    // cari nama kegiatan

    $data = $this->M_wadir1->edit_data($where, 'data_subkomponen_keg_baru')->row();
    $nama_kegiatan = $data->nama_subkomponen;

    // cari no hp unit
    $id_unit = $data->id_unit;
    $where = array(
      'kode' => $kode
    );
    $unit = $this->M_wadir1->data_no_hp($id_unit)->row();

    $tujuan = $unit->no_hp;
    $pesan = urlencode("Kegiatan " . $nama_kegiatan . " telah divalidasi Wadir1
     ");
    $result = file_get_contents("http://localhost:3000/" . "api?tujuan=" . $tujuan . "&pesan=" . $pesan);

    //notif ke wadir 2
    // cari no hp wadir 2
    $id_wadir2 = 22;

    $wadir2 = $this->M_wadir1->data_no_hp_user($id_wadir2)->row();

    $tujuanwadir2 = $wadir2->no_hp;
    $pesanwadir2 = urlencode("*Notif Wadir 2*
Kegiatan " . $nama_kegiatan . " telah divalidasi Wadir 1
    ");
    $result = file_get_contents("http://localhost:3000/" . "api?tujuan=" . $tujuanwadir2 . "&pesan=" . $pesanwadir2);


    echo $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Data Berhasil Divalidasi <button type= "button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
        </div>');
    redirect('Wadir1/usulan_anggaran_thn_keg_baru');
  }
}
