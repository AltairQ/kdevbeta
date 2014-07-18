<?php
require_once("model/get_user_hash.php");
require_once("control/crypt.php");
function checkPassword($db, $username, $pass)
{
	if(!($db&&$username&&$pass)) die("Null data");
	$hash = getUserHash($db, $username);
	if(!$hash) return false;
	return check_hash($pass, $hash);
}
?>