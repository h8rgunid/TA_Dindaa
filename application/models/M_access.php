<?php

class M_access extends CI_Model{
	protected $_table = 'access';
	protected $_table_roles = 'roles';

	public function read(){
		$this->db->select('a.*, r.name role_name');
		$this->db->join($this->_table_roles . ' r', 'r.id = a.role_id');
		$this->db->order_by('a.role_id');
		return $this->db->get($this->_table . ' a')->result();
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

	public function get_access($role_name, $model){
		$this->db->select('a.create, a.read, a.update, a.delete');
		$this->db->join($this->_table_roles . ' r', 'r.id = a.role_id');
		$this->db->where('r.name', $role_name);
		$this->db->where('a.model', $model);
		return $this->db->get($this->_table . ' a')->row_array();
	}

	public function get_access_by_role($role_name){
		$this->db->select('a.model, a.create, a.read, a.update, a.delete');
		$this->db->join($this->_table_roles . ' r', 'r.id = a.role_id');
		$this->db->where('r.name', $role_name);
		$query = $this->db->get($this->_table . ' a')->result_array();

		foreach ($query as $key => $row) {
			$key_change = $row['model'];
			unset($query[$key]);
			unset($row['model']);
			$query[$key_change] = $row;
		}
		return $query;
	}
}
