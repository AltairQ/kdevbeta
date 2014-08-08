<?php

function editWord($db, $listid, $wordid, $front, $back, $comment)
{
	$word_query = "UPDATE `l".$listid."` SET `front` = :front, `back` = :back, `comment` = :comment WHERE `id` = :word_id";
	$list_query = "UPDATE `lists` SET edit_date = :edit_date WHERE `id`=:list_id";
	try
	{
		$statement = $db->prepare($word_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':front'=>$front, ':back' => $back, ":comment" => $comment, ":word_id" => $wordid));
		if($statement -> rowCount() != 1) return -50;
		$statement = $db->prepare($list_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
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