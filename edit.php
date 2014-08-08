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
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("loltab").innerHTML=xmlhttp.responseText;
    }
  }

  function editModal (id, front, back, comment) {

    $("#editmodalid").val(id);
    $("#editmodalfront").val(front); 
    $("#editmodalback").val(back); 
    $("#editmodalcomment").val(comment);
    $("#editmodal").modal();    
  }

  function editModalApply() {
    xmlhttp.open("POST","show_list_edit.php",true);
    xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xmlhttp.send($("#editmodalform").serialize());
    $("#editmodal").modal('hide');
    
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
          <input name="lid" type="hidden" id="editmodallid" value="PHPHERE">
          <input name="id" type="hidden" id="editmodalid">
          <input name="front" type="text" id="editmodalfront">
          <input name="back" type="text" id="editmodalback">
          <input name="comment" type="text" id="editmodalcomment">
        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editModalApply()">Save changes</button>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

    <div class="jumbotron" id="loltab">
    <script type="text/javascript">
xmlhttp.open("GET","show_list_edit.php",true);
xmlhttp.send();

    </script>

      </div>
      </div>

<?php

printjsend();

?>