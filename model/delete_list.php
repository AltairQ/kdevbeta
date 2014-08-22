<?php

function deleteList($db, $listid)
{
	$deletelist2user_query = "DELETE FROM `list2user` WHERE `list_id` = $listid";
	$deletelists_query = "DELETE FROM `lists` WHERE `id` = $listid";
	$deletel_query = "DROP TABLE `l$listid`";
	try
	{
		$statement = $db->query($deletelist2user_query);
		$statement = $db->query($deletel_query);
		$statement = $db->query($deletelists_query);
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