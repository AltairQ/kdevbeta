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
	try
	{
		mkdir("./model");
		$file=fopen("./model/db_config.php", "w");
		fwrite($file, '<?php');
		fwrite($file, "\n");
		fwrite($file, '//tylko mysql');
		fwrite($file, "\n");
		fwrite($file, 'function db_create()');
		fwrite($file, "\n");
		fwrite($file, '{');
		fwrite($file, "\n");
		fwrite($file, '$db_user=\''.$_POST['login'].'\';');
		fwrite($file, "\n");
		fwrite($file, '$db_pass=\''.$_POST['password'].'\';');
		fwrite($file, "\n");
		fwrite($file, '$db_host=\''.$_POST['host'].'\';');
		fwrite($file, "\n");
		fwrite($file, '$db_name=\''.$_POST['name'].'\';');
		fwrite($file, "\n");
		if($_POST['port'])
			fwrite($file, '$db_port=\''.$_POST['port'].'\';');
		else
			fwrite($file, '$db_port=null;');
		fwrite($file, "\n");
		fwrite($file, 'return db_init($db_user, $db_pass, $db_host, $db_name, $db_port);');
		fwrite($file, "\n");
		fwrite($file, '}');
		fwrite($file, "\n");
		fwrite($file, '?>');
		echo ('<p>Done!</p>');
	}
	catch(Exception $e)
	{
		echo('<p>'.$e->getMessage().'</p>');
	}
	echo '<li class="section_break">
		<h3>SENK U VEDDY MUCH</h3>';
	include("step2end.html");
}
else
	include("step1.html");
?>
