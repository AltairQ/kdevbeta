<?php

function updateRep($db, $userid, $assoc)
{
	$update_query = "UPDATE `r$userid` SET `ef` = :ef, `repid` = :repid, `replen` = :replen, `repnext` = :repnext WHERE `list_id` = :list_id AND `word_id` = :word_id;";
	try
	{
		$statement = $db->prepare($update_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':ef' => $assoc['ef'], ':repid'=>$assoc['repid'], ':replen' => $assoc['replen'], ":repnext" => $assoc['repnext'], ":list_id" => $assoc['list_id'], ":word_id" => $assoc['word_id']));
		if($statement -> rowCount() != 1) return -50;
		return true;
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>