<?php

class Admin_model extends CI_Model{
	function __construct(){
		
	}

	public function verify_user( $email, $password ){
		$query = $this->db
					->where('email_address', $email)
					->where('password', sha1($password))
					->limit(1)
					->get('users');

		if( $query->num_rows > 0 ){
			return $query->row();
		}
		return false;
	}
	public function register( $registration_post ){
		$this->db->insert('users', $registration_post); 
	}

	public function email_exists( $email ){
		$query = $this->db
					->where('email_address', $email)
					->limit(1)
					->get('users');

		if( $query->num_rows > 0 ){
			return $query->row();
		}
		return false;
	}
}
