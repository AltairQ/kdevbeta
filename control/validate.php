<?php
function validate($string, $type)
{
	$ret = "";
	switch($type)
	{
		case 'login':
			$ret = filter_var(trim($string), FILTER_SANITIZE_SPECIAL_CHARS);
			break;
		case 'password':
			$ret = urlencode($string);
			break;
	}
	return $ret;
}
?>