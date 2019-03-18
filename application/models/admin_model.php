<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function login($username, $password) {
		$q="select * from admin_tb where username = '".esc($username)."' and password = '".esc($password)."' AND status=1";
		$query = $this->db->query($q);
		return $query->row_array();
	}
	
	function edit_admin($id,$username,$password,$active){
		$q="update admin_tb set `username`='".esc($username)."',`password`='".esc($password)."',`active`='".esc($active)."' where `id`='".esc($id)."'";
		$this->db->query($q);
	}
		
	function get_all_admin(){
		$q="select * from admin_tb ";
		$query = $this->db->query($q);
		return $query->result_array();
	}
	
	function get_all_admin_active(){
		$q="select * from admin_tb where active=1";
		$query = $this->db->query($q);
		return $query->result_array();
	}
	
	function get_all_admin_inactive(){
		$q="select * from admin_tb where active=0";
		$query = $this->db->query($q);
		return $query->result_array();
	}
	
	function get_admin($id){
		$q="select * from admin_tb where id='".esc($id)."' ";
		$query = $this->db->query($q);
		return $query->row_array();
	}
	
	function delete($id){
		$q="delete from admin_tb where `id`='".esc($id)."'";
		$this->db->query($q);
	}
	
	function active($id,$active){
		$q = "update admin_tb set status = '".esc($active)."' where id = '".esc($id)."'";
		$query = $this->db->query($q);	
	}
	
	function get_administrator_data_list()
	{
		$q = "select * from admin_tb order by `id`";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
		function insert_data($table, $data)
	{
		$this->db->insert($table, $data);
	}
	
	function get_selected_administrator_data_list($id)
	{
		$q = "select * from admin_tb where id = '".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	
	function update_data($table, $data, $where)
	{
		$this->db->update($table, $data, $where);
	}
	
	function get_id_password($password)
	{
		$q = "select * from admin_tb where password='".esc(md5($password))."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	function get_id($id)
	{
		$q = "select * from admin_tb where id='".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();	
	}
	function update_password($id,$newpassword)
	{
		$sql="update admin_tb set `password`='".esc(md5($newpassword))."' where `id`='".esc($id)."'";
		$this->db->query($sql);
	}
}