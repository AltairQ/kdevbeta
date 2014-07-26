<?php

function printheader($title='KNet')
{
$hdr= file_get_contents("templates/header.cpl");
echo str_replace("{{title}}", $title, $hdr);
}

function printjsend()
{
	echo file_get_contents("templates/jsend.cpl");
}

function printnavbar()
{
	if(!empty($_SESSION['login']))
	{
		echo str_replace("{{login}}", $_SESSION['login'], file_get_contents("templates/navbar_login.cpl")); //zaraz zmienię
	}
	else
	{
		echo file_get_contents("templates/navbar.cpl");
	}
	
}


?>