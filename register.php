<?php
require_once 'util/inc_all.php';


if (authcheck()) {
	redirect("dashboard.php");
}

$hax = false;

if (isset($_POST['login']) && isset($_POST['password'])&& isset($_POST['passwordconf'])&& isset($_POST['email'])&& isset($_POST['emailconf'])     ) {

	$Plogin = validate($_POST['login'], "login");
	$Ppass = validate($_POST['password'], "password");
	$Ppassconf = validate($_POST['password'], "password");
	$Pemail = validate($_POST['email'], "email");
	$Pemailconf = validate($_POST['emailconf'], "email");

	$passcmp= ($Ppass == $Ppassconf);

	if ($Plogin && $Ppass && $Ppassconf && $Pemail && $Pemailconf && $passcmp) {
    if (addUser($DB, $Plogin, $Ppass) === 1) {
      redirect("login.php");
    }
    else
    {
      redirect("korwin.php");
    }
		
		
	}


}

printheader("Register");
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
<legend>Register</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="login">Login</label>  
  <div class="col-md-5">
  <input id="login" name="login" placeholder="Login" class="form-control input-md" required="" type="text">
  <span class="help-block">At least 6 characters</span>  
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="password">Password</label>
  <div class="col-md-5">
    <input id="password" name="password" placeholder="Password" class="form-control input-md" required="" type="password">
    <span class="help-block">At least 5 characters - the longer, the better</span>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="passwordconf">Re-enter password</label>
  <div class="col-md-5">
    <input id="passwordconf" name="passwordconf" placeholder="Password" class="form-control input-md" required="" type="password">
    <span class="help-block">Confirm your password</span>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email</label>  
  <div class="col-md-5">
  <input id="email" name="email" placeholder="Email" class="form-control input-md" required="" type="text">
  <span class="help-block">Email used to confirm account</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="emailconf">Re-enter email</label>  
  <div class="col-md-5">
  <input id="emailconf" name="emailconf" placeholder="Email" class="form-control input-md" required="" type="text">
  <span class="help-block">Confirm your email</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <button id="submit" name="submit" class="btn btn-primary">Register</button>
  </div>
</div>

</fieldset>
</form>


</div>

	



</div>

<script type="text/javascript">
document.getElementById("login").focus();
</script>

<?php


printjsend();


	
?>