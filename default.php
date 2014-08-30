<?php
require_once 'util/inc_all.php';
if (authcheck()) {
  redirect("dashboard.php");
}

printheader('KNet');
printnavbar();

?>

    <div class="container">

    <div class="jumbotron">
        <h1>KNet beta</h1>
        <p>Bla bla knet cośtam</p>
        <p>Coming soon.</p>
        <p>
          <a class="btn btn-lg btn-primary" href="/login.php" role="button">Wow login. &raquo;</a>
        </p>
      </div>
      </div>

<?php

printjsend();

?>