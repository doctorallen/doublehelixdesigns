<?php //if( !defined('BASE_PATH')) exit ('No direct script access allowed.');

class Admin extends CI_Controller{
	function __construct(){

		parent::__construct();
		session_start();
	}

	public function index(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email'); 
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		if($this->form_validation->run() !== false){
			//verify login credentials
			$this->load->model('admin_model');
			$ver = $this->admin_model->verify_user( 
				$this->input->post('email_address'), 
				$this->input->post('password'));

			if( $ver !== false ){
				$_SESSION['username'] = $this->input->post('email_address');
				redirect('welcome');
			}	
		}
		$this->load->view('login_view');
	}

	public function logout(){
		session_destroy();
		$this->load->view('login_view');
	
	
	}

	public function register(){
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email'); 
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		$this->form_validation->set_rules('reconfirm_password', 'Reconfirm Password', 'required|min_length[4]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required'); 
		$this->form_validation->set_rules('last_name', 'Last Name', 'required'); 
		if($this->form_validation->run() !== false){
			$this->load->model('admin_model');
			//grab the post data
			$data = $this->input->post();
			//remove the unneccesary data
			unset($data['reconfirm_password']);
			unset($data['submit']);
			//sha1 the password
			$data['password'] = sha1($data['password']);
			//register user
			$register = $this->admin_model->register($data);
			if( $register !== false ){
				redirect('welcome');
			}
		}
		$this->load->view('registration');
	}

}
