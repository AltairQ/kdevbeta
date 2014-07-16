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
	$navbar = file_get_contents("templates/navbar.cpl");
	echo $navbar;
}



?>