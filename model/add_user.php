<?php
//Pobiera uchwyt i dane, zwraca true (sukces) lub null
function addUser($db, $username, $hash) //ew. inne, dunno na razie, $db -> uchwyt do bazy
{
	if (!($db&&$username&&$hash)) return null;
	$query = "INSERT INTO users VALUES(:username, :hash);";
	try
	{
		$statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':username'=>$username, ':hash' => $hash));
		if($statement->rowCount()==1)
			return true;
		else
			return null;
	}
	catch (PDOException $e)
	{
		die("PDO error");
	}
	catch (Exception $e)
	{
		die("Unable to add user");
	}
}
?>