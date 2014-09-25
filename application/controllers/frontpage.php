<?php if (!defined('BASEPATH')) die();
class Frontpage extends Main_Controller {

   public function index()
	{
      $this->load->view('include/header');
      $this->load->view('frontend/frontpage');
      $this->load->view('include/footer');
	}

	public function dashboard() {
		echo "Dashboard";
	}
   
}

/* End of file frontpage.php */
/* Location: ./application/controllers/frontpage.php */
