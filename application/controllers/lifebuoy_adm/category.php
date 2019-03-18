<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Category extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
	}
	
	function index(){
		$this->data['content']='admin/category/category_list';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function add(){
		$this->data['content']='admin/category/add_category';
		$this->load->view('common/admin/body',$this->data);
	}
	function do_add(){
		
		$newdate=date("Y-m-d H:i:s");
		$idlogin=$this->session->userdata('admin_id');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$category_type=$this->input->post('category_type');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$status=$this->input->post('status');
		$hashtag=$this->input->post('hashtag');
		$precedence=last_precedence('category_tb')+1;
		
		
		$banner = "";
		
		$this->load->library('image_lib');		
		
		$config['upload_path'] = 'userdata/category/';
		$config['allowed_types'] = 'png|jpg|jpeg';
	 	$config['image_library'] = 'gd2';
		$config['encrypt_name']=TRUE;

		$this->load->library('upload', $config);
			
		if ( $this->upload->do_upload('banner') )
		{	
			$data = $this->upload->data();
			$banner =  $data['file_name'];
			
			/*
			$source = "userdata/category/".$banner ;
			$destination = "userdata/category/";
			$destination2 = "userdata/category/m/";
			$sourceSize = getSizeImage($source);
					
			$sourceRatio = $sourceSize['height']/$sourceSize['width'];
			
			$img['image_library'] = 'GD2';
			$img['maintain_ratio']= FALSE;
			
			//// Making THUMBNAIL ///////
			$img['width']   = '1024';
			$img['height']='647';
			$img['quality']      = '100%';
			$img['source_image'] = $source ;
			$img['new_image']    = $destination;
			$this->image_lib->clear() ;	
			$this->image_lib->initialize($img);
			$this->image_lib->resize();
			*/
			
			
			
		}	
		$banner2='';
		if ( $this->upload->do_upload('banner2') )
		{	
			$data = $this->upload->data();
			$banner2 =  $data['file_name'];
			
			
			/*$source = "userdata/category/".$banner ;
			$destination = "userdata/category/";
			$sourceSize = getSizeImage($source);
					
			$sourceRatio = $sourceSize['height']/$sourceSize['width'];
			
			$img['image_library'] = 'GD2';
			$img['maintain_ratio']= FALSE;
			
			//// Making THUMBNAIL ///////
			$img['width']   = '256';
			$img['height']='647';
			$img['quality']      = '100%';
			$img['source_image'] = $source ;
			$img['new_image']    = $destination;
			$this->image_lib->clear() ;	
			$this->image_lib->initialize($img);
			$this->image_lib->resize();*/
			
		}	
		$banner3='';
		if ( $this->upload->do_upload('banner3') )
		{	
			$data = $this->upload->data();
			$banner3 =  $data['file_name'];
			
			/*$source = "userdata/category/".$banner ;
			$destination = "userdata/category/";
			$sourceSize = getSizeImage($source);
					
			$sourceRatio = $sourceSize['height']/$sourceSize['width'];
			
			$img['image_library'] = 'GD2';
			$img['maintain_ratio']= FALSE;
			
			//// Making THUMBNAIL ///////
			$img['width']   = '1107';
			$img['height']='942';
			$img['quality']      = '100%';
			$img['source_image'] = $source ;
			$img['new_image']    = $destination;
			$this->image_lib->clear() ;	
			$this->image_lib->initialize($img);
			$this->image_lib->resize();*/
			
		}	
		
		
		$config['upload_path'] = 'userdata/category/m/';
		$banner4='';
		if ( $this->upload->do_upload('banner4') )
		{				
			$data2 = $this->upload->data(); 			
			$banner4=$data2['file_name'];
		}
		
		$database = array(	'name'=>$name,
							'category_type'=>$category_type,
							'start_date'=>$start_date,
							'end_date'=>$end_date,
							'active'=>$status,
							'created_date'=>$newdate,
							'created_by'=>$idlogin,
							'updated_date'=>$newdate,
							'updated_by'=>$idlogin,
							'precedence'=>$precedence,
							'description'=>$description,
							'banner'=>$banner,
							'banner2'=>$banner2,
							'banner3'=>$banner3,
							'banner4'=>$banner4,
							'hashtag'=>$hashtag
							);		
		$this->general_model->insert_data('category_tb',$database);
		redirect('lifebuoy_adm/category');
	}
	
	function edit($id){
		$this->data['detail'] = $this->category_model->get_selected_category_data($id);
		$this->data['content']='admin/category/edit_category';
		$this->load->view('common/admin/body',$this->data);
	}
	
	function do_edit($id){
		$newdate=date("Y-m-d H:i:s");
		$idlogin=$this->session->userdata('admin_id');
		$name=$this->input->post('name');
		$description=$this->input->post('description');
		$start_date=$this->input->post('start_date');
		$end_date=$this->input->post('end_date');
		$status=$this->input->post('status');
		$hashtag=$this->input->post('hashtag');
		$category_type=$this->input->post('category_type');
		
		$detail=$this->category_model->get_selected_category_data($id);
		
		
		$this->load->library('image_lib');	
		//main_img
		$config['upload_path'] = 'userdata/category/';
		$config['allowed_types'] = 'jpg|gif|png|jpeg';
		$config['encrypt_name'] = TRUE;	
				
		$banner=$detail['banner'];	
		$this->load->library('upload', $config);
			
		if ( $this->upload->do_upload('banner') )
		{				
			$data2 = $this->upload->data(); 
			if($banner!=""){
				$src="userdata/category/".$banner;
				if(file_exists($src))unlink($src);	
			}				
			
			$banner=$data2['file_name'];
			/*
			$source = "userdata/category/".$banner ;
			$destination = "userdata/category/";
			$destination2 = "userdata/category/m/";
			$sourceSize = getSizeImage($source);
					
			$sourceRatio = $sourceSize['height']/$sourceSize['width'];
			
			$img['image_library'] = 'GD2';
			$img['maintain_ratio']= FALSE;
			
			//// Making THUMBNAIL ///////
			$img['width']   = '1024';
			$img['height']='647';
			$img['quality']      = '100%';
			$img['source_image'] = $source ;
			$img['new_image']    = $destination;
			$this->image_lib->clear() ;	
			$this->image_lib->initialize($img);
			$this->image_lib->resize();*/
			
		}
		
		$banner2=$detail['banner2'];
		if ( $this->upload->do_upload('banner2') )
		{				
			$data2 = $this->upload->data(); 
			if($banner2!=""){
				$src="userdata/category/".$banner2;
				if(file_exists($src))unlink($src);	
			}				
			
			$banner2=$data2['file_name'];
			
			/*$source = "userdata/category/".$banner2 ;
			$destination = "userdata/category/";
			$sourceSize = getSizeImage($source);
					
			$sourceRatio = $sourceSize['height']/$sourceSize['width'];
			
			$img['image_library'] = 'GD2';
			$img['maintain_ratio']= FALSE;
			
			//// Making THUMBNAIL ///////
			$img['width']   = '256';
			$img['height']='647';
			$img['quality']      = '100%';
			$img['source_image'] = $source ;
			$img['new_image']    = $destination;
			$this->image_lib->clear() ;	
			$this->image_lib->initialize($img);
			$this->image_lib->resize();*/
		}
		
		$banner3=$detail['banner3'];
		if ( $this->upload->do_upload('banner3') )
		{				
			$data2 = $this->upload->data(); 
			if($banner3!=""){
				$src="userdata/category/".$banner3;
				if(file_exists($src))unlink($src);	
			}				
			
			$banner3=$data2['file_name'];
			
			/*$source = "userdata/category/".$banner3 ;
			$destination = "userdata/category/";
			$sourceSize = getSizeImage($source);
					
			$sourceRatio = $sourceSize['height']/$sourceSize['width'];
			
			$img['image_library'] = 'GD2';
			$img['maintain_ratio']= FALSE;
			
			//// Making THUMBNAIL ///////
			$img['width']   = '1107';
			$img['height']='647';
			$img['quality']      = '100%';
			$img['source_image'] = $source ;
			$img['new_image']    = $destination;
			$this->image_lib->clear() ;	
			$this->image_lib->initialize($img);
			$this->image_lib->resize();*/
		}
		$banner4=$detail['banner4'];
		if ( $this->upload->do_upload('banner4') )
		{				
			$data2 = $this->upload->data(); 
			if($banner4!=""){
				$src="userdata/category/m/".$banner4;
				if(file_exists($src))unlink($src);	
			}				
			
			$banner4=$data2['file_name'];
		}
		
		$database = array(	'name'=>$name,
							'category_type'=>$category_type,
							'start_date'=>$start_date,
							'end_date'=>$end_date,
							'active'=>$status,
							'updated_date'=>$newdate,
							'updated_by'=>$idlogin,
							'description'=>$description,
							'banner'=>$banner,
							'banner2'=>$banner2,
							'banner3'=>$banner3,
							'banner4'=>$banner4,
							'hashtag'=>$hashtag
							);		
		$where = array('id'=>$id);
		$this->general_model->update_data('category_tb',$database,$where);
		redirect('lifebuoy_adm/category');
	}
	
	function delete($id){
		$where = array ('id'=>$id);
		$this->general_model->delete_data('category_tb',$where);
		redirect($_SERVER['HTTP_REFERER']);
	}
	function active($id,$active){
		if($active==1)$active = 0;
		else $active = 1;
		$database = array(	'active'=>$active);								
		$where = array('id'=>$id);
		$this->general_model->update_data('category_tb',$database,$where);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function up($id){
	
		$this->category_model->up($id);
	
		redirect ($_SERVER['HTTP_REFERER']);
	}
	
	function down($id){
	
		$this->category_model->down($id);
	
		redirect ($_SERVER['HTTP_REFERER']);
	}	
	
	
}