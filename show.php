<?php
require_once 'util/inc_all.php';

if (!authcheck()) {
	die();
}

printheader('Show list');
intprintnavbar($DB);

if ($_GET['id'] == '') {
    ?>
    <div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Choose a list to show...</strong>   
</div>
    <?php
    die();
}

$Plid = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


if (checkUserPermission($DB, $Plid, $_SESSION['userid']) < 1 )
{
    ?>

   <div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Sorry my friend, no permissions to show!</strong>   
</div>

    <?php
    die();
} 


?>

    <div class="container" style= "margin-top:60px">

    <div class="jumbotron" id="loltab">

<?php

$res = getList($DB, $Plid, $_SESSION['userid']);
if ($res === -100) 
    die("List does not exist");

if (empty($res)) 
    echo "Empty list.";

?>


<h2>Viewing list "<?php  echo getListName($DB, $Plid); ?>"</h2>


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
                          

        </tr>            

        <?php
        }
        
        ?>       

        </tbody>

    </table>
    </div>

      </div>
      </div>


<?php

printjsend();

?>