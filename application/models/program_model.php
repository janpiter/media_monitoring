<?php

class program_model extends CI_Model {

    private $table_name = 'program';
    private $table_join = 'publisher';
    
    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select($this->table_name.'.*, publisher_name');
        $this->db->from($this->table_name);
        $this->db->join($this->table_join, $this->table_join.'.publisher_id = '.$this->table_name.'.publisher_id', 'left');
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("publisher_name", "asc"); 
        $this->db->order_by("program_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function getProgram($program_id) {
        $query = $this->db->get_where($this->table_name, array('program_id'=>$program_id));
        
        return $query->row();
    }

    function insertProgram($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

    function updateProgram($data) {
        $this->db->where('program_id', $data['program_id']);
        $this->db->update($this->table_name, $data);        
    }

    function deleteProgram($program_id) {
        $this->db->where('program_id', $program_id);
        $this->db->delete($this->table_name);
        
        $res = $this->db->_error_number();        
        return $res;
    }
    
    function isDuplicate($data) {
        foreach ($data as $key => $value) {
            $this->db->where($key, $value);
        }        
        $this->db->from($this->table_name);        
        $res = $this->db->count_all_results();

        if($res > 0)  return TRUE;
        else    return FALSE;
    }
    
    function getListProgram($publisher_id="") {
        $this->db->select('*');
        $this->db->from($this->table_name);
        if($publisher_id != ""){
            $this->db->where($this->table_join.'.publisher_id', $publisher_id);
        }
        $this->db->join($this->table_join, $this->table_join.'.publisher_id = '.$this->table_name.'.publisher_id', 'left');
        $this->db->order_by("publisher_name", "asc"); 
        $this->db->order_by("program_name", "asc");
        $query = $this->db->get();
        $n = $query->result();
        
        $nList = array();
        $nList[""] = "-- Choose Program --";
        foreach ($n as $value) {
            $nList[$value->program_id] = $value->program_name;
        }
//        $this->mith_func->debugVar($nList);
        return $nList;
    }

}