<?php

function changePermissionInGroup($db, $userid, $groupid, $permission)
{
	$update_query = "UPDATE `user2group` SET `permission` = $permission WHERE `user_id` = $userid AND `group_id` = $groupid";
	try
	{
		$statement = $db->query($update_query);
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