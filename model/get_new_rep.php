<?php

function getNewRep($db, $user, $list=null)
{
	$list_query = "SELECT * FROM `r$user` WHERE `repnext` < '".date('Y-m-d', strtotime(' +1 day'))."' AND `word_id` != 0";
	if($list != null) $list_query = $list_query." AND `list_id` = $list";
	$list_query = $list_query." LIMIT 1";
	try
	{
		$statement = $db->query($list_query);
		$lists = $statement->fetch(PDO::FETCH_ASSOC);
		return $lists;
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>