<?php
 // Original PHP code by Chirp Internet: www.chirp.com.au 
 // Please acknowledge use of this code by including this header.
 // bla bla bla
	

	//generowanie blowfisha z losowym saltem
	function generate_hash($input, $rounds = 10)
	{
		$salt = "";
		$salt_chars = array_merge(range('A','Z'), range('a','z'), range(0,9));
		for($i=0;$i < 22;$i++){
		$salt .= $salt_chars[array_rand($salt_chars)];
		} 
		return crypt($input, sprintf('$2y$%02d$', $rounds) . $salt);
	}

	//sprawdzenie hashy - hash jest od razu saltem
	function check_hash($pass, $hash)
	{
		return (crypt($pass, $hash)===$hash);
	}

?>
