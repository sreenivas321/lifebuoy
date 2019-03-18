<?php if(!defined("BASEPATH")) exit("Hack Attempt");
class Posting_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_posting(){
		$q = "select * from posting_tb where active=1 order by winner desc ,`id` DESC limit 0, 10";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_posting_by_cat($category_id){
		if($category_id!='a')
		$s=" where category_id='".esc($category_id)."' ";
		else $s='';
		
		$q = "select * from posting_tb ".$s." order by winner desc, `id` DESC limit 0, 10";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_posting_2($limit,$offset){
		$q = "select * from posting_tb order by winner desc, `id` DESC limit ".esc($offset)." , ".esc($limit)." ";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_posting_2_by_cat($category_id,$limit,$offset){
		if($category_id!='a')
		$s=" and category_id='".esc($category_id)."' ";
		else $s='';
		
		$q = "select * from posting_tb where active=1 ".$s." order by winner desc,`id` DESC limit ".esc($offset)." , ".esc($limit)." ";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_total_posting_by_cat($category_id){
		if($category_id!='a')
		$s=" where category_id='".esc($category_id)."' ";
		else $s='';
		
		$q = "select count(*) as total from posting_tb ".$s." order by id desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}
	
	function get_total_posting(){
		$q = "select count(*) as total from posting_tb order by id desc";
		$query = $this->db->query($q);
		$data=$query->row_array();	
		return $data['total'];
	}	
	
	
	function get_posting_detail($id) {
		$q="select * from posting_tb where id = '".esc($id)."'";
		$query = $this->db->query($q);
		return $query->row_array();
	}
	
	function get_next($id,$category_id){
		if($category_id==1	){
			$sort="order by like_count ASC";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
		elseif ($category_id==4){
			$sort="order by dislike_count ASC";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
		elseif ($category_id=='a'){
			$sort="order by id ASC";
			$category_link="";
		}
		elseif ($category_id==9){
			$sort="order by like_count, id ASC";
			$sort="order by like_count desc, id asc";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
		else{
			$sort="order by id ASC";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
	
			
		$q="select * from posting_tb where active=1 AND id > '".esc($id)."'".$category_link." ".$sort." limit 1";
		
		/*if($category_id==9){
			
			$qs="select * from posting_tb where id = '".esc($id)."'";
			$query=$this->db->query($qs);
			$detail=$query->row_array();
			pre($detail);
			//$q="select * from posting_tb where active=1 AND like_count>= '".esc($detail['like_count'])."' AND id!= '".esc($id)."' AND category_id='".esc($category_id)."' order by like_count DESC limit 1";
			
			
			
			
			$q="SELECT * 
			FROM posting_tb
			WHERE like_count >= '".esc($detail['like_count'])."'
			AND id != '".esc($id)."'
			AND category_id = '".esc($category_id)."'
			ORDER BY like_count DESC limit 1 ";
		}*/
		//echo "next: ".$q;
		$query = $this->db->query($q);
		//echo "<!-- ".$q."-->";	
		return $query->row_array();
	}
	
	function get_prev($id,$category_id){
		
		if($category_id==1){
			$sort="order by like_count desc";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
		elseif ($category_id==4){
			$sort="order by dislike_count desc";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
		elseif ($category_id=='a'){
			$sort="order by id desc";
			$category_link="";
		}
		elseif ($category_id==9){
			$sort="order by like_count , id DESC";
			$sort="order by like_count desc, id asc";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
		else{
			$sort="order by id desc";
			$category_link=" AND category_id='".esc($category_id)."'";
		}
			
		
		$q="select * from posting_tb where active=1 AND  id < '".esc($id)."' ".$category_link." ".$sort." limit 1";
			
			
		/*	
		if($category_id==9){
			
			$qs="select * from posting_tb where id = '".esc($id)."'";
			$query=$this->db->query($qs);
			$detail=$query->row_array();
			
			
			$q="SELECT * 
			FROM posting_tb
			WHERE like_count >= '".esc($detail['like_count'])."'
			AND id != '".esc($id)."'
			AND category_id = '".esc($category_id)."'
			ORDER BY like_count DESC limit 1 ";
		}*/
			//echo "prev: ".$q;
		$query = $this->db->query($q);
		//echo "<!-- ".$q."-->";
		return $query->row_array();
	}
	
	function get_new_posting_max_4(){
		$q = "select * from posting_tb where active =1 order by `id` DESC LIMIT 4";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	function get_posting_winner($offset,$num){
		$q = "select * from posting_tb where `active`=1 and `winner`=1 order by `id` DESC limit ".esc($offset).",".esc($num)."";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_posting_joko_tarub($offset,$num){
		 $q = "select * from posting_tb where `active`=1 and `category_id`=9 order by `like_count` DESC, id ASC limit ".esc($offset).",".esc($num)."";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	function get_all_joko_tarub(){
		 $q = "select * from posting_tb where `active`=1 and `category_id`=9 order by `like_count` DESC, id ASC ";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_posting_joko_max16($offset){
		$q = "select * from posting_tb where `active`=1 and `category_id`=9 order by `id` DESC limit $offset, 8 ";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4(){
		$q = "select * from posting_tb where active =1 AND description LIKE '%#XLove%' order by `id` DESC LIMIT 0,4";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_more($offset,$limit){
		//#jt
		$q = "select * from posting_tb where active =1 AND `category_id`=14 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_more_jt($offset,$limit){
		//#jt
		$q = "select * from posting_tb where active =1 AND `category_id`=13 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_more_mirror($offset,$limit){
		//#mirror
		$q = "select * from posting_tb where active =1 AND `category_id`=8 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_more_groupie($offset,$limit){
		//#groupie
		$q = "select * from posting_tb where active =1 AND `category_id`=11 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_morepps($offset,$limit){
		//#pps
		$q = "select * from posting_tb where active =1 AND `category_id`=7 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_moreduckface($offset,$limit){
		//#duckface
		$q = "select * from posting_tb where active =1 AND `category_id`=10 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_more_($offset,$limit){
		//#xlove
		$q = "select * from posting_tb where active =1 AND `category_id`=5 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	function get_desc_post_max_4_more__($offset,$limit){
		//#xtreme
		$q = "select * from posting_tb where active =1 AND `category_id`=6 order by `id` DESC LIMIT $offset, $limit";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
	
	
	function get_posting_by_category($category_id='',$sorting,$offset,$per_page){
		$s='';
		$limit='limit '.$offset.','.$per_page;
		if($category_id=='')$category_id='a';
		if($category_id!='a')
			$s=" where category_id='".esc($category_id)."'";
		$sort='';
		if($sorting=='' or $sorting==0)
			$sort="order by id desc";
		else if($sorting==1)
			$sort="order by like_count desc";
		else if($sorting==2)
			$sort="order by dislike_count desc";
			
		$q = "select a.*, b.name as category_name from posting_tb a
		left join category_tb b on a.category_id=b.id
		".$s.' '.$sort.' '.$limit;
		$query = $this->db->query($q);
		return $query->result_array();	
	}
		
	function get_posting_by_category_pagination($category_id,$sorting,$offset,$perpage){
		$s='';
		if($category_id=='')$category_id='a';
		
		if($category_id!='a')
			$s=" where category_id='".esc($category_id)."'";
		else if($category_id==1 or $category_id==4)
			$s='';	
			
		$sorting;
		if($sorting=='' or $sorting==0)
			$sort="order by id desc";
		else if($sorting==1)
			$sort="order by like_count desc";
		else if($sorting==2)
			$sort="order by dislike_count desc";
		else 
			$sort="order by id desc";
			
	 	$q = "select a.*, b.name as category_name from posting_tb a
		left join category_tb b on a.category_id=b.id
		".$s.' '.$sort." limit $offset, $perpage";//echo $q;
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_posting_active_by_category_pagination($category_id,$sorting,$offset,$perpage){
		$s='';
		if($category_id=='')$category_id='a';
		
		if($category_id==1 or $category_id==4)
			$s='';	
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
			
				
		$sorting;
		if($sorting=='' or $sorting==0)
			$sort="order by id desc";
		else if($sorting==1)
			$sort="order by like_count desc";
		else if($sorting==2)
			$sort="order by dislike_count desc";
		else 
			$sort="order by id desc";
			
		$q = "select a.*, b.name as category_name from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active =1
		".$s.' '.$sort." limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	
	function get_posting_active_by_category_pagination_search($category_id,$sorting,$offset,$perpage,$keyword){
		$s='';
		if($category_id=='')$category_id='a';
		
		if($category_id==1 or $category_id==4)
			$s='';	
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
			
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";	
		
				
		$sorting;
		if($sorting=='' or $sorting==0)
			$sort="order by id desc";
		else if($sorting==1)
			$sort="order by like_count desc";
		else if($sorting==2)
			$sort="order by dislike_count desc";
		else 
			$sort="order by id desc";
			
		if($category_id==9)
			$sort="order by like_count desc, id asc";
		
		$q = "select a.*, b.name as category_name from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active =1
		".$s.' '.$sort." limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	
	function get_posting_active_by_category_pagination_search2($category_id,$sorting,$offset,$perpage,$keyword){
		$s='';
		if($category_id=='')$category_id='a';
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
			
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";	
		
				
		$sorting;
		if($sorting=='' or $sorting==0)
			$sort="order by id desc";
		else if($sorting==1)
			$sort="order by like_count desc";
		else if($sorting==2)
			$sort="order by dislike_count desc";
		else 
			$sort="order by id desc";
			
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";	
			
		$q = "select a.*, b.name as category_name from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active =1
		".$s.' '.$sort." limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	
	function get_posting_inactive_by_category_pagination_search2($category_id,$sorting,$offset,$perpage,$keyword){
		$s='';
		if($category_id=='')$category_id='a';
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
			
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";	
		
				
		$sorting;
		if($sorting=='' or $sorting==0)
			$sort="order by id desc";
		else if($sorting==1)
			$sort="order by like_count desc";
		else if($sorting==2)
			$sort="order by dislike_count desc";
		else 
			$sort="order by id desc";
			
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";	
			
		$q = "select a.*, b.name as category_name from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active =0
		".$s.' '.$sort." limit $offset, $perpage";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
    
    function get_posting_active_by_category2($category_id){
		$s='';
		if($category_id=='')$category_id='a';
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";	
			
		$q = "select a.*, b.name as category_name from posting_tb a 
        left join category_tb b on a.category_id=b.id where a.active =1
		".$s;
		$query = $this->db->query($q);
		return $query->result_array();	
	}
    
	function get_posting_by_category_pagination_total($category_id=''){
		$s='';
		if($category_id=='')$category_id='a';
		
		if($category_id!='a')
			$s=" where category_id='".esc($category_id)."'";
		else if($category_id==1 or $category_id==4)
			$s='';	
			
		$q = "select count(*) as total from posting_tb a
		left join category_tb b on a.category_id=b.id
		".$s;
		$query = $this->db->query($q);
		$detail= $query->row_array();
		return 	$detail['total'];
	}
	
	function get_active_posting_by_category_pagination_total($category_id=''){
		$s='';
		if($category_id=='')$category_id='a';	
			
		if($category_id==1 or $category_id==4)
			$s='';	
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
			

		$q = "select count(*) as total from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active=1
		".$s;
		$query = $this->db->query($q);
		$detail= $query->row_array();
		return 	$detail['total'];
	}
	
	function get_active_posting_by_category_pagination_total_search($category_id='',$keyword=''){
		$s='';
		if($category_id=='')$category_id='a';	
			
		if($category_id==1 or $category_id==4)
			$s='';	
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
		
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";
			

		$q = "select count(*) as total from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active=1
		".$s;
		$query = $this->db->query($q);
		$detail= $query->row_array();
		return 	$detail['total'];
	}
	
	function get_active_posting_by_category_pagination_total_search2($category_id='',$keyword=''){
		$s='';
		if($category_id=='')$category_id='a';	
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
		
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";
			

		$q = "select count(*) as total from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active=1
		".$s;
		$query = $this->db->query($q);
		$detail= $query->row_array();
		return 	$detail['total'];
	}
	
	function get_inactive_posting_by_category_pagination_total_search2($category_id='',$keyword=''){
		$s='';
		if($category_id=='')$category_id='a';	
		else if($category_id!='a')
			$s=" AND category_id='".esc($category_id)."'";
		
		
		if($keyword!='')
			$s.=" and (fullname like '%".esc($keyword)."%' or  a.description like '%".esc($keyword)."%' or username like '%".esc($keyword)."%') ";
			

		$q = "select count(*) as total from posting_tb a
		left join category_tb b on a.category_id=b.id where a.active=0
		".$s;
		$query = $this->db->query($q);
		$detail= $query->row_array();
		return 	$detail['total'];
	}
	
	function get_liked($id,$user_id){
		$q="select * from post_like_dislike_tb where user_id='".esc($user_id)."' and posting_id='".esc($id)."' limit 1";
		$query = $this->db->query($q);
		return $query->row_array();
	}
	
	function get_all_posting_tb(){
		$q="select * from posting_tb";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_all_start_date($start_date){
		$q="select * from posting_tb where created_date>='".esc($start_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_all_end_date($end_date){
		$q="select * from posting_tb where created_date<='".esc($end_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	function get_all_by_date($start_date,$end_date){
		$q="select * from posting_tb where created_date>='".esc($start_date)." 00:00:00' AND created_date<='".esc($end_date)." 00:00:00'";
		$query = $this->db->query($q);
		return $query->result_array();	
	}
	
	function get_posting_by_types(){
		$q = "select * from posting_tb where post_via=2 or post_via=3 order by `id` DESC";
		$query = $this->db->query($q);
		return $query->result_array();	
	} 
}