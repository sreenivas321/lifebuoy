<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Twitter extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('twitter_posting_model','tpm');
		$this->load->model('category_model');
		$this->load->model('general_model');
		$this->load->model('uploader_model');
		$this->table_name='temp_twitter_tb';
		$this->per_page=50;
		
		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
	}
	
	function save_db($hashtagx=''){
		$no=1;
		$last_data=get_last_tweet_id();
		$since_id=$last_data['since_id'];
		//echo $since_id;exit();
		//$max_id=$last_data['max_id'];
		//$max_id=603533982345494700;
		$max_id=0;
		$paging=100;
		$duplicate=0;
		$new_hashtag='#'.$hashtagx;
		$hashtag_detail=$this->category_model->get_hashtag_detail($new_hashtag);
		
		$since_id=$hashtag_detail['last_tweet_id'];
		
		$hashtag='#NyamanBerhijab #LifebuoyID';	
		
		if($hashtagx!='')$hashtag.=' '.$new_hashtag;
		
		
		if($hashtagx=='nyamanberhijab')
			$hashtag='#NyamanBerhijab #LifebuoyID';	
			
		do{
			//$url='http://staging.isysedge.com/twitterRestGet/get_tweets_api.php';
			
			$url='http://nyamanberhijab.lifebuoy.co.id/twitterRestGet/get_tweets_api.php';
			$data=array('status'=>1,'consumer_key'=>CONSUMER_KEY,'consumer_secret'=>CONSUMER_SECRET,'access_token'=>ACCESS_TOKEN,'access_token_secret'=>ACCESS_TOKEN_SECRET,'max_id'=>$max_id,'since_id'=>$since_id,'count'=>$paging,'hashtag'=>$hashtag);
		
		
		
			$result=$this->get_curl($url,$data);
			$result=json_decode($result,TRUE);
			$tweets=$result['statuses'];	
			$search_detail=$result['search_metadata'];
			//exit();
			if($tweets){
				$last_tweet_id=$tweets[0]['id'];
			}
			else {
				$last_tweet_id=0;
			}
			/*
			if($no==2){
				echo "<br>";
				echo $tweets[0]['id'].'----'.$since_id;
				echo "<br>";
			}*/
			
			$x=0;
			if($tweets){
				
				foreach($tweets as $list){
				
					$full_name=$list['user']['name'];
					$screen_name=$list['user']['screen_name'];
					$entities=$list['entities'];
					$image_url='';
					if(isset($entities['media'])){
						$image_url=$entities['media'][0]['media_url'];
					}
					else{
						if(isset($entities['urls'][0])){
							$link=$entities['urls'][0]['expanded_url'];
				
							$xxx=explode('/',$link);
							if($xxx[2]=='twitpic.com')
							$image_url='http://'.$xxx[2].'/show/full/'.$xxx[3];
							else if($xxx[2]=='imgur.com')
							$image_url='http://i.'.$xxx[2].'/'.$xxx[3].'.jpg';
							else if($xxx[2]=='yfrog.com')
							$image_url='http://'.$xxx[2].'/'.$xxx[3].':medium';
						}
					}
					
					
					if(isset($list['text']))
						$text=$list['text'];
					else 
						$text="";
					
					$check=$this->tpm->is_exists_tweet_id($list['id']);
					if(!$check){
						if($image_url){
							$tweet_data=json_encode($list);
							$user_id=$list['user']['id'];
							$post_date=date("Y-m-d H:i:s",strtotime($list['created_at']));
							
							//$is_registered=$this->user_model->check_tw_id($user_id);
							
							//if($is_registered){
								$inserts=array('image'=>$image_url,'category_id'=>$hashtag_detail['id'],'username'=>$screen_name,'fullname'=>$full_name,'post_date'=>$post_date,'description'=>$text,'tweet_id'=>$list['id'],'uploader_id'=>$user_id,'data'=>$tweet_data,'created_date'=>date("Y-m-d H:i:s"));
								$this->general_model->insert_data('temp_twitter_tb',$inserts);
							//}
						}
					}
					else {
						$duplicate=1;
						break;
					}
					$x++;
					//echo 'x='.$x;
				}
			}
			
			if(isset($search_detail['next_results'])){
				$next_url=$search_detail['next_results'];
				$params=''; 
				parse_str(parse_url($next_url, PHP_URL_QUERY), $params); 
				$max_id=$params['max_id'];
			}
			
			$no++;
		}while(isset($search_detail['next_results']) && $duplicate==0);
		$since_id=$last_tweet_id;
		//echo $last_tweet_id;
		$this->general_model->update_data('category_tb',array('last_tweet_id'=>$since_id),array('id'=>$hashtag_detail['id']));
		
		redirect('lifebuoy_adm/twitter/index/'.$hashtagx);
	}
	
	function get_curl($url,$data) {
		if(function_exists('curl_init')) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);   
			 
			$output = curl_exec($ch);
			echo curl_error($ch);
			curl_close($ch);
			return $output;
			
		
		} else{
			return file_get_contents($url);
		}
	}
	
	function index($hashtag='',$search='all',$offset=0){
		$this->load->library('pagination');
		$this->data['hashtag']=$hashtag;
		if(!$hashtag)redirect('lifebuoy_adm');
		
		$new_hashtag='#'.$hashtag;
		$hashtag_detail=$this->category_model->get_hashtag_detail($new_hashtag);
		
		$config['base_url'] = site_url('lifebuoy_adm/twitter/index').'/'.$hashtag.'/'.$search;
		$config['total_rows'] = $this->tpm->get_total_temp_twitter_by_status($hashtag_detail['id'],0,$search);
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
		$this->data['twitter']=$this->tpm->get_temp_twitter_by_status($hashtag_detail['id'],0,$offset,$this->per_page,$search);
		
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/twitter/list';
		$this->load->view('common/admin/body',$this->data);
	}
	
	
	function search_pending(){
		$search=urlencode($this->input->post('search'));
		$hashtag=urlencode($this->input->post('hashtag'));
		redirect('lifebuoy_adm/twitter/index/'.$hashtag.'/'.$search);
	}
	
	function rejected($offset=0){
		$search="all";
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('lifebuoy_adm/twitter/rejected').'/';
		$config['total_rows'] = $this->tpm->get_total_temp_twitter_by_status2(1,$search);
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
		$this->data['twitter']=$this->tpm->get_temp_twitter_by_status2(1,$offset,$this->per_page,$search);
		
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/twitter/rejected_list';
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
		$hashtag=$this->input->post('hashtag');
		
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
			
			$detail=$this->tpm->get_temp_detail($list);
			$uploaded_data=json_decode(strip_tags($detail['data']),TRUE);
			
			if($image_link!="")$table_name='uploader_rejected_tb';
			else $table_name='uploader_rejected2_tb';
			
			$check_uploader=$this->uploader_model->check_uploader_id_rejected($detail['uploader_id']);
			if($check_uploader){
				$uploader_id=$check_uploader['id'];
				$this->general_model->update_data($table_name,array('upload_count'=>$check_uploader['upload_count']+1),array('id'=>$check_uploader['id']));
			}
			else{
				
//				(`uploader_user_id`,`upload_from`,`created_date`,`username`,`fullname`,`uploader_data`,`upload_count`) values 
	//		('".mysql_escape_string($uploader['id'])."','0','".date("Y-m-d")."','".mysql_escape_string($username)."','".mysql_escape_string($fullname)."','".$uploader_data."',1)";
				
				$set=array('uploader_user_id'=>$detail['uploader_id'],'upload_from'=>0,'created_date'=>date("Y-m-d"),'username'=>$detail['username'],'fullname'=>$detail['fullname'],'upload_count'=>1,'uploader_data'=>json_encode($uploaded_data['user']));
				
				$this->general_model->insert_data($table_name,$set);
			}
	//	echo $table_name;
		}
		redirect('lifebuoy_adm/twitter/index/'.$hashtag);
	}	
	
	function batch_approve(){
		$id=$this->input->post('id');

		$hashtag=$this->input->post('hashtag');

		$data=array();
		if($id)foreach($id as $list){
			$detail=$this->tpm->get_temp_detail($list);
			$uploaded_data=json_decode(strip_tags($detail['data']),TRUE);
			
			//pre($uploaded_data);
			
			$category_id=$this->input->post('category_id'.$list);
			$image_link=$this->input->post('image_link'.$list);
			
			$post_via=0;//0 twitter, 1 instagram
			
			
			$check_uploader=$this->uploader_model->check_uploader_id($detail['uploader_id']);
			if($check_uploader){
				$uploader_id=$check_uploader['id'];
				$this->general_model->update_data('uploader_tb',array('upload_count'=>$check_uploader['upload_count']+1),array('id'=>$check_uploader['id']));
			}
			else{
				
//				(`uploader_user_id`,`upload_from`,`created_date`,`username`,`fullname`,`uploader_data`,`upload_count`) values 
	//		('".mysql_escape_string($uploader['id'])."','0','".date("Y-m-d")."','".mysql_escape_string($username)."','".mysql_escape_string($fullname)."','".$uploader_data."',1)";
				//$detail['uploader_id']=1;
				$set=array('uploader_user_id'=>$detail['uploader_id'],'upload_from'=>0,'created_date'=>date("Y-m-d"),'username'=>$detail['username'],'fullname'=>$detail['fullname'],'upload_count'=>1,'uploader_data'=>json_encode($uploaded_data['user']));
				
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
		
		

		redirect('lifebuoy_adm/twitter/index/'.$hashtag);
	}
	
	function do_approve($id=0){
		if($id!=0){
			$detail=$this->tpm->get_temp_detail($id);
			$post_via=0;//0 twitter, 1 instagram
			$data=array(
				'description'=>$detail['description'],
				'data'=>$detail['data'],
				'category_id'=>$category_id,
				'active'=>1,
				'username'=>$detail['username'],'fullname'=>$detail['fullname'],
				'post_via'=>$post_via,'image'=>$detail['image'],'created_date'=>date("Y-m-d H:i:s")
			);
			$table_name='posting_tb';
			$this->general_model->insert_data($table_name,$data);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function do_reject($id=0){
		if($id!=0){
			$set=array('rejected'=>1);
			$table=$this->table_name;
			$where=array('id'=>$id);
			$this->general_model->update_data($table, $set, $where);
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function pending_csv(){
		$status=$this->input->post('status');
		$this->data['twitter']='';
		$this->data['start_date']=$start_date=$this->input->post('start_date');
		$this->data['end_date']=$end_date=$this->input->post('end_date');
		
		if($status==1){
				if($start_date=='' && $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_twitter_posting(0);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_start_date(0,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['twitter']=$this->tpm->get_all_end_date(0,$end_date);
				}else{
				$this->data['twitter']=$this->tpm->get_all_by_date(0,$start_date,$end_date);
				}
			}
		$this->data['content']='admin/twitter/filter_pending';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function download_pending_form($start_date='',$end_date=''){

			if($start_date=='' && $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_twitter_posting(0);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_start_date(0,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['twitter']=$this->tpm->get_all_end_date(0,$end_date);
				}else{
				$this->data['twitter']=$this->tpm->get_all_by_date(0,$start_date,$end_date);
			}
		$content=$this->load->view('admin/twitter/download_pending',$this->data,TRUE);
		$filename = "Twitter Pending".$start_date." ".$end_date.".xls";
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
	
	function rejected_csv(){
		$status=$this->input->post('status');
		$this->data['twitter']='';
		$this->data['start_date']=$start_date=$this->input->post('start_date');
		$this->data['end_date']=$end_date=$this->input->post('end_date');
		
		if($status==1){
				if($start_date=='' && $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_twitter_posting(1);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_start_date(1,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['twitter']=$this->tpm->get_all_end_date(1,$end_date);
				}else{
				$this->data['twitter']=$this->tpm->get_all_by_date(1,$start_date,$end_date);
				}
			}
		$this->data['content']='admin/twitter/filter_rejected';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function download_rejected_form($start_date='',$end_date=''){

			if($start_date=='' && $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_twitter_posting(1);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['twitter']=$this->tpm->get_all_start_date(1,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['twitter']=$this->tpm->get_all_end_date(1,$end_date);
				}else{
				$this->data['twitter']=$this->tpm->get_all_by_date(1,$start_date,$end_date);
			}
		$content=$this->load->view('admin/twitter/download_pending',$this->data,TRUE);
		$filename = "Twitter Rejected ".$start_date." ".$end_date.".xls";
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