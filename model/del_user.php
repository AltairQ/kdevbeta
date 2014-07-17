<?php
//Pobiera uchwyt i nazwę użytkownika, zwraca true (sukces) lub null
function delUser($db, $username)
{
	if (!$db||!$username) return null;
	$query = "DELETE FROM users WHERE user=:username;";
	try
	{
		$statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':username'=>$username));
		if($statement -> rowCount() ==1)
			return true;
		else
			return null;
	}
	catch (PDOException $e)
	{
		die("Database error");
	}
	catch (Exception $e)
	{
		die("Unable to delete user");
	}
}
?>