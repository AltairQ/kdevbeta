<?php

// -100 = błąd wywołania
// -50 = nie ma usera
// >=0 = id usera

function getUserId($db, $username) 
{
	if(!$username||!$db) return -100;
	
	$query="SELECT id FROM users WHERE user=:username;";
	try
	{
		$cursor =  $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$cursor -> execute(array(':username'=>$username));

		if ($cursor->rowCount() != 1) {
			return -50;
		}
		return $cursor->fetch(PDO::FETCH_ASSOC)['id'];;
	}
	catch(PDOException $e)
	{
		die("Database error");
	}
	catch(Exception $e)
	{
		die("Unable to get hash");
	}
}


function getUserIdByCred($db, $username, $pass)
{
	if(!$username||!$db) return -100;
	
	$query="SELECT id FROM users WHERE username=:username AND hash=:hash;";
	try
	{
		$cursor =  $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$cursor -> execute(array(':username'=>$username, ':hash'=> crypt($pass, getUserHash($db, $username))));

		if ($cursor->rowCount() != 1) {
			return -50;
		}
		return $cursor->fetch(PDO::FETCH_ASSOC)['id'];;
	}
	catch(PDOException $e)
	{
		die("Database error");
	}
	catch(Exception $e)
	{
		die("Unable to get hash");
	}
	
}


?>