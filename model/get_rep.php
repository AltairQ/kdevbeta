<?php

function getRep($db, $user, $lid, $id);
{
	$list_query = "SELECT * FROM `r$user` WHERE `repnext` < '".date('Y-m-d', strtotime(' +1 day'))."' AND `word_id` = ? AND `list_id` = ? LIMIT 1";
	
	try
	{
		$statement = $db->prepare($list_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement->execute(array($id, $lid ));
		return $statement->fetch(PDO::FETCH_ASSOC);
		
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>