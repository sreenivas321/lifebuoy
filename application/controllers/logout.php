<?php if(!defined('BASEPATH')) exit("Hacking Attempt?");
class Logout extends CI_Controller{
	function __construct(){
		parent::__construct();
	}
		
	function index(){
		//clear shopping cart
		$this->session->sess_destroy();
		session_destroy();
		redirect('home');
	}
}