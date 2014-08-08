<?php
require_once 'util/inc_all.php';


if (!authcheck()) {
	redirect("login.php");
}

$lid = createList($DB, $_SESSION['id']);
redirect("edit.php?id=$lid");

?>