<?php

function deleteListFromRep($db, $listid, $userid)
{
	$delete_query = "DELETE FROM `r$userid` WHERE `list_id` = $listid";
	try
	{
		$statement = $db->query($delete_query);
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