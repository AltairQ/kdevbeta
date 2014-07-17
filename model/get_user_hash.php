<?php
//pobiera nazwę użytkownika i uchwyt do bazy, zwraca hash lub null
function getUserHash($db, $username) // jeśli bardzo chcesz wszystko na globalu, to usuń
{
	if(!$username||!$db) return null;
	$hash=null;
	$query="SELECT hash FROM users WHERE user=:username;";
	try
	{
		$cursor =  $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$cursor -> execute(array(':username'=>$username));
		$hash = $cursor->fetch(PDO::FETCH_ASSOC)['hash'];
	}
	catch(PDOException $e)
	{
		die("Database error");
	}
	catch(Exception $e)
	{
		die("Unable to get hash");
	}
	return $hash;
}
?>