<?php
require_once 'util/inc_all.php';


if (authcheck()) {
	redirect("dashboard.php");
}

$hax = false;

if (isset($_POST['login']) && isset($_POST['password'])) {
	$Plogin = validate($_POST['login'], "login");
	$Ppass = validate($_POST['password'], "password");

	if (($userid = getUserIdByCred($DB, $Plogin, $Ppass)) >= 0) 
	{
		logEvent("Login \"$Plogin\" success");
		$_SESSION['login']= validate($_POST['login'], "login");
		$_SESSION['userid']= $userid;
		redirect("dashboard.php");
	}
	else
	{
		logEvent("Login \"$Plogin\" fail! $userid");
		$hax = true;
	}
}

printheader("Log in");
printnavbar();

?>


<div class="container">


<div class="jumbotron" style="float:none; margin:0 auto;">
<?php if ($hax) {
	?>
<div class="alert alert-danger alert-error">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<strong>Wrong login or password!</strong>	
</div>
<?php } ?>

<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Login</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login"></label>  
  <div class="col-md-5">
  <input id="login" name="login" placeholder="Login" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password"></label>
  <div class="col-md-5">
    <input id="password" name="password" placeholder="Password" class="form-control input-md" required="" type="password">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Log in</button>
  </div>
</div>

</fieldset>
</form>
<center>
	<h6> Don't have an account? <a href="/register.php">Register.</a></h6>
</center>


</div>

	



</div>

<script type="text/javascript">
document.getElementById("login").focus();
</script>

<?php


printjsend();


	
?>