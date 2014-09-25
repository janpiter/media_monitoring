<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require 'Tank_auth.php';

/**
 * Extends the Tank Auth library with minimal support for groups
 *
 * @author John.Wright
 */
class Tank_auth_groups extends Tank_auth {
    
    function __construct()
    {
		//Run parent constructor to setup everything normally
		parent::__construct();

		//Load the groups extension model in place of 'users'
		$this->ci->load->model('tank_auth/ta_groups_users','ta_groups_users');
		$this->ci->users = $this->ci->ta_groups_users;
    }
    
    /**
     * Check if logged in user is a group member of the given group id
     *
     * @param	string
     * @return	bool
     */
    function is_group_member($group_id)
    {
		return $this->ci->session->userdata('group_id') === $group_id;
    }
    
    /**
     * Check if logged in user is an admin
     *
     * @return  bool
     */
    function is_super_admin()
    {
        return $this->ci->session->userdata('group_id') === '1';
    }

    /**
     * Check if logged in user is an admin
     *
     * @return  bool
     */
    function is_admin()
    {
        return $this->ci->session->userdata('group_id') === '2';
    }

    /**
     * Check if logged in user is an admin
     *
     * @return  bool
     */
    function is_manager()
    {
        return $this->ci->session->userdata('group_id') === '3';
    }

    /**
     * Check if logged in user is an admin
     *
     * @return  bool
     */
    function is_operator()
    {
        return $this->ci->session->userdata('group_id') === '4';
    }
}