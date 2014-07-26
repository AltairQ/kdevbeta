<?php


function redirect($where='')
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