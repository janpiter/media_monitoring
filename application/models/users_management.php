<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_management extends CI_Model {

	private $table_name			= 'users';			// user accounts
	private $profile_table_name	= 'user_profiles';	// user profiles

	function __construct() {
		parent::__construct();		
	}

	function get_all() {
		$data = array();

		$query = $this->db->query("select * from users u left join user_profiles up on u.id = up.user_id order by created asc");
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		return $data;
	}
}
?>