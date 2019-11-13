<?php # DISPLAY SHOPPING CART PAGE.

# Access session.
session_start() ;

# Redirect if not logged in.
if ( !isset( $_SESSION[ 'user_id' ] ) ) { require ( 'login_tools.php' ) ; load() ; }

# Set page title and display header section.
$page_title = 'Reservation' ;
include ( 'head_cart.php' ) ;

# Open database connection.
require ( 'connect_db.php' ) ;
 
# Retrieve items from 'orders' database table.
$q = "SELECT * FROM orders WHERE user_id={$_SESSION[user_id]}" ;
$r = mysqli_query( $link, $q ) ;
if ( mysqli_num_rows( $r ) > 0 )
{
  
  echo '<div class="container">
			<div class="table-responsive">
				<table class="table">
				<thead class="thead-dark">
				<tr>
				<th scope="col">order Refrence No.</th>
				<th scope="col">Total</th>
				<th scope="col">Order Date</th>
				<th scope="col">Status</th>
				<th scope="col">Delete</th>
				</tr>
				</thead>
				';

  while ( $row = mysqli_fetch_array( $r, MYSQLI_ASSOC ))
  {
    echo '	<tbody>
			<tr>
			<td>' . $row['order_id'] . '</td>
			<td>' . $row['total'] . '</td>
			<td>'  . $row['order_date'] . '</td>
			<td>Being processed</td>
			<td><a href="delete.php?order_id=' .$row['order_id'] . '">Cancel Order</a></td>
				
				
';
  }
	echo '</tr>
		  </tbody>
		  </table> ';  
  # Close database connection.
  mysqli_close( $link ) ; 
}

?>