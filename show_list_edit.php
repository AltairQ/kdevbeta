<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

$Plid = filter_var($_GET['lid'], FILTER_SANITIZE_NUMBER_INT);

// if (checkUserPermission($DB, )) {
// 	# code...
// }

echo rand();
$res = getList($DB, $Plid, $_SESSION['id']);
if (empty($res) || $res === -100) {
    die("NOPE");
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
                <span class="glyphicon glyphicon-remove" style="color: red;"></span>
               
                </td>
               

            </tr> 
           

        <?php
        }
        
        ?>

        

        </tbody>

    </table>


