<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

if ($_GET['lid'] == '') {
    ?>
    <div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Choose a list to edit...</strong>   
</div>
    <?php
    die();
}

$Plid = filter_var($_GET['lid'], FILTER_SANITIZE_NUMBER_INT);
$Pid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$noperm = false;


if (checkUserPermission($DB, $Plid, $_SESSION['userid'])!=2)
{
    ?>

   <div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Sorry my friend, no permissions to edit!</strong>   
</div>

    <?php
    die();
} 

   
   if ($_GET['act'] == "edit")
    {
        editWord($DB, $Plid, $Pid, validate($_GET['front'], "login"), validate($_GET['back'], "login"), validate($_GET['comment'], "login"));

    }
   
   if ($_GET['act'] == "new")
    {
        addWord($DB, $Plid, validate($_GET['front'], "login"), validate($_GET['back'], "login"), validate($_GET['comment'], "login"));

    }
   
   if ($_GET['act'] == "delete")
    {
        deleteWord($DB, $Plid, $Pid);
    }

$res = getList($DB, $Plid, $_SESSION['userid']);
if ($res === -100) 
    die("List does not exist");

if (empty($res)) 
    echo "Empty list.";

?>

<h2>Blah.</h2>

