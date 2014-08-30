<?php
session_start();
require_once 'util/inc_all.php';

if (!authcheck()) {
	redirect();
}

printheader('Edit list');
printnavbar();

?>


<script type="text/javascript">

  function editModal (id, front, back, comment) {

    $("#editmodalid").val(id);
    $("#editmodalfront").val(front); 
    $("#editmodalback").val(back); 
    $("#editmodalcomment").val(comment);
    $("#editmodal").modal();    
  }

  function editModalApply() {
    $.post( "show_list_edit.php", $("#editmodalform").serialize(), function( data ) {
 $("#loltab").html(data);
});
    $("#editmodal").modal('hide');
    
  }


  function newModal () {
    $("#newmodal").modal();  
  }

  function newModalApply() {

$.post( "show_list_edit.php", $("#newmodalform").serialize(), function( data ) {
 $("#loltab").html(data);
});
    $("#newmodal").modal('hide');
    $("#newmodalform").trigger('reset');
    
  }

    function deleteModal (id, front, back, comment) {

    $("#deletemodalid").val(id);
    $("#deletemodalwhat").html(front+" | "+back+" | "+comment); 
    $("#deletemodal").modal();    
  }


  function deleteModalApply() {

    $.post( "show_list_edit.php", $("#deletemodalform").serialize(), function( data ) {
 $("#loltab").html(data);
});

    $("#deletemodal").modal('hide');



    
  }




</script>

 <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit value</h4>
      </div>
      <div class="modal-body">
        <form id="editmodalform">
          <input name="act" type="hidden" value="edit">
          <input name="lid" type="hidden" id="editmodallid" value="<?php echo $_GET['id']; ?>">
          <input name="id" type="hidden" id="editmodalid">
          <input name="front" type="text" id="editmodalfront">
          <input name="back" type="text" id="editmodalback">
          <input name="comment" type="text" id="editmodalcomment">
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Abort</button>
        <button type="button" class="btn btn-primary" onclick="editModalApply()">Edit</button>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete value</h4>
      </div>
      <div class="modal-body">
      <form id="deletemodalform">
          <input name="act" type="hidden" value="delete">
          <input name="lid" type="hidden" id="deletemodallid" value="<?php echo $_GET['id']; ?>">
          <input name="id" type="hidden" id="deletemodalid">
      </form>
        <p id="deletemodalwhat"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Abort</button>
        <button type="button" class="btn btn-primary" onclick="deleteModalApply()">Delete</button>
      </div>
    </div>
  </div>
  </div>

 <div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new</h4>
      </div>
      <div class="modal-body">
          <form id="newmodalform">
          <input name="act" type="hidden" value="new">
          <input name="lid" type="hidden" id="newmodallid" value="<?php echo $_GET['id']; ?>">
          <input name="front" type="text" id="newmodalfront">
          <input name="back" type="text" id="newmodalback">
          <input name="comment" type="text" id="newmodalcomment">
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="newModalApply()">Add</button>
      </div>
    </div>
  </div>
</div>



    <div class="container">

    <div class="jumbotron" id="loltab">
    <script type="text/javascript">


 $.post( "show_list_edit.php", { lid: <?php echo $_GET['id']; ?> }, function( data ) {
 $("#loltab").html(data);
});


    </script>

      </div>
      </div>

<?php

printjsend();

?>