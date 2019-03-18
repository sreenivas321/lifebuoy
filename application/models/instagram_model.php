<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Instagram_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function is_post_exists($id){
	
		$q = "select * from temp_instagram_tb where instagram_post_id='".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	
	function get_total_temp_instagram_by_status($category_id,$rejected,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";
		
		$q = "select count(*) as total from temp_instagram_tb where category_id='".esc($category_id)."' and rejected='".esc($rejected)."' ".$s." order by instagram_post_id desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}	
	
	function get_total_temp_instagram_by_status2($rejected,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";
		
		$q = "select count(*) as total from temp_instagram_tb where rejected='".esc($rejected)."' ".$s." order by instagram_post_id desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}	
	
	
	function get_temp_detail($id){
		$q = "select * from temp_instagram_tb where id='".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_temp_instagram_by_status($category_id,$rejected,$offset,$per_page,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";

		$q = "select * from temp_instagram_tb where category_id='".esc($category_id)."' and rejected='".esc($rejected)."' ".$s." order by instagram_post_id desc limit $offset, $per_page";
		$query = $this->db->query($q);
		return $query->result_array();	
	}	
	
	function get_temp_instagram_by_status2($rejected,$offset,$per_page,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";

		$q = "select * from temp_instagram_tb where rejected='".esc($rejected)."' ".$s." order by instagram_post_id desc limit $offset, $per_page";
		$query = $this->db->query($q);
		return $query->result_array();	
	}	
	
	function get_uploader_rejected_all(){
		$q="select * from rejected_instagram_tb";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_uploader_by_user_name($username){
		$q = "select * from uploader_tb where username='".esc($username)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}	
	
	function get_uploader_rejected_by_user_name($username){
		$q = "select * from uploader_rejected_tb where upload_from = 1 and username='".esc($username)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}	
}