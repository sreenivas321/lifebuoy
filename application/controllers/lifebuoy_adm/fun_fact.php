<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class fun_fact extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('fun_fact_model');
		
		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
	}
	
	function index(){
		$this->data['fun_fact']=$this->fun_fact_model->get_fun_fact_list();
		$this->data['content']='admin/fun_fact/list';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function add(){
		$this->data['content']='admin/fun_fact/add';
		$this->load->view('common/admin/body',$this->data);
	}
	function do_add(){
		
		$newdate=date("Y-m-d H:i:s");
		$idlogin=$this->session->userdata('admin_id');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$status=$this->input->post('status');
		$precedence=last_precedence('fun_fact_tb')+1;
		
		
		
		
		$database = array(	'name'=>$name,
							'active'=>$status,
							'created_date'=>$newdate,
							'created_by'=>$idlogin,
							'updated_date'=>$newdate,
							'updated_by'=>$idlogin,
							'precedence'=>$precedence,
							'description'=>$description
							);		
		$this->general_model->insert_data('fun_fact_tb',$database);
		redirect('lifebuoy_adm/fun_fact');
	}
	
	function edit($id){
		$this->data['detail'] = $this->fun_fact_model->get_selected_fun_fact_data($id);
		$this->data['content']='admin/fun_fact/edit';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function do_edit($id){
		$newdate=date("Y-m-d H:i:s");
		$idlogin=$this->session->userdata('admin_id');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$status=$this->input->post('status');
		
		$database = array(	'name'=>$name,
							'active'=>$status,
							'updated_date'=>$newdate,
							'updated_by'=>$idlogin,
							'description'=>$description
							);		
		$where = array('id'=>$id);
		$this->general_model->update_data('fun_fact_tb',$database,$where);
		redirect('lifebuoy_adm/fun_fact');
	}
	
	function delete($id){
		$where = array ('id'=>$id);
		$this->general_model->delete_data('fun_fact_tb',$where);
		redirect($_SERVER['HTTP_REFERER']);
	}
	function active($id,$active){
		if($active==1)$active = 0;
		else $active = 1;
		$database = array(	'active'=>$active);								
		$where = array('id'=>$id);
		$this->general_model->update_data('fun_fact_tb',$database,$where);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function up($id){
	
		$this->fun_fact_model->up($id);
	
		redirect ($_SERVER['HTTP_REFERER']);
	}
	
	function down($id){
	
		$this->fun_fact_model->down($id);
	
		redirect ($_SERVER['HTTP_REFERER']);
	}	
	
	
}