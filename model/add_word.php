<?php

function addWord($db, $listid, $front="", $back="", $comment="")
{
	$insert_query = "INSERT INTO `l".$listid."` (front, back, comment) VALUES (:front, :back, :comment)";
	$update_query = "UPDATE `lists` SET edit_date = :edit_date WHERE id=:id";
	try
	{
		$statement = $db->prepare($insert_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':front'=>$front, ':back' => $back, ":comment" => $comment));
		if($statement -> rowCount() != 1) return -50;
		$statement = $db->prepare($update_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':edit_date'=>date("Y-m-d H:i:s"), ':id' => $listid));
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