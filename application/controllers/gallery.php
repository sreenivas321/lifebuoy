<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('user_model');
		$this->load->model('posting_model');
		$this->load->model('category_model');
		$this->per_page=10;
		$this->data['curr_page']='gallery';
		$this->data['current']=$this->category_model->get_current_category();
		$this->data['next']=$this->category_model->get_next_category($this->data['current']['precedence']);
	}
	
	function index(){
		$this->data['category_id']='a';
		$this->data['gallery']=$this->posting_model->get_posting();
		
		$this->data['category']=$this->category_model->get_category_list();	
		$this->data['total']=$this->posting_model->get_total_posting();
		$this->data['content']='home';
		$this->load->view('common/body',$this->data);
	}
	
	function category($id){
		$this->data['category_id']=$id;
		$this->data['gallery']=$this->posting_model->get_posting_by_cat($id);
		$this->data['total']=$this->posting_model->get_total_posting_by_cat($id);	
		$this->data['category']=$this->category_model->get_category_list();	
		$this->data['content']='home';
		$this->load->view('common/body',$this->data);
	}
	
	
	function load_more(){
		if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST'){
			
			$limit=$this->per_page;
			$offset=$this->input->post('offset');
			$category_id=$this->input->post('category_id');
			
			$this->data['category']=$this->category_model->get_category_list();
			
			$this->data['gallery']=$this->posting_model->get_posting_2_by_cat($category_id,$limit,$offset);
			$content=$this->load->view('gallery_load_ajax',$this->data,TRUE);
			
			$next=$this->posting_model->get_posting_2_by_cat($category_id,$limit,$offset+$limit);
			if($next)$next_offset=$offset+$limit;
			else $next_offset=0;
			
			if($content)echo json_encode(array('status'=>1,'content'=>$content,'offset'=>$next_offset));
			else echo json_encode(array('status'=>0,'content'=>'','offset'=>0));
		}
		else redirect('home');//echo json_encode(array('status'=>0,'content'=>'','offset'=>0));
		//echo $_SERVER['REQUEST_METHOD'];
	}
	
	
	
	function gallery_detail_ajax($id='xx'){
		if($id=='xx'){
			echo json_encode(array('status'=>0,'message'=>"Data not found"));
		}
		else{
			$detail=$this->posting_model->get_posting_detail($id);
		
		
			if($detail){
				if($detail['post_via']<2)$name='@ '.$detail['username'];
				else $name=$detail['fullname'];
				
				$arr=array('status'=>1,'username'=>$name,'post_date'=>time_elapsed_string(strtotime($detail['post_date'])),'image'=>$detail['image'],'description'=>$detail['description']);
				echo json_encode($arr);
			}
		
		}
		//pre($detail);
	}
}