<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_management extends CI_Model {

	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct() {
		parent::__construct();	

		$CI =& get_instance();
        $CI->load->model('logging_model');
        $this->log = $CI->logging_model;

        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');	
	}
	
	/**
	 * Get all user
	 *
	 * @return object
	 */
	function get_all() {
		$data = array();

		$query = $this->db->query("select * from users u order by u.created desc");
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		return $data;
	}
	
	/**
	 * Get user record by Id
	 *
	 * @param	int	 
	 * @return	object
	 */
	function get_user_by_id($id) {
		$this->db->where('id', $id);
		
		$query = $this->db->get($this->table_name);
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Delete user record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_user($id) {
		$data = $this->get_user_by_id($id);
		$this->db->where('id', $id);
		$this->db->delete($this->table_name);
		$this->log->insertLog('delete', $this->table_name, $id, $data);
		if ($this->db->affected_rows() > 0) return TRUE;
		return FALSE;
	}
	
	/**
	 * Create edit user record
	 *
	 * @param	array
	 * @param 	int 
	 * @return	array
	 */
	function change_user($data, $id) {

		$this->db->where("id", $id);
		$this->db->update($this->table_name, $data);
		$this->log->insertLog('update', $this->table_name, $id, $data);
		
		return $this->db->affected_rows() > 0;
	}
}
?>