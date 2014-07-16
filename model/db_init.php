<?php
//zwraca uchwt do bazy lub null
function db_init()
{
	try
	{
		if(!file_exists('db_config.php'))
			die("Config file doesn't exist");
		require_once('db_config.php');
		if(!$port)
			$db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass, array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
		else
			$db = new PDO('mysql:host='.$host.';dbname='.$name.';port='.$port, $user, $pass, array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
	}
	catch(Exception $e)
	{
		die("Database Error");
	}
	return $db;
}
?>