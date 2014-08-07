<?php
//0 - błąd techniczny, 1 - może edytować, -1 - nie może edytować
//permy 0 i 1
function checkUserPermission($db, $listid, $userid)
{
	$user_query = "SELECT `permission` FROM `list2user` WHERE `user_id` = :user_id AND `list_id` = :list_id";
	$user2group_query = "SELECT `group_id` FROM `user2group` WHERE `user_id`=:user_id AND `permission`=1";
	$group_query = "SELECT `permission` FROM `list2user` WHERE `user_id` = :group_id AND `list_id` = :list_id";
	try
	{
		$statement = $db->prepare($user_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':user_id'=>$userid, ':list_id' => $listid));
		$response =  $statement -> fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return 0;
	}
	if($response['permission'] == 1) return 1;
	try
	{
		$statement = $db->prepare($user2group_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':user_id'=>$userid));
		$groups = $statement -> fetchall(PDO::FETCH_COLUMN);
		foreach($groups as $groupid)
		{
			$statement = $db->prepare($group_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement -> execute(array(':group_id'=>$groupid, ':list_id' => $listid));
			$response =  $statement -> fetch(PDO::FETCH_ASSOC);
			if ($response['permission'] == 1) return 1;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return 0;
	}
	return -1;
}
?>