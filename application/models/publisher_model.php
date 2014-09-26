<?php
# hexacode
class publisher_model extends CI_Model {
	private $table_name = 'publisher';	
	
	function getList($where=array(), $start=0, $limit=0) {
	
        $this->db->select('*');
        $this->db->from($this->table_name);
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("publisher_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }
	
	function getPublisher($publisher_id) {
	
		$query = $this->db->get_where(
			$this->table_name, 
			array('publisher_id' => $publisher_id)
		);        
        return $query->row();
	}
	
	function insertPublisher($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

    function updatePublisher($data) {
        $this->db->where('publisher_id', $data['publisher_id']);
        $this->db->update($this->table_name, $data);        
    }

    function deletePublisher($publisher_id) {
        $this->db->where('publisher_id', $publisher_id);
        $this->db->delete($this->table_name);
        
        $res = $this->db->_error_number();        
        return $res;
    }
        
    function isDuplicate($name, $id=NULL) {
        if($id) $this->db->where('publisher_id <>', $id);
        
        $this->db->where('publisher_name', $name);
        $this->db->from($this->table_name);
        $res = $this->db->count_all_results();

        if($res > 0)  return TRUE;
        else    return FALSE;
    }
    
    function getListPublisher() {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->order_by("publisher_name", "asc"); 
        $query = $this->db->get();        
        $n = $query->result();
        
        $nList = array();
        $nList[""] = "-- Choose Publisher --";
        foreach ($n as $value) {
            $nList[$value->publisher_id] = $value->publisher_name;
        }
        
        return $nList;     
    }
}

?>