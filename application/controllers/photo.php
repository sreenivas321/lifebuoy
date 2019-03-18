<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Photo extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('posting_model');
		$this->load->model('category_model');
		$this->load->model('general_model');
		$this->per_page=1;
	}
	
	function uploads(){
		if($this->session->userdata('user_logged_in')){
			$image='';	
			$config['upload_path'] = 'userdata/temp/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['encrypt_name'] = TRUE;		
			$this->load->library('upload', $config);
			if($this->upload->do_upload('file'))
			{				
				$data = $this->upload->data();
				
				$sess=array('image_url'=>'','type'=>'');
				$this->session->set_userdata($sess);

				$image=$data['file_name'];
				$sess=array('image_url'=>base_url().'userdata/temp/'.$image,'type'=>2);
				$this->session->set_userdata($sess);
				
				echo json_encode(array('image'=>base_url().'userdata/temp/'.$image,'status'=>1));	
			}
			else{
				echo json_encode(array('image'=>'','status'=>0));
			}
		}
		else{
			echo json_encode(array('image'=>'','status'=>0));
		}
	}
	
	function do_upload(){
		$image_url=$this->session->userdata('image_url');
		$user_id=$this->session->userdata('user_id');
		$this->load->model('temp_upload_model');
		$description='';
		
		
		$config['upload_path'] = 'userdata/';
		$config['allowed_types'] = 'jpg|jpeg|png';
		$config['encrypt_name'] = TRUE;		
		$this->load->library('upload', $config);
		if($this->upload->do_upload('image'))
		{				
			$data = $this->upload->data();
			
			$image=$data['file_name'];
				
		}
		else{
			$image='';
		}
		
		$name=$this->session->userdata('name');
		$type=2;
		$description=$this->input->post('description');
		
		
		$table='temp_uploads_tb';
		$data=array('fullname'=>$name,'description'=>$description,'type'=>$type,'created_by'=>$user_id,'created_date'=>date("Y-m-d H:i:s"),'image'=>base_url().'userdata/'.$image);
		$this->general_model->insert_data($table, $data);echo mysql_insert_id();
		pre($data);
		
		pre($_FILES);				
			
	}
	
	function xxx(){
	//	echo $this->session->userdata('image_url');	
	}
	
	function index($category_id='a',$offset=0){
		//$this->load->library('pagination');	
//		
//		$sorting=1;
//		$config['base_url'] = site_url('photo/index/'.$category_id.'/');
//		$config['total_rows'] = $this->posting_model->get_posting_by_category_pagination_total($category_id);
//		$config['per_page'] = $per_page=$this->per_page; 
//		$config['uri_segment'] = 4;
//		$config['anchor_class']='class="page"';
//		$config['next_link']="&nbsp;";
//		$config['prev_link']="&nbsp;";
//		$config['prev_class']='class="page back_btn"';
//		$config['next_class']='class="page next_btn"';
//		$config['cur_tag_open'] = '<span class="page active">';
//		$config['cur_tag_close'] = '</span>';
//
//		$config['first_link']=FALSE;
//		$config['last_link']=FALSE;
//		
//		$this->pagination->initialize($config); 
//		$this->data['pagination']=$this->pagination->create_links();
//
//		$this->data['category_id']=$category_id;
//		$this->data['sorting']=$sorting;
//		$this->data['category']=$this->category_model->get_category_list_by_type($type=0);
//		$this->data['posting_list']=$this->posting_model->get_posting_by_category_pagination($category_id,$sorting,$offset,$per_page);
//
//		$this->data['content']='photo';
//		$this->load->view('common/body',$this->data);
	}
	
	
	function indexs(){
		//$this->data['posting_list']=$this->posting_model->get_posting();
		//$this->data['content']='photo2';
		//$this->load->view('common/body',$this->data);
	}
	
	function like(){
	//$newdate=date("Y-m-d H:i:s");
//	$posting_id=$this->input->post('posting_id');
//	$user_id=$this->session->userdata('user_id');
//	$type_id=$this->input->post('type');
//	
//	$data=$this->posting_model->get_posting_detail($posting_id);
//	$like_count=$data['like_count']+1;
//	$dislike_count=$data['dislike_count']+1;
//	if($type_id==0){
//	$database2 = array(		'dislike_count'=>$dislike_count, 
//							);		
//	}else{
//	$database2 = array(		'like_count'=>$like_count, 
//							);		
//	}
//	$where2= array('id'=>$posting_id);
//	if($user_id!=0){
//		$this->general_model->update_data('posting_tb', $database2, $where2);
//		$database = array(		'posting_id'=>$posting_id, 
//								'user_id'=>$user_id,
//								'type'=>$type_id,
//								'created_date'=>$newdate,
//								);		
//		$this->general_model->insert_data('post_like_dislike_tb',$database);
//	}
//	
	}

	function photo_upload_fb(){
		//$image=$this->input->post('image_url');
//		
//		
//				$sess=array('image_url'=>'','type'=>'');
//				$this->session->set_userdata($sess);
//
//		
//		$sess=array('image_url'=>$image,'type'=>3);
//		$this->session->set_userdata($sess);
//		echo $this->session->userdata('image_url');
//		
//		pre($this->session->all_userdata());
	}	
	
}