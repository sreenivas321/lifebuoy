<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rpt extends CI_Controller {

	public function index()
	{
		if ($_SERVER['REMOTE_ADDR'] != '54.251.251.19'){
		  $this->output->set_status_header(400, 'No Remote Access Allowed');
		  exit; //just for good measure
		}
	
		//uploader KPI
		$kpi_uploader = 5000;
	
		//get uploader count
		$query = $this->db->query("SELECT COUNT(id) as 'count' FROM uploader_tb");
		$uploader_count = $query->row()->count;
		
		$query = $this->db->query("SELECT COUNT(id) as 'count' FROM uploader_rejected_tb");
		$uploader_count = $uploader_count + $query->row()->count;
		
		//uploader posting
		$kpi_posting = 15000;
		
		//get posting count
		$query = $this->db->query("SELECT COUNT(id) as 'count' FROM posting_tb");
		$posting_count = $query->row()->count;
		
		$query = $this->db->query("SELECT COUNT(id) as 'count' FROM temp_twitter_tb WHERE rejected = 1");
		$posting_count = $posting_count + $query->row()->count;
		
		$query = $this->db->query("SELECT COUNT(id) as 'count' FROM temp_uploads_tb WHERE rejected = 1");
		$posting_count = $posting_count + $query->row()->count;
	
		//current date
		$date = date("Y-m-d H:i:s");
		
		//generate JSON
		$data = array(
			"data" => array(
						array(
							"name" => "Registran",
							"kpi" => $kpi_uploader,
							"current" => $uploader_count
						),
						array(
							"name" => "Submission",
							"kpi" => $kpi_posting,
							"current" => $posting_count
						)
					),
			"date" => $date 
		);
		
		//LUNCURKAN!
		echo json_encode($data);
	}
}
