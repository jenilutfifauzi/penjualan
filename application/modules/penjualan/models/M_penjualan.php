<?php 
 
class M_barang extends CI_Model{
	public function data_penjualan()
    {
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('barang','barang.id_barang = penjualan.id_barang','left');
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