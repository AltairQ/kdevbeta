<?php
//przyjmuje za argument tablicę (username, password, etc.), waliduje i zwraca
//typ walidacji do obgadania
function validate($data)
{
	if(!($data['username']&&$data['password'])) return null;
	$username = filter_var($data['username'], FILTER_SANITIZE_SPECIAL_CHAR);
	$password = filter_var($data['password'], FILTER_SANITIZE_EMAIL);
	return array('username'=>$username, 'password' => $password);
}
?>