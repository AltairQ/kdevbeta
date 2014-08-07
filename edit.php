<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}

printheader('Edit list');
printnavbar();

?>



 <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <div class="container" style= "margin-top:60px">

    <div class="jumbotron">
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

        for ($i=1; $i < 10; $i++) { 
        	
        
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


      </div>
      </div>

<?php

printjsend();

?>