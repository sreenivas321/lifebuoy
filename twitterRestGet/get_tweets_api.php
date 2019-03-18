<?php

require "autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;	

/*define('CONSUMER_KEY','4a7PGpSaBa1trSFaGxwx5kVKH');
define('CONSUMER_SECRET','i8xMib3n5LPWaJ47wzbFKe0JHVUilS6ZbmG1tdMB7NcN6azqlu');
define("ACCESS_TOKEN", "72046425-xyvUcQ4eLImL73rh9nlprzFy2Wh8zwKwcnnHpuhzA");
define("ACCESS_TOKEN_SECRET", "9dzw3bvajE4PzyiPnNuZKrNyhEbCZxzgOtjWDGld4r3Op");*/

$max_id=$since_id='';
$count=10;
$hashtag="#edwinjelek #edwinganteng";

if(isset($_POST['status'])){
	$status=$_POST['status'];
	//echo 'asdasdas';
	
	if(isset($_POST['max_id']))
	$max_id=$_POST['max_id'];
	if(isset($_POST['since_id']))
	$since_id=$_POST['since_id'];
	if(isset($_POST['count']))
	$count=$_POST['count'];
	
	
	if(isset($_POST['access_token_secret']))
	$access_token_secret=$_POST['access_token_secret'];
	if(isset($_POST['access_token']))
	$access_token=$_POST['access_token'];
	if(isset($_POST['consumer_secret']))
	$consumer_secret=$_POST['consumer_secret'];
	if(isset($_POST['consumer_key']))
	$consumer_key=$_POST['consumer_key'];
	
	if(isset($_POST['hashtag']))
	$hashtag=$_POST['hashtag'];
	
	
	
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit();

	$datass=array("q" => $hashtag, "max_id" => $max_id , "since_id" => $since_id, count=> $count);print_r($data);
	
	
	$connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
	$content = $connection->get("account/verify_credentials");
	$tweets = $connection->get("search/tweets", $datass);
	
	
	if($tweets){
		echo json_encode($tweets);
	}
	else 
	echo 'no';

}
?>