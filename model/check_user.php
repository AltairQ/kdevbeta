<?php

function checkUser($db, $username) 
{
	if(!$username||!$db) return null;
	
	$query="SELECT * FROM users WHERE user=:username;";
	try
	{
		$cursor =  $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$cursor -> execute(array(':username'=>$username));
		if ($cursor->rowCount() == 0) {
			return false;
		}
		return true;
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