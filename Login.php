<?php
 ob_start();
 session_start();
 include_once('Includes/Connection.php');
 $table_name = "tblusermaster";
 $emailError = "";
 $passError = "";
 // it will never let you open index(login) page if session is set
 if (isset($_SESSION['user'])) {
 	echo "You have already Logged into system.!";
	header("refresh:3, url = index.php");
  exit;
 }
 else {
 $error = false;
 
 if( isset($_POST['submit']) ) { 
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['UserMail']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['UserPswd']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
  
  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } 
  else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }
  
  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }
  
  // if there's no error, continue to login
  if (!$error) {
   $password = md5($pass); // password hashing using SHA256
   $qry = "SELECT UserID,username, password, UserGroupID FROM $table_name WHERE Email='$email' and password='$password'";
   $result = mysqli_query($con, $qry);
   $row = mysqli_fetch_array($result);
   $count = mysqli_num_rows($result); // if uname/pass correct it returns must be 1 row
   if( $count == 1 && $row[2]==$password ) {
   		if($row[3] != 1)
   		{
   			$_SESSION['user'] = $row[0];
    		header("Location: index.php");
		}
		else
		{
			$_SESSION['login_admin'] = $row[0];
			header("Location: Admin/index.php");
		}
   } 
   else 
   {
    $errMSG = "Incorrect Entries, Try again..!";
   }
    
  }
  
 } }
?>

<?php include_once('HeaderNavigation.php'); ?>
  <div class="w3l_banner_nav_right">
		<div class="w3_login">
			<h3>Sign In & Sign Up</h3>
			<div class="module form-module">
				  <div class="toggle"><i class="fa fa-times fa-pencil"></i>
					<div class="tooltip">Click to Register</div>
					 </div>
				  <div class="form">
					<h2>Login to your account</h2>
					
					<form class="" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
		            	<?php if ( isset($errMSG) ) { ?>
					    <div>
					        <div class="alert alert-danger">
					    		<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
					        </div>
					    </div> <?php } ?>
						<div>
						
							<div>
								<div>
									<input type="text"  name="UserMail" id="user_mail"  placeholder="Enter Registered Email ID"/>
								</div>
								<span class="text-danger"><?php echo $emailError; ?></span>
							</div>
						</div>

						<div>
							<div>
								<div>
									<input type="password" class="form-control" name="UserPswd" id="userpswd" placeholder="Enter Password"/>
								</div>
								<span class="text-danger"><?php echo $passError; ?></span>
							</div>
						</div>
						<div>
							<input type="submit" id="btnlogin" class="btn btn-primary btn-lg btn-block login-button" value="Log In" name="submit">
						</div>
					</form>
					
				  </div>
				   <div class="form">
					<h2>Create an account</h2>
					<form action="StoreData.php" method="post">
					  <input type="text" name="Username" placeholder="Username" required=" " id="uname">
					  <input type="password" name="Password" placeholder="Password" required=" " id="u_pass1">
					  <input type="email" name="Email" placeholder="Email Address" required=" " id="u_mail">
					  <input type="text" name="Phone" placeholder="Phone Number" required=" " id="u_mob">
					  <input type="submit" value="Register" name="Register">
					</form>
				  </div>
				  <div class="cta"><a href="changepassword.php">Forgot your password?</a></div>
				</div>
			</div>
			<script>
				$('.toggle').click(function(){
				  // Switches the Icon
				  $(this).children('i').toggleClass('fa-pencil');
				  // Switches the forms  
				  $('.form').animate({
					height: "toggle",
					'padding-top': 'toggle',
					'padding-bottom': 'toggle',
					opacity: "toggle"
				  }, "slow");
				});
			</script>
		</div>
	</div>
<div class="clearfix"></div>
<?php ob_end_flush(); ?>
<?php include_once('Footer.php'); ?>