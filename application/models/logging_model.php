<?php

class logging_model extends CI_Model {

    private $table_name = 'history';
    private $table_join = 'users';

    function __construct() {
        parent::__construct();

        $this->load->library('tank_auth_groups', '', 'tank_auth');
        $this->lang->load('tank_auth');
    }

    private function parsingLog($activity, $detail) {
        $data = explode(';', $detail);
        $table = $data[0];
        $id = $data[1];
        $name = is_object(json_decode($data[2])) ? json_decode($data[2]) : $data[2];

        if (is_object($name)) {
            $name = (array) $name;
            $keys = array_keys($name);
            foreach ($keys as $key) {
                if (preg_match('/(^|_)name$/', $key) == 1) {
                    $name = '<strong>'.$name[$key].'</strong>';
                }
            }
        }

        switch ($activity) {
            case 'input':
                $message = 'Add '.ucfirst($table).' '.$name;
                break;
            case 'update':
                $message = 'Change the name of the '.ucfirst($table).' '.$name;
                break;
            case 'delete':
                $message = 'Delete '.ucfirst($table).' '.$name;
                break;
            case 'login':
                $message = $name.' was login';
                break;
            default:
                $message = null;
                break;
        }

        return $message;
    }

    function getList($where=array(), $start=0, $limit=0) {
        $return_data = array();

        $this->db->select($this->table_name.'.*, '.$this->table_join.'.username');
        $this->db->from($this->table_name);
        $this->db->join($this->table_join, $this->table_name.'.user_id = '.$this->table_join.'.id');
        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        
        $this->db->order_by($this->table_name.'.created', 'desc'); 
        
        if($limit > 0){
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        $result = $query->result();

        foreach ($result as $key => $value) {
            array_push($return_data, 
                (object) array(
                    'history_id'    => $value->history_id,
                    'username'      => $value->username,
                    'created'       => $value->created,
                    'detail'        => $this->parsingLog($value->activity, $value->activity_detail)
                )
            );
        }

        return $return_data;
    }

    function getLog($log_id) {
        $query = $this->db->get_where($this->table_name, array('history_id'=>$log_id));
        
        return $query->row();
    }

    function insertLog($activity, $table, $id, $data) {
        /*
        action: login, input, update, delete, deactivate
        detail: table_name;id;value
        */
        $data = $data != '' ? json_encode($data) : '';
        $log_data = array(
            'activity'          => $activity,
            'activity_detail'   => $table.';'.$id.';'.$data,
            'user_id'           => $this->tank_auth->get_user_id()
        );
        $this->db->insert($this->table_name, $log_data);
        $last_id = $this->db->insert_id();
        
        return $last_id;
    }

    function deleteLog($log_id) {
        $data = $this->getLog($log_id);
        $this->db->where('history_id', $log_id);
        $this->db->delete($this->table_name);
        // $this->insertLog('delete', $this->table_name, $log_id, $data);
        
        $res = $this->db->_error_number();
        return $res;
    }

}