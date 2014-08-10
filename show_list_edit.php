<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

var_dump($_GET);

$Plid = filter_var($_GET['lid'], FILTER_SANITIZE_NUMBER_INT);
$Pid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
$noperm = false;


if (!empty($_GET['act']))
{
   
   if ($_GET['act'] == "edit")
    {
   if (checkUserPermission($DB, $Plid, $_SESSION['userid'])==2) 
    {
        editWord($DB, $Plid, $Pid, validate($_GET['front'], "login"), validate($_GET['back'], "login"), validate($_GET['comment'], "login"));
    }
    else
    {
     $noperm = true;
   }
    }
}



// if (checkUserPermission($DB, )) {
// 	# code...
// }


echo rand();
$res = getList($DB, $Plid, $_SESSION['userid']);
if ($res === -100) 
    die("List does not exist");

if (empty($res)) 
    echo "Empty list.";

if ($noperm === true) { //czy to kiedykolwiek się przyda? dunno.
    
    ?>

    <div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Sorry my friend, no permissions to edit!</strong>   
</div>
    <?php

}

?>

<h2>Editing list TESTOPOLECA</h2>


     

    <table class="table table-striped">

        <thead><tr>
               <th>Id</th>
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
               
                <td><?php echo $row['id'] ?></td>

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
   <button type="button" class="btn btn-success" onclick="newModal()">Add new ...</button>

