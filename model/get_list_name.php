<?php

function getListName($db, $listid)
{
	$query = "SELECT name FROM lists WHERE id = :list_id";
	try
	{
		$statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':list_id'=>$listid));
		$response = $statement->fetch(PDO::FETCH_ASSOC);
		if($response['name']==null) return -50; else return $response['name'];
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>