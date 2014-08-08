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

</script>

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

    <div class="jumbotron" id="loltab">
    <script type="text/javascript">
xmlhttp.open("GET","show_list.php",true);
xmlhttp.send();

    </script>

      </div>
      </div>

<?php

printjsend();

?>