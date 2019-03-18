<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Posting extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_logged_in')==FALSE)redirect('lifebuoy_adm/login');
		$this->load->model('posting_model');
		$this->load->model('general_model');
		$this->load->model('category_model');
		$this->table_name='posting_tb';
		$this->per_page=20;
		
		
		$this->load->model('category_model');
		$this->data['category']=$this->category_model->get_category_list();
	}
	
	function set_as_winner($id){
		
		$active = find('winner',$id,'posting_tb');
		if($active==1)$active = 0;
		else $active = 1;
		
		$database = array('winner'=>$active);
		$where=array('id'=>$id);		
		$this->general_model->update_data($this->table_name,$database,$where);
		
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function index(){
		$this->load->library('pagination');	
		
		
		$category_id=$this->input->get('category_id');
		if($category_id=='')$category_id='a';
		$keyword=$this->input->get('keyword');
		
		
		$offset=$this->input->get('page');
		if($offset=='')$offset=0;
		
		
		$sorting=$this->input->get('sorting');
		if($sorting=='')$sorting=0;
		
		
		
		$config['base_url'] = site_url('lifebuoy_adm/posting/index')."?category_id=".$category_id."&keyword=".$keyword."&sorting=".$sorting;
		$config['total_rows'] = $this->posting_model->get_active_posting_by_category_pagination_total_search2($category_id,$keyword);
		
		$config['per_page'] = $per_page=$this->per_page; 
		$config['uri_segment'] = 6;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Next &gt";
		$config['prev_link']="&lt; Prev";
		$config['first_link']="&laquo; First";
		$config['last_link']="Last &raquo";
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		
		$this->pagination->initialize($config); 
		$this->data['pagination']=$this->pagination->create_links();

		$this->data['category_id']=$category_id;
		$this->data['sorting']=$sorting;
		$this->data['total_item']=$config['total_rows'];
		$this->data['category']=$this->category_model->get_category_list_by_type($type=0);
		$this->data['posting']=$this->posting_model->get_posting_active_by_category_pagination_search2($category_id,$sorting,$offset,$per_page,$keyword);
		$this->data['content']='admin/posting/list';
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
	
	function active($id){
		$active = find('active',$id,'posting_tb');	
		if($active==1)$active = 0;
		else $active = 1;
		
		$database = array('active'=>$active);
		$where=array('id'=>$id);		
		$this->general_model->update_data($this->table_name,$database,$where);
		
		echo $active;
	}
	
	function csv(){
		$status=$this->input->post('status');
		$this->data['posting']='';
		$this->data['start_date']=$start_date=$this->input->post('start_date');
		$this->data['end_date']=$end_date=$this->input->post('end_date');
		
		if($status==1){
				if($start_date=='' && $end_date==''){
				$this->data['posting']=$this->posting_model->get_all_posting_tb();
				}elseif($start_date!=''&& $end_date==''){
				$this->data['posting']=$this->posting_model->get_all_start_date($start_date);
				}elseif($start_date==''&& $end_date!=''){
				$this->data['posting']=$this->posting_model->get_all_end_date($end_date);
				}else{
				$this->data['posting']=$this->posting_model->get_all_by_date($start_date,$end_date);
				}
			}
		$this->data['content']='admin/posting/filter_posting';
		$this->load->view('common/admin/body',$this->data);		
	}
	
	function download_csv_form($start_date='',$end_date=''){

		if($start_date=='' && $end_date==''){
			$this->data['posting']=$this->posting_model->get_all_posting_tb();
			}elseif($start_date!=''&& $end_date==''){
			$this->data['posting']=$this->posting_model->get_all_start_date($start_date);
			}elseif($start_date==''&& $end_date!=''){
			$this->data['posting']=$this->posting_model->get_all_end_date($end_date);
			}else{
			$this->data['posting']=$this->posting_model->get_all_by_date($start_date,$end_date);
		}
		$content=$this->load->view('admin/posting/download_posting',$this->data,TRUE);
		$filename = "posting ".$start_date." ".$end_date.".xls";
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
	

	
	function inactive(){
		$this->load->library('pagination');	
		
		
		$category_id=$this->input->get('category_id');
		if($category_id=='')$category_id='a';
		$keyword=$this->input->get('keyword');
		
		
		$offset=$this->input->get('page');
		if($offset=='')$offset=0;
		
		
		$sorting=$this->input->get('sorting');
		if($sorting=='')$sorting=0;
		
		
		
		$config['base_url'] = site_url('lifebuoy_adm/posting/index')."?category_id=".$category_id."&keyword=".$keyword."&sorting=".$sorting;
		$config['total_rows'] = $this->posting_model->get_inactive_posting_by_category_pagination_total_search2($category_id,$keyword);
		
		$config['per_page'] = $per_page=$this->per_page; 
		$config['uri_segment'] = 6;
		$config['display_pages'] = FALSE;
		$config['anchor_class']='class="defBtn"';
		$config['next_link']="Next &gt";
		$config['prev_link']="&lt; Prev";
		$config['first_link']="&laquo; First";
		$config['last_link']="Last &raquo";
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		
		$this->pagination->initialize($config); 
		$this->data['pagination']=$this->pagination->create_links();

		$this->data['category_id']=$category_id;
		$this->data['sorting']=$sorting;
		$this->data['total_item']=$config['total_rows'];
		$this->data['category']=$this->category_model->get_category_list_by_type($type=0);
		$this->data['posting']=$this->posting_model->get_posting_inactive_by_category_pagination_search2($category_id,$sorting,$offset,$per_page,$keyword);
		$this->data['content']='admin/posting/list2';
		$this->load->view('common/admin/body',$this->data);
	}
	
    function download_approved($category_id){
        $date = date("d F Y H:i:s");
        
        $category = $this->category_model->get_category_list_by_type($type=0);
        
        $posting=$this->posting_model->get_posting_active_by_category2($category_id);
        
        
		$this->load->library('PHPExcel');
		
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Lifebuoy")
							 ->setLastModifiedBy("Lifebuoy")
							 ->setTitle("Lifebuoy Approve title")
							 ->setSubject("Lifebuoy Approve subject")
							 ->setDescription("Lifebuoy Approve list")
							 ->setKeywords("Lifebuoy Approve keyword")
							 ->setCategory("Lifebuoy Approve category");
		// Add some data
		$a=1;
			
		$word='Approved List ('.$date.')';
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$a, $word);
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$a.':E'.$a);
		$a++;
		
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a, 'No')
					->setCellValue('B'.$a, 'Post Via')
					->setCellValue('C'.$a, 'Category')
					->setCellValue('D'.$a, 'Name(Username)')
					->setCellValue('E'.$a, 'Image')
					->setCellValue('F'.$a, 'Description')
                    ->setCellValue('G'.$a, 'Post Date');
	
		$a++;
		
		$no=1;
		if($posting)foreach($posting as $list){
            
            if($list['post_via']==0)$postvia =  'Twitter';else if($list['post_via']==1)$postvia =  'Instagram'; else if($list['post_via']==2)$postvia =  'Web Upload';
                
            if($category)foreach($category as $list2){
                if($list2['id']==$list['category_id'])$category2 =  $list2['name'];
            }
            
            $name = $list['fullname'].'('.$list['username'].')';
            
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$a, $no)
					->setCellValue('B'.$a, $postvia)
					->setCellValue('C'.$a, $category2)
					->setCellValue('D'.$a, $name)
					->setCellValue('E'.$a, $list['image'])
					->setCellValue('F'.$a, $list['description'])
                    ->setCellValue('G'.$a, display_date_full($list['post_date']))
					;
			$a++;$no++;
		}
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="lifebuoy_approved_list'.$date.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
							 
	}
    
}