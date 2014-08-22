<?php

function createGroup($db, $name)
{
	$users_query = "INSERT INTO `users` (`name`, `type`) VALUES (:name, 1);";
	try
	{
		$statement = $db->prepare($users_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':name'=>$name));
		if($statement -> rowCount() != 1) return -50;
		$groupid = $db -> lastInsertId('id');
		return $groupid;
	}
	catch(Exception $e)
	{
		echo $e -> getMessage();
		return -100;
	}
}
?>