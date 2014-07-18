<?php
//zwraca uchwt do bazy lub null
function db_init($db_user, $db_pass, $db_host, $db_name, $db_port=null)
{
	try
	{
		if(empty($port))
			$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
		else
			$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';port='.$db_port, $db_user, $db_pass, array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
	}
	catch(Exception $e)
	{
		die("Database Error".$e->getMessage());
	}
	return $db;
}
?>