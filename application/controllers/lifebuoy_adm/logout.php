<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Logout extends CI_Controller {
	function __construct(){
		parent::__construct();
		
	}
	function index(){
		$sess_admin = array (
			'admin_logged_in' => '',
			'admin_id' => '',
			'admin_username' => '',
			'admin_last_login' => ''
		);
		$this->session->unset_userdata($sess_admin);
		redirect('lifebuoy_adm/login'); 
	}
}