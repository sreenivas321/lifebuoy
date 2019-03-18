<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Uploader_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_uploader_rejected_all(){
		$q="select * from uploader_rejected_tb";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
    
    function get_uploader_type2(){
		$q="SELECT uploader_tb.*, user_tb.fb_id, user_tb.tw_id, user_tb.id FROM user_tb JOIN uploader_tb ON user_tb.id = uploader_tb.uploader_user_id";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
    
	function get_uploader_by_list($category_id,$upload_by,$offset,$perpage){
		$s='where id!="" ';
		if($category_id!='a')	
			$s="where category_id='".esc($category_id)."'";
		
		if($category_id!='a' || $upload_by!='a')
			$s.=" and upload_from='".esc($upload_by)."'";
			
		$g='';
		if($upload_by==2)
			$g=" group by uploader_user_id ";
			
		$q="select * from uploader_tb ".$s.$g." order by upload_count desc limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	
	function get_uploader_by_list_rejected($category_id,$upload_by,$offset,$perpage){
		$s='where id!="" ';
		if($category_id!='a')	
			$s="where category_id='".esc($category_id)."'";
		
		if($category_id!='a' || $upload_by!='a')
			$s.=" and upload_from='".esc($upload_by)."'";
			
		$g='';
		if($upload_by==2)
			$g=" group by uploader_user_id ";
			
		$q="select * from uploader_rejected_tb ".$s.$g." order by upload_count desc limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_uploader_by_list_rejected2($category_id,$upload_by,$offset,$perpage){
		$s='where id!="" ';
		if($category_id!='a')	
			$s="where category_id='".esc($category_id)."'";
		
		if($category_id!='a' || $upload_by!='a')
			$s.=" and upload_from='".esc($upload_by)."'";
			
		$g='';
		if($upload_by==2)
			$g=" group by uploader_user_id ";
			
		$q="select * from uploader_rejected2_tb ".$s.$g." order by upload_count desc limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_total_uploader_by_category($category_id,$upload_by){
		$s='where id!="" ';
		if($category_id!='a')	
			$s="where category_id='".esc($category_id)."'";
		
		if($category_id!='a' || $upload_by!='a')
			$s.=" and upload_from='".esc($upload_by)."'";
			
			
		$g='';
		if($upload_by==2){
			$q="select * from uploader_tb ".$s." group by uploader_user_id order by upload_count desc";
				
			$query = $this->db->query($q);
			return $data=$query->num_rows();	
			//return $data['total'];
		}
		else{
			$q="select count(*) as total from uploader_tb ".$s.$g." order by upload_count desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
		}
	}
	
	
	function get_total_uploader_by_category_rejected($category_id,$upload_by){
		$s='where id!="" ';
		if($category_id!='a')	
			$s="where category_id='".esc($category_id)."'";
		
		if($category_id!='a' || $upload_by!='a')
			$s.=" and upload_from='".esc($upload_by)."'";
			
			
		$g='';
		if($upload_by==2){
			$q="select * from uploader_rejected_tb ".$s." group by uploader_user_id order by upload_count desc";
				
			$query = $this->db->query($q);
			return $data=$query->num_rows();	
			//return $data['total'];
		}
		else{
			$q="select count(*) as total from uploader_rejected_tb ".$s.$g." order by upload_count desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
		}
	}
	
	
	function get_total_uploader_by_category_rejected2($category_id,$upload_by){
		$s='where id!="" ';
		if($category_id!='a')	
			$s="where category_id='".esc($category_id)."'";
		
		if($category_id!='a' || $upload_by!='a')
			$s.=" and upload_from='".esc($upload_by)."'";
			
			
		$g='';
		if($upload_by==2){
			$q="select * from uploader_rejected2_tb ".$s." group by uploader_user_id order by upload_count desc";
				
			$query = $this->db->query($q);
			return $data=$query->num_rows();	
			//return $data['total'];
		}
		else{
			$q="select count(*) as total from uploader_rejected2_tb ".$s.$g." order by upload_count desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
		}
	}
	
	function get_uploader_by_category($category_id){
		$s='';
		if($category_id!='a')
			$s="where category_id='".esc($category_id)."'";
			
		$q="select * from uploader_tb ".$s." order by upload_count desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}
	
	function check_uploader_id($uploader_id){
		$q="select * from uploader_tb where `uploader_user_id`='".esc($uploader_id)."' and upload_from=0 limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id_ig($uploader_id){
		$q="select * from uploader_tb where `uploader_user_id`='".esc($uploader_id)."' and upload_from=1 limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id_rejected($uploader_id){
		$q="select * from uploader_rejected_tb where `uploader_user_id`='".esc($uploader_id)."' and upload_from=0 limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id_rejected_ig($uploader_id){
		$q="select * from uploader_rejected_tb where `uploader_user_id`='".esc($uploader_id)."' and upload_from=1 limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id2($uploader_id){
		$q="select * from uploader_tb where `uploader_user_id`='".esc($uploader_id)."' and upload_from=2 limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id3($user_id){
		$q="select * from user_tb where `id`='".esc($user_id)."' limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id_fb($user_id){
		$q="select * from uploader_tb where `uploader_user_id`='".esc($user_id)."' and upload_from=2 order by upload_count desc limit 1 ";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function check_uploader_id_fb_rejected($user_id){
		$q="select * from uploader_rejected_tb where `uploader_user_id`='".esc($user_id)."' and upload_from=2 order by upload_count desc limit 1 ";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_all_uploader(){
		$q="select * from uploader_tb";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_all_start_date($start_date){
		$q="select * from uploader_tb where created_date>='".esc($start_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_all_end_date($end_date){
		$q="select * from uploader_tb where created_date<='".esc($end_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_all_by_date($start_date,$end_date){
		$q="select * from uploader_tb where created_date>='".esc($start_date)." 00:00:00' AND created_date<='".esc($end_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
}