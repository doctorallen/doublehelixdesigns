<?php

class Ajax extends CI_Controller{
	function __construct(){
		parent::__construct();
		session_start();
	}
	public function email_taken(){
		$this->load->model('admin_model');
		$email = trim($_POST['email_address']);
		if( $this->admin_model->email_exists( $email )){
			echo '1';
		}
	}

	public function login(){
		if( $this->input->post('ajax') == '1'){
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
	}
}
