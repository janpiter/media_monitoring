<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

Class Task extends CI_Model {

	private $table_name	= 'tasks';

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get all task
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
	 * Get task record by Id
	 *
	 * @param	int	 
	 * @return	object
	 */
	function get_task_by_id($task_id) {
		$this->db->where('task_id', $task_id);
		
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Delete task record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_task($task_id) {
		$this->db->where('task_id', $task_id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) return TRUE;
		return FALSE;
	}

	/**
	 * Create new task record
	 *
	 * @param	array	 
	 * @return	array
	 */
	function create_task($data) {

		$data['cdate'] = date('Y-m-d H:i:s');		

		if ($this->db->insert($this->table_name, $data)) {
			$task_id = $this->db->insert_id();			
			return array('task_id' => $task_id);
		}
		return NULL;
	}

	/**
	 * Create edit task record
	 *
	 * @param	array
	 * @param 	int 
	 * @return	array
	 */
	function change_task($data, $id) {

		$this->db->where("task_id", $id);
		$this->db->update($this->table_name, $data);
		
		return $this->db->affected_rows() > 0;
	}
}
?>