<?php
//Pobiera uchwyt i dane, zwraca true (sukces) lub null
function addUser($db, $username, $hash) //ew. inne, dunno na razie, $db -> uchwyt do bazy
{
	if (!($db&&$username&&$hash)) return null;
	try
	{
		$num = $db->exec('INSERT INTO users VALUES("'.$username.'","'.$hash.'");');
		if($num==1)
			return true;
		else
			return null;
	}
	catch (PDOException $e)
	{
		die("Database error");
	}
}
?>