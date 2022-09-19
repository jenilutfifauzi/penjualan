<?php 
 
class M_global extends CI_Model{
	public function data_barang()
    {
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('jenis_barang','jenis_barang.id_jenis = barang.id_jenis','left');
		$hasil= $this->db->get();
    	
    	if ($hasil->num_rows() > 0){
    		return $hasil->result_array();
    	}else{
    		return [];
    	}
    }

	public function filter_jenis_barang($id, $tgl_awal, $tgl_akhir)
    {
		
		$hasil = $this->db->query("Select Max(tb1.jml_terjual) as total from penjualan tb1 join barang tb2 on tb2.id_barang=tb1.id_barang Where tb2.id_jenis =".$id . " and tb1.tgl_transaksi between ".$tgl_awal." and ".$tgl_akhir."");
	
    	if ($hasil->num_rows() > 0){
    		return $hasil->result_array();
    	}else{
    		return [];
    	}
    }
	public function filter_data($id, $tgl_awal, $tgl_akhir)
    {
		
		$hasil = $this->db->query("Select (*) from penjualan tb1 join barang tb2 on tb2.id_barang=tb1.id_barang Where tb2.id_jenis =".$id . " and tb1.tgl_transaksi between ".$tgl_awal." and ".$tgl_akhir."");
	
    	if ($hasil->num_rows() > 0){
    		return $hasil->result_array();
    	}else{
    		return [];
    	}
    }
	public function filter_data2($id, $tgl_awal, $tgl_akhir, $filter_jml_terjual)
    {
		
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('jenis_barang','barang.id_jenis = jenis_barang.id_jenis','right');
		$this->db->join('penjualan','barang.id_barang = penjualan.id_barang','right');
		$this->db->where('barang.id_jenis',$id);
		$this->db->where('penjualan.tgl_transaksi BETWEEN "'. date('Y-m-d', strtotime($tgl_awal)). '" and "'. date('Y-m-d', strtotime($tgl_akhir)).'"');
		$this->db->order_by("penjualan.jml_terjual",$filter_jml_terjual);
		$hasil= $this->db->get();
    	
    	if ($hasil->num_rows() > 0){
    		return $hasil->result_array();
    	}else{
    		return [];
    	}
	
    	if ($hasil->num_rows() > 0){
    		return $hasil->result_array();
    	}else{
    		return [];
    	}
    }
	public function data_jenis()
    {
    	$hasil= $this->db->get('jenis_barang');
    	if ($hasil->num_rows() > 0){
    		return $hasil->result_array();
    	}else{
    		return [];
    	}
    }

	public function insert_data($table,$data)
	{
		$this->db->insert($table, $data);
	}

	public function edit_data($where,$table)
	{
		return $this->db->get_where($table,$where);
	}
	public function update_data($where,$data,$table)
	{
		$this->db->where($where);
		$this->db->update($table,$data);
	}
	public function hapus_data($where,$table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

}