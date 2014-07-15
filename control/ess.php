<?php

session_start();

function redirect($url='')
{
	header("Location: ".$_SERVER['HTTP_HOST']."/".$url);
}




?>