<?php

class news_model extends CI_Model {

    private $table_name = 'news';
    private $table_join = 'program';
    private $table_join2 = 'publisher';
    
    function __construct() {
        parent::__construct();

        $CI =& get_instance();
        $CI->load->model('logging_model');
        $this->log = $CI->logging_model;
    }

    function getList($where=array(), $start=0, $limit=0) {
        $this->db->select($this->table_name.'.*, program_name, publisher_name');
        $this->db->from($this->table_name);
        $this->db->join($this->table_join, $this->table_join.'.program_id = '.$this->table_name.'.program_id', 'left');
        $this->db->join($this->table_join2, $this->table_join2.'.publisher_id = '.$this->table_join.'.publisher_id', 'left');
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by("news_date", "desc"); 
        $this->db->order_by("news_title", "asc");
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result();
    }

    function getNews($news_id) {
        $query = $this->db->get_where($this->table_name, array('news_id'=>$news_id));
        
        return $query->row();
    }

    function insertNews($data) {
        $this->db->insert($this->table_name, $data);
        $last_id = $this->db->insert_id();
        $this->log->insertLog('input', $this->table_name, $last_id, $data);
        return $last_id;
    }

    function updateNews($data) {
        $this->db->where('news_id', $data['news_id']);
        $this->db->update($this->table_name, $data);        
        $this->log->insertLog('update', $this->table_name, $data['organization_id'], $data);
    }

    function deleteNews($news_id) {
        $this->db->where('news_id', $news_id);
        $this->db->delete($this->table_name);
        $this->log->insertLog('delete', $this->table_name, $topic_id, $data);
        
        $res = $this->db->_error_number();        
        return $res;
    }
    
}