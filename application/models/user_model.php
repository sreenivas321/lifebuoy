<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class User_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}		
	
    function user_list(){
		$q="select * from user_tb";
		$query = $this->db->query($q);
		return $query->result_array();
	}
	
	function check_tw_id($twid){
		$q="select * from user_tb where tw_id='".esc($twid)."' ";
		$query = $this->db->query($q);
		return $query->row_array();
	}
	
	function check_fb_id($fbid){
		$q="select * from user_tb where fb_id='".esc($fbid)."' ";
		$query = $this->db->query($q);
		return $query->row_array();
	}
	
	
	function check_registered_email($email){
		$q="select * from user_tb where registered_email='".esc($email)."' ";
		$query = $this->db->query($q);
		return $query->row_array();
	}
		
	function get_user_detail($id){
		$q="select * from user_tb where id='".esc($id)."' ";
		$query = $this->db->query($q);
		return $query->row_array();
	}
}