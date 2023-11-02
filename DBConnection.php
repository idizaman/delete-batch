<?php
if (!defined('APP_KEY')) {
    define('APP_KEY', '91yr17w4lrgu6lzd');
}
require_once dirname(__FILE__)."/BanglalinkCrypt/BanglalinkCrypt.php";
BanglalinkCrypt::setEncryptionKey(APP_KEY);

$server = '172.16.11.209:4306';
$user="ccdmis_app";
$password = 'Zh3lbhxYkIZLObXzuJ/6vg==';
$password = BanglalinkCrypt::decrypt($password);


$database="training_feedback";


$conn=mysql_connect($server,$user,$password) or die( "Unable to connect to $server");
mysql_select_db($database) or die( "Unable to select database");

?>