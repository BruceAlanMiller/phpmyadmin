<?php # DISPLAY SHOPPING CART ADDITIONS PAGE.

# Access session.
session_start() ;

# Set page title and display header section.
$page_title = 'User Account' ;



# Open database connection.
require ( 'connect_db.php' ) ;

include('head_cart.php');

# Get passed product id and assign it to a variable.
if ( isset( $_GET['id'] ) ) $id = $_GET['id'] ; 



# Retrieve selective item data from 'shop' database table. 
$q = "SELECT * FROM products WHERE item_id = $id" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) == 1 )
{
  $row = mysqli_fetch_array( $r, MYSQLI_ASSOC );

  # Check if cart already contains one of this product id.
  if ( isset( $_SESSION['cart'][$id] ) )
  { 
    # Add one more of this product.
    $_SESSION['cart'][$id]['quantity']++; 
    echo '<div class="col-lg-9">

        <div class="card mt-4">
		<img class="card-img-top img-fluid" src='. $row['item_img'].'>
			<div class="card-body">
            <h3 class="card-title">' . $row['item_name'] .'</h3>
			<h4>&pound ' . $row['item_price'] . '</h4>
			<p class="card-text">' . $row['item_desc'] . '</p>
			</div>
			
            <div class="card-footer">
			<a href="cart.php" class="btn btn-primary btn-block"  role="button"><span class="glyphicon glyphicon-shopping-cart"></span> VIEW CART</a>
			<a href="index.php" class="btn btn-success btn-block">Continue Shopping</a>	
			</div>
		  </div>';
  } 
  else
  {
    # Or add one of this product to the cart.
    $_SESSION['cart'][$id]= array ( 'quantity' => 1, 'price' => $row['item_price'] ) ;
  echo '<div class="col-lg-9">

        <div class="card mt-4">
		<img class="card-img-top img-fluid" src='. $row['item_img'].'>
			<div class="card-body">
            <h3 class="card-title">' . $row['item_name'] .'</h3>
			<h4>&pound ' . $row['item_price'] . '</h4>
			<p class="card-text">' . $row['item_desc'] . '</p>
			</div>
			
            <div class="card-footer">
			<a href="cart.php" class="btn btn-primary btn-block"  role="button">View Cart</a>
			<a href="index.php" class="btn btn-success btn-block">Continue Shopping</a>	
			</div>
		  </div>';
  }
}

# Close database connection.
mysqli_close($link);




?>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>			