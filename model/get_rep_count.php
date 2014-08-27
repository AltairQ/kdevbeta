<?php

function getRepCount($db, $user)
{
	$list_query = "SELECT * FROM `r$user` WHERE `repnext` < '".date('Y-m-d', strtotime(' +1 day'))."'";
	
	try
	{
		$statement = $db->prepare($list_query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement->execute();
		return $statement->rowCount();
		
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
}
?>