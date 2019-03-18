<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Category_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_hashtag_detail($hashtag)
	{
		$q = "select * from category_tb where hashtag='".esc($hashtag)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_current_category()
	{
		$q = "select * from category_tb where active=1 and (start_date <= '".date("Y-m-d")."' and end_date >= '".date("Y-m-d")."') order by `precedence` asc limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_next_category($precedence){
	//echo "<br>";
		$q = "select * from category_tb where precedence > ".esc($precedence)." order by `precedence` asc limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	//category
	function get_category_list()
	{
		$q = "select * from category_tb order by `precedence` asc";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_category_list_by_type($type)
	{
		$q = "select * from category_tb where category_type='".esc($type)."' order by `id` ASC";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_category_list_by_typeactiveprece($type)
	{
		$q = "select * from category_tb where active=1 AND category_type='".esc($type)."' order by `precedence` DESC";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_category_photo_betweendate()
	{
		$q = "select * from category_tb where active=1 AND category_type=0 and CURDATE() between `start_date` AND `end_date` order by `id` ASC";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
		
	function get_selected_category_data($id)
	{
		$q = "select * from category_tb where `id` = '".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function up($id)
	{
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from category_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from category_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		$sql1 = "update		category_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		category_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);
		$this->db->query($sql2);
	}
	
	function down($id)
	{
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from category_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from category_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		$sql1 = "update		category_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		category_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);
		$this->db->query($sql2);
	}
	
}