<?php

require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

addListToRep($DB, 11, $_SESSION['userid']);

?>