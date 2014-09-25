<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

   public function index()
	{
		$this->load->view('include/header_backend');
		$this->load->view('frontend/frontpage');
		$this->load->view('include/footer_backend');
	}

	public function dashboard() {
		echo "Dashboard";
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
