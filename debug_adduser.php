<?php
require_once 'util/inc_all.php';

if (isset($_GET["login"]) && isset($_GET['password'])) {
	addUser($DB, $_GET["login"], $_GET["password"]);
}


?>