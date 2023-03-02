<?php
 class M_telenotif extends CI_Model {
 
    protected $_table_notif = 'telenotif';

    function sendTele($data)
    {
		return $this->db->insert($this->_table_notif, $data);
    }
}