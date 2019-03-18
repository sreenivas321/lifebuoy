<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in') == TRUE)redirect('lifebuoy_adm/home');
		$this->load->model('admin_model');
	}
	
	function index(){
		$this->data['content'] = 'admin/login';
		$this->load->view('common/admin/body', $this->data);
	}
	
	function do_login(){
		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		
		if(!$username || !$password){
			$this->data['error'] = 'Invalid username or password';
			$this->data['content'] = 'admin/login';
			$this->load->view('common/admin/body',$this->data);
		}
		else{
			$login = $this->admin_model->login($username, $password);
			if ($login != NULL) {
				$sess_admin = array (
									   'admin_logged_in' => true,
									   'admin_id' => $login['id'],
									   'admin_username' => $login['username'],
									   'admin_privilege' => $login['privilege_id'],
									   //'admin_last_login' => $login['last_login_date'],
									);
				$this->session->set_userdata($sess_admin);
				
				redirect ('lifebuoy_adm/home');
			}
			else {
				$this->data['content'] = 'admin/login';
				$this->data['error'] = 'Invalid username or password';
				$this->load->view('common/admin/body', $this->data);
			}
		}
	}
	
}