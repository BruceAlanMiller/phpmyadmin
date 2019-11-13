<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Checkout' ;

include ( 'head_cart.php' ) ;

# Open database connection.
require ( 'connect_db.php' ) ;
 


# Retrieve items from 'bookings' database table.
$q = "SELECT * FROM orders WHERE user_id={$_SESSION[user_id]}" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
  
  

  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
        <h2 class="text-center text-white mb-4">Your Order</h2>
        <div class="row">
          <div class="col-md-6 mx-auto">
            <!-- form  -->
            <div class="card rounded-0">
              <div class="card-header bg-dark text-light">
			   <h3 class="mb-0">Your Order</h3>
              </div>
			 
			<div class="card-body">
			<p>Total:  &pound;' . $row['total'] . '</p>
			<p>Order Ref:  ECCSc ' . $row['order_id'] . ' </p>			
			
';
  }
  
  echo '
	<form class="paypal" action="payments.php" method="post" id="paypal_form" target="_blank">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="no_note" value="'.$row['total'].'" />
		<input type="hidden" name="lc" value="UK" />
		<input type="hidden" name="currency_code" value="GBP" />
		<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
		<input type="hidden" name="first_name" value="' .$row['first_name'].'"  />
		<input type="hidden" name="last_name" value="' .$row['last_name'].'"  />
		<input type="hidden" name="item_number" value="'.$row['order_id'].'" / >
		<input class="btn btn-outline-info btn-lg btn-block"type="submit" name="submit" value="Pay Now"/>
		<a class="btn btn-dark btn-lg btn-block" href="delete.php?order_id=' .$row['order_id'] . '">Cancel</a>
	</form>';
	
 # Close database connection.
  mysqli_close( $link ) ; 
}
# Display footer section.


?>