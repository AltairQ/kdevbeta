<?php

function printheader($title='KNet')
{

if (date("d.m") == "14.11") {
	$title = "Wszystkiego najlepszego!";
}

echo str_replace("{{title}}", $title, file_get_contents("templates/header.cpl"));
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