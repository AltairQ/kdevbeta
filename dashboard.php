<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}

printheader('Dashboard');
intprintnavbar($DB);
updateRecalledWords($DB, $_SESSION['userid']);
?>

    <div class="container">

    <div class="jumbotron">
      <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Joː lysts</h3>
  </div>
  <div class="panel-body">
    <?php

foreach(getListsOfUser($DB, $_SESSION['userid']) as $grp)
{


foreach ($grp['lists'] as $lst) {
  echo "<p><a href=\"show.php?id=".$lst['id']."\" >".$lst['name']."</a></p>";
}

}
    ?>
  </div>
</div>   
        <p>
          <a class="btn btn-lg btn-primary" href="newlist.php" role="button">Utwórz nową listę &raquo;</a>
        </p>
        
        <p>
          <a class="btn btn-lg btn-primary" href="rep.php" role="button">Powtórka &raquo;</a>
        </p>


     
        
      </div>

<?php

printjsend();

?>