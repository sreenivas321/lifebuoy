<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Instagram extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('posting_model');
		$this->load->model('category_model');
		$this->load->model('instagram_model');
		$this->load->model('uploader_model');


		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
		$this->per_page=50;
		$this->table_name='temp_instagram_tb';
	}
	
	function search_pending(){
		$search=urlencode($this->input->post('search'));
		$hashtag=urlencode($this->input->post('hashtag'));
		redirect('lifebuoy_adm/instagram/index/'.$hashtag.'/'.$search);
	}
	
	
	function rejected($offset=0){
		$search="all";
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('lifebuoy_adm/instagram/rejected').'/';
		$config['total_rows'] = $this->instagram_model->get_total_temp_instagram_by_status2(1,$search);
		$config['per_page'] = $this->per_page; 
		
		$config['uri_segment'] = 4;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Older &gt";
		$config['prev_link']="&lt; Newer";
		$config['first_link']="&laquo; Newest";
		$config['last_link']="Oldest &raquo";
		//$config['first_link']=FALSE;
		//$config['last_link']=FALSE;
		
		$this->pagination->initialize($config); 

		$this->data['pagination']=$this->pagination->create_links();

		$type=0;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['instagram']=$this->instagram_model->get_temp_instagram_by_status2(1,$offset,$this->per_page,$search);
		
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/instagram/rejected';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function save_db($hashtagx=''){
		$no=1;
		
		$client = "65be10b376fa4d61a2d67d92d9bf9f44";
		
		
		
		$duplicate=0;
		$new_hashtag='#'.$hashtagx;
		$hashtag_detail=$this->category_model->get_hashtag_detail($new_hashtag);
		
		$min_tag_id=$hashtag_detail['instagram_last_id'];
		
			
			
	
	
	
		$url= "https://api.instagram.com/v1/tags/".$hashtagx."/media/recent?count=50&client_id=".$client;
	

	
		do{
			
			
		
		
			$result=$this->get_curl($url);
			$result=json_decode($result,TRUE);
			if(isset($result['data']))
			$data=$result['data'];
			else
			$data=null;
			
			$x=0;
			if($data){
				
				foreach($data as $list){
					//pre($list);
					$image_data=$list['images'];
					$image_url=$image_data['standard_resolution']['url'];
					$post_id=$list['id'];
					
					
					$check=$this->instagram_model->is_post_exists($post_id);
					if(!$check){
						$ig_data=json_encode($list);
						$user_id=$list['user']['id'];
						$post_date=date("Y-m-d H:i:s",($list['created_time']));
						$text=$list['caption']['text'];
						$username=$list['user']['username'];
						$full_name=$list['user']['full_name'];
						
						$inserts=array('image'=>$image_url,'category_id'=>$hashtag_detail['id'],'username'=>$username,'fullname'=>$full_name,'post_date'=>$post_date,'description'=>$text,'instagram_post_id'=>$post_id,'uploader_id'=>$user_id,'data'=>$ig_data,'created_date'=>date("Y-m-d H:i:s"));
						$this->general_model->insert_data('temp_instagram_tb',$inserts);
					}
					else {
						$duplicate=1;
						break;
					}
					$x++;
					//echo 'x='.$x;
				}
			}
			
			
			$pagination=$result['pagination'];
			
			
			if(isset($pagination['next_url'])){
				$url=$pagination['next_url'];
			}
			else{
				$duplicate=1;
			}
			
			$no++;
			
			
		}while(isset($result['data']) && $duplicate==0);
		//$since_id=$last_tweet_id;
		//echo $last_tweet_id;
		//$this->general_model->update_data('category_tb',array('last_tweet_id'=>$since_id),array('id'=>$hashtag_detail['id']));
		//echo $no;
		redirect('lifebuoy_adm/instagram/index/'.$hashtagx);
	}
	
	
	function index($hashtag='',$search='all',$offset=0){
		$this->load->library('pagination');
		$this->data['hashtag']=$hashtag;
		
		
		$new_hashtag='#'.$hashtag;
		$hashtag_detail=$this->category_model->get_hashtag_detail($new_hashtag);
		
		$config['base_url'] = site_url('lifebuoy_adm/instagram/index').'/'.$hashtag.'/'.$search;
		$config['total_rows'] = $this->instagram_model->get_total_temp_instagram_by_status($hashtag_detail['id'],0,$search);
		$config['per_page'] = $this->per_page; 
		
		$config['uri_segment'] = 6;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Older &gt";
		$config['prev_link']="&lt; Newer";
		$config['first_link']="&laquo; Newest";
		$config['last_link']="Oldest &raquo";
		//$config['first_link']=FALSE;
		//$config['last_link']=FALSE;
		
		$this->pagination->initialize($config); 

		$this->data['pagination']=$this->pagination->create_links();

		$type=0;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['twitter']=$this->instagram_model->get_temp_instagram_by_status($hashtag_detail['id'],0,$offset,$this->per_page,$search);
		
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/instagram/list';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function batch_update(){
		$id=$this->input->post('ids');

		$data=array();
		if($id)foreach($id as $list){
			$detail=$this->tpm->get_temp_detail($list);
			
			$category_id=$this->input->post('category_id'.$list);
			$image_link=$this->input->post('image_link'.$list);
			
			$data=array(
				'image'=>$image_link,
				'category_id'=>$category_id,
				'updated_date'=>date("Y-m-d H:i:s"),
				'updated_by'=>$this->session->userdata("admin_id")
			);
			$where=array('id'=>$list);
			$this->general_model->update_data($this->table_name,$data,$where);
		}
				
		redirect($_SERVER['HTTP_REFERER']);
	}
		
	function batch_reject(){
		$id=$this->input->post('id');
		
		if($id)foreach($id as $list){
			$category_id=$this->input->post('category_id'.$list);
			$image_link=$this->input->post('image_link'.$list);
			
			$set=array('rejected'=>1,
				'image'=>$image_link,
				'category_id'=>$category_id,
				'updated_date'=>date("Y-m-d H:i:s"),
				'updated_by'=>$this->session->userdata("admin_id"));
			$table=$this->table_name;
			$where=array('id'=>$list);
			$this->general_model->update_data($table, $set, $where);
			
			$detail=$this->instagram_model->get_temp_detail($list);
			$uploaded_data=json_decode(strip_tags($detail['data']),TRUE);
			
			if($image_link!="")$table_name='uploader_rejected_tb';
			else $table_name='uploader_rejected2_tb';
			
			$check_uploader=$this->uploader_model->check_uploader_id_rejected_ig($detail['uploader_id']);
			if($check_uploader){
				$uploader_id=$check_uploader['id'];
				$this->general_model->update_data($table_name,array('upload_count'=>$check_uploader['upload_count']+1),array('id'=>$check_uploader['id']));
			}
			else{
				
//				(`uploader_user_id`,`upload_from`,`created_date`,`username`,`fullname`,`uploader_data`,`upload_count`) values 
	//		('".mysql_escape_string($uploader['id'])."','0','".date("Y-m-d")."','".mysql_escape_string($username)."','".mysql_escape_string($fullname)."','".$uploader_data."',1)";
				
				$set=array('uploader_user_id'=>$detail['uploader_id'],'upload_from'=>1,'created_date'=>date("Y-m-d"),'username'=>$detail['username'],'fullname'=>$detail['fullname'],'upload_count'=>1,'uploader_data'=>json_encode($uploaded_data['user']));
				
				$this->general_model->insert_data($table_name,$set);
			}
	//	echo $table_name;
		}
		$hashtag=$this->input->post('hashtag');	
		redirect('lifebuoy_adm/instagram/index/'.$hashtag);
	}	
	
	function batch_approve(){
		$id=$this->input->post('id');

		$data=array();
		if($id)foreach($id as $list){
			$detail=$this->instagram_model->get_temp_detail($list);
			$uploaded_data=json_decode(strip_tags($detail['data']),TRUE);
			
			//pre($uploaded_data);
			
			$category_id=$this->input->post('category_id'.$list);
			$image_link=$this->input->post('image_link'.$list);
			
			$post_via=1;//0 twitter, 1 instagram
			
			
			$check_uploader=$this->uploader_model->check_uploader_id_ig($detail['uploader_id']);
			if($check_uploader){
				$uploader_id=$check_uploader['id'];
				$this->general_model->update_data('uploader_tb',array('upload_count'=>$check_uploader['upload_count']+1),array('id'=>$check_uploader['id']));
			}
			else{
				
//				(`uploader_user_id`,`upload_from`,`created_date`,`username`,`fullname`,`uploader_data`,`upload_count`) values 
	//		('".mysql_escape_string($uploader['id'])."','0','".date("Y-m-d")."','".mysql_escape_string($username)."','".mysql_escape_string($fullname)."','".$uploader_data."',1)";
				//$detail['uploader_id']=1;
				$set=array('uploader_user_id'=>$detail['uploader_id'],'upload_from'=>1,'created_date'=>date("Y-m-d"),'username'=>$detail['username'],'fullname'=>$detail['fullname'],'upload_count'=>1,'uploader_data'=>json_encode($uploaded_data['user']));
				
				$this->general_model->insert_data('uploader_tb',$set);
			}
			//pre($detail);
			$data[]=array(
				'description'=>$detail['description'],
				'image'=>$image_link,
				'active'=>1,
				'data'=>$detail['data'],
				'category_id'=>$category_id,
				'username'=>$detail['username'],'fullname'=>$detail['fullname'],
				'post_via'=>$post_via,'image'=>$detail['image'],'created_date'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata("admin_id"),'post_date'=>$detail['post_date']
			);
		//	exit();
		}
		
		$table_name='posting_tb';
		
		if($data)
			$this->general_model->insert_data_batch($table_name,$data);
			
		
		if($id)foreach($id as $list){
			$where=array('id'=>$list);
			$this->general_model->delete_data($this->table_name,$where);
		}
		
		$hashtag=$this->input->post('hashtag');	
		redirect('lifebuoy_adm/instagram/index/'.$hashtag);
	}
		
	function get_curl($url) {
	if(function_exists('curl_init')) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
		$output = curl_exec($ch);
		echo curl_error($ch);
		curl_close($ch);
		return $output;
		
	
	} else{
		return file_get_contents($url);
	}
}



	function do_approve() {

		$newdate=date("Y-m-d H:i:s");
		$idlogin=$this->session->userdata('admin_id');
		$image_src=$this->input->post('image_src');
		$caption=$this->input->post('caption');
		$fullname=$this->input->post('fullname');
		$username=$this->input->post('username');
		$category=$this->input->post('category');
		$dataall=$this->input->post('dataall');
		$instagram_id=$this->input->post('instagram_id');
		$profile_picture=$this->input->post('profile_picture');
		$post_date=$this->input->post('post_date');
		$status=1;
		$post_via=1;
		$upload_count='';
		$database = array(	'category_id'=>$category,
							'description'=>$caption,
							'data'=>$dataall,
							'image'=>$image_src,
							'active'=>$status,
							'username'=>$username,
							'fullname'=>$fullname,
							'post_via'=>$post_via,
						//	'profile_picture'=>$profile_picture,
							'created_date'=>$newdate,
							'created_by'=>$idlogin,
							'updated_date'=>$newdate,
							'updated_by'=>$idlogin,	
							'post_date'=>$post_date
							);		
		$this->general_model->insert_data('posting_tb',$database);
		
		$data3=$this->instagram_model->get_uploader_by_user_name($username);
		if(!$data3){
		$database2 = array(	'username'=>$username,
							'fullname'=>$fullname,
							'upload_from'=>$post_via,
							'uploader_data'=>$dataall,
							'upload_count'=>1,
							'uploader_user_id'=>$instagram_id,
							'category_id'=>$category,
							'created_date'=>$newdate,
							);	
		$this->general_model->insert_data('uploader_tb',$database2);		
		echo 'a';									
		}else{
		$upload_count=$data3['upload_count']+1;
			$database2 = array(	
							'upload_count'=>$upload_count,
							'category_id'=>$category,
							);	
							
		$where = array('username'=>$username);
		$this->general_model->update_data('uploader_tb', $database2, $where);	
		echo'b';
		}
		
	}
	
		function do_reject() {

		$newdate=date("Y-m-d H:i:s");
		$idlogin=$this->session->userdata('admin_id');
		$image_src=$this->input->post('image_src');
		$caption=$this->input->post('caption');
		$fullname=$this->input->post('fullname');
		$username=$this->input->post('username');
		$category=$this->input->post('category');
		$dataall=$this->input->post('dataall');
		$instagram_id=$this->input->post('instagram_id');
		$profile_picture=$this->input->post('profile_picture');
		$status=1;
		$post_via=1;
		$upload_count='';
		pre($_POST);
		pre($image_src);
		$database = array(	'category_id'=>$category,
							'description'=>$caption,
							'data'=>$dataall,
							'image'=>$image_src,
							'active'=>$status,
							'username'=>$username,
							'fullname'=>$fullname,
							'post_via'=>$post_via,
						//	'profile_picture'=>$profile_picture,
							'created_date'=>$newdate,
							'created_by'=>$idlogin,
							'updated_date'=>$newdate,
							'updated_by'=>$idlogin,	
							);		
		$this->general_model->insert_data('rejected_instagram_tb',$database);
		
		$data3=$this->instagram_model->get_uploader_rejected_by_user_name($username);

		if(!$data3){
		$database2 = array(	'username'=>$username,
							'fullname'=>$fullname,
							'upload_from'=>$post_via,
							'uploader_data'=>$dataall,
							'upload_count'=>1,
							'uploader_user_id'=>$instagram_id,
							'category_id'=>$category,
							'created_date'=>$newdate,
							);	
		$this->general_model->insert_data('uploader_rejected_tb',$database2);		
		echo 'a';									
		}else{
		$upload_count=$data3['upload_count']+1;
			$database2 = array(	
							'upload_count'=>$upload_count,
							'category_id'=>$category,
							);	
							
		$where = array('username'=>$username);
		$this->general_model->update_data('uploader_rejected_tb', $database2, $where);	
		echo'b';
		}
		
	}
	
	
}