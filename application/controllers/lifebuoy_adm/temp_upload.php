<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Temp_upload extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('temp_upload_model','tum');
		$this->load->model('category_model');
		$this->load->model('general_model');
		$this->load->model('uploader_model');
		$this->table_name='temp_uploads_tb';
		$this->per_page=50;
	}
	
	function index($hashtag='',$search='all',$offset=0){
		///type 1 = selfieunlimited, 2 xlove
		$this->load->library('pagination');
		$this->data['hashtag']=$hashtag;
		$config['base_url'] = site_url('lifebuoy_adm/temp_upload/index').'/'.$hashtag.'/'.$search;
		
		
		$new_hashtag='#'.$hashtag;
		$hashtag_detail=$this->category_model->get_hashtag_detail($new_hashtag);
		
		
		$config['total_rows'] = $this->tum->get_total_temp_upload_by_status($hashtag_detail['id'],0,$search);
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

		$type=0;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['temp_upload']=$this->tum->get_temp_upload_by_status($hashtag_detail['id'],0,$offset,$this->per_page,$search);
		
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/temp/list';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function search_pending(){
		$search=urlencode($this->input->post('search'));
		$hashtag=urlencode($this->input->post('hashtag'));
		redirect('lifebuoy_adm/temp_upload/index/'.$hashtag.'/'.$search);
	}
	
	function rejected($offset=0){
		$search="all";
		$this->load->library('pagination');
		
		$config['base_url'] = site_url('lifebuoy_adm/temp_upload/rejected').'/';
		$config['total_rows'] = $this->tum->get_total_temp_upload_by_status2(1,$search);
		$config['per_page'] = $this->per_page; 
		
		$config['uri_segment'] = 4;
		$config['display_pages'] = TRUE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Next &gt";
		$config['prev_link']="&lt; Prev";
		$config['first_link']="&laquo; First";
		$config['last_link']="Last &raquo";
		//$config['first_link']=FALSE;
		//$config['last_link']=FALSE;
		
		$this->pagination->initialize($config); 

		$this->data['pagination']=$this->pagination->create_links();

		$type=0;//0 photo, 1 user
		$this->data['category']=$this->category_model->get_category_list_by_type($type);
		$this->data['temp_upload']=$this->tum->get_temp_upload_by_status2(1,$offset,$this->per_page,$search);
		
		$this->data['offset']=$offset;
		$this->data['total_item']=$config['total_rows'];
		$this->data['content']='admin/temp/rejected';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function batch_update(){
		$id=$this->input->post('ids');
		$data=array();
		if($id)foreach($id as $list){
			$detail=$this->tum->get_temp_detail($list);
			
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
			
			
			$detail=$this->tum->get_temp_detail($list);
			//pre($detail);
			$check_uploader=$this->uploader_model->check_uploader_id_fb_rejected($detail['created_by']);
			if($check_uploader){
				$uploader_id=$check_uploader['id'];
				$this->general_model->update_data('uploader_rejected_tb',array('upload_count'=>$check_uploader['upload_count']+1),array('id'=>$check_uploader['id']));
			}
			else{
				
//				(`uploader_user_id`,`upload_from`,`created_date`,`username`,`fullname`,`uploader_data`,`upload_count`) values 
	//		('".mysql_escape_string($uploader['id'])."','0','".date("Y-m-d")."','".mysql_escape_string($username)."','".mysql_escape_string($fullname)."','".$uploader_data."',1)";
				
				$set=array('uploader_user_id'=>$detail['created_by'],'upload_from'=>2,'created_date'=>date("Y-m-d"),
				'username'=>'','fullname'=>$detail['fullname'],'upload_count'=>1,'uploader_data'=>'');
				
				$this->general_model->insert_data('uploader_rejected_tb',$set);
			}
		}
		
		$hashtag=$this->input->post('hashtag');	
		redirect('lifebuoy_adm/temp_upload/index/'.$hashtag);
	}	
	
	function batch_approve(){
		$id=$this->input->post('id');

		$data=array();
		if($id)foreach($id as $list){
			$detail=$this->tum->get_temp_detail($list);
			
			//pre($uploaded_data);
			
			$category_id=$this->input->post('category_id'.$list);
			$image_link=$this->input->post('image_link'.$list);
			
			$post_via=2;//0 temp_upload, 1 instagram, 2 manual upload
			
			
			$check_uploader=$this->uploader_model->check_uploader_id_fb($detail['created_by']);
			if($check_uploader){
				$uploader_id=$check_uploader['id'];
				$this->general_model->update_data('uploader_tb',array('upload_count'=>$check_uploader['upload_count']+1),array('id'=>$check_uploader['id']));
			}
			else{
				
//				(`uploader_user_id`,`upload_from`,`created_date`,`username`,`fullname`,`uploader_data`,`upload_count`) values 
	//		('".mysql_escape_string($uploader['id'])."','0','".date("Y-m-d")."','".mysql_escape_string($username)."','".mysql_escape_string($fullname)."','".$uploader_data."',1)";
				
				$set=array('uploader_user_id'=>$detail['created_by'],'upload_from'=>2,'created_date'=>date("Y-m-d"),
				'username'=>'','fullname'=>$detail['fullname'],'upload_count'=>1,'uploader_data'=>'');
				
				$this->general_model->insert_data('uploader_tb',$set);
			}
			
			$data[]=array(
				'description'=>$detail['description'],
				'image'=>$image_link,
				'active'=>1,
				'category_id'=>$category_id,'uploader_id'=>$detail['created_by'],
				'username'=>'','fullname'=>$detail['fullname'],
				'post_via'=>$post_via,'image'=>$detail['image'],'created_date'=>date("Y-m-d H:i:s"),
				'created_by'=>$this->session->userdata("admin_id"),'post_date'=>$detail['created_date']
			);
		//	exit();
		}
		//pre($data);
		//exit;
		$table_name='posting_tb';
		
		if($data)
			$this->general_model->insert_data_batch($table_name,$data);
			
		
		if($id)foreach($id as $list){
			$where=array('id'=>$list);
			$this->general_model->delete_data($this->table_name,$where);
		}
		
		$hashtag=$this->input->post('hashtag');	
		redirect('lifebuoy_adm/temp_upload/index/'.$hashtag);
	}
	
	function do_approve($id=0){
		if($id!=0){
			$detail=$this->tum->get_temp_detail($id);
			$post_via=2;//$detail['type'];//0 temp_upload, 1 instagram, 2 web upload, 3 fb
			$data=array(
				'description'=>$detail['description'],
				'data'=>$detail['data'],
				'category_id'=>$category_id,
				'active'=>1,
				'username'=>$detail['username'],'fullname'=>$detail['fullname'],
				'post_via'=>$post_via,'image'=>$detail['image'],'created_date'=>date("Y-m-d H:i:s"),'post_date'=>$detail['created_date']
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
		$this->data['temp_upload']='';
		$this->data['start_date']=$start_date=$this->input->post('start_date');
		$this->data['end_date']=$end_date=$this->input->post('end_date');
		
		if($status==1){
				if($start_date=='' && $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_upload_posting(0);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_start_date(0,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['temp_upload']=$this->tum->get_all_end_date(0,$end_date);
				}else{
				$this->data['temp_upload']=$this->tum->get_all_by_date(0,$start_date,$end_date);
				}
			}
		$this->data['content']='admin/temp/filter_pending';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function download_pending_form($start_date='',$end_date=''){

			if($start_date=='' && $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_upload_posting(0);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_start_date(0,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['temp_upload']=$this->tum->get_all_end_date(0,$end_date);
				}else{
				$this->data['temp_upload']=$this->tum->get_all_by_date(0,$start_date,$end_date);
			}
		$content=$this->load->view('admin/temp/download_pending',$this->data,TRUE);
		$filename = "temp_upload Pending".$start_date." ".$end_date.".xls";
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
		$this->data['temp_upload']='';
		$this->data['start_date']=$start_date=$this->input->post('start_date');
		$this->data['end_date']=$end_date=$this->input->post('end_date');
		
		if($status==1){
				if($start_date=='' && $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_upload_posting(1);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_start_date(1,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['temp_upload']=$this->tum->get_all_end_date(1,$end_date);
				}else{
				$this->data['temp_upload']=$this->tum->get_all_by_date(1,$start_date,$end_date);
				}
			}
		$this->data['content']='admin/temp/filter_rejected';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function download_rejected_form($start_date='',$end_date=''){

			if($start_date=='' && $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_upload_posting(1);
				}elseif($start_date!=''&& $end_date==''){
				$this->data['temp_upload']=$this->tum->get_all_start_date(1,$start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['temp_upload']=$this->tum->get_all_end_date(1,$end_date);
				}else{
				$this->data['temp_upload']=$this->tum->get_all_by_date(1,$start_date,$end_date);
			}
		$content=$this->load->view('admin/temp/download_pending',$this->data,TRUE);
		$filename = "temp_upload Rejected ".$start_date." ".$end_date.".xls";
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
	
	
	function get_uploader_id(){
		$data=$this->tum->get_all();
		
		
		if($data)foreach($data as $list){
			echo $id=find_2('id','name',$list['fullname'],'user_tb');
			
			$id_data=get_id_data($id);	
			
			$set=array('uploader_id'=>$id);
			$table=$this->table_name;
			$where=array('id'=>$id);
			$this->general_model->update_data($table, $set, $where);
			
		}
	}
    
    function registrant(){
        
        $this->load->model('user_model');
        
        $this->data['category']= $category = $this->category_model->get_category_list();
        $this->data['user']= $user = $this->user_model->user_list();
        $this->data['uploader']= $uploader = $this->uploader_model->get_uploader_type2();
        
        
        if($category)foreach($category as $row){
            $this->data['list_user_fb_'.$row['id']]=${"list_user_fb_".$row['id']}=0;
            $this->data['list_user_tw_'.$row['id']]=${"list_user_tw_".$row['id']}=0;
            $this->data['list_uploader_fb_'.$row['id']]=${"list_uploader_fb_".$row['id']}=0;
            $this->data['list_uploader_tw_'.$row['id']]=${"list_uploader_tw_".$row['id']}=0;
        }
        
        if($user)foreach($user as $ulist){
            if($ulist['fb_id'] != ''){
                if($category)foreach($category as $clist){
                    if(($ulist['created_date'] >= $clist['start_date']) && ($ulist['created_date'] <= $clist['end_date'])){
                        ${"list_user_fb_".$clist['id']}++;
                    }
                }
            }else if($ulist['tw_id'] != ''){
                if($category)foreach($category as $clist){
                    if(($ulist['created_date'] >= $clist['start_date']) && ($ulist['created_date'] <= $clist['end_date'])){
                        ${"list_user_tw_".$clist['id']}++;
                    }
                }
            }
        }
        
        if($uploader)foreach($uploader as $uplist){
            if($uplist['fb_id'] != ''){
                if($category)foreach($category as $clist){
                    if(($uplist['created_date'] >= $clist['start_date']) && ($uplist['created_date'] <= $clist['end_date'])){
                        ${"list_uploader_fb_".$clist['id']}++;
                    }
                }
            }else if($uplist['tw_id'] != ''){
                if($category)foreach($category as $clist){
                    if(($uplist['created_date'] >= $clist['start_date']) && ($uplist['created_date'] <= $clist['end_date'])){
                        ${"list_uploader_tw_".$clist['id']}++;
                    }
                }
            }
        }
        
        if($category)foreach($category as $row){
            $this->data['list_user_fb_'.$row['id']]=${"list_user_fb_".$row['id']};
            $this->data['list_user_tw_'.$row['id']]=${"list_user_tw_".$row['id']};
            $this->data['list_uploader_fb_'.$row['id']]=${"list_uploader_fb_".$row['id']};
            $this->data['list_uploader_tw_'.$row['id']]=${"list_uploader_tw_".$row['id']};
        }
        
        $this->data['content']='admin/temp/registrant_list';
		$this->load->view('common/admin/body',$this->data);
    }
}