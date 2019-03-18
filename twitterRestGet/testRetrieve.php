<?php

require "autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;	

define("CONSUMER_KEY", "vsL1wXIsNvZejm3giFgcmu5sG");
define("CONSUMER_SECRET", "sotDmFkKyG2XPsmCShMMv59XOyuR9biYwnpgW7ZAjeC7VfcYbE");
define("ACCESS_TOKEN", "185127584-AHF8eVbIRthFwdQrLBuguMWt2jVq5xIwdQJLCqnE");
define("ACCESS_TOKEN_SECRET", "ul1s4YZaXERniASwhFkNHOczJhh4YSF5GstwRArC0V8Bx");

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$content = $connection->get("account/verify_credentials");
$tweets = $connection->get("search/tweets", array("q" => "#edwinjelek #edwinganteng", "max_id" => '' , "since_id" => '', count=> 100));
echo "<pre>";
print_r($tweets);
echo "</pre>";

?>