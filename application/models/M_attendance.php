<?php

class M_attendance extends CI_Model{
	protected $_table = 'attendance';
	protected $_table_users = 'users';

	public function read(){
		$this->db->select('a.*, u.name user_name');
		$this->db->join($this->_table_users . ' u', 'a.user_id = u.id');
		return $this->db->get($this->_table . ' a')->result();
	}

	public function read_by_id($id){
		$this->db->select('a.*, u.name user_name');
		$this->db->join($this->_table_users . ' u', 'a.user_id = u.id');
		$this->db->where('a.id', $id);
		return $this->db->get($this->_table . ' a')->row();
	}

	public function read_by_email($email){
		$this->db->select('a.*, u.name user_name');
		$this->db->join($this->_table_users . ' u', 'a.user_id = u.id');
		$this->db->where('u.email', $email);
		return $this->db->get($this->_table . ' a')->result();
	}

	public function read_api(){
		return $this->db->get($this->_table)->result();
	}

	public function read_by_id_api_arr($id){
		$this->db->where('id', $id);
		return $this->db->get($this->_table)->row_array();
	}

	public function check_attendance($user_id, $date){
		$this->db->where('user_id', $user_id);
		$this->db->where('date', $date);
		return $this->db->get($this->_table)->row();
	}

	public function check_work_day($user_id, $date){
		$date_object = date_create_from_format('ymd', $date);
		$daynumber = date('N', strtotime($date_object->format('Y-m-d')));
		echo $daynumber;

		$this->db->where('id', $user_id);
		$this->db->where('d' . $daynumber, '1');
		return $this->db->get($this->_table_users)->row();
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

	public function count_by_email($email){
		$this->db->select('a.*, u.name user_name');
		$this->db->join($this->_table_users . ' u', 'a.user_id = u.id');
		$this->db->where('u.email', $email);
		return $this->db->get($this->_table . ' a')->num_rows();
	}
}
