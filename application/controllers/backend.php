<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Backend extends CI_Controller {

	function __construct()
	{
		parent::__construct();

        $this->load->model('solr_model','',TRUE);           
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		// $this->load->library('tank_auth');
		$this->load->library('tank_auth_groups','','tank_auth');
		$this->lang->load('tank_auth');
	}

    # default view        
    public function index() {
    	if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		}
		
        $newsToday = $this->solr_model->getNewsToday();
        
        $data['total_news'] = $this->mith_func->number_format($newsToday['total']);
        $data['total_media'] = count($newsToday['per_media']);        
        $data['top_media'] = "-";
        $data['top_percent'] = "0";
        $data['top_total'] = "0";
        $data['last_media'] = str_replace("+", " ", ucfirst($newsToday['last_news']->media));
        $data['last_news'] = $this->mith_func->time_elapsed_string($newsToday['last_news']->pubDate, TRUE);
//        $this->mith_func->debugVar($data['last_news']);
        foreach ($newsToday['per_media'] as $key => $value) {
            $data['top_media'] = str_replace("+", " ", ucfirst($key));
            $data['top_total'] = $this->mith_func->number_format($value);
            $data['top_percent'] = $this->mith_func->number_format(($value / $newsToday['total']) * 100);
            break;
        }
        
        $this->load->view('include/header_backend');
        // $this->load->view('backend/box-themes');		
        $this->load->view('backend/dashboard', $data);
        $this->load->view('include/footer_backend');
    }

    public function users() {
        $this->load->view('include/header_backend');
        $this->load->view('backend/users');
        $this->load->view('include/footer_backend');
    }

}
