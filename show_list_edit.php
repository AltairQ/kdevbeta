<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

$Plid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

// if (checkUserPermission($DB, )) {
// 	# code...
// }

echo rand();
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

        for ($i=1; $i < $Plid+30; $i++) { 
        	
        
        ?>
        <tr>
               
                <td><?php echo $i ?></td>

                <td>TEST</td>

                <td>TEST</td>

                <td>nadal TEST</td>
                <td>
                <span class="glyphicon glyphicon-wrench" onClick="editModal('lol', 'lol', 'lol', 'lol')"></span>
                <span class="glyphicon glyphicon-remove" style="color: red;"></span>
               
                </td>
               

            </tr> 
           

        <?php
        }
        
        ?>

        

        </tbody>

    </table>


