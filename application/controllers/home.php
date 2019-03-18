<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('user_model');
		$this->load->model('posting_model');
		$this->load->model('category_model');
	}
	
	function index___(){
		$this->data['content']='home';
		$this->load->view('common/body',$this->data);

	}
	
	function index(){
		$this->data['curr_page']='home';
		$this->data['current']=$this->category_model->get_current_category();//pre($this->data['current']);
		$x=$this->data['next']=$this->category_model->get_next_category($this->data['current']['precedence']);
		
		$this->data['category_id']='a';
		$this->data['gallery']=$this->posting_model->get_posting();
		$this->data['total']=$this->posting_model->get_total_posting();	
		$this->data['category']=$this->category_model->get_category_list();	
		$this->data['content']='home';
		$this->load->view('common/body',$this->data);
	}
	
	function new_register(){
		$id=$this->session->userdata('user_id');
		if(!$id)redirect('home/index/gak_jelas');
		$this->data['user_detail']=$user_detail=$this->user_model->get_user_detail($id);
		if($user_detail['registered_email']!=''){
			$this->session->set_flashdata('notif','You alredy input email');
			redirect('home/index');
		}
		$this->data['content']='new_register';
		$this->load->view('common/body',$this->data);
	}
	
	function process_email(){
		$user_id=$this->session->userdata('user_id');
		$email=$this->input->post('email');	
		
		$check=$this->user_model->check_registered_email($email);
		
		if(!$email){
			$this->session->set_flashdata('notif','Email empty');
			redirect('home');
		}
		
		if($check){
			$this->session->set_flashdata('notif','Email already registered');
			redirect('home');
		}
		else{
			$data=array('registered_email'=>$email);
			$where=array('id'=>$user_id);
			$this->general_model->update_data('user_tb',$data,$where);
			$this->session->set_flashdata('notif','done');
			redirect('home');
		}
	}
}