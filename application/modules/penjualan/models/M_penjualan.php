<?php 
 
class M_penjualan extends CI_Model{
	public function data_penjualan()
    {
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->join('jenis_barang','barang.id_jenis = jenis_barang.id_jenis','right');
		$this->db->join('penjualan','barang.id_barang = penjualan.id_barang','right');
		$hasil= $this->db->get();
    	
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