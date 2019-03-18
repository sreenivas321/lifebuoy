<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('time_elapsed_string'))
{
function time_elapsed_string($ptime)
{
	
    $etime = time() - $ptime;

    if ($etime < 1)
    {
        return 'Just now';
    }

    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
}

if ( ! function_exists('time_elapsed_string2'))
{
function time_elapsed_string2($ptime)
{
	
    $etime =  $ptime - strtotime(date("Y-m-d"));

   /* if ($etime < 1)
    {
        return 'Just now';
    }*/

    $a = array( 365 * 24 * 60 * 60  =>  'tahun',
                 30 * 24 * 60 * 60  =>  'bulan',
                      24 * 60 * 60  =>  'hari'
                );
    $a_plural = array( 'tahun'   => 'tahun',
                       'bulan'  => 'bulan',
                       'hari'    => 'hari'
                );
				
    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' lagi';
        }
    }
}
}

if ( ! function_exists('pre'))
{
	function pre($var)
	{
		echo "<pre>";
		print_r($var);
		echo "</pre>";
	}	
}



if ( ! function_exists('get_profile_link'))
{
	function get_profile_link($username,$postvia,$uploaderid) {
		$link='';
		if($postvia==0){
			$link='<a href="https://twitter.com/'.$username.'" target="_blank">View Profile</a>';
		}else if($postvia==1){
			$link='<a href="https://instagram.com/'.$username.'" target="_blank">View Profile</a>';
		}else if($postvia==2){
			
			

			$q="select * from user_tb where id='".esc($uploaderid)."'";
			$user_data=mysql_fetch_assoc(mysql_query($q));
			//	pre($user_data);
			//pre($uploader_data);
			//pre( json_decode($uploader_data['uploader_data'],true));

			if($user_data['fb_id']!=''){
				$link='Email: '.$user_data['email'];
				$fblink='https://facebook.com/'.$user_data['fb_id'];
				$link.='<br><a href="'.$fblink.'" target="_blank">View Profile</a>';

			}
			else if($user_data['tw_id']!=''){
			
				$tw_data=json_decode($user_data['tw_data'],TRUE);
				$twlink='https://twitter.com/'.$tw_data['screen_name'];
				$link='<a href="'.$twlink.'" target="_blank">View Profile</a>';
			}
		}
		
		return $link;
	}
}


if ( ! function_exists('curr_url'))
{
	function curr_url() {
		$pageURL = 'http';
		if (isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

if ( ! function_exists('make_alias'))
{
	function make_alias($string)
	{
		$string=strtolower($string);
		
		$string=str_replace('&','n',$string);
		
		$string=preg_replace('/[^a-z0-9]/', "_", $string);
		
		$string=ltrim(rtrim($string,'_'),'_');
		
		return $string;
	}	
}
if ( ! function_exists('esc')) //alias: mysql_real_escape_string()
{
	function esc($string)
	{
		$result=mysql_real_escape_string(trim($string));
		return $result;
	}	
}

if ( ! function_exists('get_last_tweet_id'))
{
	function get_last_tweet_id()
	{
		//echo "select `".$coloumn."` from `".$table."` where id='".$id."'";
		$q="select * from last_tweet_tb";
		$result=mysql_fetch_assoc(mysql_query($q));//pre($result);
		return $result;
	}	
}

if ( ! function_exists('find'))
{
	function find($coloumn,$id,$table)
	{
		//echo "select `".$coloumn."` from `".$table."` where id='".$id."'";
		$q="select `".esc($coloumn)."` from `".esc($table)."` where id='".esc($id)."'";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result[$coloumn];
	}	
}

if ( ! function_exists('find_2'))
{
	function find_2($coloumn,$data,$data_2,$table)
	{
 		$q="select ".esc($coloumn)." from ".esc($table)." where ".esc($data)."= '".esc($data_2)."'";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result[$coloumn];
	}	
}


if ( ! function_exists('get_id_data'))
{
	function get_id_data($id)
	{
		$result=mysql_fetch_assoc(mysql_query("select * from user_tb where id='".esc($id)."'"));
		return $result;
	}	
}


if ( ! function_exists('get_prev_precedence'))
{
	function get_prev_precedence($id,$table)
	{
		$precedence=find('precedence',$id,$table);
		$q="select id, precedence from `".esc($table)."` where precedence < ".$precedence." order by precedence desc limit 1";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result['precedence'];
	}	
}

if ( ! function_exists('get_next_precedence'))
{
	function get_next_precedence($id,$table)
	{
		$precedence=find('precedence',$id,$table);
		$q="select id, precedence from `".esc($table)."` where precedence > ".$precedence." order by precedence asc limit 1";
		$result=mysql_fetch_assoc(mysql_query($q));
		return $result['precedence'];
	}	
}

if ( ! function_exists('first_precedence'))
{
	function first_precedence($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' order by precedence asc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('last_precedence'))
{
	function last_precedence($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('last_precedence_2'))
{
	function last_precedence_2($table,$data_1,$data_2)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$data_1.' = '.$data_2.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('first_precedence_2'))
{
	function first_precedence_2($table,$data_1,$data_2)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$data_1.' = '.$data_2.' order by precedence asc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('last_precedence_3'))
{
	function last_precedence_3($table,$data_1,$data_2,$data_3,$data_4)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$data_1.' = '.$data_2.' and '.$data_3.' = '.$data_4.' order by precedence desc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('first_precedence_3'))
{
	function first_precedence_3($table,$data_1,$data_2,$data_3,$data_4)
	{
		$result=mysql_fetch_assoc(mysql_query('select precedence from '.$table.' where '.$data_1.' = '.$data_2.' and '.$data_3.' = '.$data_4.'  order by precedence asc'));
		return $result['precedence'];
	}	
}

if ( ! function_exists('get_alias_id'))
{
	function get_alias_id($table,$alias)
	{
		$q="select id from `".esc($table)."` where `alias`='".strtolower(esc($alias))."'";
		$result=mysql_fetch_assoc(mysql_query($q));
		
		return $result['id'];
	}	
}

if ( ! function_exists('getSizeImage'))
{	function getSizeImage ($image)
    {
        $imgData = getimagesize($image);
        $retval['width'] = $imgData[0];
        $retval['height'] = $imgData[1];
        $retval['mime'] = $imgData['mime'];
        return $retval;
    }
}

if ( ! function_exists('display_date2'))
{
	function display_date2($date)
	{
		if($date!="0000-00-00")
		{
		$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$date_format=date("j F Y",mktime(0,0,0,$m,$d,$y));
		}
		else
		{
		$date_format="-";
		}	
		return $date_format;
	}
}


if ( ! function_exists('display_date_full'))
{
	function display_date_full($date)
	{
		if($date!="0000-00-00" or $date!="0000-00-00 00:00:00")
		{
		/*$y=substr($date,0,4);
		$m=substr($date,5,2);
		$d=substr($date,8,2);
		$date_format=date("j F Y",mktime(0,0,0,$m,$d,$y));*/
			$date_format=date("j F Y H:i",strtotime($date));
		}
		else
		{
		$date_format="-";
		}	
		return $date_format;
	}
}

if ( ! function_exists('last_precedence_flexible'))
{
	function last_precedence_flexible($precedence,$table,$data_1,$data_2)
	{
		$result=mysql_fetch_assoc(mysql_query('select '.$precedence.' from '.$table.' where '.$data_1.' = '.$data_2.' order by '.$precedence.' desc'));
		return $result[$precedence];
	}	
}

if ( ! function_exists('last_product_id'))
{
	function last_product_id($table)
	{
		$result=mysql_fetch_assoc(mysql_query('select id from '.$table.' order by id desc'));
		return $result['id'];
	}	
}



if ( ! function_exists('digits'))
{
	function digits($input)
	{
		return number_format($input, '0', ',', '.');
		
	}

}
