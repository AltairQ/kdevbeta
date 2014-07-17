<?php
session_start();
require_once 'control/authcheck.php';
require_once 'control/ess.php';

if (!authcheck()) {
	redirect();
}

echo "logged in!";


?>