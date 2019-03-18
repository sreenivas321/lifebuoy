<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('general_model');
		$this->load->model('user_model');
		$this->load->model('posting_model');
		$this->load->model('category_model');
		
		if(strtotime(date("Y-m-d"))>strtotime("2015-07-31"))redirect('home');
	}
	
	
	
	function index(){
		if(!$this->session->userdata('user_logged_in')){
			$this->session->set_flashdata('notif',"please login first");
			redirect('home');
		}
		$this->data['curr_page']='upload';
		$this->load->model('fun_fact_model');
		$this->data['fun_fact']=$this->fun_fact_model->get_random_fun_fact();
		$this->data['current']=$this->category_model->get_current_category();
		$this->data['next']=$this->category_model->get_next_category($this->data['current']['precedence']);
		$this->data['content']='upload';
		$this->load->view('common/body',$this->data);
	}
	
	function do_upload(){
		if($this->session->userdata('user_logged_in')){
			$image='';	
			$config['upload_path'] = 'userdata/uploads/';
			$config['allowed_types'] = 'jpg|jpeg|png';
			$config['encrypt_name'] = TRUE;		
			$this->load->library('upload', $config);
			if($this->upload->do_upload('upload'))
			{				
				$data = $this->upload->data();
				
				$sess=array('image_url'=>'','type'=>'');
				$this->session->set_userdata($sess);

				$image=$data['file_name'];
				$sess=array('image_url'=>base_url().'userdata/uploads/'.$image,'type'=>2);
				$this->session->set_userdata($sess);
				
				
				$id=0;
				$user_id=$this->session->userdata('user_id');
				$detail=$this->user_model->get_user_detail($user_id);
				$username='';
				$fullname=$detail['name'];
				
				
				$category_detail=$this->category_model->get_current_category();
				if($category_detail)$cat_id=$category_detail['id'];
				else $cat_id=0;
				
				$insert=array('image'=>base_url().'userdata/uploads/'.$image,'created_date'=>date("Y-m-d H:i:s"),'created_by'=>$user_id,'username'=>$username,'fullname'=>$fullname,'type'=>2,'category_id'=>$cat_id);
				$this->general_model->insert_data('temp_uploads_tb',$insert);
				$id=mysql_insert_id();
				
				$fblink="https://www.facebook.com/dialog/feed?app_id=".APP_ID."&link=".urlencode('http://nyamanberhijab.lifebuoy.co.id/')."&picture=".urlencode($insert['image'])."&name=".urlencode("Lifebuoy Nyaman Berhijab Terlindungi")."&description=".urlencode("Ayo, upload foto Moms bersama Si Kecil & menangkan voucher belanja Zoya senilai Rp. 1.000.000 #NyamanBerhijab")."&redirect_uri=".urlencode(site_url('closefb'));
				$twlink=urlencode("Ayo, upload foto Moms bersama Si Kecil & menangkan voucher belanja di nyamanberhijab.lifebuoy.co.id #NyamanBerhijab");
			 
				echo json_encode(array('image'=>base_url().'userdata/uploads/'.$image,'status'=>1,'imid'=>$id,'fblink'=>$fblink,'twlink'=>$twlink));	
				
				
			}
			else{
				echo json_encode(array('image'=>'','status'=>0,'imid'=>0,'fblink'=>'','twlink'=>''));
			}
		}
		else{
			echo json_encode(array('image'=>'','status'=>0,'imid'=>0,'fblink'=>'','twlink'=>''));
		}
	}
	
	function save_description(){
		
		if($this->session->userdata('user_logged_in')){
			$description=$this->input->post('description');
			$imid=$this->input->post('imid');
			$cat_id=$this->input->post('cat_id');
			
			
			if($imid>0){
				$where=array('id'=>$imid);
				$update=array('description'=>$description);
				$this->general_model->update_data('temp_uploads_tb',$update,$where);
				echo json_encode(array('status'=>1));
				
			}
			else
				echo json_encode(array('status'=>0));
		}
		else{
			
		echo json_encode(array('status'=>2));
		}
	}
}