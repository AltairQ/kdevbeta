<?php

function getIP()
{
 if($_SERVER['HTTP_CLIENT_IP'])
 {
  $ip = $_SERVER['HTTP_CLIENT_IP'];
 }
 else if($_SERVER['HTTP_X_FORWARDED_FOR'])
 {
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 }
 else
 {
  $ip = $_SERVER['REMOTE_ADDR'];
 }

 return $ip;
}


function logEvent($event)
{
	file_put_contents("log.txt", "\n[".date("Y-m-d H:i:s:u")."] @ ".getIP()."\t".$event, FILE_APPEND | LOCK_EX);
}

function redirect($where='')
{
	header("Location: http://".$_SERVER['HTTP_HOST']."/".$where);
	exit(0);
}


function redirectNoDie($where='')
{
	header("Location: http://".$_SERVER['HTTP_HOST']."/".$where);
}


function destroySession()
{
	
$_SESSION = array();

if (isset($_COOKIE[session_name()])) { 
   setcookie(session_name(), '', time()-42000, '/'); 
}

session_destroy();
}
?>