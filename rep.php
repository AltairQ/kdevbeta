<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}


if(updateRecalledWords($DB, $_SESSION['userid']) === -100)
{
  die();
}

printheader('Review');
printnavbar();



?>
<div class="alert alert-info" id="nothingalert" style="display: none">
<strong>No knowledge to repeat! <a href="dashboard.php">Click to go back</a></strong> 
</div>

<script type="text/javascript">
function showAnswer () {

  $("#ansbox").html(window.back);
  $("#buttons").show();
}

function showData (data) {
  
    window.lid = data.lid;
    window.front = data.front;
    window.back = data.back;
    window.id = data.id;
    window.front = data.front;

$("#quebox").html(window.front);
$("#ansbox").html("Show answer");
$("#buttons").hide();


}

function endStuff () {

  $("#loltab").remove();
  $("#nothingalert").detach().appendTo('#maincont');
  $("#nothingalert").show();
  
}

function getNextPair() {
  $.post( "repajax.php", { action: "getnew" }, function( data ) {

if (data.code == 0)
 {
  endStuff();
 }
 else if(data.code== 1)
 {
  showData(data);
 }

}, "json");
}


function answer(ansgrade) {
  $.post( "repajax.php", { lid: window.lid,
                           id: window.id,
                           action: "answer",
                           grade: ansgrade }, function( data ) {
if (data.code == 0)
 {
  endStuff();
 }
 else if(data.code== 1)
 {
  showData(data);
 }

}, "json");
}




</script>

<div class="container" id="maincont" >
    <div id="loltab">
        
        <div class="panel panel-default">
          <div class="panel-body" style="text-align: center; font-size:large;" id="quebox">
            Question
          </div>
        </div>

        <div class="panel panel-default" onclick="showAnswer()">
          <div class="panel-body" style="text-align: center; font-size:large;" id="ansbox" >
            Show answer
          </div>
        </div>

        <!-- <div style="width: 200px; margin-left: auto; margin-right: auto;"> -->
        <div class="btn-group btn-group-justified" id="buttons">
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
      <script type="text/javascript">
getNextPair();
      </script>
      
  </div>
</div>

</div>
<?php

printjsend();

?>