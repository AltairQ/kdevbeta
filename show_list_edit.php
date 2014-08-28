<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}


if (!empty($_POST['pk'])) {
    if (!empty($_POST['value'])) {
        
    
    $pk =  filter_var($_POST['pk'], FILTER_SANITIZE_NUMBER_INT);
    $val = validate(substr(trim($_POST['value']), 0, 40), "login");

    if (checkUserPermission($DB, $pk, $_SESSION['userid'])==2) {
        editListName($DB, $pk, $val);
    }
}
}

if ($_POST['lid'] == '') {
    ?>
    <div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Choose a list to edit...</strong>   
</div>
    <?php
    die();
}

$Plid = filter_var($_POST['lid'], FILTER_SANITIZE_NUMBER_INT);
$Pid = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
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

   
   if ($_POST['act'] == "edit")
    {
        editWord($DB, $Plid, $Pid, validate($_POST['front'], "login"), validate($_POST['back'], "login"), validate($_POST['comment'], "login"));

    }
   
   if ($_POST['act'] == "new")
    {
        addWord($DB, $Plid, validate($_POST['front'], "login"), validate($_POST['back'], "login"), validate($_POST['comment'], "login"));

    }
   
   if ($_POST['act'] == "delete")
    {
        deleteWord($DB, $Plid, $Pid);
    }

$res = getList($DB, $Plid, $_SESSION['userid']);
if ($res === -100) 
    die("List does not exist");

if (empty($res)) 
    echo "Empty list.";

?>

<h2>Editing list "<a href="#" id="listname" data-type="text" data-pk="<?php  echo $Plid; ?>" data-url="/show_list_edit.php" ><?php  echo getListName($DB, $Plid); ?></a>"</h2>

<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
    $(document).ready(function() {
    $('#listname').editable();
    });
</script>

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
                <span class="glyphicon glyphicon-wrench" style="cursor: pointer;" onClick="editModal('<?php echo $row['id'] ?>', '<?php echo $row['front'] ?>', '<?php echo $row['back'] ?>', '<?php echo $row['comment'] ?>')"></span>
                <span class="glyphicon glyphicon-remove" style="cursor: pointer; color: red;" onClick="deleteModal('<?php echo $row['id'] ?>', '<?php echo $row['front'] ?>', '<?php echo $row['back'] ?>', '<?php echo $row['comment'] ?>')" ></span>
                </td>              

        </tr>            

        <?php
        }
        
        ?>       

        </tbody>

    </table>
    </div>
   <button type="button" class="btn btn-success" onclick="newModal()">Add new ...</button>

