<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Fun_fact_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_random_fun_fact()
	{
		$q = "select * from fun_fact_tb order by rand() limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function get_fun_fact(){
	
		$q = "select * from fun_fact_tb where precedence > ".esc($precedence)." order by `precedence` asc limit 1";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	//fun_fact
	function get_fun_fact_list()
	{
		$q = "select * from fun_fact_tb order by `precedence` asc";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_fun_fact_list_by_type($type)
	{
		$q = "select * from fun_fact_tb where fun_fact_type='".esc($type)."' order by `id` ASC";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_fun_fact_list_by_typeactiveprece($type)
	{
		$q = "select * from fun_fact_tb where active=1 AND fun_fact_type='".esc($type)."' order by `precedence` DESC";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_fun_fact_photo_betweendate()
	{
		$q = "select * from fun_fact_tb where active=1 AND fun_fact_type=0 and CURDATE() between `start_date` AND `end_date` order by `id` ASC";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
		
	function get_selected_fun_fact_data($id)
	{
		$q = "select * from fun_fact_tb where `id` = '".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function up($id)
	{
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from fun_fact_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from fun_fact_tb where precedence < '.$from['precedence'].' order by precedence desc'));
		
		$sql1 = "update		fun_fact_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		fun_fact_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);
		$this->db->query($sql2);
	}
	
	function down($id)
	{
		$from=mysql_fetch_assoc(mysql_query('select id, precedence from fun_fact_tb where id = '.$id));
		$to=mysql_fetch_assoc(mysql_query('select id, precedence from fun_fact_tb where precedence > '.$from['precedence'].' order by precedence asc'));
		
		$sql1 = "update		fun_fact_tb
				set 		`precedence` = '".esc($to['precedence'])."'
				where 		`id` = '".esc($from['id'])."'";
		$sql2 = "update		fun_fact_tb
				set 		`precedence` = '".esc($from['precedence'])."'
				where 		`id` = '".esc($to['id'])."'";
		
		$this->db->query($sql1);
		$this->db->query($sql2);
	}
	
	
}