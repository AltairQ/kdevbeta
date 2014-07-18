<?php

session_start();

function redirect($where='')
{
	header("Location: http://".$_SERVER['HTTP_HOST']."/".$where);
}




?>