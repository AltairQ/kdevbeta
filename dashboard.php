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
        <h2>DZIEŃ DOBRY KUHWA</h2>
       
        <p>
          <a class="btn btn-lg btn-primary" href="../../components/#navbar" role="button">Utwórz nową listę &raquo;</a>
        </p>
      </div>

<?php

printjsend();

?>