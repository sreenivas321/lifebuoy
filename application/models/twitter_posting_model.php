<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Twitter_posting_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function is_exists_tweet_id($id){
	
		$q = "select * from temp_twitter_tb where tweet_id='".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_twitter_rejected_by_username($username){
		$q = "select * from uploader_rejected_tb where upload_from=0 AND username='".esc($username)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}	
	
	function get_temp_twitter_by_status($category_id,$rejected,$offset,$per_page,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";

		$q = "select * from temp_twitter_tb where category_id='".esc($category_id)."' and rejected='".esc($rejected)."' ".$s." order by tweet_id desc limit $offset, $per_page";
		$query = $this->db->query($q);
		return $query->result_array();	
	}	
	
	function get_temp_twitter_by_status2($rejected,$offset,$per_page,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";

		$q = "select * from temp_twitter_tb where rejected='".esc($rejected)."' ".$s." order by tweet_id desc limit $offset, $per_page";
		$query = $this->db->query($q);
		return $query->result_array();	
	}	
	
	function get_twitter_all_reject(){
	 	$q= "select * from temp_twitter_tb where rejected=1";
		$query= $this->db->query($q);
		return $query->result_array();
	}
	
	function get_twitter_all_reject_x($offset,$limit){
	 	$q= "select * from temp_twitter_tb where rejected=1 limit $offset, $limit ";
		$query= $this->db->query($q);
		return $query->result_array();
	}
	
	function get_total_temp_twitter_by_status($category_id,$rejected,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";
		
		$q = "select count(*) as total from temp_twitter_tb where category_id='".esc($category_id)."' and rejected='".esc($rejected)."' ".$s." order by id desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}	
	
	function get_total_temp_twitter_by_status2($rejected,$search){
		if($search!='all' and $search!="")
		$s=" and description like '%".esc(urldecode($search))."%'";
		else
		$s="";
		
		$q = "select count(*) as total from temp_twitter_tb where rejected='".esc($rejected)."' ".$s." order by id desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}	
	
	function get_temp_detail($id){
		$q = "select * from temp_twitter_tb where id='".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_all_temp_total_by_status($rejected){
		$q = "select count(*) as total from temp_twitter_tb where rejected='".esc($rejected)."'";
		$query = $this->db->query($q);
		$data= $query->row_array();
		return $data['total'];	
	}
	
	
	function get_all_twitter_posting($rejected){
		$q="select * from temp_twitter_tb where rejected='".esc($rejected)."' ";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_all_start_date($rejected,$start_date){
		$q="select * from temp_twitter_tb where rejected='".esc($rejected)."' AND created_date>='".esc($start_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_all_end_date($rejected,$end_date){
		$q="select * from temp_twitter_tb where rejected='".esc($rejected)."' AND created_date<='".esc($end_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_all_by_date($rejected,$start_date,$end_date){
		$q="select * from temp_twitter_tb where rejected='".esc($rejected)."' AND created_date>='".esc($start_date)." 00:00:00' AND created_date<='".esc($end_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
}