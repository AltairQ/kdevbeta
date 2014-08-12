<?php

function updateRecalledWords($db, $userid)
{
	$lists_query = "SELECT DISTINCT `list_id` FROM `list2user` WHERE `user_id` IN (SELECT DISTINCT `group_id` FROM user2group WHERE `user_id` = $userid AND `permission`>=1) OR `user_id` = $userid;";
	$delete_lists_query = "DELETE FROM `r$userid` WHERE `list_id` NOT IN ";
	$delete_words_query = "DELETE FROM `r$userid` WHERE `word_id` NOT IN (SELECT `id` FROM `l:list_id`) AND `list_id` = :list_id";
	$insert_words_query = "INSERT INTO `r$userid` (list_id, word_id, ef, repid, replen, repnext) SELECT :list_id, `id`, 1, 1 ,1, '1970-01-01' FROM `l:list_id` WHERE `id` NOT IN (SELECT `word_id` FROM `r$userid`)";
	try
	{
		$statement = $db->query($lists_query);
		$lists = $statement->fetchAll(PDO::FETCH_COLUMN);
		$delete_lists_query = $delete_lists_query."(".implode(", ", $lists).")";
		$statement = $db->query($delete_lists_query);
		foreach($lists as $list)
		{
			$delete_words_query = str_replace(":list_id", $list, $delete_words_query);
			$insert_words_query = str_replace(":list_id", $list, $insert_words_query);
			$statement = $db->query($delete_words_query);
			$statement = $db->query($insert_words_query);
		}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>