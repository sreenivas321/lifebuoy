<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		
		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
	}
	
	function index(){
		$this->data['content']='admin/home';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function cheat(){
		$this->load->model('posting_model');
		$this->load->model('general_model');
		$lists=$this->posting_model->get_posting_by_types();
		pre($lists);
		$table='uploader_tb';
		if($lists)foreach($lists as $list){
			$data=array('fullname'=>$list['fullname'],'created_date'=>$list['created_date'],'upload_count'=>1,'upload_from'=>2);
			$this->general_model->insert_data($table, $data);
		}
	}
}