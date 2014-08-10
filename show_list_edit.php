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

<h2>Editing list "<?php  echo getListName($DB, $Plid); ?>"</h2>


     <div class="table-responsive">

    <table class="table table-striped">

        <thead><tr>
              
               <th>Question</th>
               <th>Answer</th>
               <th>Comment</th>

            </tr>
        </thead>
        <tbody>
        <?php

        foreach ($res as $row) {              	
        
        ?>
        <tr>
                <td><?php echo $row['front'] ?></td>
                <td><?php echo $row['back'] ?></td>
                <td><?php echo $row['comment'] ?></td>
                <td>
                <span class="glyphicon glyphicon-wrench" onClick="editModal('<?php echo $row['id'] ?>', '<?php echo $row['front'] ?>', '<?php echo $row['back'] ?>', '<?php echo $row['comment'] ?>')"></span>
                <span class="glyphicon glyphicon-remove" onClick="deleteModal('<?php echo $row['id'] ?>', '<?php echo $row['front'] ?>', '<?php echo $row['back'] ?>', '<?php echo $row['comment'] ?>')"style="color: red;"></span>
                </td>              

        </tr>            

        <?php
        }
        
        ?>       

        </tbody>

    </table>
    </div>
   <button type="button" class="btn btn-success" onclick="newModal()">Add new ...</button>

