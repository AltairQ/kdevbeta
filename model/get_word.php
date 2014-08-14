<?php

function getWord($db, $listid, $wordid, $userid)
{
	// if (checkUserPermission($db, $listid, $userid)==0 ) {
	// 	redirect("");
	// }

	$query = "SELECT * FROM `l$listid` WHERE `id` = ?";

	try {
		$qry =  $db->prepare($query);
		$qry -> execute(array($wordid));
		return $qry->fetch();

	} catch (Exception $e) {
		echo $e->getMessage();
		return -100;
	}	


}

?>