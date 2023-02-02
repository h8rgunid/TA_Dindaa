<?php

class M_logs extends CI_Model{
	protected $_table = 'logs';

	public function read(){
		return $this->db->get($this->_table)->result();
	}

	public function read_by_id($id){
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row();
	}

	public function delete($id){
		return $this->db->delete($this->_table, ['id' => $id]);
	}

	public function delete_all(){
		return $this->db->truncate($this->_table);
	}

	public function count(){
		return $this->db->get($this->_table)->num_rows();
	}
}
