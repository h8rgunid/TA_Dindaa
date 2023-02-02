<?php

class M_keys extends CI_Model{
	protected $_table = 'keys';
	protected $_table_users = 'users';

	public function read(){
		$this->db->select('k.*, u.name user_name');
		$this->db->join($this->_table_users . ' u', 'u.id = k.user_id');
		return $this->db->get($this->_table . ' k')->result();
	}

	public function read_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row();
	}

	public function create($data){
		return $this->db->insert($this->_table, $data);
	}

	public function update($data, $id){
		$this->db->set($data);
		$this->db->where(['id' => $id]);
		return $this->db->update($this->_table);
	}

	public function delete($id){
		return $this->db->delete($this->_table, ['id' => $id]);
	}

	public function count(){
		return $this->db->get($this->_table)->num_rows();
	}
}
