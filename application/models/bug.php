<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Bug extends CI_Model {

	private $table_name = 'bugs';

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get all bug
	 *
	 * @return object
	 */
	function get_all() {

		$data = array();

		$this->db->order_by('cdate', 'desc');
		$query = $this->db->get($this->table_name);

		if ($query->num_rows() >= 1) {
			foreach ($query->result() as $value) {				
				$data[] = $value;
			}
			return $data;
		}
		return NULL;
	}

	/**
	 * Get bug record by Id
	 *
	 * @param	int	 
	 * @return	object
	 */
	function get_bug_by_id($bug_id) {
		$this->db->where('bug_id', $bug_id);
		
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Delete bug record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_bug($bug_id) {
		$this->db->where('bug_id', $bug_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) return TRUE;
		return FALSE;
	}

	/**
	 * Create new bug record
	 *
	 * @param	array	 
	 * @return	array
	 */
	function create_bug($data) {
		$data['cdate'] = date('Y-m-d H:i:s');		

		if ($this->db->insert($this->table_name, $data)) {
			$bug_id = $this->db->insert_id();			
			return array('bug' => $bug_id);
		}
		return NULL;
	}

	/**
	 * Create edit bug record
	 *
	 * @param	array
	 * @param 	int 
	 * @return	array
	 */
	function change_bug($data, $id) {
		$this->db->where("bug_id", $id);
		$this->db->update($this->table_name, $data);
		
		return $this->db->affected_rows() > 0;
	}
}
?>