<?php
//-100 - błąd techniczny, 0 - "nie może", 1 - może wyświetlać, 2 - może edytować
function checkUserPermission($db, $listid, $userid)
{
	$user_query = "SELECT `permission` FROM `list2user` WHERE `user_id` = :user_id AND `list_id` = :list_id";
	$user2group_view_query = "SELECT `group_id` FROM `user2group` WHERE `user_id`=:user_id AND `permission`=1";
	$user2group_edit_query = "SELECT `group_id` FROM `user2group` WHERE `user_id`=:user_id AND `permission`>1";
	$group_query = "SELECT `permission` FROM `list2user` WHERE `user_id` = :group_id AND `list_id` = :list_id";
	$permission = 0;
	//sprawdź, co siedzi w list2user, jeśli 2 - zwróć, jeśli 1 - popraw permission
	try
	{
		$statement = $db->prepare($user_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':user_id'=>$userid, ':list_id' => $listid));
		$response =  $statement -> fetch(PDO::FETCH_ASSOC);
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	if($response['permission'] == 2) return 2; else $permission = max($permission, $response['permission']);
	//pobierz grupy, w których user może edytować listy, porównaj z używaną listą, jeśli pasuje - zakończ
	try
	{
		$statement = $db->prepare($user2group_edit_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':user_id'=>$userid));
		$groups = $statement -> fetchall(PDO::FETCH_COLUMN);
		foreach($groups as $groupid)
		{
			$statement = $db->prepare($group_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement -> execute(array(':group_id'=>$groupid, ':list_id' => $listid));
			$response =  $statement -> fetch(PDO::FETCH_ASSOC);
			if ($response['permission'] == 2) return 2; else $permission=max($permission, $response['permission']);
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	//jeśli nie jest jasne, czy user może choćby przeglądać listę, pobierz grupy, których członkiem on jest, i sprawdź ich możliwości co do listy
	if($permission == 1) return 1;
	try
	{
		$statement = $db->prepare($user2group_view_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':user_id'=>$userid));
		$groups = $statement -> fetchall(PDO::FETCH_COLUMN);
		foreach($groups as $groupid)
		{
			$statement = $db->prepare($group_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement -> execute(array(':group_id'=>$groupid, ':list_id' => $listid));
			$response =  $statement -> fetch(PDO::FETCH_ASSOC);
			if ($response['permission'] >= 1) return 1;
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	return 0;
}
?>