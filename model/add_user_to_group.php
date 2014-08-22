<?php

function addUserToGroup($db, $userid, $groupid, $permission)
{
	$user2group_query = "INSERT INTO `user2group` (`user_id`, `group_id`, `permission`) VALUES ($userid, $groupid, $permission)";
	try
	{
		$statement = $db->query($user2group_query);
		if($statement -> rowCount() == 0) return -50;
		return true;
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>