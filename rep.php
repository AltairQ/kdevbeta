<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}

printheader('Review');
printnavbar();

?>
<div class="container" style= "margin-top:60px;" >
    <div class="jumbotron" id="loltab">
        
        <div class="panel panel-default">
          <div class="panel-body" style="text-align: center; font-size:large;">
            Question
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-body" style="text-align: center; font-size:large;">
            Answer
          </div>
        </div>

       
        <div class="btn-group btn-group-justified">
        <div class="btn-group">
        <button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Complete blackout">0</button>
        </div>
        <div class="btn-group">
        <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Incorrect">1</button>
        </div>
        <div class="btn-group">
        <button type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Incorrect, but seemed easy">2</button>
        </div>
        <div class="btn-group">
        <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Correct with problems">3</button>
        </div>
        <div class="btn-group">
        <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Correct response">4</button>
        </div>
        <div class="btn-group">
        <button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Perfect response">5</button>
        </div>
        </div>
         
  </div>
</div>
<?php

printjsend();

?>