<?php
function authcheck()
{
	return !empty($_SESSION['login']);
}

?>