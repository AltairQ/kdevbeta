<?php
require_once 'util/inc_all.php';


if (!authcheck()) {
	redirect("login.php");
}

$lid = createList($DB, $_SESSION['userid']);
addListToRep($DB, $lid, $_SESSION['userid']);
redirect("edit.php?id=$lid");

?>