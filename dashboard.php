<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}

printheader('Dashboard');
printnavbar();

?>

    <div class="container" style= "margin-top:60px">

    <div class="jumbotron">
        <h1>NO JAK TAM <?php echo $_SESSION['login'] ?>?</h1>
        <h2>DZIEŃ DOBRY</h2>
       
        <p>
          <a class="btn btn-lg btn-primary" href="newlist.php" role="button">Utwórz nową listę &raquo;</a>
        </p>
        
        <p>
          <a class="btn btn-lg btn-primary" href="rep.php" role="button">Powtórka &raquo;</a>
        </p>
        
        <p>
          <a class="btn btn-lg btn-primary" href="https://www.youtube.com/watch?v=fU02v-3TSFw" role="button">Papaj &raquo;</a>
        </p>
        
      </div>

<?php

printjsend();

?>