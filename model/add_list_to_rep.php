<?php

function addListToRep($db, $listid, $userid)
{
	$insert_query = "INSERT INTO `r$userid` (list_id, word_id, ef, repid, replen, repnext) SELECT $listid, `id`, 1, 1 ,1, '1970-01-01' FROM `l$listid` WHERE `id` NOT IN (SELECT `word_id` FROM `r$userid` WHERE `list_id`=$listid)";
	$insert_zero_query = "INSERT INTO `r$userid` (list_id, word_id, ef, repid, replen, repnext) VALUES ($listid, 0, 1, 1, 1, '1970-01-01')";
	try
	{
		$statement = $db->query($insert_zero_query);
		if($statement->rowCount() != 1) return -50;
		$statement = $db->query($insert_query);
		return true;
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>