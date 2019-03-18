<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

//facebook
define('APP_ID','876838822375660');
define('APP_SECRET','16944e5984410e5eda551f8712dff40f');

//twitter
define('CONSUMER_KEY','4a7PGpSaBa1trSFaGxwx5kVKH');
define('CONSUMER_SECRET','i8xMib3n5LPWaJ47wzbFKe0JHVUilS6ZbmG1tdMB7NcN6azqlu');
define("ACCESS_TOKEN", "72046425-xyvUcQ4eLImL73rh9nlprzFy2Wh8zwKwcnnHpuhzA");
define("ACCESS_TOKEN_SECRET", "9dzw3bvajE4PzyiPnNuZKrNyhEbCZxzgOtjWDGld4r3Op");
/* End of file constants.php */
/* Location: ./application/config/constants.php */