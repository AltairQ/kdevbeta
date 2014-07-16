<?php
public funtion db_init()
{
	try
	{
		if(!file_exists('db_config.php'))
			die("Config file doesn't exist");
		require_once('db_config.php');
		if(!$port)
			$db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $pass);
		else
			$db = new PDO('mysql:host='.$host.';dbname='.$name.';port='.$port, $user, $pass);
		return $db;
	}
	catch(Exception $e)
	{
		die("Database Error");
	}
}
?>