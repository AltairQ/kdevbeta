<?php
// require_once 'util/inc_all.php';
foreach (glob("control/*.php") as $filename)
{
    require_once $filename;
}

foreach (glob("view/*.php") as $filename)
{
    require_once $filename;
}

if (authcheck()) {
	redirect("dashboard.php");
}

if (isset($_POST['login']) && isset($_POST['password'])) {
	die("k.");
}

printheader();
printnavbar();

?>
<div class="container" style= "margin-top:30px">
<div class="jumbotron" style="float:none; margin:0 auto;">
<div style="margin: 0 auto; width:80%;">

<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Log in to proceed</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="login"></label>
  <div class="controls">
    <input id="login" name="login" placeholder="Login" class="input-large" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="password"></label>
  <div class="controls">
    <input id="password" name="password" placeholder="Password" class="input-large" required="" type="password">
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="apply"></label>
  <div class="controls">
    <button id="apply" name="apply" class="btn btn-primary">Log in</button>
  </div>
</div>

</fieldset>
</form>
</div>

	
</div>


</div>

<?php


printjsend();


	
?>