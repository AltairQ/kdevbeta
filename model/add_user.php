<?php
/*Pobiera uchwyt i dane, zwraca 
1 (sukces),
-100 (błąd dodania), 
-50 (już istnieje)

*/
function addUser($db, $username, $password) //ew. inne, dunno na razie, $db -> uchwyt do bazy
{
	if (getUserId($db, $username) != -50) return -50;

	$query = "INSERT INTO `users` (username, hash) VALUES(:username, :hash);";
	try
	{
		$statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':username'=>$username, ':hash' => generate_hash($password)));
		$userid = $db -> lastInsertId('id');
		if($statement->rowCount()!=1) return -100;
		$create_query = "CREATE TABLE `r$userid` ( `list_id` INT UNSIGNED NOT NULL , `word_id` INT UNSIGNED NOT NULL , `ef` FLOAT NOT NULL , `repid` INT NOT NULL , `replen` FLOAT NOT NULL , `repnext` DATE NOT NULL );";
		$db -> exec($create_query);
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
		return -100;
	}
	return 1;
}
?>