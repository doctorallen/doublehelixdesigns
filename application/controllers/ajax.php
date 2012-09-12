<?php

class Ajax extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
	public function email_taken(){
		$this->load->model('admin_model');
		$email = trim($_POST['email_address']);
		if( $this->admin_model->email_exists( $email )){
			echo '1';
		}
	}
}
