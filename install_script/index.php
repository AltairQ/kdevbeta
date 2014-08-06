<?php
if($_POST)
{
	try
	{
		
		if(!$_POST['port'])
			$db = new PDO('mysql:host='.$_POST['host'].';dbname='.$_POST['name'], $_POST['login'], $_POST['password'], array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
		else
			$db = new PDO('mysql:host='.$_POST['host'].';dbname='.$_POST['name'].';port='.$_POST['port'], $_POST['login'], $_POST['password'], array(PDO::ATTR_PERSISTENT => true, PDO::ERRMODE_EXCEPTION => true));
	}
	catch(Exception $e)
	{
		die($e->getMessage().'<a href="index.php">return</a>');
	}
	include("step2begin.html");
	//users
	echo '<li class="section_break">
		<h3>Creating table "users"...</h3>';
	try
	{
		$db->exec("CREATE TABLE `users` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `username` TEXT NULL DEFAULT NULL , `name` TEXT NULL DEFAULT NULL , `hash` TEXT NULL DEFAULT NULL , `mail` TEXT NULL DEFAULT NULL , `type` TINYINT NOT NULL DEFAULT '0' , PRIMARY KEY (`id`) , UNIQUE (`id`) )");
		echo ('<p>Done!</p>');
	}
	catch(PDOException $e)
	{
		echo('<p>'.$e->getMessage().'</p>');
	}
	//lists
	echo '<li class="section_break">
		<h3>Creating table "lists"...</h3>';
	try
	{
		$db->exec("CREATE TABLE `lists` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `name` TEXT NOT NULL , `creator` INT UNSIGNED NOT NULL , `creation_date` DATETIME NOT NULL , `version` INT UNSIGNED NOT NULL DEFAULT '1' , `edit_date` DATETIME NOT NULL , PRIMARY KEY (`id`) , UNIQUE (`id`) );");
		echo ('<p>Done!</p>');
	}
	catch(PDOException $e)
	{
		echo('<p>'.$e->getMessage().'</p>');
	}
	//list2user
	echo '<li class="section_break">
		<h3>Creating table "list2user"...</h3>';
	try
	{
		$db->exec("CREATE TABLE `list2user` ( `list_id` INT UNSIGNED NOT NULL , `user_id` INT UNSIGNED NOT NULL , `permission` TINYINT NOT NULL DEFAULT '0' );");
		echo ('<p>Done!</p>');
	}
	catch(PDOException $e)
	{
		echo('<p>'.$e->getMessage().'</p>');
	}
	//user2group
	echo '<li class="section_break">
		<h3>Creating table "user2group"...</h3>';
	try
	{
		$db->exec("CREATE TABLE `user2group` ( `user_id` INT UNSIGNED NOT NULL , `group_id` INT UNSIGNED NOT NULL , `permission` TINYINT NOT NULL DEFAULT '0' );");
		echo ('<p>Done!</p>');
	}
	catch(PDOException $e)
	{
		echo('<p>'.$e->getMessage().'</p>');
	}
	//db_config.php
	echo '<li class="section_break">
		<h3>Creating config file...</h3>';

		$dbinit = 
'<?php
function db_create()
{
$db_user=\'{{user}}\';
$db_pass=\'{{pass}}\';
$db_host=\'{{host}}\';
$db_name=\'{{name}}\';
$db_port= null;
return db_init($db_user, $db_pass, $db_host, $db_name, $db_port);
}
?>';

	try
	{
		if (empty($_POST['port'])) {

		file_put_contents("../model/db_config.php", //nie jestem pewien CWD, trzeba sprawdzić
			str_replace( 
			array(     '{{user}}',      '{{pass}}',         '{{host}}',     '{{name}}'),
			array($_POST['login'], $_POST['password'], $_POST['host'], $_POST['name']),
			 $dbinit));
	}
	else
	{
		file_put_contents("../model/db_config.php", 
			str_replace(
			array(     '{{user}}',      '{{pass}}',         '{{host}}',     '{{name}}',       'null'),
			array($_POST['login'], $_POST['password'], $_POST['host'], $_POST['name'], $_POST['port']),
			 $dbinit));
	}


		echo ('<p>Done!</p>');
	}
	catch(Exception $e)
	{
		echo('<p>'.$e->getMessage().'</p>');
	}
	echo '<li class="section_break">
		<h3>SENK U VEDDY MUCH MA FREND</h3>';
	include("step2end.html");
}
else
	include("step1.html");
?>
