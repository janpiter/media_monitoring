<?php
# hexacode
class publisher_model extends CI_Model {
	private $table_name = 'publisher';
	
	/**
	 * Get all publisher
	 *
	 * @return object
	 */
	function get_all($where=array(), $start=0, $limit=0) {
	
		$data = array();
		
		$this->db->select('*');
        $this->db->from($this->table_name);
        
        foreach ($where as $key => $value)
            $this->db->where($key, $value);        
        
        $this->db->order_by("created", "desc"); 
        
        if($limit > 0) $this->db->limit($limit, $start);

		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
		}

		return $data;
	}
	
	/**
	 * Get publisher record by Id
	 *
	 * @param	int	 
	 * @return	object
	 */
	function get_publisher_by_id($id) {
	
		$query = $this->db->get_where($this->table_name, array('publisher_id' => $id));
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}
	
	/**
	 * Create new publisher record
	 *
	 * @param	array	 
	 * @return	array
	 */
	function create_publisher($data) {
	
		if ($this->db->insert($this->table_name, $data)) {
			$research_id = $this->db->insert_id();			
			return array('r_id' => $research_id);
		}
		return NULL;
	}
	
	/**
	 * Delete publisher record
	 *
	 * @param	int
	 * @return	bool
	 */
	function delete_publisher($id) {
		$this->db->where('publisher_id', $id);
		$this->db->delete($this->table_name);
		if ($this->db->affected_rows() > 0) return TRUE;
		return FALSE;
	}
	
	/**
	 * Create edit publisher record
	 *
	 * @param	array
	 * @param 	int 
	 * @return	array
	 */
	function change_publisher($data, $id) {

		$this->db->where("publisher_id", $id);
		$this->db->update($this->table_name, $data);
		
		return $this->db->affected_rows() > 0;
	}
}

?>