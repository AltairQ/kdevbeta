<?php

function getListsOfUser($db, $userid)
{
	$groups_query = "SELECT `group_id`, `permission` FROM `user2group` WHERE `user_id` = $userid AND `permission` >= 1";
	$lists_in_group_query = "SELECT * FROM `lists` WHERE `id` IN (SELECT `list_id` FROM `list2user` WHERE `user_id` = :group_id)";
	$user_query = "SELECT * FROM `lists` WHERE `id` IN (SELECT `list_id` FROM `list2user` WHERE `user_id` = $userid)";
	$finalarray = null;
	try
	{
		//zerowy index to listy usera
		$finalarray = array();
		$statement = $db->query($user_query);
		array_push($finalarray, array("lists" => array(), "group_id" => 0, "group_permission" => 0));
		while($row = $statement -> fetch(PDO::FETCH_ASSOC))
			array_push($finalarray[0]["lists"], $row);
		//pobieranie gropu i foreach
		$groups = array();
		$statement = $db->query($groups_query);
		while($row = $statement -> fetch(PDO::FETCH_ASSOC))
			array_push($groups, $row);
		foreach($groups as $group)
		{
			$temparray = array("lists" => array(), "group_id" => $group["group_id"], "group_permission" => $group["permission"]);
			$statement = $db->prepare($lists_in_group_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$statement -> execute(array(':group_id'=>$group["group_id"]));
			while($row = $statement -> fetch(PDO::FETCH_ASSOC))
				array_push($temparray["lists"], $row);
			array_push($finalarray, $temparray);
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	return $finalarray;
}
?>