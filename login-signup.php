<?php
include_once 'header.php';

//If User has already logged in, redirect to dashboard page.
if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === TRUE) 
{
  redirect(SITE_URL.'/index.php');
  die();
}

 $frmsumit=false;
?>

  <div id="page-register">
  	<div class="container">
  		<?php 
  		 if(isset($_POST['loginSubmit']))
  		 {
  		 	//print_r($_POST);
  		 }
  		?>
  		<div class="row">
  			<div class="col-sm-4">
  			 	<div class="page-header">
				    <h1><img src="img/icon4.png"> Login</h1>
				</div>
				<div class="login-frm-out">				
				 <form method="post" id="login-frm">
				  <div class="panel panel-default">
	               <!-- <div class="panel-heading"><h4 class="login-head">Enter Login Details</h4></div> -->
	               <div class="panel-body">
	               	 	<div class="form-group">
	               	 		<label>Enter Username</label>
	               	 		<input type="text" name="lusername" value="" class="form-control" placeholder="Enter Username" required>
	               	 	</div>
	               	 	<div class="form-group">
	               	 		<label>Enter Password</label>
	               	 		<input type="password" name="lpassword" value="" class="form-control" placeholder="Enter Password" required>
	               	 	</div>
	               	 	<div class="form-group">
	               	 		<input type="submit" name="loginSubmit" class="btn btn-primary" value="Login">
	               	 	</div>	               
	               </div>	
	             </div>  
	           </form>
			  </div>
  			</div>
  		 <div class="col-sm-8">
	  		<div class="page-header">
			    <h1><img src="img/icon4.png"> Sign Up</h1>
			</div>
  		   <div class="signup-main-outer">
		 	<?php 			 
			  if(!$frmsumit)
			  {
			?>
		 	  <div class="signup-frm-out">
		 		<form id="signupForm"  method="post">
			 	<div class="panel panel-default">
	             <!--  <div class="panel-heading"><h4 class="login-head">Sign Up</h4></div> -->
	             <div class="panel-body">
		 		  <div class="row">	
					<div class="frm-seprator">
					  <h3 class="sec-seprator"><span>Personal Information</span></h3>
					</div>
					
					<div class="col-sm-6 col-md-6">
					  <div class="form-group">					  
						<label class="control-label">Full Name<span class="req">*</span></label>
				         <input id="full_name" class="form-control" type="text" 
					     name="full_name" placeholder="Enter Full Name" 
					     value="<?php if(isset($_POST['full_name'])){echo $_POST['full_name']; } ?>" required>
					  </div>
					</div>
										
					<div class="col-sm-6 col-md-6">
					  <div class="form-group">	
						<label class="control-label">Gender<span class="req">*</span></label>	
						<div class="form-control">
				     	 <input type="radio" name="gender" value="male" checked=""> Male
				     	 &nbsp; &nbsp;
				     	 <input type="radio" name="gender" value="female"> Female
				     	</div>
					  </div>
					</div>

					<div class="col-sm-6 col-md-6">
					   <div class="form-group">						
						 <label class="control-label">Mobile No.<span class="req">*</span></label>
							<input id="phone_number" class="form-control" type="text" 
							name="phone_number" placeholder="Mobile No" 
							value="<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number']; } ?>" required>
						</div>
					</div>

					<div class="col-sm-6 col-md-6">
						<div class="form-group">
						<label class="control-label">Email Address</label>						
						<input id="uemail" class="form-control" type="email" 
							name="uemail" placeholder="Enter Email" 
							value="<?php if(isset($_POST['uemail'])){echo $_POST['uemail']; } ?>" required>
						</div>
					</div>

						
				

					<div class="frm-seprator">
						<h3 class="sec-seprator"><span>Address</span></h3>
					</div>

					
					<div class="col-sm-12">
						<div class="form-group">
						  <label>Full Address <span class="req">*</span></label>
						  <input type="text" name="full_address" class="form-control" 
						  value="<?php if(isset($_POST['full_address'])){echo $_POST['full_address']; } ?>" placeholder="Enter Postal Address" required>
						</div>
					</div>
					
					<div class="col-sm-6 col-md-6">
					  <div class="form-group">						
						<label class="control-label">City<span class="req">*</span></label>
						<input type="text" class="form-control" name="city" id="city" 
						 value="<?php if(isset($_POST['city'])){echo $_POST['city']; } ?>" placeholder="Enter city name" required>
					  </div>
					</div>

					<div class="col-sm-6 col-md-6">
					  <div class="form-group">						
						<label class="control-label">State<span class="req">*</span></label>
						 <input type="text" name="state" class="form-control"  value="<?php if(isset($_POST['state'])){echo $_POST['state']; }?>" required>
					  </div>
					</div>
					<div class="col-sm-6 col-md-6">
					  <div class="form-group">						
						<label class="control-label">Country<span class="req">*</span></label>
						 <input type="text" name="country" value="<?php if(isset($_POST['country'])){echo $_POST['country']; }?>" class="form-control" required>
					  </div>
					</div>
					
					
					<div class="col-sm-6 col-md-6">
					  <div class="form-group">
					    <label>Pincode<span class="req">*</span></label>
					    <input type="text" name="pincode" class="form-control" 
					    placeholder="Pincode" value="<?php if(isset($_POST['pincode'])){echo $_POST['pincode']; }?>" required>
					  </div>
					</div>
					

					<!--Seprator-->
					<div class="frm-seprator">
					  <h3 class="sec-seprator"><span>Security Information</span></h3>
					</div>
					<!-- Close Seprator-->

					
					 <div class="col-sm-6 col-md-6">
					 	<div class="form-group">
						  <label class="control-label">Password</label>
						
						   <input id="password" class="form-control" type="password" name="password" placeholder="Password">
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
					 	<div class="form-group"> 
							<label class="control-label">Confirm Password:</label>
						
						   <input id="confirm_password" class="form-control" type="password" 
						   name="confirm_password" placeholder="Confirm password">
						</div>
					</div>
					
					<div class="col-sm-6 col-md-6">
					<div class="form-group">
					  <label class="control-label">Enter image code</label>	<br>				
					  <input type="text" name="sgcaptcha" class="form-control" 
						style="width:100px; display:inline-block;">
						<img src="signup-captcha.php" style="width:74px;" />
					 </div>	
					</div>						

					
					<div class="col-sm-12 text-center">
						<div class="form-group">
						  <input id="signUpBtn" class="btn btn-primary submit-btn" type="submit" 
						   name="signupbtn" value="SIGN UP">
						</div>
						 <!--<p class="signup-msg">Already have an account, Please <a href="login.php">Login</a> here.</p>-->
					</div>
				  </div>
				</div>
			   </div>
			  </form>
		 	</div>
		 <?php } ?>
		</div>
       <!--Close Sing up form-->	
      </div>
	</div>
 </div> 

<div class="clearfix"></div>
<?php include_once 'footer.php'; ?>