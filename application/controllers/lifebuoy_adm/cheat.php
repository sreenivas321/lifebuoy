<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cheat extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('xlselfie_admin/login');
		$this->load->model('twitter_posting_model','tpm');
		$this->load->model('category_model');
		$this->load->model('general_model');
		$this->load->model('uploader_model');
		$this->table_name='temp_twitter_tb';		$this->per_page=20;
	}
	
	function repeat($offset=0){
		$limit=3000;
		$data=$this->tpm->get_twitter_all_reject_x($offset,$limit);
		$post_via=0;
		//pre($data);
		$no=1;
		//while($data){
			if($data){
				foreach ($data as $list){
					$username=$list['username'];
					$fullname=$list['fullname'];
					$dataall=$list['data'];
					$category=$list['category_id'];
					$newdate=$list['created_date'];
					
					$data3=$this->tpm->get_twitter_rejected_by_username($username);
					if(!$data3){
						$database2 = array(	'username'=>$username,
											'fullname'=>$fullname,
											'upload_from'=>$post_via,
											'uploader_data'=>$dataall,
											'upload_count'=>1,
											'category_id'=>$category,
											'created_date'=>$newdate,
											);	
						$this->general_model->insert_data('uploader_rejected_tb',$database2);		
														
					}else{
						$upload_count=$data3['upload_count']+1;
							$database2 = array(	
											'upload_count'=>$upload_count,
											'category_id'=>$category,
											);	
											
						$where = array('username'=>$username);
						$this->general_model->update_data('uploader_rejected_tb', $database2, $where);	
					
					}
					
				}
			}	
			echo $no;
			$no++;
		//	$offset+=2000;
		//	$data=array();
			//$data=$this->tpm->get_twitter_all_reject_x($offset,$limit);
	//	}
	}

	function index(){
		$data=$this->tpm->get_twitter_all_reject();
		$post_via=0;
		pre($data);
		if($data)
		foreach ($data as $list)
		{
		$username=$list['username'];
		$fullname=$list['fullname'];
		$dataall=$list['data'];
		$category=$list['category_id'];
		$newdate=$list['created_date'];
		
		$data3=$this->tpm->get_twitter_rejected_by_username($username);
		if(!$data3){
		$database2 = array(	'username'=>$username,
							'fullname'=>$fullname,
							'upload_from'=>$post_via,
							'uploader_data'=>$dataall,
							'upload_count'=>1,
							'category_id'=>$category,
							'created_date'=>$newdate,
							);	
		$this->general_model->insert_data('uploader_rejected_tb',$database2);		
											
		}else{
		$upload_count=$data3['upload_count']+1;
			$database2 = array(	
							'upload_count'=>$upload_count,
							'category_id'=>$category,
							);	
							
		$where = array('username'=>$username);
		$this->general_model->update_data('uploader_rejected_tb', $database2, $where);	
		
		}
		
		
		}
		$this->data['content']='admin/twitter/rejected_list';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function cheat_facebook(){
		$this->load->model('temp_upload_model');
		$data=$this->temp_upload_model->get_all_cheat();
		$post_via=0;
	if($data)
		foreach ($data as $list)
		{
		
		$fullname=$list['fullname'];

		$newdate=$list['created_date'];
		$created_by=$list['created_by'];
					$data3=$this->uploader_model->check_uploader_id_fb_rejected($created_by);
		
		if(!$data3){
			
		$database2 = array('uploader_user_id'=>$created_by,'upload_from'=>2,'created_date'=>date("Y-m-d"),
				'username'=>'','fullname'=>$fullname,'upload_count'=>1,'uploader_data'=>'');
		$this->general_model->insert_data('uploader_rejected_tb',$database2);		
											
		}else{
		$upload_count=$data3['upload_count']+1;
			$database2 = array(	
							'upload_count'=>$upload_count,
				
							);	
							
		$where = array('id'=>$data3['id']);
		$this->general_model->update_data('uploader_rejected_tb', $database2, $where);	
		
		}
		
		
		}
	}
}