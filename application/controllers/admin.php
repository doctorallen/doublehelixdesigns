<?php //if( !defined('BASE_PATH')) exit ('No direct script access allowed.');

class Admin extends CI_Controller{
	function __construct(){

		parent::__construct();
		session_start();
	}

	public function index(){
		if(isset($_SESSION['username'])){
			redirect('welcome');
		}
		$this->load->view('login_view');
	}

	public function registration(){
		
		$this->load->view('registration');
	}

	public function logout(){
		unset($_SESSION['username']);
		redirect('');
	}

}
