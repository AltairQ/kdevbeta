<?php

function deleteWord($db, $listid, $wordid)
{
	$delete_query = "DELETE FROM `l$listid` WHERE `id` = :word_id";
	$update_query = "UPDATE `lists` SET edit_date = :edit_date WHERE id=:list_id";
	try
	{
		$statement = $db->prepare($delete_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(":word_id" => $wordid));
		if($statement -> rowCount() != 1) return -50;
		$statement = $db->prepare($update_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':edit_date'=>date("Y-m-d H:i:s"), ':list_id' => $listid));
		if($statement -> rowCount() != 1) return -50;
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	return true;
}
?>