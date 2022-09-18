<?php

class Ajuan_model extends CI_Model
{
	function tampil_data($table)
	{
		return $this->db->get($table);
	}

	function data_no_hp($id_unit)
	{

		$this->db->select('*');
		$this->db->from('kegiatan');
		$this->db->join('user', 'user.id = kegiatan.id_unit', 'inner');
		$this->db->where('kegiatan.id_unit', $id_unit);
		return $this->db->get();
	}

	public function rekap()
	{
		return $this->db->query("select * from kegiatan order by status ASC, tgl ASC");
	}

	public function ambil_id_user($id)
	{
		$hasil = $this->db->where('id', $id)->get('data_pengajuan');
		if ($hasil->num_rows() > 0) {
			return $hasil->result();
		} else {
			return false;
		}
	}

	public function insert_data($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_data($where, $table)
	{
		return $this->db->get_where($table, $where);
	}

	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
	public function hapus_data($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}
	public function ajuanMaretAkademik()
	{
		$tahun = date("Y");
		$tgl_awal = $tahun.'-03-20';
		$tgl_akhir = $tahun.'-06-20';
		$this->db->from('data_subkomponen_keg_baru');
		$this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
		$this->db->where('direktur', 1);
		$this->db->where('wadir1', 1);
		$this->db->where('wadir2', 1);
		return $this->db->get();
	}
	public function ajuanAkademik($tgl_awal,$tgl_akhir)
	{
		$tahun = date("Y");
		$this->db->from('data_subkomponen_keg_baru');
		$this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
		$this->db->where('direktur', 1);
		$this->db->where('wadir1', 1);
		$this->db->where('wadir2', 1);
		return $this->db->get();
	}
	public function ajuanAkademik2($tgl_buat)
	{
		$tahun = date("Y");
		$this->db->from('data_subkomponen_keg_baru');
		$this->db->where('direktur', 1);
		$this->db->where('wadir1', 1);
		$this->db->where('wadir2', 1);
		$this->db->where('jenis_kegiatan', 'akademik');
		$this->db->where('tgl_buat', $tgl_buat);
		return $this->db->get();
	}
	public function ajuanNonAkademik($tgl_buat)
	{
		$tahun = date("Y");
		$this->db->from('data_subkomponen_keg_baru');
		$this->db->where('direktur', 1);
		$this->db->where('wadir2', 1);
		$this->db->where('jenis_kegiatan', 'non_akademik');
		$this->db->where('tgl_buat', $tgl_buat);

		return $this->db->get();
	}
	public function ajuanNonAkademik2($tgl_awal,$tgl_akhir)
	{
		$tahun = date("Y");
		$this->db->from('data_subkomponen_keg_baru');
		$this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
		$this->db->where('direktur', 1);
		$this->db->where('wadir2', 1);
		$this->db->where('jenis_kegiatan', 'non_akademik');
		return $this->db->get();
	}
	public function ajuanMaretnonAkademik()
	{
		$tahun = date("Y");
		$tgl_awal = $tahun.'-03-20';
		$tgl_akhir = $tahun.'-06-20';
		$this->db->from('data_subkomponen_keg_baru');
		$this->db->where('tanggal >=', $tgl_awal);
		$this->db->where('tanggal <=', $tgl_akhir);
		$this->db->where('direktur', 1);
		$this->db->where('wadir2', 1);
		return $this->db->get();
	}
}
