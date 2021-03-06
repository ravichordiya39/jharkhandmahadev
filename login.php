<?php
include_once 'header.php';
?>
<div class="clearfix"></div>
<section class="sliderSec">
<?php
//If User has already logged in, redirect to dashboard page.
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE) {
    header('Location:index.php');
}

//If user has previously selected "remember me option", his credentials are stored in cookies.
if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
{
	//Get user credentials from cookies.
	$username = filter_var($_COOKIE['username']);
	$passwd = filter_var($_COOKIE['password']);
	$db->where ("email", $username);
	$db->where ("passwd", $passwd);
    $row = $db->get('customers');

    if ($db->count >= 1) 
    {
    	//Allow user to login.
        $_SESSION['user_logged_in'] = TRUE;
        $_SESSION['admin_type'] = $row[0]['admin_type'];
        header('Location:index.php');
        exit;
    }
    else //Username Or password might be changed. Unset cookie
    {
    unset($_COOKIE['username']);
    unset($_COOKIE['password']);
    setcookie('username', null, -1, '/');
    setcookie('password', null, -1, '/');
    header('Location:login.php');
    exit;
    }
}

?>
<p></p>
<div id="page-register" class="col-md-4 col-md-offset-4">
	<form class="form loginform" method="POST" action="authenticate.php">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Please Sign in</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label">Email</label>
					<input type="email" name="username" class="form-control" required="required">
				</div>
				<div class="form-group">
					<label class="control-label">password</label>
					<input type="password" name="passwd" class="form-control" required="required">
				</div>
				<div class="checkbox">
					<label>
						<input name="remember" type="checkbox" value="1">Remember Me
					</label>
				</div>
				<?php
				if(isset($_SESSION['login_failure'])){ ?>
				<div class="alert alert-danger alert-dismissable fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']);?>
				</div>
				<?php } ?>
				<button type="submit" class="btn btn-success loginField" >Login</button>

				<div class="form-group">
					<label class="control-label"><a href="register.php">Create new account</a></label>
				</div>
			</div>
		</div>
	</form>
</div>
</section>
<div class="clearfix"></div>
<?php include_once 'footer.php'; ?>