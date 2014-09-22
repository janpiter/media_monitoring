<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Research extends CI_Model {

	private $table_name			= 'research';

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get all research
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
	 * Get research record by Id
	 *
	 * @param	int	 
	 * @return	object
	 */
	function get_research_by_id($research_id) {
		$this->db->where('r_id', $research_id);
		
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Delete research record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_research($research_id) {
		$this->db->where('r_id', $research_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) return TRUE;
		return FALSE;
	}

	/**
	 * Create new research record
	 *
	 * @param	array	 
	 * @return	array
	 */
	function create_research($data) {

		$data['cdate'] = date('Y-m-d H:i:s');		

		if ($this->db->insert($this->table_name, $data)) {
			$research_id = $this->db->insert_id();			
			return array('r_id' => $research_id);
		}
		return NULL;
	}

	/**
	 * Create edit research record
	 *
	 * @param	array
	 * @param 	int 
	 * @return	array
	 */
	function change_research($data, $id) {

		$this->db->where("r_id", $id);
		$this->db->update($this->table_name, $data);
		
		return $this->db->affected_rows() > 0;
	}
}
?>