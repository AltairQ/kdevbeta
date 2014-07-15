<?php
function authcheck()
{
	return isset($_SESSION['login']);
}

?>