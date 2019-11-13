<?php
$page_title = 'Register ' ;
include('head_login.php');

# Display any error messages if present.
if ( isset( $errors ) && !empty( $errors ) )
{
 echo '<p id="err_msg">Oops! There was a problem:<br>' ;
 foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
 echo 'Please try again or create account.</p>' ;
}
?>



<!-- Display body section. -->

<div class="container">
	<h1>Login</h1>
</div>
                
	<div class="container">
        <div class="row">
			<div class="col-lg-6 col-md-6 mb-6">
				<form action="login_action.php" method="post">
					<div class="form-group">
						<label for="email">Email</label>
						<hr>
						<input type="text" class="form-control" placeholder="Email" name="email" required>
						<hr>
					</div>
			</div>
	
			<div class="col-lg-6 col-md-6 mb-6">		
				<div class="form-group">
					<label for="password">Password</label>
					<hr>
					<input type="password" class="form-control" placeholder="Password" name="pass" required>
					<hr>
				</div>
			</div>
		</div>
			
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-6">
				<div class="form-group">
					<input class="btn btn-dark btn-lg btn-block" type="submit" value="Login Now">
				</div>
			</div></form>

			<hr>
			
			<div class="col-lg-6 col-md-6 mb-6">	
				<form method="get" action="register.php">
				<div class="form-group">
					<input class="btn btn-dark btn-lg btn-block" type="submit" value="Create Account">
				</div>
			</div>
				</form>

 </body>
</html>
