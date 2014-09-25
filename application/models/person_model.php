<?php

class person_model extends CI_Model {

    private $table_name = 'person';

    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select('*');
        $this->db->from($this->table_name);
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("person_name", "asc"); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function getPerson($person_id) {
        $query = $this->db->get_where($this->table_name, array('person_id'=>$person_id));
        
        return $query->row();
    }

    function insertPerson($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

    function updatePerson($data) {
        $this->db->where('person_id', $data['person_id']);
        $this->db->update($this->table_name, $data);        
    }

    function deletePerson($person_id) {
        $this->db->where('person_id', $person_id);
        $this->db->delete($this->table_name);
        
        $res = $this->db->_error_number();        
        return $res;
    }
        
    function isDuplicate($name) {
        $this->db->where('person_name', $name);
        $this->db->from($this->table_name);        
        $res = $this->db->count_all_results();

        if($res > 0)  return TRUE;
        else    return FALSE;
    }
    
    function getListPerson() {
        $this->db->select('*');
        $this->db->from($this->table_name);
        $this->db->order_by("person_name", "asc"); 
        $query = $this->db->get();        
        $n = $query->result();
        
        $nList = array();
        $nList[""] = "-- Choose Person --";
        foreach ($n as $value) {
            $nList[$value->person_id] = $value->person_name;
        }
        
        return $nList;     
    }

}