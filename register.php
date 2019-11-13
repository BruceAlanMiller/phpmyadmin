<?php
$page_title = 'Register ' ;
include('head_login.php');
# Check form submitted.
if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
{
  # Connect to the database.
  require ('connect_db.php'); 
  
  # Initialize an error array.
  $errors = array();

  # Check for a first name.
  if ( empty( $_POST[ 'first_name' ] ) )
  { $errors[] = 'Enter your first name.' ; }
  else
  { $fn = mysqli_real_escape_string( $link, trim( $_POST[ 'first_name' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'last_name' ] ) )
  { $errors[] = 'Enter your last name.' ; }
  else
  { $ln = mysqli_real_escape_string( $link, trim( $_POST[ 'last_name' ] ) ) ; }

  # Check for an email address:
  if ( empty( $_POST[ 'email' ] ) )
  { $errors[] = 'Enter your email address.'; }
  else
  { $e = mysqli_real_escape_string( $link, trim( $_POST[ 'email' ] ) ) ; }

  # Check for a password and matching input passwords.
  if ( !empty($_POST[ 'pass1' ] ) )
  {
    if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    { $errors[] = 'Passwords do not match.' ; }
    else
    { $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
  }
  else { $errors[] = 'Enter your password.' ; }
  
  # Check if email address already registered.
  if ( empty( $errors ) )
  {
    $q = "SELECT user_id FROM users WHERE email='$e'" ;
    $r = @mysqli_query ( $link, $q ) ;
    if ( mysqli_num_rows( $r ) != 0 ) $errors[] = 'Email address already registered. <a href="login.php">Login</a>' ;
  }
  
  # On success register user inserting into 'users' database table.
  if ( empty( $errors ) ) 
  {
    $q = "INSERT INTO users (first_name, last_name, email, pass, reg_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<div class="container"><h1>Registered!</h1><p>You are now registered.</p><p><a href="login.php">Login</a></p>'; }
  
    # Close database connection.
    mysqli_close($link); 

     
    exit();
  }
  # Or report errors.
  else 
  {
    echo '<div class="container"><h1>Error!</h1><p id="err_msg">The following error(s) occurred:<br>' ;
    foreach ( $errors as $msg )
    { echo " - $msg<br>" ; }
    echo 'Please try again.</p></div>';
    # Close database connection.
    mysqli_close( $link );
  }  
}
?>

<form action="register.php" method="post">
	<div class="container">
	
	<h1>Create Account</h1>
	
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-6">
				<label for="first_name">First Name</label>
				<hr>
				<input type="text" 
					   class="form-control" 
					   placeholder="First name"
					   name="first_name" 
					   required size="20" 
					   value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" required> 
			</div>
			<div class="col-lg-6 col-md-6 mb-6">
				<label for="last_name">Last Name</label>
				<hr>
				<input type="text" 
					   class="form-control" 
					   placeholder="Last name"
					   name="last_name" 
					   required size="20" 
					   value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 mb-12">
			<hr>
				<label for="email">Email</label>
				
				<input type="text" 
					   class="form-control" 
					   placeholder="Email" 
					   name="email" 
					   required 
					   size="20" 
					   value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required>
			<div>
		</div>
		<hr>
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-6">
				<label for="password">Create Password</label>
				<input type="password" 
					   class="form-control" 
					   placeholder="Create Password" 
					   name="pass1" 
					   required size="20" 
					   value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" required>
			</div>
			<div class="col-lg-6 col-md-6 mb-6">		
				<label for="password">Confirm Password</label>
				<input type="password" 
					   class="form-control" 
					   placeholder="Confirm Password" 
					   name="pass2" 
					   required size="20" 
					   value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required>
			</div>
		</div>
		<hr>
		<div class="row">	
			<div class="col-lg-12 col-md-12 mb-12">
				<input class="btn btn-dark btn-lg btn-block" type="submit" value="Create Account">
			<hr>
			</div>
		</div>
	</form>
	</div>
	
	
</body>
</html>



  
  
  
  
  
  
  
  
  
  
  
  
  