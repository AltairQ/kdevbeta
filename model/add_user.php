<?php
/*Pobiera uchwyt i dane, zwraca 
1 (sukces),
0 (błąd dodania), 
-1 (już istnieje)

*/
function addUser($db, $username, $password) //ew. inne, dunno na razie, $db -> uchwyt do bazy
{
	if (!($db&&$username&&$password)) return 0;


	if (checkUser($db, $username)) {
		return -1;
	}


	$query = "INSERT INTO users VALUES(:username, :hash);";
	try
	{
		$statement = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$statement -> execute(array(':username'=>$username, ':hash' => generate_hash($password)));
		if($statement->rowCount()==1)
			return 1;
		else
			return 0;
	}
	catch (PDOException $e)
	{
		die("PDO error");
	}
	catch (Exception $e)
	{
		die("Unable to add user");
	}
}
?>