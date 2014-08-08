<?php

function getList($db, $listid, $userid)
{
	// if (checkUserPermission($db, $listid, $userid)==0 ) {
	// 	redirect("");
	// }

	$query = "SELECT * FROM `l$listid`";

	try {
		$qry =  $db->prepare($query);
		$qry -> execute();
		return $qry->fetchAll();

	} catch (Exception $e) {
		echo $e->getMessage();
		return -100;
	}	


}

?>