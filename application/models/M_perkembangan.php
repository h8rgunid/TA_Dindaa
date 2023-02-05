<?php

class M_perkembangan extends CI_Model{
	protected $_table_baby = 'baby';
	protected $_table_perkembangan = 'perkembangan';
	protected $_table_users = 'users';

	public function read(){
		$query = 'SELECT * FROM users s,baby b, perkembangan p INNER JOIN (SELECT max(tanggal) as max_tanggal FROM perkembangan GROUP by id_bayi) p1 on p.tanggal = p1.max_tanggal where b.id_baby = p.id_bayi group by id_baby';
		return $this->db->query($query)->result();
	}
	public function read_per_user($id){
		$query = 'SELECT * FROM users s,baby b, perkembangan p INNER JOIN (SELECT max(tanggal) as max_tanggal FROM perkembangan GROUP by id_bayi) p1 on p.tanggal = p1.max_tanggal where b.id_baby = p.id_bayi and s.id = b.id_user and s.id = "'.$id.'" group by id_bayi';
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

	public function count_per_id($id){
		$query = "SELECT * FROM users, baby, perkembangan where id = id_user and id_bayi = id_baby and id = '".$id."' GROUP by id_bayi";
		return $this->db->query($query)->num_rows();
	}

	public function beratmax_per_id($id){
		$query = "SELECT max(berat_bayi) as berat_bayi FROM users, baby, perkembangan where id = id_user and id_bayi = id_baby and id = '".$id."'";
		return $this->db->query($query)->result();
	}

	public function beratavg_per_id($id){
		$query = "SELECT avg(berat_bayi) as berat_bayi FROM users, baby, perkembangan where id = id_user and id_bayi = id_baby and id = '".$id."'";
		return $this->db->query($query)->result();
	}

	public function berat_per_bulan(){
		$query = "select date_format(tanggal, '%M %Y') as ptanggal, tanggal as otanggal, sum(berat_bayi) as pberat from perkembangan, users, baby where id = id_user and id_baby = id_bayi group by date_format(tanggal, '%M %Y') ORDER by otanggal ASC";
		return $this->db->query($query)->result();
	}

	public function berat_per_bulan_id($id){
		$query = "select date_format(tanggal, '%M %Y') as ptanggal, tanggal as otanggal, sum(berat_bayi) as pberat ,nama_baby , berat_bayi from perkembangan, users, baby where id = id_user and id_baby = id_bayi and id_baby = '".$id."'group by date_format(tanggal, '%M %Y') ORDER by otanggal ASC";
		return $this->db->query($query)->result();
	}
}