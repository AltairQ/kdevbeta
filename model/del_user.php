<?php
//Pobiera uchwyt i nazwę użytkownika, zwraca true (sukces) lub null
function delUser($db, $user)
{
	if (!$db||!$user) return null;
	try
	{
		$num = $db->exec('DELETE FROM users WHERE user="'.$user.'"');
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