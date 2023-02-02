<?php

class M_users extends CI_Model{
	protected $_table = 'users';
	protected $_table_role = 'roles';

	public function read(){
		$this->db->select('u.*, r.name role_name, r.id role_id');
		$this->db->join($this->_table_role . ' r', 'u.role_id = r.id');
		return $this->db->get($this->_table . ' u')->result();
	}

	public function read_by_id($id){
		$this->db->select('u.*, r.name role_name, r.id role_id');
		$this->db->join($this->_table_role . ' r', 'u.role_id = r.id');
		$this->db->where('u.id', $id);
		return $this->db->get($this->_table . ' u')->row();
	}

	public function read_by_email($email){
		$this->db->select('u.*, r.name role_name, r.id role_id');
		$this->db->join($this->_table_role . ' r', 'u.role_id = r.id');
		$this->db->where('u.email', $email);
		return $this->db->get($this->_table . ' u')->row();
	}

	public function read_api(){
		$this->db->select('id, name, email, d1, d2, d3, d4, d5, d6, d7');
		return $this->db->get($this->_table)->result();
	}

	public function read_by_id_api_arr($id){
		$this->db->select('id, name, email');
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row_array();
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
