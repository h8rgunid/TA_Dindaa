<?php

class M_perkembangan extends CI_Model{
	protected $_table_baby = 'baby';
	protected $_table_perkembangan = 'perkembangan';
	protected $_table_users = 'users';

	public function read(){
		$query = 'SELECT * FROM users s,baby b, perkembangan p INNER JOIN (SELECT max(tanggal) as max_tanggal FROM perkembangan GROUP by id_bayi) p1 on p.tanggal = p1.max_tanggal where b.id_baby = p.id_bayi group by id_baby';
		return $this->db->query($query)->result();
	}

	public function read_by_id($id){
		$query = "SELECT * FROM baby b,perkembangan p where b.id_baby = p.id_bayi and id_bayi =".$id."";
		return $this->db->query($query)->result();
	}

	public function read_by_id_perkembangan($id){
		$this->db->where('id_perkembangan_bayi', $id);
		return $this->db->get($this->_table_perkembangan)->row();
	}

	public function nama_baby($id){
		$query = "SELECT * FROM baby b,perkembangan p WHERE p.id_bayi = ".$id." and b.id_baby = p.id_bayi GROUP by nama_baby";
		return $this->db->query($query)->result();
	}
	public function create($data){
		return $this->db->insert($this->_table, $data);
	}

	public function update($data, $id){
		$this->db->set($data);
		$this->db->where(['id_perkembangan_bayi' => $id]);
		return $this->db->update($this->_table_perkembangan);
	}

	public function delete($id){
		return $this->db->delete($this->_table_perkembangan, ['id_bayi' => $id]);
	}

	public function delete1($id){
		return $this->db->delete($this->_table_perkembangan, ['id_perkembangan_bayi' => $id]);
	}

	public function count(){
		$query = "SELECT * FROM perkembangan GROUP by id_bayi";
		return $this->db->query($query)->num_rows();
	}

	public function beratmax(){
		$this->db->select_max('berat_bayi');
		return $this->db->get('perkembangan')->result(); 
	}

	public function beratavg(){
		$this->db->select_avg('berat_bayi');
		return $this->db->get('perkembangan')->result(); 
	}
}