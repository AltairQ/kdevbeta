<?php

function createList($db, $userid)
{
	$lists_query = "INSERT INTO `lists` (name, creator, creation_date, edit_date) VALUES('New list', :userid, :creation_date, :edit_date);";
	$list2user_query = "INSERT INTO `list2user` (list_id, user_id, permission) VALUES(:list_id, :user_id, :permission);";
	try
	{
		//dodaj do 'lists'
		$statement = $db->prepare($lists_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':userid'=>$userid, ':creation_date' => date("Y-m-d H:i:s"), ":edit_date" => date("Y-m-d H:i:s")));
		//pobierz id listy
		$listid = $db->lastInsertId('id');
		//stwórz tabelę
		$create_query = "CREATE TABLE  `l$listid` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `front` TEXT , `back` TEXT , `comment` TEXT , PRIMARY KEY  (`id`) , UNIQUE  (`id`) )";
		$db -> exec($create_query);
		//dodaj do 'list2user'
		$statement = $db->prepare($list2user_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':list_id'=>$listid, ':user_id' => $userid, ":permission" => 2));
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	return $listid;
}
?>