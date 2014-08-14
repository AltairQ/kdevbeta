<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}

printheader('Review');
printnavbar();

?>

<script type="text/javascript">
function dosth () {
$("#testid").html("done.");
  }


</script>

<div class="container" style= "margin-top:60px;" >
    <div class="jumbotron" id="loltab">
        
        <div class="panel panel-default">
          <div class="panel-body" style="text-align: center; font-size:large;" id="quebox">
            Question
          </div>
        </div>

        <div class="panel panel-default" onclick="showAnswer()">
          <div class="panel-body" style="text-align: center; font-size:large;" id="ansbox" >
            Answer
          </div>
        </div>

        <!-- <div style="width: 200px; margin-left: auto; margin-right: auto;"> -->
        <div class="btn-group btn-group-justified">
        <div class="btn-group">
        <button type="button" onclick="answer(0)" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Complete blackout">0</button>
        </div>
        <div class="btn-group">
        <button type="button" onclick="answer(1)" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Incorrect">1</button>
        </div>
        <div class="btn-group">
        <button type="button" onclick="answer(2)" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Incorrect, but seemed easy">2</button>
        </div>
        <div class="btn-group">
        <button type="button" onclick="answer(3)" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Correct with problems">3</button>
        </div>
        <div class="btn-group">
        <button type="button" onclick="answer(4)" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Correct response">4</button>
        </div>
        <div class="btn-group">
        <button type="button" onclick="answer(5)" class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Perfect response">5</button>
        </div>
        </div>
      <!--   </div> -->
      
  </div>
</div>
<?php

printjsend();

?>