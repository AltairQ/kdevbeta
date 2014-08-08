<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

$Plid = $_GET['id'];

// if (checkUserPermission($DB, )) {
// 	# code...
// }

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

        for ($i=1; $i < $Plid; $i++) { 
        	
        
        ?>
            <tr>

                <td>1</td>

                <td>Jan Paweł II</td>

                <td>Papież</td>

                <td>PS to prawda</td>
                <td>
                <span class="glyphicon glyphicon-wrench" onClick="$('#myModal1').modal();"></span>
                <span class="glyphicon glyphicon-remove" style="color: red;"></span>
               
                </td>

            </tr>

        <?php
        }
        
        ?>

        

        </tbody>

    </table>


