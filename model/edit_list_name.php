<?php

function editListName($db, $listid, $name)
{
	$query = "UPDATE `lists` SET `name` = :name WHERE `id` = :list_id";
	try
	{
		$statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':name'=>$name, ':list_id'=>$listid));
		if($statement -> rowCount() == 1) return true; else return -50;
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>