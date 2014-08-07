<?php

function createList($db, $userid)
{
	$insert_query = "INSERT INTO `lists` (name, creator, creation_date, edit_date) VALUES('New list', :userid, :creation_date, :edit_date);";
	try
	{
		$statement = $db->prepare($insert_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':userid'=>$userid, ':creation_date' => date("Y-m-d H:i:s"), ":edit_date" => date("Y-m-d H:i:s")));
		$create_query = "CREATE TABLE  `l".$db->lastInsertId('id')."` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `front` TEXT , `back` TEXT , `comment` TEXT , PRIMARY KEY  (`id`) , UNIQUE  (`id`) )";
		if($statement->rowCount()==1)
			return 1;
		else
			return 0;
		$db -> exec($create_query);
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return 0;
	}
}
?>