<?php
function getUserHash($user=null, $db = null) // jeśli bardzo chcesz wszystko na globalu, to usuń
{
	if(!$user||!$db) return null;
	$hash=null;
	try
	{
		$cursor = $db->query('SELECT hash FROM users WHERE user="'.$user.'"');
		foreach($cursor as $row)
			$hash = $row['hash'];
		$cursor->closeCursor();
	}
	catch(PDOException $e)
	{
		die("Database error:");
	}
	return $hash;
}
?>