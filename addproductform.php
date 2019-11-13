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
  if ( empty( $_POST[ 'item_name' ] ) )
  { $errors[] = 'Enter item name.' ; }
  else
  { $in = mysqli_real_escape_string( $link, trim( $_POST[ 'item_name' ] ) ) ; }

  # Check for a last name.
  if (empty( $_POST[ 'item_desc' ] ) )
  { $errors[] = 'Enter item desc.' ; }
  else
  { $desc = mysqli_real_escape_string( $link, trim( $_POST[ 'item_desc' ] ) ) ; }

  # Check for an email address:
  if ( empty( $_POST[ 'item_img' ] ) )
  { $errors[] = 'Enter item_img.'; }
  else
  { $img = mysqli_real_escape_string( $link, trim( $_POST[ 'item_img' ] ) ) ; }

 # Check for an product type:
  if ( empty( $_POST[ 'product_type' ] ) )
  { $errors[] = 'Enter product_type.'; }
  else
  { $pt = mysqli_real_escape_string( $link, trim( $_POST[ 'product_type' ] ) ) ; }

 # Check for an email address:
  if ( empty( $_POST[ 'item_price' ] ) )
  { $errors[] = 'Enter item_price.'; }
  else
  { $ip = mysqli_real_escape_string( $link, trim( $_POST[ 'item_price' ] ) ) ; }

#  # Check for a password and matching input passwords.
 # if ( !empty($_POST[ 'pass1' ] ) )
  #{
   #if ( $_POST[ 'pass1' ] != $_POST[ 'pass2' ] )
    #{ $errors[] = 'Passwords do not match.' ; }
    #else
    #{ $p = mysqli_real_escape_string( $link, trim( $_POST[ 'pass1' ] ) ) ; }
  #}
  #else { $errors[] = 'Enter your password.' ; }
  
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
    $q = "INSERT INTO products (item_name, item_desc, item_img, product_type, item_price)  VALUES ('$in', '$desc', '$img', '$pt','$ip' )";
    $r = @mysqli_query ( $link, $q ) ;
    if ($r)
    { echo '<div class="container"><h1>Registered!</h1><p>You are now registered.</p><p><a href="addproductform.php">Login</a></p>'; }
  
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

<form action="addproductform.php" method="post">
	<div class="container">
	
	<h1>Add New Product</h1>
	
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-6">
				<label for="item_name">item_name</label>
				<hr>
				<input type="text" 
					   class="form-control" 
					   placeholder="item name"
					   name="item_name" 
					   required size="20" 
					   value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?>" required> 
			</div>
			<div class="col-lg-6 col-md-6 mb-6">
				<label for="item_desc">description</label>
				<hr>
				<input type="text" 
					   class="form-control" 
					   placeholder="product description"
					   name="item_desc" 
					   required size="20" 
					   value="<?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?>" required>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12 mb-12">
			<hr>
				<label for="item_img">image</label>
				
				<input type="text" 
					   class="form-control" 
					   placeholder="item_img" 
					   name="item_img" 
					   required 
					   size="20" 
					   value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>" required>
					   </div>
					   
					   <div class="col-lg-6 col-md-6 mb-6">
				<label for="item_name">product_type</label>
				<hr>
				<input type="text" 
					   class="form-control" 
					   placeholder="product_type"
					   name="product_type" 
					   required size="20" 
					   value="<?php if (isset($_POST['product_type'])) echo $_POST['product_type']; ?>" required> 
			</div>
			<div class="col-lg-6 col-md-6 mb-6">
				<label for="item_name">item_price</label>
				<hr>
				<input type="text" 
					   class="form-control" 
					   placeholder="item_price"
					   name="item_price" 
					   required size="20" 
					   value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>" required> 
			</div>
			<div>
		</div>
		<hr>
		<!-- <div class="row">
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
		-->
		<hr>
		<div class="row">	
			<div class="col-lg-12 col-md-12 mb-12">
				<input class="btn btn-dark btn-lg btn-block" type="submit" value="Add Product">
			<hr>
			</div>
		</div>
	</form>
	</div>
	
	
</body>
</html> 



  
  
  
  
  
  
  
  
  
  
  
  
  