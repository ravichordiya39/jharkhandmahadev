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
?>
<p></p>
<div id="page-register" class="col-md-8 col-md-offset-2">
	<form class="form loginform" method="POST" action="postRegister.php">
		<div class="login-panel panel panel-default">
			<div class="panel-heading">Registration Form</div>
			<div class="panel-body">
				<div class="row">
					<div class="form-group col-sm-6">
						<label class="control-label">First Name</label>
						<input type="text" name="f_name" class="form-control" required="required" value="<?= isset($data_to_store['f_name'])?$data_to_store['f_name']:'' ?>">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">Last Name</label>
						<input type="text" name="l_name" class="form-control" value="<?= isset($data_to_store['l_name'])?$data_to_store['l_name']:'' ?>"/>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label class="control-label">Gender</label>
						<select name="gender" class="form-control" required>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">Email</label>
						<input type="email" name="email" class="form-control" required="required" value="<?= isset($data_to_store['email'])?$data_to_store['email']:'' ?>">
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label class="control-label">Address</label>
						<input type="text" name="address" class="form-control" required="required" value="<?= isset($data_to_store['address'])?$data_to_store['address']:'' ?>">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">City</label>
						<input type="text" name="city" class="form-control" required value="<?= isset($data_to_store['city'])?$data_to_store['city']:'' ?>"/>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="form-group col-sm-4">
						<label class="control-label">State</label>
						<input type="text" name="state" class="form-control" required="required" value="<?= isset($data_to_store['state'])?$data_to_store['state']:'' ?>">
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label">Date of birth</label>
						<input type="date" name="date_of_birth" class="form-control" required value="<?= isset($data_to_store['date_of_birth'])?$data_to_store['date_of_birth']:'' ?>"/>
					</div>
					<div class="form-group col-sm-4">
						<label class="control-label">Phone</label>
						<input type="text" name="phone" class="form-control" required value="<?= isset($data_to_store['phone'])?$data_to_store['phone']:'' ?>"/>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row">
					<div class="form-group col-sm-6">
						<label class="control-label">Password</label>
						<input type="password" name="passwd" class="form-control" required="required">
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label">Confirm password</label>
						<input type="password" name="confirm_passwd" class="form-control" required="required">
					</div>
				</div>
				<div class="clearfix"></div>
				<?php
				if(isset($_SESSION['login_failure'])){ ?>
				<div class="alert alert-danger alert-dismissable fade in">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo $_SESSION['login_failure']; unset($_SESSION['login_failure']);?>
				</div>
				<?php } ?>
				<button type="submit" class="btn btn-success loginField" >Register</button>
			</div>
		</div>
	</form>
</div>
</section>
<div class="clearfix"></div>
<?php include_once 'footer.php'; ?>