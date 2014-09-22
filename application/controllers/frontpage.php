<?php 
if (!defined('BASEPATH')) die();

class Frontpage extends Main_Controller {

	function __construct() {
		parent::__construct();
		$this->load->library('functions');
		$this->load->library('session');		
	}

	public function index() {		
		redirect('/auth/login/');
	}
	
	public function home() {		
		$this->functions->check_session();
		
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/home');
		$this->load->view('include/footer');
		
	}

	public function simulation_news() {
		$this->functions->check_session();

		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/simulation_news');
		$this->load->view('include/footer');
	}

	public function simulation_pickle() {
		$this->functions->check_session();

		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/simulation_pickle');
		$this->load->view('include/footer');
	}

	public function sentiment_news() {
		$this->functions->check_session();

		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/sentiment_news');
		$this->load->view('include/footer');
	}

	public function sentiment_facebook() {
		$this->functions->check_session();

		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/sentiment_facebook');
		$this->load->view('include/footer');
	}

	public function sentiment_twitter() {
		$this->functions->check_session();

		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/sentiment_twitter');
		$this->load->view('include/footer');
	}

	public function news_tracker($page) {
		$this->functions->check_session();

		$data['page'] = $page;

		$this->load->view('include/header');
		$this->load->view('include/nav');	
		$this->load->view('frontpage/news_tracker', $data);
		$this->load->view('include/footer');
	}
	
	public function bugs_tracker($act="list") {

		$this->functions->check_session();
		
		$this->load->model('bug');
		$this->load->model('research');
		$msg = '';

		if($this->input->post()) {
			switch ($act) {
				case 'add':				
					$param = array(
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'r_id' => $this->input->post('research'),
							'status' => $this->input->post('status'),
							'cdate' => date('Y-m-d H:i:s')
						);
					$this->bug->create_bug($param);						
					break;
				case 'edit':
					$param = array(
							'title' => $this->input->post('title'),
							'description' => $this->input->post('description'),
							'r_id' => $this->input->post('research'),
							'status' => $this->input->post('status')
						);	
					$this->bug->change_bug($param, $this->input->post("id"));
					break;
				case 'delete':
					$this->bug->delete_bug($this->input->post("id"));
					break;
				case 'get':					
					echo json_encode($this->bug->get_bug_by_id($this->input->post("id")));
					exit();
					break;
			}
		}

		$data['research'] = $this->research->get_all();
		$bugs = $this->bug->get_all();
		foreach ($bugs as $b) {
			$new_data[] = (object) array(
					'bug_id' => $b->bug_id,
					'title' => $b->title,
					'description' => $b->description,
					'date' => $this->functions->format_date($b->cdate, "d/m/Y"),					
					'status' => $this->functions->get_status_issue($b->status)
				);
		}
		$data['bugs'] = $new_data;
		$data['msg'] = $msg;
		
		
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/bugs_tracker', $data);
		$this->load->view('include/footer');
	}

	public function tasks($act="list") {
		$this->functions->check_session();

		switch ($act) {
			case 'single_task':
				$param = array(
						'r_id' => 0,
						'task' => $this->input->post("task"),
						'description' => '',
						'duedate' => $this->functions->format_date($this->input->post("duedate"), "Y-m-d"),
						'cdate' => date("Y-m-d")
					);
				break;		
		}

		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/tasks');
		$this->load->view('include/footer');
	}

	public function research($act="list") {

		$this->functions->check_session();

		$this->load->model('research');
		$msg = '';

		if($this->input->post()) {
			switch ($act) {
				case 'add':				
					$param = array(
							'name' => $this->input->post('research_name'),
							'description' => $this->input->post('description'),
							'cdate' => $this->functions->format_date(date("Y-m-d"))
						);
					$this->research->create_research($param);						
					break;
				case 'edit':
					$param = array(
							'name' => $this->input->post('research_name'),
							'description' => $this->input->post('description')							
						);	
					$this->research->change_research($param, $this->input->post("id"));
					break;
				case 'delete':
					$this->research->delete_research($this->input->post("id"));
					break;
				case 'get':					
					echo json_encode($this->research->get_research_by_id($this->input->post("id")));
					exit();
					break;
			}
		}
		
		$data['research'] = $this->research->get_all();
		$data['msg'] = $msg;
		
		$this->load->view('include/header');
		$this->load->view('include/nav');
		$this->load->view('frontpage/research', $data);
		$this->load->view('include/footer');
	}
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
