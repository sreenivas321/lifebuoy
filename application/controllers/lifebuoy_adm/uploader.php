<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Uploader extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('uploader_model');
		$this->load->model('category_model');
		$this->load->model('general_model');
		$this->table_name='uploader_tb';
		$this->per_page=20;
		
		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
	}
	
	function index(){redirect('lifebuoy_adm/uploader/page/a');}
	
	function page($category_id='a',$upload_by='a',$offset=0){
		$this->data['uploaded_by_filter']=$upload_by;
		$this->load->library('pagination');
		$config['base_url'] = site_url('lifebuoy_adm/uploader/page').'/'.$category_id.'/'.$upload_by.'/';
		$config['total_rows'] = $this->uploader_model->get_total_uploader_by_category($category_id,$upload_by);
		$config['per_page'] = $this->per_page; 	
		$config['uri_segment'] = 6;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Next &gt";
		$config['prev_link']="&lt; Prev";
		$config['first_link']="&laquo; First";
		$config['last_link']="Last &raquo";
		//$config['first_link']=FALSE;
		//$config['last_link']=FALSE;
		
		$this->pagination->initialize($config); 

		$this->data['pagination']=$this->pagination->create_links();

		$type=1;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['uploader']=$this->uploader_model->get_uploader_by_list($category_id,$upload_by,$offset,$this->per_page,$upload_by);
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/uploader/uploader_list';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	
	function rejected($category_id='a',$upload_by='a',$offset=0){
		$this->data['uploaded_by_filter']=$upload_by;
		$this->load->library('pagination');
		$config['base_url'] = site_url('lifebuoy_adm/uploader/rejected').'/'.$category_id.'/'.$upload_by.'/';
		$config['total_rows'] = $this->uploader_model->get_total_uploader_by_category_rejected($category_id,$upload_by);
		$config['per_page'] = $this->per_page; 	
		$config['uri_segment'] = 6;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Next &gt";
		$config['prev_link']="&lt; Prev";
		$config['first_link']="&laquo; First";
		$config['last_link']="Last &raquo";
		//$config['first_link']=FALSE;
		//$config['last_link']=FALSE;
		
		$this->pagination->initialize($config); 

		$this->data['pagination']=$this->pagination->create_links();

		$type=1;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['uploader']=$this->uploader_model->get_uploader_by_list_rejected($category_id,$upload_by,$offset,$this->per_page,$upload_by);
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/uploader/rejected';
		$this->load->view('common/admin/body',$this->data);		
	}
	function rejected2($category_id='a',$upload_by='a',$offset=0){
		$this->data['uploaded_by_filter']=$upload_by;
		$this->load->library('pagination');
		$config['base_url'] = site_url('lifebuoy_adm/uploader/rejected2').'/'.$category_id.'/'.$upload_by.'/';
		$config['total_rows'] = $this->uploader_model->get_total_uploader_by_category_rejected2($category_id,$upload_by);
		$config['per_page'] = $this->per_page; 	
		$config['uri_segment'] = 6;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Next &gt";
		$config['prev_link']="&lt; Prev";
		$config['first_link']="&laquo; First";
		$config['last_link']="Last &raquo";
		//$config['first_link']=FALSE;
		//$config['last_link']=FALSE;
		
		$this->pagination->initialize($config); 

		$this->data['pagination']=$this->pagination->create_links();

		$type=1;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['uploader']=$this->uploader_model->get_uploader_by_list_rejected2($category_id,$upload_by,$offset,$this->per_page,$upload_by);
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/uploader/rejected2';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function update_data(){
		$id=$this->input->post('id');

		$data=array();
		if($id)foreach($id as $list){
			$category_id=$this->input->post('category_id'.$list);
			
			$data=array(
				'category_id'=>$category_id
			);
			
			$where=array('id'=>$list);
			
			$this->general_model->update_data($this->table_name,$data,$where);
		}
		
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	function update_data_rejected(){
		$id=$this->input->post('id');

		$data=array();
		if($id)foreach($id as $list){
			$category_id=$this->input->post('category_id'.$list);
			
			$data=array(
				'category_id'=>$category_id
			);
			
			$where=array('id'=>$list);
			
			$this->general_model->update_data('uploader_rejected_tb',$data,$where);
		}
		
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	function update_data_rejected2(){
		$id=$this->input->post('id');

		$data=array();
		if($id)foreach($id as $list){
			$category_id=$this->input->post('category_id'.$list);
			
			$data=array(
				'category_id'=>$category_id
			);
			
			$where=array('id'=>$list);
			
			$this->general_model->update_data('uploader_rejected2_tb',$data,$where);
		}
		
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	
	function csv(){
		$status=$this->input->post('status');
		$this->data['uploader']='';
		$this->data['start_date']=$start_date=$this->input->post('start_date');
		$this->data['end_date']=$end_date=$this->input->post('end_date');
		
		if($status==1){
				if($start_date=='' && $end_date==''){
				$this->data['uploader']=$this->uploader_model->get_all_uploader();
				}elseif($start_date!=''&& $end_date==''){
				$this->data['uploader']=$this->uploader_model->get_all_start_date($start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['uploader']=$this->uploader_model->get_all_end_date($end_date);
				}else{
				$this->data['uploader']=$this->uploader_model->get_all_by_date($start_date,$end_date);
				}
			}
		$this->data['content']='admin/uploader/filter_uploader';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function download_csv_form($start_date='',$end_date=''){

			if($start_date=='' && $end_date==''){
				$this->data['uploader']=$this->uploader_model->get_all_uploader();
				}elseif($start_date!=''&& $end_date==''){
				$this->data['uploader']=$this->uploader_model->get_all_start_date($start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['uploader']=$this->uploader_model->get_all_end_date($end_date);
				}else{
				$this->data['uploader']=$this->uploader_model->get_all_by_date($start_date,$end_date);
			}
		$content=$this->load->view('admin/uploader/download_uploader',$this->data,TRUE);
		$filename = "Uploader ".$start_date." ".$end_date.".xls";
		//prepare to give the user a Save/Open dialog...
		header ("Content-type: application/octet-stream");
		header ("Content-Disposition: attachment; filename=".$filename);
		
		//setting the cache expiration to 30 seconds ahead of current time. an IE 8 issue when opening the data directly in the browser without first saving it to a file
		$expiredate = time() + 30;
		$expireheader = "Expires: ".gmdate("D, d M Y G:i:s",$expiredate)." GMT";
		header ($expireheader);
		
		echo $content;
		exit;			
	}

}